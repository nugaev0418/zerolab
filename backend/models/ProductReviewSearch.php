<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductReview;

/**
 * ProductReviewSearch represents the model behind the search form of `common\models\ProductReview`.
 */
class ProductReviewSearch extends ProductReview
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'rating', 'status', 'created_at'], 'integer'],
            [['full_name', 'phone', 'review'], 'safe'],
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
        $query = ProductReview::find();

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
            'product_id' => $this->product_id,
            'rating' => $this->rating,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'review', $this->review]);

        return $dataProvider;
    }
}
