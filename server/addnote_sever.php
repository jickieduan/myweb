<?php
include ("conn.php");
    if(isset($_GET['addnote'])){
        $title = $_POST['title'];
        $type = $_POST['type'];
        $content = $_POST['content'];

        $sql = "INSERT INTO note (title, time, type, content) VALUES ('$title', now(), '$type', '$content')";
        $con->query($sql);

        header("location:../index.php");
    }
?>
