<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EmployeesRoles */

$this->title = 'Create Employees Roles';
$this->params['breadcrumbs'][] = ['label' => 'Employees Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
