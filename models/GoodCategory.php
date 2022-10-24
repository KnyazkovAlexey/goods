<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table `{{%good_category}}`.
 *
 * @property int $id
 * @property int $good_id
 * @property int $category_id
 */
class GoodCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%good_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['good_id', 'category_id'], 'required'],
            [['good_id', 'category_id'], 'integer'],
            [['good_id', 'category_id'], 'unique', 'targetAttribute' => ['good_id', 'category_id']],
            [['good_id'], 'exist', 'targetClass' => Good::class],
            [['category_id'], 'exist', 'targetClass' => Category::class],
        ];
    }
}
