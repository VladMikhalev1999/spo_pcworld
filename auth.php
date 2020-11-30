<?php
function br($str) {
    return "'" . $str . "'";
}
    $db = mysqli_connect('192.168.0.107', 'root', 'root', 'spo');
    $mail = $_REQUEST['mail'];
    $passwd = $_REQUEST['passwd'];
    $res = mysqli_query($db, "CALL getUserByEmailPassword(" . br($mail) . "," . br($passwd) . ")");
    if (!$res) {
        echo "[Error] " . mysqli_error($db);
    } else {
        $row = mysqli_fetch_array($res, MYSQL_ASSOC);
        echo "<div style='color: blue;'><p>email:" . $row["email"] . "</p><p>username:" . $row["username"] . "</p><p>login:" . $row["login"] . "</p><p>password:" . $row["passwd"] . "</p><div>";
    }
?>