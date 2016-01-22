<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Habitats */

$this->title = 'Create Habitats';
$this->params['breadcrumbs'][] = ['label' => 'Habitats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
