<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;

$this->title = Yii::t('person', 'กิจกรรม/สัมมนา');
$this->params['breadcrumbs'][] = $this->title;
?>


<h1><?=$this->title?></h1>
       <ul class="list-group">
 <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'itemOptions' => [
            'class' => 'col-sm-12 col-md-12',
        ],
        'layout' =>  '{items}',
    ]);

    ?>  

</ul>