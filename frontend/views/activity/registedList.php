<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\BaseStringHelper;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\modules\persons\models\activity\TbActivityJoin;

//$baseUrl = Yii::getAlias('@web');
//$basePath = Yii::getAlias('@webroot');
//$url = Url::to(['/activity/view', 'id' => $modelAct->activity_id]);
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\activity\TbActivity */
//$content = BaseStringHelper::truncate($content,200);
$this->title = Yii::t('person', 'รายชื่อผู้เข้าร่วม');
$act_title=BaseStringHelper::truncate($model->activity_title, 50) ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'กิจกรรม/สัมมนา'), 'url' => ['/activity']];
$this->params['breadcrumbs'][] = ['label' => $act_title, 'url' => ['/activity/view','id'=>$model->activity_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <?=
        Html::tag('h2', Html::encode($this->title))
        ?>  
        <p>กิจกรรม / สัมมนา : <?=$model->activity_title?></p>
    </div><!--box-header -->
    <div class='box-body pad'>    
        <p>
<?= Html::a(Yii::t('person', ' < กลับไปหน้ากิจกรรม'), Url::to(['/activity']), ['class' => 'btn btn-info']); ?> 
<?= Html::a(Yii::t('person', 'ลงทะเบียน'), Url::to(['/activity/register', 'id' => $model->activity_id]), ['class' => 'btn btn-warning']); ?>
        </p>
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
//                    [
//                        'attribute' => 'position_id',
//                        //'filter' => TbActivityJoin::itemsAlias('person_mode'),
//                        'value' => function($model) {                            
//                            return $model->position->position_title;
//                        }
//                    ],
                    [
                        'attribute' => 'tbPersonnels.school_id',
                        'label' =>'โรงเรียน / หน่วยงาน',
                        //'filter' => TbActivityJoin::itemsAlias('person_mode'),
                        'value' => function($model) { 
//                             echo "<pre>";
//                            foreach($model->tbPersonnels);
//                              echo "</pre>";
                            return $model->tbPersonnels[0]->school->school_title;
                        }
                    ],
                    [
                        'attribute' => 'tbPersonnels.position_id',
                        //'filter' => TbActivityJoin::itemsAlias('person_mode'),
                        'value' => function($model) { 
//                             echo "<pre>";
//                            foreach($model->tbPersonnels);
//                              echo "</pre>";
                            return $model->tbPersonnels[0]->position->position_title;
                        }
                    ],
                    
            ]
        ])?>
        
        <br />
        

    </div><!--box-body pad-->
    

    
</div><!--box box-info-->
