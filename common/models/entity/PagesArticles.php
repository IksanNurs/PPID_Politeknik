<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "v_page_cat".
 *
 * @property string $title
 * @property integer $type
 */
class PagesArticles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
            \yii\behaviors\BlameableBehavior::className(),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_page_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['title'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'type' => 'Type',
        ];
    }
}
