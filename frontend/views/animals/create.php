<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Animals */

$this->title = 'Create Animals';
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
