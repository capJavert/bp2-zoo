<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsRecordsAssigned */

$this->title = 'Update Animals Records Assigned: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Animals Records Assigneds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animals-records-assigned-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
