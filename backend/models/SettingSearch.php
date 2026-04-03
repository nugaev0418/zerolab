<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Setting;

/**
 * SettingSearch represents the model behind the search form of `common\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_at'], 'integer'],
            [['site_name_uz', 'site_name_ru', 'site_name_en', 'about_title_uz', 'about_title_ru', 'about_title_en', 'about_content_uz', 'about_content_ru', 'about_content_en', 'address_uz', 'address_ru', 'address_en', 'phone', 'email', 'telegram', 'instagram', 'facebook'], 'safe'],
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
        $query = Setting::find();

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
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'site_name_uz', $this->site_name_uz])
            ->andFilterWhere(['like', 'site_name_ru', $this->site_name_ru])
            ->andFilterWhere(['like', 'site_name_en', $this->site_name_en])
            ->andFilterWhere(['like', 'about_title_uz', $this->about_title_uz])
            ->andFilterWhere(['like', 'about_title_ru', $this->about_title_ru])
            ->andFilterWhere(['like', 'about_title_en', $this->about_title_en])
            ->andFilterWhere(['like', 'about_content_uz', $this->about_content_uz])
            ->andFilterWhere(['like', 'about_content_ru', $this->about_content_ru])
            ->andFilterWhere(['like', 'about_content_en', $this->about_content_en])
            ->andFilterWhere(['like', 'address_uz', $this->address_uz])
            ->andFilterWhere(['like', 'address_ru', $this->address_ru])
            ->andFilterWhere(['like', 'address_en', $this->address_en])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'facebook', $this->facebook]);

        return $dataProvider;
    }
}
