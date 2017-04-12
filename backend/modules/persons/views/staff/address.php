<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use beastbytes\wizard\WizardMenu;

$this->title = 'Registration Wizard';

echo WizardMenu::widget(['step' => $event->step, 'wizard' => $event->sender]);
echo $this->render("_form/address",
        [
    'model'=>$model,
            ]);