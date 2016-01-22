<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "animals_records_assigned".
 *
 * @property integer $animal_id
 * @property integer $record_id
 *
 * @property Animals $animal
 * @property AnimalsRecords $record
 */
class AnimalsRecordsAssigned extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animals_records_assigned';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['animal_id', 'record_id'], 'required'],
            [['animal_id', 'record_id'], 'integer'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animals::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalsRecords::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => 'Animal ID',
            'record_id' => 'Record title',
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
    public function getRecord()
    {
        return $this->hasOne(AnimalsRecords::className(), ['id' => 'record_id']);
    }
}
