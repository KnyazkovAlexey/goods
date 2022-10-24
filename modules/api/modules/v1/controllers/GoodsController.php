<?php

namespace app\modules\api\modules\v1\controllers;

use app\forms\GoodForm;

class GoodsController extends BaseController
{
    /**
     * @inheridoc
     */
    public $modelClass = GoodForm::class;
}