<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'brand_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'name_uz', 'name_ru', 'name_en', 'catalog_number', 'short_description_uz', 'short_description_ru', 'short_description_en', 'description_uz', 'description_ru', 'description_en', 'meta_title_uz', 'meta_title_ru', 'meta_title_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en', 'image'], 'safe'],

            [['category_id', 'brand_id', 'status'], 'integer'],
        ];
    }

    public $category_id;
    public $brand_id;

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
        $query = Product::find()->with(['category', 'brand']);

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
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'catalog_number', $this->catalog_number])
            ->andFilterWhere(['like', 'short_description_uz', $this->short_description_uz])
            ->andFilterWhere(['like', 'short_description_ru', $this->short_description_ru])
            ->andFilterWhere(['like', 'short_description_en', $this->short_description_en])
            ->andFilterWhere(['like', 'description_uz', $this->description_uz])
            ->andFilterWhere(['like', 'description_ru', $this->description_ru])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'meta_title_uz', $this->meta_title_uz])
            ->andFilterWhere(['like', 'meta_title_ru', $this->meta_title_ru])
            ->andFilterWhere(['like', 'meta_title_en', $this->meta_title_en])
            ->andFilterWhere(['like', 'meta_description_uz', $this->meta_description_uz])
            ->andFilterWhere(['like', 'meta_description_ru', $this->meta_description_ru])
            ->andFilterWhere(['like', 'meta_description_en', $this->meta_description_en])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
