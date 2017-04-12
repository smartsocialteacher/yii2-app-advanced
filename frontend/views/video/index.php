<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->yt_title;
$this->params['breadcrumbs'][] = [
    'label' => 'วิดีโอ',
    'url' => ['/video']
];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("

.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px; height: 0; overflow: hidden;
    width: 100% !important;
}

.video-container iframe,
.video-container object,
.video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

")
?>




    <?php /*= \cics\widgets\VideoEmbed::widget(['url' => $model->yt_watchURL, 'show_errors' => true,'container_class'=>'VideoEmbed','responsive' => false]);?>
    <?= \bupy7\embed\Embed::widget([
    'url' => $model->yt_watchURL,
]); */?>
    <div class="video-container">
     <?=\tuyakhov\youtube\EmbedWidget::widget([
        'code' => $model->yt_vid,
//        'playerParameters' => [
//            'controls' => 2
//        ],
        'iframeOptions' => [
            'width' => '560',
            'height' => '349',
            'frameborder'=>"0",
            'allowfullscreen'=>''
            
        ]
    ]);?>
    </div>
<?=Html::tag('h2',"<i class='fa fa-youtube-play '></i> ".$this->title)?>
<?=Html::tag('small','โดย '.$model->yt_author)?>
<?=Html::tag('p',$model->yt_description)?>
<?=Html::tag('p','ที่มา '.Html::a($model->yt_watchURL,$model->yt_watchURL,['target'=>'_blank']))?>

