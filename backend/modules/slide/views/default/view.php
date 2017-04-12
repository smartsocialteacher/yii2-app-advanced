<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\slide\models\TbSlide */

$this->title = $model->slide_title;
$this->params['breadcrumbs'][] = ['label' => 'Tb Slides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->
    
    <div class='box-body pad'>
<?php if($model->img_id){
    //echo Html::img(Yii::$app->img->getUploadUrl().$model->img->img_path_file.'/'.$model->img->img_id, ['width' => '','height'=>'250','class'=>'thumbnail']);
    $img=Yii::$app->img->getUploadUrl().$model->img->img_path_file.'/'.$model->img->img_id;
}
?>
        <section id="main-slider" >
        <div class="owl-carousel" >
            <div class="item thumbnail" style="background-image: url(<?=$img?>);height:<?=$model->slideCate->slide_cate_height?>px;width:<?=$model->slideCate->slide_cate_width?>px;">
                <div class="slider-inner">
                    <div class="container">
                        <?=$model->slide_detail?>
                    </div>
                </div>
            </div><!--/.item-->
            </div>
        </section>
        
        
        
        
    </div>
     <div class='box-body pad'>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->slide_id], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a('Upload', ['upload', 'id' => $model->slide_id], ['class' => 'btn btn-success']) */?>
        <?= Html::a('Delete', ['delete', 'id' => $model->slide_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'slide_id',
           [
                'attribute'=>'slide_cate_id',
                'value'=> $model->slideCate->slide_cate_title
            ],            
            'slide_link',
            'slide_date_create',
            'slide_published',
            'slide_sort',
            'slide_start',
            'slide_end',
            [
                'attribute'=>'user_id',
                'value'=> $model->user->username
            ],
        ],
    ]) ?>


    </div><!--box-body pad-->
 </div><!--box box-info-->
