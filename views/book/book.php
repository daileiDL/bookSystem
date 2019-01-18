<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

    <?=$form->field($model, 'book_name')->label('书名')->input('text', ['value' => isset($book) ? $book->book_name : '']); ?>
    <?=$form->field($model, 'book_author')->label('作者')->input('text', ['value' => isset($book) ? $book->book_author : '']); ?>
    <?=$form->field($model, 'book_publish')->label('出版社')->input('text', ['value' => isset($book) ? $book->book_publish : '']); ?>
    <?=$form->field($model, 'book_date')
            ->label('出版时间')
            // ->input('text', ['value' => isset($book) ? $book->book_date : ''])
            ->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => '',
                    'autocomplete' => 'off',
                    'value' => isset($book) ? $book->book_date : '',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ]);
    ?>
    <?=$form->field($model, 'book_summary')->label('简介')->input('text', ['value' => isset($book) ? $book->book_summary : '']); ?>
    <?=$form->field($model, 'book_remark')->label('备注')->input('text', ['value' => isset($book) ? $book->book_remark : '']); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-4">
            <?=Html::submitButton('提 交', ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>