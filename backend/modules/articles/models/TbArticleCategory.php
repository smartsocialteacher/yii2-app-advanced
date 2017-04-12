<?php

namespace  backend\modules\articles\models;

use Yii;

/**
 * This is the model class for table "tb_article_category".
 *
 * @property integer $art_cate_id
 * @property string $art_cate_title
 * @property string $art_cate_intro
 * @property string $art_cate_created
 * @property string $art_cate_created_by
 * @property integer $art_cate_parent_id
 *
 * @property TbArticle[] $tbArticles
 */
class TbArticleCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['art_cate_intro'], 'string'],
            [['art_cate_created'], 'safe'],
            [['art_cate_parent_id'], 'integer'],
            [['art_cate_title'], 'string', 'max' => 50],
            [['art_cate_created_by'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'art_cate_id' => 'รหัสหมวดหมู่',
            'art_cate_title' => 'ชื่อหมวดหมู่',
            'art_cate_intro' => 'รายละเอียด',
            'art_cate_created' => 'Art Cate Created',
            'art_cate_created_by' => 'Art Cate Created By',
            'art_cate_parent_id' => 'ภายใต้หมวด',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbArticles()
    {
        return $this->hasMany(TbArticle::className(), ['art_cate_id' => 'art_cate_id']);
    }
}
