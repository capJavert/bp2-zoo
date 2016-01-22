<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Animals', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Assign Habitats', '/animals-habitats-assigned', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Assign Records', '/animals-records-assigned', ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'type_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return \backend\models\AnimalsTypes::findOne($model->type_id)->name;
                },

            ],
            [
                'label' => 'Habitat',
                'format' => 'raw',
                'value' => function ($model) {
                    $assigned = \backend\models\AnimalsHabitatsAssigned::find()->where('animal_id='.$model->id)->one();

                    if(!$assigned) return '/';

                    $habitat = \backend\models\Habitats::findOne($assigned->habitat_id);
                    return 'HABITAT#'.$habitat->id;
                },

            ],
            [
                'attribute' => 'gender',
                'format' => 'raw',
                'value' => function ($model) {
                    return ($model->gender ? 'Male':'Female');
                },

            ],
            'weight',
            'age',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
