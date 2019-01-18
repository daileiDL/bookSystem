<?php

namespace app\models;

use yii\base\Model;

class BookForm extends Model
{
    public $book_id;
    public $book_name;
    public $book_author;
    public $book_publish;
    public $book_date;
    public $book_summary;
    public $book_remark;

    public function rules()
    {
        return [
            [['book_name', 'book_author', 'book_publish', 'book_date', 'book_summary', 'book_remark'], 'required'],
        ];
    }
}
