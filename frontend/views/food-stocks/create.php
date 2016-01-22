<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FoodStocks */

$this->title = 'Create Food Stocks';
$this->params['breadcrumbs'][] = ['label' => 'Food Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-stocks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
