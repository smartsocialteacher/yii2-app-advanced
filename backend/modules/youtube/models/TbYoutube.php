<?php

namespace backend\modules\youtube\models;

use Yii;

/**
 * This is the model class for table "tb_youtube".
 *
 * @property integer $yt_id
 * @property string $yt_vid
 * @property string $yt_title
 * @property string $yt_description
 * @property string $yt_watchURL
 * @property string $yt_thumbnailURL
 * @property string $yt_viewCount
 * @property string $yt_length
 * @property string $yt_author
 * @property string $yt_date_create
 * @property string $yt_published
 */
class TbYoutube extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_youtube';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['yt_watchURL'], 'required'],
            [['yt_description', 'yt_published'], 'string'],
            [['yt_date_create'], 'safe'],
            [['yt_vid'], 'string', 'max' => 100],
            [['yt_title'], 'string', 'max' => 100],
            [['yt_watchURL', 'yt_thumbnailURL'], 'string', 'max' => 250],
            //[['yt_viewCount', 'yt_length'], 'string', 'max' => 10],
            [['yt_author'], 'string', 'max' => 200],
            //[['yt_watchURL'],'checkWatchUrl']
        ];
    }
    
    
    
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'yt_id' => Yii::t('person', 'Yt ID'),
            'yt_vid' => Yii::t('person', 'รหัสบนวิดีโอ'),
            'yt_title' => Yii::t('person', 'ชื่อวีดีโอ'),
            'yt_description' => Yii::t('person', 'รายละเอียด'),
            'yt_watchURL' => Yii::t('person', 'ลิงค์'),
            'yt_thumbnailURL' => Yii::t('person', 'Yt Thumbnail Url'),
            'yt_viewCount' => Yii::t('person', 'Yt View Count'),
            'yt_length' => Yii::t('person', 'Yt Length'),
            'yt_author' => Yii::t('person', 'ผู้เขียน'),
            'yt_date_create' => Yii::t('person', 'Yt Date Create'),
            'yt_published' => Yii::t('person', 'Yt Published'),
        ];
    }
}
