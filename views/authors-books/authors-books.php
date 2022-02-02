<?php

use yii\bootstrap4\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $authorsItems */
/* @var $this yii\web\View */
/* @var $model app\models\AuthorsBooks */
/* @var $modelsAuthors app\models\Authors */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors of books' . $model->title ;
$this->params['breadcrumbs'][] = ['label' => 'Authors of books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-books-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'surname',
                'value' => 'authors.surname',

            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url,$model,$key) {
                        return Html::a('<i class=\"fa fa-trash\"></i>', $url, ['class' => 'btn btn-danger btn-xs']);
                    },
                ],

            ],
        ],
    ]); ?>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelsAuthors, 'surname')->dropdownList($authorsItems)->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
