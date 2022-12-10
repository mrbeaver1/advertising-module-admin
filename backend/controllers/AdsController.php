<?php

namespace backend\controllers;

use common\components\ImageHelper;
use common\models\Ads;
use common\models\form\CreateAdsForm;
use common\models\form\UpdateAdsForm;
use common\models\search\Ads as AdsSearch;
use common\services\ads\AdsService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdsController implements the CRUD actions for Ads model.
 */
class AdsController extends Controller
{
    private $service;

    public function __construct($id, $module, $config, AdsService $service)
    {
        parent::__construct($id, $module, $config);

        $this->service = $service;
    }

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
     * Lists all Ads models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ads model.
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
     * Creates a new Ads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form = new CreateAdsForm();

        if ($this->request->isPost) {
            if ($form->load($this->request->post())) {
                $form->image = UploadedFile::getInstance($form, 'image');

                $image = ImageHelper::upload($form->image);
                $ads = $this->service->create($image, $form->dateStart, $form->dateEnd, $form->redirectUrl);

                return $this->redirect(['view', 'id' => $ads->id]);
            }
        }

        return $this->render('create', [
            'form' => $form,
        ]);
    }

    /**
     * Updates an existing Ads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $form = new UpdateAdsForm($model);

        if ($this->request->isPost && $form->load($this->request->post())) {
            $image = UploadedFile::getInstance($form, 'image');

            if (!is_null($image)) {
                $imageFile = ImageHelper::upload($image);
            } else {
                $imageFile = $model->image;
            }

            $model = $this->service->update($model, $imageFile, $form->dateStart, $form->dateEnd, $form->redirectUrl);
            Yii::$app->session->setFlash('success', 'Рекламное объявление (ID:  ' . $model->id . ') успешно обновлено');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'form' => $form,
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Ads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->service->delete($model);
        Yii::$app->session->setFlash('success', 'Рекламное объявление (ID:  ' . $model->id . ') успешно удалено');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ads::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
