<?php

namespace app\models;

use function PHPUnit\Framework\throwException;
use Yii;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property integer $created_date
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
            [['color'], 'required'],
            [['id'], 'integer'],
            [['created_date', 'fall_date'], 'safe'],
            [['eat', 'size'], 'number'],
            [['color', 'status', 'state'], 'string', 'max' => 50],
            [['id'], 'unique'],

        ];
    }

    public function getColor()
    {
        return $this->_color;
    }

    public function setColor($value)
    {
        $this->_color = $value;
    }

    public function eat($eated)
    {
        if ($this->status == 'ontree' || $this->state == 'spoiled') {
            $this->size = 1;
            $this->eat = $eated;
            throw new NotFoundHttpException('Съесть нельзя, яблоко на дереве');
        } else {
            $this->eat = $eated;
            $this->size = round(1 - $eated / 100, 2);
        }
    }

    public function fallToGround()
    {
        if ($this->status == 'ontree') {
            $this->state = 'fell';
            $this->status = 'fell';
            $this->fall_date = strtotime('now');
        }
    }

    public function getApple($color)
    {
        $this->color = $color;
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
