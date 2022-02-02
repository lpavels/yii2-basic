<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors_books".
 *
 * @property int $authors_id
 * @property int $books_id
 *
 * @property Authors $authors
 * @property Books $books
 */
class AuthorsBooks extends \yii\db\ActiveRecord
{
    public $authorSurname;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors_books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authors_id', 'books_id'], 'required'],
            [['authors_id', 'books_id'], 'integer'],
            [['authors_id', 'books_id'], 'unique', 'targetAttribute' => ['authors_id', 'books_id']],
            [
                ['authors_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Authors::className(),
                'targetAttribute' => ['authors_id' => 'id']
            ],
            [
                ['books_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Books::className(),
                'targetAttribute' => ['books_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'authors_id' => 'Authors ID',
            'books_id' => 'Books ID',
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasOne(Authors::className(), ['id' => 'authors_id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasOne(Books::className(), ['id' => 'books_id']);
    }

    public function getAuthor($id)
    {
        return Authors::findOne($id)->surname;
    }

    public function getBooksTitle($id)
    {
        return Books::findOne($id)->title;
    }

    public function getBooksAuthors($id)
    {
        $authorsBooks = AuthorsBooks::find()->select(['authors.surname as authorSurname'])->joinWith('authors')->where(['authors_books.books_id' => $id])->all();

        foreach ($authorsBooks as $authors) {
            $author .= $authors['authorSurname'] . ', ';
        }
        $author = substr($author, 0, -2);

        return $author;
    }
}
