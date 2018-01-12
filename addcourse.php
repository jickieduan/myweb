<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/6
 * Time: 15:26
 */
?>
<?php
include ("server/conn.php");
if(isset($_POST['addcourse'])){
    $name = $_POST['name'];
    $cl = $_POST['cl'];
    $sql = "select * from course where type = '$name'";
    $rs = $con->query($sql);
    $rowCount = $rs->rowCount();
    if ($rowCount) {
        echo "<script>alert('类型已存在！');</script>";
    }
    else{
        $dir = "/var/www/file/".$cl."/".$name;
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
            $sql = "INSERT INTO course (type,class) VALUES ('$name', '$cl')";
            $con->query($sql);
            header("location:index.php");
        } else {
            echo '<script>alert(\'需创建的文件夹已经存在！\');</script>';
        }
    }
}
include ('head.php');
?>

<script>
    function addcourse() {
        var name = $('#name').val();
        if((name.length == 0 ) | (name.length > 10)){
            alert("课程名在1-10之间！");
            return false;
        }
    }
</script>
<link rel="stylesheet" type="text/css" href="css/type.css">
<div class="type">
    <div style="width: 400px;height: 300px;margin: 0 auto;margin-top: 200px;">
        <form method="post" action="" onsubmit="return addcourse();" class="form-horizontal">
            课程名称：<input type="text" class="form-control"; id="name" name="name"><br>
            选择学期：<select name="cl" id="cl">
                <option value="大三下">大三下</option>
                <option value="大四上">大四上</option>
                <option value="大四下">大三下</option>
            <input class="btn btn-default" style="float: right;" type="submit" name="addcourse" value="添加">

        </form>
    </div>
</div>
</div>
</div>
<!-- E main -->

</div>
