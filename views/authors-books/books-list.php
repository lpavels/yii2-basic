<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsBooks */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books list';
$this->params['breadcrumbs'][] = ['label' => 'Books list', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">

        <?php
        $count = 1;
        foreach ($data as $key => $book) { ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $model->getBooksTitle($book['books_id']) ?></td>
                <td><?= $model->getBooksAuthors($book['books_id']) ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

</div>
