<?php

namespace backend\controllers;

use common\models\Product;
use backend\models\ProductSearch;
use common\models\ProductImage;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->galleryFiles = UploadedFile::getInstances($model, 'galleryFiles');

            if ($model->save()) {

                if ($model->imageFile) {
                    $fileName = 'product_' . $model->id . '.' . $model->imageFile->extension;
                    $model->imageFile->saveAs('@frontend/web/upload/product/' . $fileName);
                    $model->updateAttributes(['image' => $fileName]);
                }

                if ($model->galleryFiles) {
                    foreach ($model->galleryFiles as $file) {

                        $fileName = uniqid() . '.' . $file->extension;
                        $file->saveAs(Yii::getAlias('@frontend/web/upload/product/') . $fileName);

                        $image = new ProductImage();
                        $image->product_id = $model->id;
                        $image->image = $fileName;
                        $image->sort_order = 0;
                        $image->save(false);
                    }
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Product::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }

        $oldImage = $model->image; // asosiy rasmni saqlab qo'yamiz

        if ($model->load(Yii::$app->request->post())) {

            // =============================
            // 1️⃣ ASOSIY RASM
            // =============================
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            $uploadPath = Yii::getAlias('@frontend') . '/web/upload/product/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            if ($model->imageFile) {

                $fileName = 'product_' . $model->id . '_' . time() . '.' . $model->imageFile->extension;
                $model->imageFile->saveAs($uploadPath . $fileName);

                // eski rasmni o‘chiramiz
                if ($oldImage && file_exists($uploadPath . $oldImage)) {
                    unlink($uploadPath . $oldImage);
                }

                $model->image = $fileName;
            } else {
                // yangi rasm yuklanmasa eski rasm qoladi
                $model->image = $oldImage;
            }

            // =============================
            // 2️⃣ MODELNI SAQLAYMIZ
            // =============================
            if ($model->save(false)) {

                // =============================
                // 3️⃣ GALLERY RASMLAR
                // =============================
                $galleryFiles = UploadedFile::getInstances($model, 'galleryFiles');

                if (!empty($galleryFiles)) {

                    foreach ($galleryFiles as $file) {

                        $fileName = uniqid() . '.' . $file->extension;
                        $file->saveAs($uploadPath . $fileName);

                        $image = new ProductImage();
                        $image->product_id = $model->id;
                        $image->image = $fileName;

                        // sort_order oxiriga qo‘shiladi
                        $maxOrder = ProductImage::find()
                            ->where(['product_id' => $model->id])
                            ->max('sort_order');

                        $image->sort_order = $maxOrder + 1;
                        $image->save(false);
                    }
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage()
    {
        $id = Yii::$app->request->post('key');

        $model = ProductImage::findOne($id);

        if ($model) {
            @unlink(Yii::getAlias('@frontend/web/upload/product/') . $model->image);
            $model->delete();
        }

        return json_encode(['success'=>true]);
    }

    public function actionSortImages()
    {
        $order = Yii::$app->request->post('order');

        if ($order) {
            foreach ($order as $index => $id) {
                ProductImage::updateAll(
                    ['sort_order' => $index],
                    ['id' => $id]
                );
            }
        }

        return true;
    }


    public function actionCkUpload()
    {
        $uploadedFile = UploadedFile::getInstanceByName('upload');

        if (!$uploadedFile) {
            echo "No file uploaded";
            exit;
        }

        if (!in_array($uploadedFile->extension, ['jpg','jpeg','png','webp'])) {

            echo "Faqat 'jpg','jpeg','png','webp' formatidagi fayllarni yuklash mumkin!";
            exit;
        }

        if ($uploadedFile->size > 5 * 1024 * 1024) {
            echo "Fayl hajmi 5mb dan katta!";
            exit;
        }

        $uploadPath = Yii::getAlias('@frontend') . '/web/upload/ckeditor/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileName = uniqid() . '.' . $uploadedFile->extension;
        $uploadedFile->saveAs($uploadPath . $fileName);

        // frontend domenini aniqlash
        $frontendHost = preg_replace('/^admin\./', '', Yii::$app->request->hostInfo);

        $url = $frontendHost . '/upload/ckeditor/' . $fileName;

        // 🔥 MUHIM QISM — CKEditor 4 callback
        $funcNum = Yii::$app->request->get('CKEditorFuncNum');

        echo "<script>
        window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '');
    </script>";

        exit;
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
