<?php

require_once('db_login.php');

$error = '';

if ($_POST['username'] && $_POST['password']) {
    $sql = 'SELECT username, password, is_admin FROM users WHERE username = \'' . $_POST['username'] . '\'';
    $result = $db->query($sql);
    if (DB::isError($result)) die($result->getMessage( ));

    $row = $result->fetchRow( );

    if ($row && $row[1] === md5($_POST['password'])) {
        session_start();
        $_SESSION['username'] = $row[0];
        $_SESSION['is_admin'] = (bool) $row[2];

        header('Location: /');
        exit;
    }

    $error = 'Login failed.';
}

?>
<html>
<head>
    <title>
        <?php
        $doc_title = 'Login';
        echo "$doc_title\n";
        ?>
    </title>
</head>
<body>
<h1>
    <?= $doc_title ?>
</h1>

<form method="POST">
    <p><b><?= $error ?></b></p>

    <p>Username: <input name="username" type="text" /></p>
    <p>Password: <input name="password" type="password" /></p>
    <p><input type="submit" /></p>
</form>

</body>
</html>
