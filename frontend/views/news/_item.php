<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $art app\modules\articles\models\TbArticle */



$this->title = $cate->art_cate_title;
//$this->params['breadcrumbs'][] = [
//    'label' => $cate->art_cate_title,
//    'url' => ['/art/cate', 'id' => $art->art_cate_id]
//];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12 col-sm-12">

            <div class="box box-widget">
                <div class="box-header with-border">
                    <i class="fa fa-th"></i><h3 class="box-title"><?=$cate->art_cate_title?></h3>
                </div>
                <div class="box-body">
<?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '/articles/_item',
                'itemOptions' => [
                    'class' => 'col-sm-12 col-md-12',
                ],
                'layout' =>  '<div class="col-sm-12 col-md-12">{summary}</div>{items}<div class="col-sm-12 col-md-12">{pager}</div>',
    ]);
?>

                    </div>
            </div>

    </div>
</div>

  