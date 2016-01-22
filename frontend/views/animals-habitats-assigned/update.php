<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsHabitatsAssigned */

$this->title = 'Update Animals Habitats Assigned: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Animals Habitats Assigneds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animals-habitats-assigned-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
