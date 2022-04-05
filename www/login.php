<?php

include('config.php');
include('header.php');

if (isset($_SESSION['account'])) { // redirect
    $message = REDIRECT_TO_INDEX;
} elseif (isset($_POST['account']) && isset($_POST['password'])) { // register
    $stat = $link->prepare('SELECT * FROM users WHERE `account` = ?');
    $stat->bind_param('s', $_POST['account']);
    $stat->execute();
    $result = $stat->get_result()->fetch_assoc();

    if (isset($result['password']) && password_verify($_POST['password'], $result['password'])) {
        $_SESSION['account'] = $_POST['account'];
        $message = REDIRECT_TO_INDEX;
    } else {
        $message = '登入失敗';
    }
}

?>

<div class="container">
    <h2>登入</h2>
    <?= @$message; ?>
    <form action="" method="POST">
        <input type="text" name="account" id=""><br><br>
        <input type="password" name="password" id=""><br><br>
        <input type="submit" value="送出">
    </form>
</div>