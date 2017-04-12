<?php
use yii\widgets\ListView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = $model->art_cate_title;
$this->params['breadcrumbs'][] = $this->title;
?>


<?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_listItem',
                'itemOptions' => [
                    'class' => 'col-sm-12 col-md-12',
                ],
                'layout' =>  '<div class="col-sm-12 col-md-12">{summary}</div>{items}<div class="col-sm-12 col-md-12">{pager}</div>',
    ]);
?>
