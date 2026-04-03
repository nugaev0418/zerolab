<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Brand;

/**
 * BrandSearch represents the model behind the search form of `common\models\Brand`.
 */
class BrandSearch extends Brand
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'name_uz', 'name_ru', 'name_en', 'logo', 'website', 'meta_title_uz', 'meta_title_ru', 'meta_title_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en'], 'safe'],
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
        $query = Brand::find();

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'meta_title_uz', $this->meta_title_uz])
            ->andFilterWhere(['like', 'meta_title_ru', $this->meta_title_ru])
            ->andFilterWhere(['like', 'meta_title_en', $this->meta_title_en])
            ->andFilterWhere(['like', 'meta_description_uz', $this->meta_description_uz])
            ->andFilterWhere(['like', 'meta_description_ru', $this->meta_description_ru])
            ->andFilterWhere(['like', 'meta_description_en', $this->meta_description_en]);

        return $dataProvider;
    }
}
