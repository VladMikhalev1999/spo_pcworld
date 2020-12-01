<?php
function br($str) {
    return "'" . $str . "'";
}
    $db = mysqli_connect('192.168.0.107', 'root', 'root', 'spo');
    $mail = $_REQUEST['mail'];
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "[Error] Incorrect email!";
    }
    else {
        $passwd = $_REQUEST['passwd'];
        $res = mysqli_query($db, "CALL get_salt(" . br($mail) . ")");
        $salt = mysqli_fetch_array($res, MYSQL_NUM)[0];
        mysqli_free_result($res);
        mysqli_close($db);
        $db = mysqli_connect('192.168.0.107', 'root', 'root', 'spo');
        $res = mysqli_query($db, "CALL getUserByEmailPassword(" . br($mail) . "," . br(crypt($passwd, $salt)) . ")");
        if (!$res) {
            echo "[Error] " . mysqli_error($db);
        } else {
            $row = mysqli_fetch_array($res, MYSQL_ASSOC);
        echo "<div style='color: blue;'><p>email:" . $row["email"] . "</p><p>username:" . $row["username"] . "</p><p>login:" . $row["login"] . "</p><p>cryptPasswd:" . $row["passwd"] . "</p><div>";
        }
    }
?>