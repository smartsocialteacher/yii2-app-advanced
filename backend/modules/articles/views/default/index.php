<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\Url;
use backend\modules\articles\models\TbArticleCategory;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\articles\models\TbArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$artCate=new TbArticleCategory();
$art_cate = TbArticleCategory::find()->all();
$listCate = ArrayHelper::map($art_cate,'art_cate_id','art_cate_title');

$this->title = 'การจัดการบทความ/ข่าว';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
  jQuery("#btn-delete").click(function(){ 
    var keys = $("#w0").yiiGridView("getSelectedRows");
    //console.log(keys);
    if(keys.length>0){
        if(!confirm("คุณแน่ใจที่จะลบ"))return false;
        jQuery.post("'.Url::to(['delete-all']).'",{ids:keys.join()},function(){
      });
    }else{
        alert("กรุณาเลือก");
    }
  });
');
?>
<div class='box box-info'>
    <div class='box-header'>
     <!-- <h3 class='box-title'></h3>-->
	</div><!-- /.box-header -->
	<div class='box-body pad'>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php    /*/*Pjax::begin(['enablePushState'=>false]);*/?>
    <p>
        <?= Html::a('สร้างบทความ', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('จัดการหมวดหมู่', ['/articles/category'], ['class' => 'btn btn-success']) ?>
        <?= Html::button(Yii::t('app', 'Delete'), ['class' => 'btn btn-warning pull-right','id'=>'btn-delete']) ?>
    </p>

     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => [
                    'multiple'=>true,
                    'name'=>'selection[]'
                ]
            ],

            //'art_id',
            //'art_title',
             [
                'attribute' => "art_title",
                'format' => 'raw',
                'value' => function($model){
                    $url=Url::to(['update','id'=>$model->art_id]);
                    return Html::a($model->art_title,$url);
                },
            ],
            //'art_cate_id',           
            [
                'attribute' =>'art_cate_id',
                'label'=>$artCate->getAttributeLabel('art_cate_title'),
                'filter'=>$listCate,
                'value' => function($model){return $model->artCate->art_cate_title;},
            ],
            //'art_access',
            [
                'attribute' => "art_published",
                'filter'=>[
                	'1'=>'แสดง',
                	'0'=>'ซ่อน'
                ],
                'value' => function($model){
                	// ดึงแบบสร้างตัวแปรจากอาเรย์
                	return $model->publish;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php /*Pjax::end();*/ ?>
        </div>
 </div><!-- /.box -->
