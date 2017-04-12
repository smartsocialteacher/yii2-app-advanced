<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;
 
use yii\base\Widget;

//use common\models\SysMenu;
use backend\modules\system\modules\menu\models\SysMenuSearch;
use dmstr\widgets\Menu;
 
class Menus extends Widget
{
    public $menu_cate_id;
    public $items;
    public $show_header;
    public $itemOption=['class'=>''];
    public $option=['class' => 'sidebar-menu'];
    public $linkTemplate = '<a href="{url}" {target} >{icon} <span>{label}</span></a>';

    public function init()
    {
        if(php_sapi_name() === 'cli')
        {
            return true;
        }
 
        parent::init();  
        
        if(isset($this->menu_cate_id)){
             $this->items = SysMenuSearch::getItems($this->menu_cate_id,$this->show_header,$this->itemOption);
        }
 
    }
 
    public function run(){
        if($this->items!==null){
           // print_r($this->items);
         return  Menu::widget(
            [
                'options' => $this->option,
                'items' => $this->items,
                'itemOptions' => $this->itemOption,
                'activateParents'=>true,
                'linkTemplate' => $this->linkTemplate,
            ]
        );
        }
    }
 
}