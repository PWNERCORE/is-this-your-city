<?php

namespace app\controllers;

use app\models\City;
use ArrayObject;
use Yii;
use app\models\Review;
use app\models\ReviewSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use function GuzzleHttp\Promise\all;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Review model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Review model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->city_id) {
                $temp = [];
                $model->city_id = implode(',', $model->city_id);
                $items = explode(',', $model->city_id);
                foreach ($items as $item) {
                    Yii::$app->geolocation->inputCity($item);
                    $inputCity = Yii::$app->geolocation->inputCity($item);
                    if (City::find()->where(['id' => $item])->exists()) {
                        array_push($temp, $item);
                    }
                    else {
                        if (is_integer($item)) {
                            return null;
                        }
                        else {
                            if (City::find()->where(['name' => $inputCity])->exists()) {
                                $tempCity = City::find()->where(['name' => $inputCity])->one();
                                array_push($temp, $tempCity->id);
                            }
                            else {
                                Yii::$app->db->createCommand('INSERT INTO city (name) VALUES (:name)')
                                    ->bindValue(':name', $inputCity)
                                    ->execute();
                                $tempCity = City::find()->where(['name' => $inputCity])->one();
                                array_push($temp, $tempCity->id);
                            }
                        }
                    }
                }
                $model->city_id = implode(',', array_unique($temp));
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        return $this->render('update', ['model' => $model]);
    }
    /**
     * Deletes an existing Review model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSetImage($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->post())
        {
            $image = UploadedFile::getInstance($model, 'img');
            $model->saveImage($model->uploadFile($image, $model->img));
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('image', ['model' => $model]);
    }


    /**
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
