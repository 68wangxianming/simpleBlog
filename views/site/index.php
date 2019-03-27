<?php
$this->title = '图书管理系统';
?>
<input type="text" class="form-control" placeholder="输入文章id">
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
                    <button type="button" class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
