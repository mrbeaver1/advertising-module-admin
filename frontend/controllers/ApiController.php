<?php

namespace frontend\controllers;

use common\services\ads\AdsService;
use common\services\customer\CustomerService;
use frontend\models\DTO\GetAdsData;
use frontend\models\DTO\RedirectRequestData;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;

class ApiController extends \yii\rest\Controller
{
    private $customerService;
    private $adsService;

    public function __construct($id, $module, $config, CustomerService $customerService, AdsService $adsService)
    {
        parent::__construct($id, $module, $config);

        $this->customerService = $customerService;
        $this->adsService = $adsService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['get-ads', 'redirect'],
                'rules' => [
                    [
                        'actions' => ['get-ads', 'redirect'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'get-ads' => ['post'],
                    'redirect' => ['get'],
                ],
            ],
        ];
    }
    public function actionGetAds()
    {
        $params = $this->request->post();

        $clientId = $params['clientId'] ?? null;
        $adsCount = $params['adsCount'] ?? null;
        $adsRange = $params['adsRange'] ?? null;

        $adsData = new GetAdsData($clientId, $adsCount, $adsRange);

        if (!$adsData->validate()) {
            throw new BadRequestHttpException('Проверьте передаваемые параметры. Поля clientId - число, adsCount - число, adsRange - массив строк', 400);
        }

        $customer = $this->customerService->getById($adsData->clientId);

        $adsIds = $this->customerService->getRelatedAdsIds($customer);

        if (count($adsIds) <= $adsData->adsCount) {
            $availableIds = $adsIds;
        } else {
            $rand = array_rand($adsIds, $adsData->adsCount);

            foreach ($rand as $randKey) {
                $availableIds[] = $adsIds[$randKey];
            }
        }

        $adsResponseData = $this->adsService->getDataForResponse($availableIds, $adsData->adsRange);

        return $this->asJson(['data'=>$adsResponseData]);
    }

    public function actionRedirect()
    {
        $params = $this->request->get();
        $adsId = (int)$params['adsId'] ?? null;
        $redirectTo = $params['redirectTo'] ?? null;

        $redirectDto = new RedirectRequestData($adsId, $redirectTo);

        if (!$redirectDto->validate()) {
            throw new BadRequestHttpException('Поля adsId и adsRange обязательны к заполнению', 400);
        }

        $this->adsService->redirectClick($adsId);

        return $this->redirect($redirectTo);
    }

}
