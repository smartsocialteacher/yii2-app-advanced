<?php
use common\components\Menus;
use yii\helpers\Html;
use backend\modules\user\models\TbUserProfile;
$user = Yii::$app->user->id;
$profile = TbUserProfile::findOne($user);
$img=$profile->user_img&&(Yii::$app->img->chkImg(TbUserProfile::PATH_IMG,$profile->user_img)) ? Yii::$app->img->getUploadUrl($profile->img->img_path_file) .'thumbnail/'. $profile->user_img : Yii::$app->img->getNoimg();

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<!--                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
                <?=Html::img($img, [
                            'width' => '100%',
                            'class' => 'img-circle',
                            "alt"=>"User Image"
                        ]);
                        ?>
                
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->displayname?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= Menus::widget(['menu_cate_id'=>2,
            //'show_header'=>true
            ]); ?>
        
        <?php if(in_array(Yii::$app->user->identity->username,["admin","syabinsaleh"])){?>
        <hr/>
        <?= Menus::widget(['menu_cate_id'=>1]); ?>

        
        <?php if(Yii::$app->user->identity->username=="admin"){?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                ],
            ]
        ) ?>
        
        <?php } ?>
        <?php } ?>
    </section>

</aside>
