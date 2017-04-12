<?php

namespace backend\modules\system\modules\menu\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "sys_menu_category".
 *
 * @property integer $menu_cate_id
 * @property string $menu_cate_title
 * @property string $menu_cate_status
 *
 * @property SysMenu[] $sysMenus
 */
class SysMenuCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_menu_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_cate_status'], 'string'],
            [['menu_cate_title'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_cate_id' => 'รหัสหมวดเมนู',
            'menu_cate_title' => 'ชื่อหมวดเมนู',
            'menu_cate_status' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysMenus()
    {
        return $this->hasMany(SysMenu::className(), ['menu_cate_id' => 'menu_cate_id']);
    }
    
    ###########################################
    public static function itemsAlias($key){
        
        $items= [
            'status'=>[
                0 => 'ปีด',
                1 => 'เปิด'
            ]
        ];
        return ArrayHelper::getValue($items, $key,[]);
    }
    
    public function getStatus() {
        return ArrayHelper::getValue(self::itemsAlias('status'), $this->menu_cate_status);
    }
}
