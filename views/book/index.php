<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;

$this->title = '图书列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <form class="navbar-form navbar-left" role="search" method="get" action="/yii/web/index.php?r=book/index">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="书名" name="book_name" value="<?=$book_name; ?>">
            <input type="hidden" name="r" value="book/index">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="作者" name="book_author" value="<?=$book_author; ?>">
        </div>
        <button type="submit" class="btn btn-default">查找</button>
    </form>
    <div class="navbar-header pull-right">
        <a href="/yii/web/index.php?r=book/add" type="button" class="btn btn-primary navbar-btn">添加图书</a>
    </div>
  </div>
</nav>
<table class="table table-bordered table-hover table-striped text-center">
    <tr class="info">
        <th class="text-center">#</th>
        <th class="text-center">书名</th>
        <th class="text-center">作者</th>
        <th class="text-center">出版社</th>
        <th class="text-center">出版日期</th>
        <th class="text-center">简介</th>
        <th class="text-center">备注</th>
        <th class="text-center">操作</th>
    </tr>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><?=$book->book_id; ?></td>
            <td><?=$book->book_name; ?></td>
            <td><?=$book->book_author; ?></td>
            <td><?=$book->book_publish; ?></td>
            <td><?=$book->book_date; ?></td>
            <td><?=$book->book_summary; ?></td>
            <td><?=$book->book_remark; ?></td>
            <td>
                <a href="/yii/web/index.php?r=book/edit&book_id=<?=$book->book_id; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;
                <a href="/yii/web/index.php?r=book/delete&book_id=<?=$book->book_id; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?=LinkPager::widget([
    'pagination' => $pagination,
    'nextPageLabel' => '下一页',
    'prevPageLabel' => '上一页',
    'firstPageLabel' => '首页',
    'lastPageLabel' => '尾页',
    'maxButtonCount' => 5,
    ]); ?>
