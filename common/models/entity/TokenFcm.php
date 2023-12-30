<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "token_fcm".
 *
 * @property string $token
 */
class TokenFcm extends \yii\db\ActiveRecord
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
        return 'token_fcm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token'], 'required'],
            [['token'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token' => 'Token',
        ];
    }
}
