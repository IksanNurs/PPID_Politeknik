<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property integer $publish_at
 * @property integer $author_id
 * @property string $content
 * @property string $photo
 * @property integer $views
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Pages extends \yii\db\ActiveRecord
{
    const STATUS_DRAF = 0;
    const STATUS_PUBLISH = 1;


    public static function statuses($index = 'all', $html = false, $cssClass = '')
    {
        $array = [
            self::STATUS_DRAF => 'Draf',
            self::STATUS_PUBLISH => 'Publish',
        ];
        if ($html) $array = [
            self::STATUS_DRAF => '<span class="label label-default label-inline nowrap">Draf</span>',
            self::STATUS_PUBLISH => '<span class="label label-success label-inline nowrap">Publish</span>',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }


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
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'author_id', 'content'], 'required'],
            [['id', 'publish_at', 'author_id', 'views', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['title', 'photo'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Judul Laman',
            'publish_at' => 'Tanggal Publish',
            'author_id' => 'Nama Penulis',
            'content' => 'Konten',
            'photo' => 'Photo',
            'views' => 'views',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public static function uploadableFields()
    {
        return [
            'photo'
        ];
    }

    public function getStatusText()
    {
        return self::statuses($this->status, false);
    }

    public function getStatusHtml()
    {
        return self::statuses($this->status, true);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id']);
    }
}
