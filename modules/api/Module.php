<?php

namespace app\modules\api;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\Response;

class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/categories'],
            ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/goods'],
        ], false);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->request->parsers = [
            'application/json' => 'yii\web\JsonParser',
        ];

        Yii::$app->response->formatters = [
            Response::FORMAT_JSON => [
                'class' => 'yii\web\JsonResponseFormatter'
            ],
        ];

        $this->modules = [
            'v1' => [
                'class' => 'app\modules\api\modules\v1\Module',
            ],
        ];
    }
}