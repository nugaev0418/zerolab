<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Slider;

/**
 * SliderSearch represents the model behind the search form of `common\models\Slider`.
 */
class SliderSearch extends Slider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title_uz', 'title_ru', 'title_en', 'text_uz', 'text_ru', 'text_en', 'image', 'url'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Slider::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title_uz', $this->title_uz])
            ->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'text_uz', $this->text_uz])
            ->andFilterWhere(['like', 'text_ru', $this->text_ru])
            ->andFilterWhere(['like', 'text_en', $this->text_en])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
