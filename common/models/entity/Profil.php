<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "profil".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $notelp
 */
class Profil extends \yii\db\ActiveRecord
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
        return 'profil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'notelp'], 'required'],
            [['nama'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 100],
            [['notelp'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'notelp' => 'Notelp',
        ];
    }
}
