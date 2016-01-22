<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employees', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'oib',
            'firstname',
            'lastname',
            'address',
            [
                'label' => 'Role',
                'format' => 'raw',
                'value' => function ($model) {
                    $assigned = \backend\models\EmployeesRoles::findOne($model->role_id);
                    return $assigned->name;
                },

            ],
            // 'city',
            // 'postal_code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
