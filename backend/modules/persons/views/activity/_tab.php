<?php
use yii\bootstrap\Tabs;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo Tabs::widget([
    'items' => [
        [
            'label' => 'เลือกกิจกรรม',
            'content' => $this->render('_list', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                        
            ]),
            'active' => true
        ],
        [
            'label' => 'เพิ่มกิจกรรมใหม่',
            'content' => $this->render('_form', [
                    'model' => $model,
                        
            ]),
           // 'headerOptions' => [...],
            'options' => ['id' => 'myveryownID'],
        ],        
        
    ],
]);