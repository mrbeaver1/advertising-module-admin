<?php

namespace backend\controllers;

use common\models\Customer;
use common\models\form\CreateCustomerForm;
use common\models\form\UpdateCustomerForm;
use common\models\search\Customer as CustomerSearch;
use common\services\customer\CustomerService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerController implements the CRUD actions for customer model.
 */
class CustomerController extends Controller
{
    private $service;
    public function __construct($id, $module, $config, CustomerService $service)
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
     * Lists all customer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single customer model.
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
     * Creates a new customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form = new CreateCustomerForm();

        if ($this->request->isPost) {
            if ($form->load($this->request->post())) {
                $customer = $this->service->create(
                    $form->url,
                    $form->active,
                    $form->adsIds
                );

                Yii::$app->session->setFlash('success', 'Клиент ' . $form->url . ' успешно добавлен');

                return $this->redirect(['view', 'id' => $customer->id]);
            }
        }

        return $this->render('create', [
            'form' => $form,
        ]);
    }

    /**
     * Updates an existing customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $form = new UpdateCustomerForm($model);

        $adsIds = $this->service->getRelatedAdsIds($model);
        $form->adsIds = $adsIds;

        if ($this->request->isPost && $form->load($this->request->post())) {
            $this->service->update($model, $form->url, $form->active, $form->adsIds);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'form' => $form,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->service->delete($model);

        Yii::$app->session->setFlash('success', 'Клиент ' . $model->url . ' успешно удален');

        return $this->redirect(['index']);
    }

    /**
     * Finds the customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
