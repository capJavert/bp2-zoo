<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsRecords */

$this->title = 'Create Animals Records';
$this->params['breadcrumbs'][] = ['label' => 'Animals Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-records-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
