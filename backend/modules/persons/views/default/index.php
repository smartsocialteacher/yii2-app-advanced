<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\persons\models\TbPersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\modules\persons\models\TbPerson;
use backend\modules\persons\models\TbPosition;

$Position = TbPosition::find()->all();
$listPosition = ArrayHelper::map($Position, 'position_id', 'position_title');

use backend\modules\persons\models\TbPersonType;

$PersonType = TbPersonType::find()->all();
$listPersonType = ArrayHelper::map($PersonType, 'person_type_id', 'person_type_title');

$this->title = Yii::t('person', 'ระบบจัดการผู้บริหาร/บุคลากร');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <p>
<?= Html::a("<i class='fa fa-user-plus'></i> " . Yii::t('person', 'เพิ่มบุคลากร'), ['default/create'], ['class' => 'btn btn-success']) ?> 
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'person_id',
                [
                    'attribute' => "image",
                    'format' => 'html',
                    'value' =>function($model){
            return Html::img($model->image,['width'=>'80']);
                    }
                  
                 ],
                        'person_id_card',
                        //'fullName',
                        [
                            'attribute' => "fullName",
                            'format' => 'raw',
                            'value' => function($model) {
                                $url = Url::to(['profile', 'id' => $model->person_id]);
                                return Html::a($model->fullName, $url);
                            },
                                ],
                                //'person_name',
                                //'person_surname',
                                // 'person_birthday',
                                // 'person_blood_groups',
                                // 'person_phone',
                                // 'person_mobile',
                                // 'person_email:email',   
                                [
                                    'attribute' => 'person_type_id',
                                    'filter' => $listPersonType,
                                    'value' => function($model) {
                                        return $model->personType->person_type_title;
                                    }
                                ],
                                [
                                    'attribute' => 'position_id',
                                    'filter' => $listPosition,
                                    'value' => function($model) {
                                        return $model->position->position_title;
                                    }
                                ],
                                [
                                    'attribute' => 'person_sex',
                                    'filter' => TbPerson::itemsAlias('sex'),
                                    'value' => function($model) {
                                        return $model->sexName;
                                    }
                                ],
                                [
                                    'attribute' => 'person_create_at',
                                    'format' => 'html',
                                    //'filter' => TbPerson::itemsAlias('sex'),
                                    'value' => function($model) {
                                        //return $model->person_create_at;
                                        return Yii::$app->formatter->asDateTime($model->person_create_at, 'medium');
                                    }
                                ],
                                //'person_create_at',
                                // 'person_type_id',
                                // 'race_id',
                                // 'nationality_id',
                                // 'religion_id',
                                ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]);
                        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->


