<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/6
 * Time: 13:04
 */
?>
<?php
include ("conn.php");
#添加
if(isset($_GET['up'])){
    if ($_FILES["file"]["error"] > 0)
    {
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        $class = $_GET['class'];
        $type = $_GET['type'];
        $name = $_FILES["file"]["name"];
        $path = "/var/www/file/".$class."/".$type."/";
        if (file_exists($path .$name ))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"],
                $path . $name);
            $sql = "INSERT INTO week (name,type,time) VALUES ('$name', '$type', now())";
            $con->query($sql);
            header("location:../course.php?class=$class&type=$type");
        }
    }
}
#删除
if(isset($_GET['del'])){
    $id = $_GET['id'];
    $sql = "select * from week where id = $id";
    $rs = $con->query($sql);
    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
        $type = $row['type'];
        $name = $row['name'];
    }
    $sql = "select * from course where TYPE = '$type'";
    $rs = $con->query($sql);
    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
        $class = $row['class'];
    }
    $file = "/var/www/file/".$class."/".$type."/".$name;
    if (!unlink($file))
    {
        echo ("删除文件 $name 时发生错误");
    }
    else
    {
        $sql = "delete from week where id = $id";
        $rs = $con->query($sql);
        header("location:../course.php?class=$class&type=$type");
    }

}
#下载
if(isset($_GET['d'])){
    $id = $_GET['id'];
    $sql = "select * from week where id = $id";
    $rs = $con->query($sql);
    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
        $type = $row['type'];
        $name = $row['name'];
    }
    $sql = "select * from course where TYPE = '$type'";
    $rs = $con->query($sql);
    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
        $class = $row['class'];
    }
    $dir = "/var/www/file/".$class."/".$type."/";
    $file_name = $name;     //下载文件名
    $file_dir = $dir;        //下载文件存放目录
//检查文件是否存在
    if (! file_exists ( $file_dir . $file_name )) {
        echo "文件找不到";
        exit ();
    } else {
        //打开文件
        $file = fopen ( $file_dir . $file_name, "r" );
        //输入文件标签
        Header ( "Content-type: application/octet-stream" );
        Header ( "Accept-Ranges: bytes" );
        Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );
        Header ( "Content-Disposition: attachment; filename=" . $file_name );
        //输出文件内容
        //读取文件内容并直接输出到浏览器
        echo fread ( $file, filesize ( $file_dir . $file_name ) );
        fclose ( $file );
        exit ();
    }

}

?>
