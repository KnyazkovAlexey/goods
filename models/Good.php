<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table `{{%goods}}`.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $cost
 * @property int $quantity
 *
 * @property Category[] $categories
 */
class Good extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%goods}}';
    }

    /**
     * {@inheritdoc}
     */
    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'cost', 'quantity'], 'required'],
            [['name'], 'string', 'min' => 10, 'max' => 100],
            [['name'], 'unique'],
            [['description'], 'string', 'max' => 1000],
            [['cost'], 'double'],
            [['cost'], 'compare', 'compareValue' => 0, 'operator' => '>'],
            [['quantity'], 'integer', 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function extraFields(): array
    {
        return [
            'categories',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable(GoodCategory::tableName(), ['good_id' => 'id']);
    }
}
