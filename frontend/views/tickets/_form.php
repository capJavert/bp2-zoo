<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Employee</label>
        <?= Html::activeDropDownList($model, 'employee_id',
            yii\helpers\ArrayHelper::map(\backend\models\Employees::find()->where(['role_id' => 4])->all(), 'oib',
                function($model) {
                    return $model->firstname.' '.$model->lastname;
                }
            ), ['class'=>'form-control']) ?>
    </div>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_expire')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'cash')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
