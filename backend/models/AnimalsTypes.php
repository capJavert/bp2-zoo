<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "animals_types".
 *
 * @property integer $id
 * @property string $name
 * @property integer $carnivore
 *
 * @property Animals[] $animals
 * @property FoodStocks[] $foodStocks
 */
class AnimalsTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animals_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'carnivore'], 'required'],
            [['carnivore'], 'integer'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'carnivore' => 'Carnivore',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animals::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFoodStocks()
    {
        return $this->hasMany(FoodStocks::className(), ['animal_type_id' => 'id']);
    }
}
