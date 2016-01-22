<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FoodStocks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-stocks-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Type</label>
        <?= Html::activeDropDownList($model, 'animal_type_id',
            yii\helpers\ArrayHelper::map(\backend\models\AnimalsTypes::find()->all(), 'id', 'name'), ['class'=>'form-control']) ?>
    </div>

    <?= $form->field($model, 'date_arrived')->textInput() ?>

    <?= $form->field($model, 'date_expire')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
