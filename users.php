<?php
    $name = $_REQUEST["mail"];
    $db = mysqli_connect('192.168.0.107', 'root', 'root', 'spo');
    $res = mysqli_query($db, "SELECT COUNT(email) AS CNT FROM users WHERE email = '" . $name . "'");
    $data = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $cnt = $data['CNT'];
    echo $cnt;
?>