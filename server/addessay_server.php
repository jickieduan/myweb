<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/2
 * Time: 14:10
 */
?>
<?php
include ("conn.php");
if(isset($_GET['addessay'])){
    $title = $_POST['title'];
    $type = $_POST['type'];
    $content = $_POST['content'];

    $sql = "INSERT INTO essay (title, time, content, type) VALUES ('$title', now(), '$content', '$type')";
    $con->query($sql);

    header("location:../index.php");
}
?>
