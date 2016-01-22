<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property integer $oib
 * @property integer $role_id
 * @property string $firstname
 * @property string $lastname
 * @property string $address
 * @property string $city
 * @property integer $postal_code
 *
 * @property AnimalsRecords[] $animalsRecords
 * @property EmployeesRoles $role
 * @property Tickets[] $tickets
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oib', 'role_id', 'firstname', 'lastname', 'address', 'city', 'postal_code'], 'required'],
            [['oib', 'role_id', 'postal_code'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 60],
            [['city'], 'string', 'max' => 50],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmployeesRoles::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oib' => 'Oib',
            'role_id' => 'Role ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'address' => 'Address',
            'city' => 'City',
            'postal_code' => 'Postal Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalsRecords()
    {
        return $this->hasMany(AnimalsRecords::className(), ['employee_id' => 'oib']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(EmployeesRoles::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['employee_id' => 'oib']);
    }
}
