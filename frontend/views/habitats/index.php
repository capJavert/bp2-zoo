<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Habitats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitats-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Habitats', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lenght',
            'width',
            'height',
            [
                'label' => 'Animals number',
                'format' => 'raw',
                'value' => function ($model) {
                    $assigned = \backend\models\AnimalsHabitatsAssigned::find()->where(['habitat_id'=>$model->id])->all();
                    return count($assigned);
                },

            ],
            //'latitude',
            // 'longitude',
            // 'open',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
