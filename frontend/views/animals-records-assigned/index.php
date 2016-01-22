<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animals Records Assigneds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-records-assigned-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Animals Records Assigned', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'animal_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $assigned = \backend\models\Animals::findOne($model->animal_id);
                    return $assigned->id.' - '.\backend\models\AnimalsTypes::find()->where(['id'=>$assigned->type_id])->one()->name.'#'.$assigned->id;
                },

            ],
            [
                'attribute' => 'record_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $assigned = \backend\models\AnimalsRecords::findOne($model->record_id);
                    return $assigned->title;
                },

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
