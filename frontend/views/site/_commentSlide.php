<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;

use backend\modules\persons\models\TbPersonComment;

$comment = TbPersonComment::find()->with('person')->all();
?>


<section id="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                <div id="carousel-testimonial" class="carousel slide text-center" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php
                        foreach ($comment as $k => $model) {
                            ?>
                        
                            <div class="item <?=($k==0)?'active':''?>">
                                <p>
                                    <?= Html::img($model->person->image, ['class' => 'img-circle img-thumbnail']) ?>
                                </p>
                                <h4><?= $model->person->fullname ?></h4>
                                <small>Treatment, storage, and disposal (TSD) worker</small>
                                <p><?= $model->person_comment ?></p>
                            </div>                       


                            <?php
                        }
                        ?>
                    </div>
                    <!-- Controls -->
                    <div class="btns">
                        <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="next">
                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#testimonial-->


