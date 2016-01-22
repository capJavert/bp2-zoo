<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AnimalsRecords */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Animals Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-records-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'employee_id',
            'title',
            'date_added',
            'description:ntext',
        ],
    ]) ?>

</div>