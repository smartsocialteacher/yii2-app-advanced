<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\TbPersonCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('person', 'Tb Person Comments');
$this->params['breadcrumbs'][] = $this->title;

use backend\modules\persons\models\TbPerson;
$listPerson = ArrayHelper::map(TbPerson::find()->all(),'person_id','fullname');

?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <p>
            <?= Html::a(Yii::t('person', 'เพิ่มความคิดเห็น'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'person_id',
                [
                    'attribute' => 'person_id',
                    'filter'=>$listPerson,
                    'value' => function($model) {
                        return $model->person->fullname;
                    }
                ],
                'person_comment_highlight:ntext',
                //'person_comment:ntext',
                [
                    'attribute' => 'person_comment_datetime',
                    'value' => function($model) {
                        return Yii::$app->thaiFormatter->asDateTime($model->person_comment_datetime, 'medium');
                    }
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
