<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsTypes */

$this->title = 'Create Animals Types';
$this->params['breadcrumbs'][] = ['label' => 'Animals Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
