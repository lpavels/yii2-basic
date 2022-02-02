<?php

namespace app\controllers;

use app\models\Authors;
use app\models\AuthorsBooks;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AuthorsBooksController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        //'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /*public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthorsBooks::find(),

            //'pagination' => [
            //    'pageSize' => 50
            //],
            //'sort' => [
            //    'defaultOrder' => [
            //        'authors_id' => SORT_DESC,
            //        'books_id' => SORT_DESC,
            //    ]
            //],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /*public function actionView($authors_id, $books_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($authors_id, $books_id),
        ]);
    }*/

    /*public function actionCreate()
    {
        $model = new AuthorsBooks();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'authors_id' => $model->authors_id, 'books_id' => $model->books_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    public function actionBooksList()
    {
        $model = new AuthorsBooks();
        $AuthorsBooks = AuthorsBooks::find()->select(['authors_books.books_id'])->groupBy('books_id')->all();

        return $this->render('books-list', [
            'model' => $model,
            'data' => $AuthorsBooks,
        ]);
    }

    public function actionAuthorsList()
    {
        $model = new AuthorsBooks();
        $AuthorsBooks = AuthorsBooks::find()->select(['authors_books.authors_id as authors_id','COUNT(authors_books.authors_id) as count_book'])->groupBy('authors_books.authors_id')->asArray()->all();

        return $this->render('authors-list', [
            'model' => $model,
            'data' => $AuthorsBooks,
        ]);
    }

    public function actionAuthorsBooks($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthorsBooks::find()->joinWith('authors')->where(['books_id'=>$id]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'authors_id' => SORT_DESC,
                    'books_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        $model = new AuthorsBooks();
        $modelsAuthors = new Authors();
        $authorsItems = ArrayHelper::map(Authors::find()->all(), 'id', 'surname');

        if ($this->request->isPost) {
            $model->books_id = $id;
            $model->authors_id = $this->request->post()['Authors']['surname'];
            $model->save();
        }


        return $this->render('authors-books', [
            'dataProvider' => $dataProvider,
            'modelsAuthors' => $modelsAuthors,
            'authorsItems' => $authorsItems,
        ]);
    }

    /*public function actionUpdate($authors_id, $books_id)
    {
        $model = $this->findModel($authors_id, $books_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'authors_id' => $model->authors_id, 'books_id' => $model->books_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /*public function actionDelete($authors_id, $books_id)
    {
        $this->findModel($authors_id, $books_id)->delete();

        return $this->redirect(['index']);
    }*/

    protected function findModel($authors_id, $books_id)
    {
        if (($model = AuthorsBooks::findOne(['authors_id' => $authors_id, 'books_id' => $books_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
