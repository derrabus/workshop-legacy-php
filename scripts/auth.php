<?php

if (!empty($_SESSION['is_admin'])) {
    return;
}

header('HTTP/1.1 403 Forbidden');

?>
<html>
<head>
    <title>Error</title>
</head>
<body>
<h1>
    Forbidden
</h1>

<p>
    You are not allowed to see this page.
</p>
</body>
</html>
<?php exit; ?>
