<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\system\modules\menu\models\SysMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Url;
use backend\modules\system\modules\menu\models\SysMenuCategory;
use yii\helpers\ArrayHelper;

$menuCate = new SysMenuCategory();
$menu_cate = SysMenuCategory::find()->all();
$listCate = ArrayHelper::map($menu_cate, 'menu_cate_id', 'menu_cate_title');


$this->title = 'Sys Menus';
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
     <!-- <h3 class='box-title'><?= Html::encode($this->title) ?></h3>-->
    </div><!--box-header -->

    <div class='box-body pad'>

        <p>
            <?= Html::a('Create Sys Menu', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::button(Yii::t('app', 'Delete'), ['class' => 'btn btn-warning pull-right','id'=>'btn-delete']) ?>
        </p>

        
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => [
                        //'checkboxOptions'=>[],
                        'multiple'=>true,
                        'name'=>'selection[]'
                    ]
                ],
                //'menu_id',
                //'menu_title',
                [
                    'attribute' => "menu_title",
                    'format' => 'html',
                    'value' => function($model) {
                        $url = Url::to(['update', 'id' => $model->menu_id]);
                        $icon =$model->menu_icon?'<i class="'.$model->menu_icon.'"></i>&nbsp; ':'';
                        return Html::a($icon.$model->menu_title, $url);
                    },
                ],
                //'menu_cate_id',
                [ 'attribute' => 'menu_cate_id',
                    'label' => $menuCate->getAttributeLabel('menu_cate_title'),
                    'filter' => $listCate,
                    'value' => 'menuCate.menu_cate_title'
                ],
                //'menu_parent_id',
                //'menu_link',
                [
                    'attribute' => "menu_link",
                    'format' => 'raw',
                    'value' => function($model) {
                        $url = Url::to([$model->menu_link]);
                        return Html::a($model->menu_link, $url);
                    },
                ],
                // 'menu_parameter',
                // 'menu_icon',
                // 'mod_id',
                // 'menu_published',
                // 'menu_access',
                // 'menu_target',
                // 'menu_ptc',
                // 'menu_params',
                // 'menu_home',
                'menu_sort',
                // 'language',
                // 'menu_assoc',
                //['class' => 'yii\grid\ActionColumn'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttonOptions' => ['class' => 'btn btn-default'],
                    'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>'
                ],
                    ],
            ]);
        ?>


    </div><!--box-body pad-->
</div><!--box box-info-->
