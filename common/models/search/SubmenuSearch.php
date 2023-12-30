<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entity\Submenu;

/**
 * SubmenuSearch represents the model behind the search form about `common\models\entity\Submenu`.
 */
class SubmenuSearch extends Submenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_menu', 'status', 'category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sub_title', 'sub_url'], 'safe'],
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
        $query = Submenu::find();

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
            'id_menu' => $this->id_menu,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'sub_url', $this->sub_url]);

        return $dataProvider;
    }
}
