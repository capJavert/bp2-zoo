<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FoodStocks */

$this->title = 'Update Food Stocks: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Food Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="food-stocks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
