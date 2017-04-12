<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use beastbytes\wizard\WizardMenu;

$this->title = 'Registration Wizard';

echo WizardMenu::widget(['step' => $event->step, 'wizard' => $event->sender]);



?>

<div class='box box-info'>
    <div class='box-header'>
        <?= Html::tag('h3',Yii::t('person','general'),['class'=>'box-title']) ?>
    </div><!--box-header -->
    
<?=$this->render("_form/person",
        [
        'model'=>$model,        
        ]);?>
   
</div>

    

        
