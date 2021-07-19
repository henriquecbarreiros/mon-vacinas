<?php

/* @var $this yii\web\View */

/**
* @val $dataprovider
* @val $json
*/

use yii\grid\Column;
use yii\grid\GridView;

$this->title = 'iotWebside';

$this->registerJs(' 
    setInterval(function(){  
        $.post(
            "index.php?r=site/update",
            function(data){
                $("#tempAtual").html(data);
            }
        ),
        $.post(
            "index.php?r=site/updategrid",
            function(data){
                $("#gridTemp").html(data);
            }
        )


    }, 5000);', \yii\web\VIEW::POS_HEAD
);

?>
<div class="site-index">

    <div class="body-content">

        <div class = "row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class = "panel panel-primary">
                   
                    <div class="panel-heading">
                        <center>
                            <h2>Lote Astrazenica</h2>
                        </center>
                    </div>
                    
                    <div class="panel-body">
                        <div class="jumbotron">
                            <h2>Temp. atual</h1>
                            <h3 id = "tempAtual"><?= $json->temperature ?></h3>
                        </div>
                        <hr>
                        
                        <div class = "panel panel-default">
                            <div class="panel-heading">
                                <center>
                                <h4 class="panel-title">
                                    picos de temperatura
                                </h4>
                                </center>
                            </div>
                            <div class="panel-body">
                                <?= GridView::widget([
                                    'options' =>['id' => 'gridTemp'],
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
