<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_site".
 *
 * @property integer $site_id
 * @property string $site_title
 * @property string $site_path
 * @property integer $temp_id
 * @property integer $temp_id_login
 * @property integer $site_status
 *
 * @property SysTemplates $temp
 */
class SysSite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['temp_id', 'temp_id_login', 'site_status'], 'integer'],
            [['site_title', 'site_path'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site_id' => 'รหัสไซต์',
            'site_title' => 'ชื่อไซต์',
            'site_path' => 'Site Path',
            'temp_id' => 'Temp ID',
            'temp_id_login' => 'Temp Id Login',
            'site_status' => 'Site Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemp()
    {
        return $this->hasOne(SysTemplates::className(), ['temp_id' => 'temp_id']);
    }
}
