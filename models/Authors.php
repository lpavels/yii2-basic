<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $surname Фамилия
 * @property string $first_name Имя
 * @property string|null $middle_name Отчество
 * @property string $created_at
 *
 * @property AuthorsBooks[] $authorsBooks
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'first_name'], 'required'],
            [['created_at'], 'safe'],
            [['surname', 'first_name', 'middle_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Surname',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[AuthorsBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorsBooks()
    {
        return $this->hasMany(AuthorsBooks::className(), ['authors_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['id' => 'books_id'])->viaTable('authors_books', ['authors_id' => 'id']);
    }
}
