<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\TbUserProfile */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Tb User Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>

    <p>
        <?= Html::a(Yii::t('person', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('person', 'Delete'), ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('person', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    <div class="row">
        
        <div class="col-sm-3">
            <div class="img img-thumbnail" style="overflow: hidden;height: 200px;width: 100%;" >
<?=
Html::img(
        ($model->user_img) ? Yii::$app->img->getUploadUrl($model->img->img_path_file) . $model->user_img : Yii::$app->img->getNoimg()
        , [
    'width' => '100%',
    'class' => 'user_img',
]);
?>
            
        </div><!--img-->           
    
        </div>
        <div class="col-sm-9">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'user_idcard',
            'user_name',
            'user_surname',
            'user_nickname',
            'antecedent_id',
            'user_sex',
            'user_data:ntext',
            'user_img',
            'person_id',
            'user_phone',
            'user_workstation',
        ],
    ]) ?>

</div></div>
    </div><!--box-body pad-->
 </div><!--box box-info-->
