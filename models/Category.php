<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table `{{%categories}}`.
 *
 * @property int $id
 * @property string $name
 *
 * @property Good[] $goods
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%categories}}';
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
            [['name'], 'required'],
            [['name'], 'string'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getGoods()
    {
        return $this->hasMany(Good::class, ['id' => 'good_id'])
            ->viaTable(GoodCategory::tableName(), ['category_id' => 'id']);
    }
}
