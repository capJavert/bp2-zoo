<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsRecords */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animals-records-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Employee</label>
        <?= Html::activeDropDownList($model, 'employee_id',
            yii\helpers\ArrayHelper::map(\backend\models\Employees::find()->all(), 'oib',
                function($model) {
                    return $model->firstname.' '.$model->lastname;
                }
            ), ['class'=>'form-control']) ?>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
