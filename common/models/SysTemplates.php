<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_templates".
 *
 * @property integer $temp_id
 * @property string $temp_title
 * @property string $temp_mode
 * @property string $temp_position
 * @property string $temp_postion_main
 */
class SysTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['temp_mode', 'temp_position'], 'string'],
            [['temp_title', 'temp_postion_main'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'temp_id' => 'Temp ID',
            'temp_title' => 'Temp Title',
            'temp_mode' => 'Temp Mode',
            'temp_position' => 'Temp Position',
            'temp_postion_main' => 'Temp Postion Main',
        ];
    }
}
