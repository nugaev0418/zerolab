<?php

namespace frontend\controllers;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;
use common\models\Product;
use common\models\Category;
use common\models\Brand;

class ShopController extends Controller
{

    public function actionIndex()
    {
        $query = Product::find()
            ->with(['category', 'mainImage'])
            ->where(['status' => 1]);

        $request = Yii::$app->request;

        /* CATEGORY FILTER */
        $selectedCategories = $request->get('category', []);
        if (!empty($selectedCategories)) {
            $query->andWhere(['category_id' => $selectedCategories]);
        }

        /* BRAND FILTER */
        $selectedBrands = $request->get('brand', []);
        if (!empty($selectedBrands)) {
            $query->andWhere(['brand_id' => $selectedBrands]);
        }

        /* SORT */
        $sort = $request->get('sort');

        if ($sort == 'name_asc') {
            $query->orderBy(['name_uz' => SORT_ASC]);
        } elseif ($sort == 'name_desc') {
            $query->orderBy(['name_uz' => SORT_DESC]);
        } else {
            $query->orderBy(['id' => SORT_DESC]);
        }

        /* DATA PROVIDER */
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        $categories = Category::find()->where(['status'=>1])->all();
        $brands = Brand::find()->where(['status'=>1])->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'brands' => $brands,
            'selectedCategories' => $selectedCategories,
            'selectedBrands' => $selectedBrands,
        ]);
    }
}