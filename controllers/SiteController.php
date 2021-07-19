<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\grid\Column;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $last = "https://iotservertest.herokuapp.com/last";
        $json = json_decode(file_get_contents($last))[0];

        $lastten = "https://iotservertest.herokuapp.com/all";
        $json_ten = json_decode(file_get_contents($lastten));

        $warning = array();

        foreach($json_ten as $temp){
            if($temp->temperature > 34.3){
                array_push($warning, $temp);
            }
        }

        $dataprovider = new ArrayDataProvider([
            'allModels' => $warning,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' =>[
                'attributes' => ['_id']
            ]
        ]);
        return $this->render('index', ['dataprovider' => $dataprovider, 'json' => $json]);

    }

    public function actionUpdate(){

        $last = "https://iotservertest.herokuapp.com/last";
        $json = json_decode(file_get_contents($last))[0];

        echo $json->temperature;

    }

    public function actionUpdategrid(){
        
        $lastten = "https://iotservertest.herokuapp.com/all";
        $json_ten = json_decode(file_get_contents($lastten));

        $warning = array();

        foreach($json_ten as $temp){
            if($temp->temperature > 34.3){
                array_push($warning, $temp);
            }
        }

        $dataprovider = new ArrayDataProvider([
            'allModels' => $warning,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' =>[
                'attributes' => ['_id']
            ]
        ]);

        echo GridView::widget([
            'options' =>['id' => 'gridTemp'],
            'dataProvider' => $dataprovider,
            'columns' =>[

                'temperature',
                'createdAt'
    
            ]]
        );

    }
    
}
