<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<p>เรียนคุณ <?php echo $fullname; ?></p>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
