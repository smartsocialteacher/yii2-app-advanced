 <?php
$this->title = Yii::t('person', 'จัดการข้อมูลต่างๆ ที่เกี่ยวข้อง');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'บุคคล'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-envelope"></i> จัดการข้อมูลต่างๆ ที่เกี่ยวข้อง
            </h4>
        </div>
        <div class="panel-body">
            <div class="study-items">-->


<?php

        $menu = [];
        $menu[] = ['label' => Yii::t('person', 'ชื่อประเภท'), 'url' => ['/persons/type']];
        $menu[] = ['label' => Yii::t('person', 'ชื่อตำแหน่ง'), 'url' => ['/persons/position']];
        $menu[] = ['label' => Yii::t('person', 'คำนำหน้า'), 'url' => ['/persons/antecedent']];
        $menu[] = ['label' => Yii::t('person', 'เชื่อชาติ'), 'url' => ['/persons/race']];
        $menu[] = ['label' => Yii::t('person', 'สัญชาติ'), 'url' => ['/persons/nationality']];
        $menu[] = ['label' => Yii::t('person', 'ศาสนา'), 'url' => ['/persons/religion']];
        
        echo $this->render('_box', [
            'head_title' => 'ข้อมูลเบื้องต้น',
            'menu' => $menu
        ]);
        
        $menu = [];
        $menu[] = ['label' => Yii::t('person', 'ระดับการศึกษา'), 'url' => ['/persons/edulevel']];
        $menu[] = ['label' => Yii::t('person', 'วุฒิการศึกษา'), 'url' => ['/persons/degree']];
        $menu[] = ['label' => Yii::t('person', 'สาขา'), 'url' => ['/persons/major']];
        $menu[] = ['label' => Yii::t('person', 'สถานศึกษา'), 'url' => ['/persons/edulocal']];
        
        
         echo $this->render('_box', [
            'head_title' => 'ประวัติการศึกษา',
            'menu' => $menu
        ]);
         
         
           $menu = [];
        $menu[] = ['label' => Yii::t('person', 'ข้อมูลโรงเรียน'), 'url' => ['/persons/school']];
         
         echo $this->render('_box', [
            'head_title' => 'ข้อมูลโรงเรียน & การบรรจุเป็นบุคลากรด้านการศึกษา',
            'menu' => $menu
        ]);
         
         $menu = [];
        $menu[] = ['label' => Yii::t('person', 'ระดับชั้น'), 'url' => ['/persons/educlass']];
         echo $this->render('_box', [
            'head_title' => 'ด้านการเป็นครูประจำชั้น',
            'menu' => $menu
        ]);
         
         $menu = [];
        $menu[] = ['label' => Yii::t('person', 'ระดับชั้น'), 'url' => ['/persons/educlass']];
        $menu[] = ['label' => Yii::t('person', 'รายวิชาที่สอน'), 'url' => ['/persons/subject']];
          echo $this->render('_box', [
            'head_title' => 'ด้านการสอน',
            'menu' => $menu
        ]);
          
          
        $menu = [];
        $menu[] = ['label' => Yii::t('person', 'ข้อมูลอบรม / สัมมนา'), 'url' => ['/persons/activity']];
          echo $this->render('_box', [
            'head_title' => 'ด้านการฝึกอบรม / สัมมนา',
            'menu' => $menu
        ]);
        
        
        ?>
<!--  </div>
        </div>
    </div>-->