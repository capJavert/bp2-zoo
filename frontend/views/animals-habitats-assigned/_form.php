<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsHabitatsAssigned */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animals-habitats-assigned-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Animal</label>
        <?= Html::activeDropDownList($model, 'animal_id',
            yii\helpers\ArrayHelper::map(\backend\models\Animals::find()->all(), 'id',
                function($model) {
                    return $model->id.' - '.\backend\models\AnimalsTypes::find()->where(['id'=>$model->type_id])->one()->name.'#'.$model->id;
                }
            ), ['class'=>'form-control']) ?>
    </div>

    <div class="form-group">
        <label>Habitat</label>
        <?= Html::activeDropDownList($model, 'habitat_id',
            yii\helpers\ArrayHelper::map(\backend\models\Habitats::find()->all(), 'id',
                function($model) {
                    return 'HABITAT#'.$model->id;
                }
            ), ['class'=>'form-control']) ?>
    </div>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_transfered')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
