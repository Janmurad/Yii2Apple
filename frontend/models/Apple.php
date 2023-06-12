<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property string $created_date
 * @property string|null $fall_date
 * @property string $status
 * @property string $state
 * @property float $eat
 * @property float $size
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'color'], 'required'],
            [['id'], 'integer'],
            [['created_date', 'fall_date'], 'safe'],
            [['eat', 'size'], 'number'],
            [['color', 'status', 'state'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'created_date' => 'Created Date',
            'fall_date' => 'Fall Date',
            'status' => 'Status',
            'state' => 'State',
            'eat' => 'Eat',
            'size' => 'Size',
        ];
    }
}
