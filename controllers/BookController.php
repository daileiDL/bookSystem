<?php

namespace app\controllers;

use app\models\Book;
use app\models\BookForm;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Book controller.
 */
class BookController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * 列表 搜索.
     */
    public function actionIndex()
    {
        $query = Book::find();

        $book_name = trim($_GET['book_name'] ?? '');
        if ($book_name !== '') {
            $query->andWhere(['like', 'book_name', $book_name]);
        }

        $book_author = trim($_GET['book_author'] ?? '');
        if ($book_author !== '') {
            $query->andWhere(['like', 'book_author', $book_author]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $books = $query->orderBy('book_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'books' => $books,
            'pagination' => $pagination,
            'book_name' => $book_name,
            'book_author' => $book_author,
        ]);
    }

    /**
     * 添加.
     */
    public function actionAdd()
    {
        $model = new BookForm();
        $book = new Book();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据
            foreach ($model as $k => $v) {
                $book->$k = $v;
            }
            $book->save();

            return $this->render('book-confirm', ['model' => $model]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('book', ['model' => $model]);
        }
    }

    /**
     * 编辑.
     */
    public function actionEdit($book_id = 1)
    {
        $model = new BookForm();
        $book = Book::findOne($book_id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据
            foreach ($model as $k => $v) {
                if ($v != null) {
                    $book->$k = $v;
                }
            }
            $book->save();

            return $this->render('book-confirm', ['model' => $model]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('book', [
                'model' => $model,
                'book' => $book,
            ]);
        }
    }

    /**
     * 删除.
     */
    public function actionDelete($book_id)
    {
        Book::findOne($book_id)->delete();

        return $this->redirect([
            'book/index',
            'page' => $_GET['page'] ?? 1,
        ]);
    }
}
