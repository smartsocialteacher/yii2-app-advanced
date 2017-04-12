<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\LoginForm;
$model = new LoginForm();

?>
<div class="box-login green-gradient">
    <?= Html::tag('h3',Yii::t('app','Login')) ?>
    <small>Please fill out the following fields to login:</small>
    <div class="row">
        <div class="col-sm-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form','action'=>['/site/login']]); ?>
            <?php if(Yii::$app->user->isGuest){ 
            ?>
                <?= $form->field($model, 'username')->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput()->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->inline() ?>
               
                

                <div class="form-group">
                     <?= Html::a('ลืมรหัสผ่าน', ['site/request-password-reset']) ?> |
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>  
             <?php   
                
            }elseif(Yii::$app->user->identity){
            echo Yii::$app->user->identity->displayname;   
            
            echo '</br>';
            echo Html::a('Logout',
    ['/site/logout'],
    [
        'data-method' => 'post',
        'class' => 'btn btn-success'
        ]);    
                
            
             }?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
