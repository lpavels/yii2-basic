<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsBooks */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors list';
$this->params['breadcrumbs'][] = ['label' => 'Authors list', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead class="font-weight-bold">
        <tr>
            <td>#</td>
            <td>Фамилия</td>
            <td>Кол-во книг</td>
        </tr>
        </thead>

        <tbody>
        <?php
        $count = 1;
        foreach ($data as $key => $book) { ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $model->getAuthor($book['authors_id']) ?></td>
                <td><?= $book['count_book'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>
