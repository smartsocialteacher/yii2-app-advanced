<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\BaseStringHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\persons\models\activity\TbActivityJoin;

use yii\helpers\Url;
$baseUrl = Yii::getAlias('@web');
$basePath = Yii::getAlias('@webroot');
$url = Url::to(['/activity/view', 'id' => $model->activity_id]);
/* @var $this yii\web\View */
/* @var $model backend\modules\persons\models\activity\TbActivity */
//$content = BaseStringHelper::truncate($content,200);
$this->title = BaseStringHelper::truncate($model->activity_title,100);
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'กิจกรรม/สัมมนา'), 'url' => ['/activity']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
    <?=$model->activity_detail ?> 

    <?php /*= DetailView::widget([
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
    ]) */ ?>

<?= Html::a('<i class="fa fa-plus-circle" ></i> '.Yii::t('person', 'ลงทะเบียน'),Url::to(['/activity/register', 'id' => $model->activity_id]),['class'=>'btn btn-success' ]); ?> 
<?=Html::a('<i class="fa fa-list" ></i> ดูรายชื่อ',  Url::to(['/activity/registed','id'=>$model->activity_id]),['class'=>'btn btn-warning'])?>
    </div><!--box-body pad-->    
    
 </div><!--box box-info-->
