<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use beastbytes\wizard\WizardMenu;

$this->title = 'Registration Wizard';

echo WizardMenu::widget(['step' => $event->step, 'wizard' => $event->sender]);

echo $this->render("../create",
        [
    'model'=>$model,
            ]);
