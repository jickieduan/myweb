<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/4
 * Time: 23:18
 */
?>
<?php
include ("conn.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    $content = $_POST['content'];
    $sql = "UPDATE essay SET title = '$title',type = '$type',content = '$content',time = now() WHERE id = $id";
    $con->query($sql);
    header("location:../essaycontent.php?id=$id");
}
?>
