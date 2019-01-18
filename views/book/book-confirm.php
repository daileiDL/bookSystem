<?php
use yii\helpers\Html;
?>
<p>您已输入以下信息：</p>

<ul>
    <li><label>书名</label>: <?= Html::encode($model->book_name) ?></li>
    <li><label>作者</label>: <?= Html::encode($model->book_author) ?></li>
    <li><label>作者</label>: <?= Html::encode($model->book_publish) ?></li>
    <li><label>作者</label>: <?= Html::encode($model->book_date) ?></li>
    <li><label>作者</label>: <?= Html::encode($model->book_summary) ?></li>
    <li><label>作者</label>: <?= Html::encode($model->book_remark) ?></li>
</ul>