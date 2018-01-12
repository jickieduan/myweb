<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/5
 * Time: 0:40
 */
?>
<?php
include ("server/conn.php");
if(isset($_POST['uptype'])){
    $name = $_POST['name'];
    $brief = $_POST['brief'];
    $sql = "select * from type where type = '$name'";
    $rs = $con->query($sql);
    $rowCount = $rs->rowCount();
    if ($rowCount) {
        echo "<script>alert('类型已存在！');</script>";
    }
    else{
        $sql = "INSERT INTO type (type,brief,class) VALUES ('$name', '$brief', 0)";
        $con->query($sql);
        header("location:index.php");
    }
}
include ('head.php');
?>

<script>
    function Uptype() {
        var name = $('#name').val();
        var brief = $('#brief').val();
        if((name.length == 0 ) | (name.length > 10)){
            alert("标题字数在1-10之间！");
            return false;
        }
        if(brief.length == 0){
            alert("描述不能为空！");
            return false;
        }
    }
</script>
<link rel="stylesheet" type="text/css" href="css/type.css">
<div class="type">
    <div style="width: 400px;height: 300px;margin: 0 auto;margin-top: 200px;">
        <form method="post" action="" onsubmit="return Uptype();" class="form-horizontal">
            笔记类型：<input type="text" class="form-control"; id="name" name="name"><br>
            类型描述：<textarea class="form-control"; name="brief" id="brief"></textarea><br>
            <input class="btn btn-default" style="float: right;" type="submit" name="uptype" value="添加">

        </form>
    </div>
</div>
</div>
</div>
<!-- E main -->

</div>
