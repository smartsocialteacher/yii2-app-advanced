<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use backend\modules\persons\models\TbPerson;
use backend\modules\persons\models\TbPersonComment;

$comment = TbPersonComment::find()->with('person')->all();
?>

<div class="section-header">                
    <h3 class="text-left wow fadeInDown article-head animated" style="visibility: visible; animation-name: fadeInDown;">เครือข่ายครู</h3>
</div>
<div class="row">                
    <div class="col-sm-12">  
        <?php
        foreach ($comment as $k => $model) {
            echo $this->render(
                    '/person/_itemHome', [
                'model' => $model,
                'asset' => $asset,
                    ]
            );
        }
        ?>

        <p>
            <?= Html::tag('h3', Html::a('<i class="fa fa-chevron-right"></i> อ่านทั้งหมด', Url::to(['/comment']), ['class' => 'pull-right'])) ?>
        </p>
    </div>
</div>