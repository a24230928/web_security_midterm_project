<?php

include('header.php');

?>
<div class="container">
    <h2>首頁</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">作者</th>
                <th scope="col">留言</th>
                <th scope="col">留言時間</th>
                <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getMessages() as $key => $value) : ?>
                <tr>
                    <td>
                        <?php if ($value['avatar_path']) : ?>
                            <img class="avatar" src="<?= substr($value['avatar_path'], 14); ?>" alt="avatar">
                        <?php else : ?>
                            <img class="avatar" src="avatars/default.png" alt="avatar">
                        <?php endif; ?>
                        <?= filterString($value['account']); ?>
                    </td>
                    <td>
                        <?php if (strlen($value['content']) > 15) : ?>
                            <?= substr($value['content'], 0, 15) . "..."; ?>
                        <?php else : ?>
                            <?= $value['content']; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $value[5]; ?></td>
                    <td>
                        <a href="message.php?id=<?= $value[0] ?>" class="btn btn-secondary me-2" tabindex="-1" role="button">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($user) : ?>
        <hr>
        <h2>留言</h2>
        <form action="message.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">留言內容</label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3" style="resize:none"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">上傳檔案</label>
                <input class="form-control" name="file" type="file" id="formFile">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">留言</button>
            </div>
        </form>
    <?php endif ?>
</div>