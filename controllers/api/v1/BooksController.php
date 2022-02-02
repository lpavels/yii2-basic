<?php

namespace app\controllers\api\v1;

use app\models\Books;
//use app\controllers\api\v1\BaseApiController;
use yii\rest\ActiveController;

class BooksController extends ActiveController
{
    public $modelClass = Books::class;

    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['update'] = ['POST'];

        return $verbs;
    }

    public function actionList()
    {
        return $this->asJson(Books::find()->all());
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->save();
    }

}
