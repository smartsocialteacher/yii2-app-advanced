<?php

namespace backend\modules\system\modules\menu\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "sys_menu".
 *
 * @property integer $menu_id
 * @property integer $menu_cate_id
 * @property integer $menu_parent_id
 * @property string $menu_title
 * @property string $menu_link
 * @property string $menu_parameter
 * @property string $menu_icon
 * @property integer $mod_id
 * @property string $menu_published
 * @property string $menu_access
 * @property string $menu_target
 * @property string $menu_ptc
 * @property string $menu_params
 * @property string $menu_home
 * @property integer $menu_sort
 * @property string $language
 * @property string $menu_assoc
 *
 * @property SysMenuCategory $menuCate
 */
class SysMenu extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sys_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['menu_cate_id', 'menu_parent_id', 'mod_id', 'menu_sort'], 'integer'],
            [['menu_title', 'menu_link'], 'required'],
            [['menu_published', 'menu_access', 'menu_params', 'menu_home'], 'string'],
            [['menu_title'], 'string', 'max' => 200],
            [['menu_link', 'menu_parameter'], 'string', 'max' => 250],
            [['menu_icon'], 'string', 'max' => 30],
            [['menu_target', 'menu_ptc'], 'string', 'max' => 20],
            [['language'], 'string', 'max' => 7],
            [['menu_assoc'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'menu_id' => 'รหัสเมนู',
            'menu_cate_id' => 'รหัสหมวดเมนู',
            'menu_parent_id' => 'ภายใต้เมนู',
            'menu_title' => 'ชื่อเมนู',
            'menu_link' => 'ลิงค์',
            'menu_parameter' => 'พารามิเตอร์',
            'menu_icon' => 'Menu Icon',
            'mod_id' => 'Mod ID',
            'menu_published' => 'แสดง',
            'menu_access' => 'การเข้าถึง',
            'menu_target' => 'Menu Target',
            'menu_ptc' => 'Menu Ptc',
            'menu_params' => 'Menu Params',
            'menu_home' => 'หน้าแรก',
            'menu_sort' => 'Menu Sort',
            'language' => 'Language',
            'menu_assoc' => 'Menu Assoc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuCate() {
        return $this->hasOne(SysMenuCategory::className(), ['menu_cate_id' => 'menu_cate_id']);
    }

    ###########################################
    public static function itemsAlias($key){
        
        $items= [
            'status'=>[
                0 => 'ปีด',
                1 => 'เปิด'
            ],
           'target' => [
               '_blank' => '_blank',
               '_self' => '_self',
               '_parent' => '_parent',
               '_top' => '_top',
           ]
           
        ];
        return ArrayHelper::getValue($items, $key,[]);
    }
    
    public function getStatus() {
        return ArrayHelper::getValue(self::itemsAlias('status'), $this->menu__status);
    }
    
    public function getTarget() {
        return ArrayHelper::getValue(self::itemsAlias('target'), $this->menu_target);
    }
    
}
