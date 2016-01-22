<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsRecords */

$this->title = 'Update Animals Records: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Animals Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animals-records-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
