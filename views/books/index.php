<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'created_at',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {createAuthors}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-eye"></i>', $url, ['class' => 'btn btn-success btn-xs']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class=\"fa fa-pencil\"></i>', $url, ['class' => 'btn btn-warning btn-xs']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class=\"fa fa-trash\"></i>', $url, ['class' => 'btn btn-danger btn-xs']);
                    },
                    'createAuthors' => function ($url, $model, $key) {
                        return Html::a('<i class=\"fa fa-plus-square\"></i>',
                            ['/authors-books/authors-books', 'id' => $model->id],
                            ['class' => 'btn btn-primary btn-xs']);
                    },
                ],

            ],
        ],
    ]); ?>


</div>
