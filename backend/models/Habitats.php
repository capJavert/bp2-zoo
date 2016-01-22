<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "habitats".
 *
 * @property integer $id
 * @property integer $lenght
 * @property integer $width
 * @property integer $height
 * @property double $latitude
 * @property double $longitude
 * @property integer $open
 *
 * @property AnimalsHabitatsAssigned[] $animalsHabitatsAssigneds
 */
class Habitats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'habitats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lenght', 'width', 'height', 'latitude', 'longitude', 'open'], 'required'],
            [['lenght', 'width', 'height', 'open'], 'integer'],
            [['latitude', 'longitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lenght' => 'Lenght',
            'width' => 'Width',
            'height' => 'Height',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'open' => 'Open',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalsHabitatsAssigneds()
    {
        return $this->hasMany(AnimalsHabitatsAssigned::className(), ['habitat_id' => 'id']);
    }
}
