<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entity\News;

/**
 * NewsSearch represents the model behind the search form about `common\models\entity\News`.
 */
class NewsSearch extends News
{
    public $date1, $date2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'subcategory_id', 'publish_at', 'author_id', 'views', 'status', 'type','created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'content', 'photo', 'date1', 'date2'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'publish_at' => $this->publish_at,
            'author_id' => $this->author_id,
            'views' => $this->views,
            'status' => $this->status,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['between', 'publish_at', $this->date1, $this->date2]);

        return $dataProvider;
    }
}
