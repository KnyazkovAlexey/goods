<?php

namespace app\forms;

use app\models\Category;
use app\models\Good;
use app\models\GoodCategory;
use yii\helpers\ArrayHelper;
use Yii;
use Exception;

class GoodForm extends Good
{
    /**
     * @var int[]
     */
    public $categoryIds;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['categoryIds'], 'required', 'when' => function ($model) {
                return $model->needToSaveCategories();
            }],
            [['categoryIds'], 'each', 'rule' => ['integer']],
            [['categoryIds'], 'validateCategories', 'skipOnError' => true],
        ]);
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateCategories($attribute, $params)
    {
        $categoriesCount = Category::find()->where(['in', 'id', $this->categoryIds])->count();

        if ($categoriesCount != count($this->categoryIds)) {
            $this->addError($attribute, 'Incorrect category list.');
        }
    }

    /**
     * @return bool
     */
    public function needToSaveCategories(): bool
    {
        return $this->isNewRecord || $this->categoryIds !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        $this->cost = round($this->cost, 2);

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->needToSaveCategories() && !$this->saveCategories()) {
            throw new Exception('Failed to save categories.');
        }
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    protected function saveCategories(): bool
    {
        GoodCategory::deleteAll(['good_id' => $this->id]);

        $models = [];
        foreach ($this->categoryIds as $categoryId) {
            $models[] = [$categoryId, $this->id];
        }

        $result = Yii::$app->db->createCommand()
            ->batchInsert(GoodCategory::tableName(), ['category_id', 'good_id'], $models)
            ->execute();

        return $result > 0;
    }
}
