<?php

namespace app\api\v1\controllers;

use app\models\Books;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;


class BooksController extends ActiveController
{
    public $modelClass = Books::class;

    public function actionList()
    {
        $books = Books::find()->all();
        return $this->asJson($books);
    }

    public function actionAdd($id)
    {

        //return $this->asJson($id);


        $model = $this->findModel($id);
        if(!empty($model)){
            return $this->asJson($model);
        }
        else{
            return $this->asJson('not found');
        }

    }

    public function actionUpdate($request)
    {
        /*$model = $this->findModel($request->id);
        $model->title = $request->title;
        if($model->save()){
            return $this->asJson($model);
        }
        else{
            return $this->asJson('Model not saved');
        }*/
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $this->asJson($model);
    }

    public function actionDelete($id)
    {
        $model = Books::findOne($id);
        if(!empty($model)){
            $model->delete();
            return $this->asJson('Model was deleted');
        }
        else{
            return $this->asJson('not found');
        }
    }

    protected function findModel($id)
    {
        if (($model = Books::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
