<?php
function br($str) {
    return "'" . $str . "'";
}
    $db = mysqli_connect('192.168.0.107', 'root', 'root', 'spo');
    $mail = $_REQUEST['mail'];
    $login = $_REQUEST['login'];
    $name = $_REQUEST['firstName'];
    $passwd = $_REQUEST['passwd'];
    $repasswd = $_REQUEST['rePasswd'];
    if ($passwd == $repasswd) {
        $res = mysqli_query($db, 'CALL add_user(' . br($mail) . ',' . br($name) . ',' . br($login) . ',' . br($passwd) . ')');
        if (!$res) {
            echo "[Error] " . mysqli_error($db);
        } else {
            echo "<h2>Регистрация прошла успешно!</h2><h2>Имя пользователя - " . $name . "</h2><h2>Почтовый ящик - " . $mail . "</h2><a id='inborder' href='index.html'>Вернуться на сайт</a>";
        }
    } else {
        echo "[Error] Passwords don't match!";
    }
?>