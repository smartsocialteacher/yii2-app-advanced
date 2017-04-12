<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\BaseStringHelper;

$this->title = BaseStringHelper::truncate($model->person_comment_highlight, 70);
$this->params['breadcrumbs'][] = [
    'label' => 'ความคิดเห็น',
    'url' => ['/news']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::tag('h1', $this->title) ?> 

<div class="row">

    <div class="col-sm-2">
        <?= Html::img($model->person->image) ?> 
    </div>
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">

                <strong><?=Html::a($model->person->fullname,Url::to(['/person','id'=>$model->person->person_id]))?></strong> <span class="text-muted"><?=Yii::$app->formatter->asDateTime($model->person_comment_datetime, 'medium'); ?></span>

            </div>
            <div class="panel-body" style="text-indent: 30px;">
                <?= $model->person_comment ?>      
            </div><!-- /panel-body -->
        </div><!-- /panel panel-default -->
    </div>
</div>

<?php

 $this->registerCss('
  
.panel {
	position:relative;
}
.panel>.panel-heading:after,.panel>.panel-heading:before{
	position:absolute;
	top:11px;left:-16px;
	right:100%;
	width:0;
	height:0;
	display:block;
	content:" ";
	border-color:transparent;
	border-style:solid solid outset;
	pointer-events:none;
}
.panel>.panel-heading:after{
	border-width:7px;
	border-right-color:#f7f7f7;
	margin-top:1px;
	margin-left:2px;
}
.panel>.panel-heading:before{
	border-right-color:#ddd;
	border-width:8px;
}
         ');
 ?>