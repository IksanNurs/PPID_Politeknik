<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $news_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property News $news
 * @property User $createdBy
 * @property User $updatedBy
 * @property Submenu[] $submenus
 */
class Menu extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;
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
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['news_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name','submenu'], 'string', 'max' => 225],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama Menu',
            'news_id' => 'Konten yang ditampilkan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'submenu' => 'Tambahkan submenu?'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubmenus()
    {
        return $this->hasMany(Submenu::className(), ['menu_id' => 'id']);
    }
    public function setSubmenus($value)
    {
        $this->loadRelated('submenus', $value);
    }

    public static function getContent($id)
    {
        $menu = Menu::findOne($id);
        $submenus =  Submenu::find()->where(['menu_id' => $id]);
        $object = $submenus->all();
        $array = [];
        foreach ($object as $object) {
            $array[] = '- ' . $object->news->title;
        }
        if ($submenus->count() == 0) {
            return $menu->news->title;
        } else {
            return implode('<br>', $array);
        }
    }
}
