<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property string $date_added
 * @property string $date_expire
 * @property double $price
 * @property integer $cash
 *
 * @property Employees $employee
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'price', 'cash'], 'required'],
            [['employee_id', 'cash'], 'integer'],
            [['date_added', 'date_expire'], 'safe'],
            [['price'], 'number'],
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
            'date_added' => 'Date Added',
            'date_expire' => 'Date Expire',
            'price' => 'Price',
            'cash' => 'Cash',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['oib' => 'employee_id']);
    }
}
