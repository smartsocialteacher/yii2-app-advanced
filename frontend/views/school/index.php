<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\persons\models\teach\TbSchool;

$this->title = $model->getAttributeLabel('school') . $model->school_title;
$this->params['breadcrumbs'][] = [
    'label' => 'โรงเรียน',
    'url' => ['/school']
];
$this->params['breadcrumbs'][] = $this->title;

$url_img = Yii::$app->img->chkImg(TbSchool::PATH_IMG, $model->img_id) ? Yii::$app->img->getUploadUrl(TbSchool::PATH_IMG) . $model->img_id : Yii::$app->img->getNoImg();
?>
<?= Html::tag('h1', $this->title) ?>

<div class="row">
    <div class="col-sm-12">

        <?= Html::img($url_img, ['class' => 'thumbails', 'width' => '100%']) ?>

        <hr />
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => '<tr><th width="150" nowrap="nowrap">{label}</th><td valign="top">{value}</td></tr>',
            'attributes' => [
                //'school_id',
                'school_title',
                'address',
//            'school_no',
//            'school_village',
//            'school_mu',
//            'school_road',
//            'tambol_id',
//            'amphur_id',
//            'province_id',
                'phone',
                'fax',
//            [
//                'attribute'=>'degree_id',
//                'content' => $model->degree->degree_title,
//                
//            ],
                [
                    'attribute' => 'school_level_id',
                    'format' => 'html',
                    'value' => $model->tbSchoolLevel
                ],
                [
                    'attribute' => 'school_number_staff',
                    'value' => count($model->tbPersonnels) . " " . Yii::t('person', 'คน'),
                ],
                [
                    'attribute' => 'school_size',
                    'value' => $model->schoolSize,
                ],
                [
                    'attribute' => 'school_category',
                    'value' => $model->schoolCategory,
                ],
                'school_detail:html'
            ],
        ])
        ?>


    </div>
</div>
