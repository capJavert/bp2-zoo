<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "animals_habitats_assigned".
 *
 * @property integer $animal_id
 * @property integer $habitat_id
 * @property string $date_added
 * @property string $date_transfered
 *
 * @property Animals $animal
 * @property Habitats $habitat
 */
class AnimalsHabitatsAssigned extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animals_habitats_assigned';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['animal_id', 'habitat_id'], 'required'],
            [['animal_id', 'habitat_id'], 'integer'],
            [['date_added', 'date_transfered'], 'safe'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animals::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['habitat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Habitats::className(), 'targetAttribute' => ['habitat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => 'Animal ID',
            'habitat_id' => 'Habitat ID',
            'date_added' => 'Date Added',
            'date_transfered' => 'Date Transfered',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animals::className(), ['id' => 'animal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHabitat()
    {
        return $this->hasOne(Habitats::className(), ['id' => 'habitat_id']);
    }
}
