<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsHabitatsAssigned */

$this->title = 'Create Animals Habitats Assigned';
$this->params['breadcrumbs'][] = ['label' => 'Animals Habitats Assigneds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-habitats-assigned-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
