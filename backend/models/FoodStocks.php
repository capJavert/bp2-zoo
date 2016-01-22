<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "food_stocks".
 *
 * @property integer $id
 * @property integer $animal_type_id
 * @property string $date_arrived
 * @property string $date_expire
 * @property integer $weight
 *
 * @property AnimalsTypes $animalType
 */
class FoodStocks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_stocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['animal_type_id', 'weight'], 'required'],
            [['animal_type_id', 'weight'], 'integer'],
            [['date_arrived', 'date_expire'], 'safe'],
            [['animal_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalsTypes::className(), 'targetAttribute' => ['animal_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'animal_type_id' => 'Animal Type ID',
            'date_arrived' => 'Date Arrived',
            'date_expire' => 'Date Expire',
            'weight' => 'Weight',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalType()
    {
        return $this->hasOne(AnimalsTypes::className(), ['id' => 'animal_type_id']);
    }
}
