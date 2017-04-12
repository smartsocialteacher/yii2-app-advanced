<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//\frontend\assets\AppAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\articles\models\TbArticle */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = [
    'label' => 'บุคคล',
    'url' => ['/news']
];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::tag('h1', $this->title) ?>
<div class="row">  
    <div class="col-sm-3">
        <?= Html::img($model->image) ?>
    </div>
    <div class="col-sm-9">
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => '<tr><th nowrap="">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                'person_id_card',
                'fullName',
                // 'person_sex', 
                [
                    'attribute' => 'person_type_id',
                    'value' => $model->personType->person_type_title,
                ],
                [
                    'attribute' => 'position_id',
                    'value' => $model->position->position_title,
                ],
                [
                    'attribute' => 'person_sex',
                    'value' => $model->sexName,
                ],
                [
                    'attribute' => 'person_birthday',
                    'format' => 'html',
                    'value' => Yii::$app->formatter->asDate($model->person_birthday, 'medium'),
                ],
                'person_blood_groups',
                [
                    'attribute' => 'race_id',
                    'value' => $model->race->race_title,
                ],
                [
                    'attribute' => 'nationality_id',
                    'value' => $model->nationality->nationality_title,
                ],
                [
                    'attribute' => 'religion_id',
                    'value' => $model->religion->religion_title,
                ],
                'person_phone',
                'person_mobile',
                'person_email:email',
            ],
        ])
        ?>


    </div>

</div>
<?php
if ($model->comments) {
    echo Html::tag('h1','ความคิดเห็นต่อโครงการ');
    foreach ($model->comments as $comment) {
        //echo $comment->person_comment;
        ?>
        <div class="row">
            <div class="col-sm-2">
                <div class="thumbnail">
                    <?= Html::img($model->image,['class'=>'img-responsive user-photo']) ?>
                </div><!-- /thumbnail -->
            </div><!-- /col-sm-1 -->

            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><?=$model->fullname?></strong> <span class="text-muted"><?=Yii::$app->formatter->asDateTime($comment->person_comment_datetime, 'medium'); ?></span>
                    </div>
                    <div class="panel-body">
                        <?=$comment->person_comment;?>
                    </div><!-- /panel-body -->
                </div><!-- /panel panel-default -->
            </div><!-- /col-sm-5 -->
            </div><!-- /row -->

            <?php
        }
    }
    
    
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
        


