<?php
namespace common\components;
 
 
use Yii;
use yii\base\Component;
 
class WebCom extends Component
{
 public function welcome()
 {
  echo "Hello..Welcome to MyComponent";
 }
 
 
 public function position()
 {
   //return Yii::$app->runAction('site/about');
 }
 
}