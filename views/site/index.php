<?php
$this->title = '图书管理系统';

$form = \yii\bootstrap\ActiveForm::begin();

echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'author')->textInput();
echo $form->field($model, 'desc')->textInput();
echo '<input type="submit" name="chooseType"  value="添加" class="btn btn-primary"/>';
echo '<span>   </span>';
echo '<input type="submit" name="chooseType" value="搜索" class="btn btn-primary"/>';
\yii\bootstrap\ActiveForm::end();
?>

<div class="site-index">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>书名</th>
            <th>作者</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($data as $d): ?>
            <tr>
                <td class="active"><?php echo $d->id ?></td>
                <td class="success" width="130"><?php echo $d->name ?></td>
                <td class="warning" width="130"><?php echo $d->author ?></td>
                <td class="info"><?php echo $d->desc ?></td>
                <td class="danger" width="60">
                    <?= \yii\bootstrap\Html::a('删除', ['/', 'id' => $d->id, 'action' => 'delete']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
