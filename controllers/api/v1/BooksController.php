<?php

namespace app\controllers\api\v1;

use app\models\Books;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class BooksController extends ActiveController
{
    public $modelClass = Books::class;

    public function actionList()
    {
        return $this->asJson(Books::find()->all());
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->save();
    }


    protected function findModel($id)
    {
        if (($model = Books::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
