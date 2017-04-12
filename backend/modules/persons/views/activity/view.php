<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\BaseStringHelper;
use yii\widgets\Pjax;
use backend\modules\persons\models\activity\TbActivityJoin;
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\activity\TbActivity */
//$content = BaseStringHelper::truncate($content,200);
$this->title = BaseStringHelper::truncate($model->activity_title, 50);
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <p>
            <?= Html::a(Yii::t('person', 'Update'), ['update', 'id' => $model->activity_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a(Yii::t('person', 'Delete'), ['delete', 'id' => $model->activity_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('person', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'activity_id',
                'activity_title',
                'activity_detail:html',
                'activity_start:datetime',
                'activity_end:datetime',
                'location_id',
                'activity_cate_id',
                'activity_status',
            ],
        ])
        ?>
    </div><!--box-body -->

    <div class='box-body pad'>
<?php Pjax::begin(['id' => 'person-id']) ?>
        <?=
        GridView::widget([
            'dataProvider' => $modelPerson,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'fullName',
                        'format' => 'html',
                        'value' => function($model) {
                            $url = \yii\helpers\Url::to(['/persons/default/view', 'id' => $model->person_id]);
                            return Html::a($model->fullName, $url, ['target' => '_blank']);
                        }
                    ],
                    'person_email',
                    'person_mobile',  
                    [
                        'attribute' => 'tbActivityJoin.personMode',
                        'filter' => TbActivityJoin::itemsAlias('person_mode'),
                        'value' => function($model) {                            
                            return $model->tbActivityJoin->personMode;
                        }
                    ],
                    [   
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                       // print_r($model);
                                $url=  \yii\helpers\Url::to(['/persons/activity/person-delete','id'=>$model->tbActivityJoin->activity_id,'person'=>$model->person_id]);
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST']);
                            }
                        ],
                    ],
            ]
        ])?>
<?php Pjax::end(); ?>
    </div><!--box-body pad-->
</div><!--box box-info-->
