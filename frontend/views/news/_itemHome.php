<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="blog-post blog-media wow fadeInRight" data-wow-duration="300ms" data-wow-delay="100ms">
                        <article class="media clearfix">
                           
                            <div class="entry-thumbnail pull-left">
                                 <?php $src=(empty($model->art_images))?Yii::$app->img->getNoImg():$model->art_images;?>
                                <img class="img-responsive" src="<?=$src?>" alt="<?=$model->art_title?>" />
<!--                                <span class="post-format post-format-gallery"><i class="fa fa-image"></i></span>-->
                            </div>
                            
                            
                            <div class="media-body">
                                <header class="entry-header">
                                    
                                    <h2 class="entry-title"><?=Html::a($model->art_title,$url)?></h2>
                                </header>

                                <div class="entry-content"> 
                                    <P><?=$content?></P>  
                                   <?php /*=Html::a(Yii::t('app','Read More'),$url,['class'=>'btn btn-xs pull-right'])*/?>
                                </div>

                                <footer class="entry-meta">
                                    <small>
                                    <span class="entry-author">
                                    <i class="fa fa-clock-o"></i> <?=Yii::$app->formatter->asDateTime($model->art_created, 'medium')?>
                                    </span>
                                    
                                    <?php if($model->user_id):?>
                                    <span class="entry-author"><i class="fa fa-pencil"></i> <a href="#"><?=$model->user->displayname?></a></span>
                                    <?php endif?>
                                    <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="#"><?=$model->artCate->art_cate_title?></a></span>
                                    </small>
                             
                                </footer>
                           
                            </div>
                        </article>
                    </div>
