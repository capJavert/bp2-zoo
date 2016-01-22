<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "animals".
 *
 * @property integer $id
 * @property integer $type_id
 * @property integer $gender
 * @property integer $weight
 * @property integer $age
 *
 * @property AnimalsTypes $type
 * @property AnimalsHabitatsAssigned[] $animalsHabitatsAssigneds
 * @property AnimalsRecordsAssigned[] $animalsRecordsAssigneds
 */
class Animals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'gender', 'weight', 'age'], 'required'],
            [['type_id', 'gender', 'weight', 'age'], 'integer'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalsTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Species',
            'gender' => 'Gender',
            'weight' => 'Weight',
            'age' => 'Age',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AnimalsTypes::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalsHabitatsAssigneds()
    {
        return $this->hasMany(AnimalsHabitatsAssigned::className(), ['animal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalsRecordsAssigneds()
    {
        return $this->hasMany(AnimalsRecordsAssigned::className(), ['animal_id' => 'id']);
    }
}
