<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsRecordsAssigned */

$this->title = 'Create Animals Records Assigned';
$this->params['breadcrumbs'][] = ['label' => 'Animals Records Assigneds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-records-assigned-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
