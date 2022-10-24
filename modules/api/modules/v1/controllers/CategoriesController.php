<?php

namespace app\modules\api\modules\v1\controllers;

use app\models\Category;

class CategoriesController extends BaseController
{
    /**
     * @inheridoc
     */
    public $modelClass = Category::class;
}