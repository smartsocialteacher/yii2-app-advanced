<?php

use common\models\AuthAssignment;
use common\models\TbUser;
use yii\helpers\Html;

$auth = TbUser::find()->joinWith('auth')->with('profile')->where(['auth_assignment.item_name' => 'research'])->all();
//print_r($auth);
?>

<section id="meet-team">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown"><?=Yii::t('person','Researcher');?></h2>
            <p class="text-center wow fadeInDown"></p>
        </div>


        <?php ?>


        <div class="row ">


            <div class="col-sm-10 col-sm-offset-1">
                <div class="row ">
                    
                    <?php foreach($auth as $model):?>
                    <div class="col-sm-6 col-md-4">
                        <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
                            <div class="team-img">
                                
                                <?=
Html::img(
        ($model->profile->user_img) ? Yii::$app->img->getUploadUrl($model->profile->img->img_path_file) . $model->profile->user_img : Yii::$app->img->getNoimg()
        , [
    'width' => '100%',
    'class' => 'img-responsive',
]);
?>
                            </div>
                            <div class="team-info">
                                <h3><?=$model->fullname;?> </h3>   
                            </div>
                            <p><?=$model->profile->user_phone;?></p>
                            <p><?=$model->email;?></p>
                            <p><?=$model->profile->user_workstation;?></p>
<!--                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>-->
                        </div>
                    </div>
                    <?php endforeach; ?>
                   
                </div>
            </div>
        </div>

        <div class="divider"></div>

    </div>
</section><!--/#meet-team-->

