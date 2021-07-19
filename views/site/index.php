<?php

/* @var $this yii\web\View */

/**
* @val $dataprovider
*/

use yii\grid\Column;
use yii\grid\GridView;

$this->title = 'My Yii Application';

$last = "https://iotservertest.herokuapp.com/last";
$json = json_decode(file_get_contents($last))[0];

$lastten = "https://iotservertest.herokuapp.com/lastten";
$json_ten = json_decode(file_get_contents($lastten));

$this->registerJs(' 
    setInterval(function(){  
        
    }, 10000);', \yii\web\VIEW::POS_HEAD
); 

?>
<div class="site-index">

    <div class="body-content">
        <div class = "row">
            <div class="col-lg-6">
                <div class = "panel panel-default">
                    <div class="panel-heading">
                        Lote: 1
                    </div>
                    <div id = "lote1" class="panel-body">
                        <div class="jumbotron">
                            <h2>Temp. atual</h1>
                            <h3><?= $json->temperature ?></h3>
                        </div>
                        <hr>
                        
                        <div class = "panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    picos de temperatura
                                </h4>
                            </div>
                            <div class="panel-body">
                                <?= GridView::widget([
                                    'dataProvider' => $dataprovider,
                                    'columns' =>[

                                        'temperature',
                                        'createdAt'
                                
                                    ]
                                ]) ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            

        </div>

    </div>
</div>