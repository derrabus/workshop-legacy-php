<?php

session_start();

?>
<html>
<head>
    <title>
        <?php
        $doc_title = 'Business Listings';
        echo "$doc_title\n";
        ?>
    </title>
</head>
<body>
<h1>
    <?= $doc_title ?>
</h1>

<?php
// establish the database connection

require_once('db_login.php');

$pick_message = 'Click on a category to find business listings:';
?>

<table>
    <tr><td valign="top">
            <table>
                <tr><td class="picklist"><?= $pick_message ?></td></tr>
                <p>
                    <?php
                    // build the scrolling pick list for the categories
                    $sql = "SELECT * FROM categories";
                    $result = $db->query($sql);
                    if (DB::isError($result)) die($result->getMessage( ));
                    while ($row = $result->fetchRow( )){
                        if (DB::isError($row)) die($row->getMessage( ));
                        echo '<tr><td class="formlabel">';
                        echo "<a href=\"$PHP_SELF?cat_id=$row[0]\">";
                        echo "$row[1]</a></td></tr>\n";
                    }
                    ?>
            </table>
        </td>
        <td valign="top">
            <table>
                <tr><th bgcolor="#EEEEEE">Biz ID</th>
                    <th bgcolor="#EEEEEE">Name</th>
                    <th bgcolor="#EEEEEE">Address</th>
                    <th bgcolor="#EEEEEE">City</th>
                    <th bgcolor="#EEEEEE">Telephone</th>
                    <th bgcolor="#EEEEEE">URL</th>
                </tr>
                <?php
                if ($cat_id) {
                    $sql = "SELECT b.* FROM businesses b, biz_categories bc where";
                    $sql .= " bc.category_id = '$cat_id'";
                    $sql .= " and b.business_id = bc.business_id";
                    $result = $db->query($sql);
                    if (DB::isError($result)) die($result->getMessage( ));
                    while ($row = $result->fetchRow( )){
                        if (DB::isError($row)) die($row->getMessage( ));
                        if ($color == 1) {
                            $bg_shade = 'dark';
                            $color = 0;
                        } else {
                            $bg_shade = 'light';
                            $color = 1;
                        }
                        echo "<tr>\n";
                        for($i = 0; $i < count($row); $i++) {
                            echo "<td class=\"$bg_shade\">$row[$i]</td>\n";
                        }
                        echo "</tr>\n";
                    }
                }
                ?>
            </table>
        </td></tr>
</table>
<?php require 'footer.php'; ?>
</body>
</html>
