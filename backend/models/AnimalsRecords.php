<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "animals_records".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property string $title
 * @property string $date_added
 * @property string $description
 *
 * @property Employees $employee
 * @property AnimalsRecordsAssigned[] $animalsRecordsAssigneds
 */
class AnimalsRecords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animals_records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id'], 'integer'],
            [['date_added'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 45],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'oib']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'title' => 'Title',
            'date_added' => 'Date Added',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['oib' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalsRecordsAssigneds()
    {
        return $this->hasMany(AnimalsRecordsAssigned::className(), ['record_id' => 'id']);
    }
}
