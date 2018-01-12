<?php
include ('head.php');
?>
<script>
    function showup() {
        $('#upload').css("display","block");
    }
    function unshowup() {
        $('#upload').css("display","none");
    }
    function selectdir(obj) {
        var dir=obj.value;
        var n = dir.length;
        for(;n>=0;n--){
            if(dir[n] == "\\"){
                break;
            }
        }
        dir = dir.substring(n+1);
        $('#textName').html(dir);
    }
    function deleteweek(id) {
        if(confirm("您确定要删除吗？")){
            window.location.href = "server/file_server.php?del=1&id=" +id;
        }
        else {

        }
    }
</script>
<style>
    .report-file {
        position: relative;
        width: 120px;
        height: 28px;
        overflow: hidden;
        border: 1px solid #428bca;
        background: none repeat scroll 0 0 #428bca;
        color: #fff;
        cursor: pointer;
        text-align: center;
        margin-left: 45px;
        margin-top: -10px;
    }
    .report-file span {
        cursor: pointer;
        display: block;
        line-height: 28px;
    }
    .file-prew {
        cursor: pointer;
        position: absolute;
        top: 0;
        left:0;1

    
        width: 120px;
        height: 30px;
        font-size: 100px;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>
<link rel="stylesheet" type="text/css" href="css/course.css">

<div class="course">
    <?php
    include "server/conn.php";
    $type = $_GET['type'];
    $class = $_GET['class'];
    ?>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="background: #FFFFFF;color: #888888;font-size: 15px;"><?php echo $class;?></div>
        <div class="panel-body">
            <span style="color:#2aabd2;"><h2><?php echo $type;?></h2></span>
            <div style="float: right;">
                <button type="submit" class="btn btn-default" onclick="showup()">上传</button>
            </div>
        </div>
    <table class="table table-hover table-striped" style="text-align: center; overflow: auto;">
        <tr style="color: #3b4249;">
            <td><b>文件名</b></td>
            <td><b>上传时间</b></td>
            <td colspan="2"><b>操作</b></td>
        </tr>
        <?php
        $sql = "select * from week where type = '$type'";
        $rs = $con->query($sql);
        while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $name = $row['name'];
            $time = $row['time'];
            echo "<tr><td>$name</td>";
            echo "<td>$time</td>";
            echo "<td><a class=\"btn btn-danger btn-sm\" href='javascript:void(0);' onclick='deleteweek(".$id.")' role=\"button\">删除</a></td>";
            echo "<td><a class=\"btn btn-info btn-sm\" href='server/file_server.php?d=1&id=$id' role=\"button\">下载</a></tr>";

        }
        ?>
    </table>
    </div>
</div>
</div>
	<!-- E main -->

</div>
<div id="upload" style="width: 500px;height: 300px; background-image: url(imags/uploadbg.png); margin-left: 45%; margin-top: -550px; z-index:99999;position:absolute;color: #FFFFFF;display: none;">
    <form action="server/file_server.php?up=1&<?php echo "class=$class&type=$type";?>" method="post"
          enctype="multipart/form-data">
        <div style=" text-align: center;"><h2>上传文件</h2></div>
        <div style="margin-top: 70px; margin-left: 150px">
            <div class="report-file">
                <span>选择文件</span><input tabindex="3" size="3" name="file" class="file-prew" type="file" onchange="selectdir(this)">
            </div>
            <div id="textName" style="margin-top: 10px;margin-left: -150px;text-align: center;">

            </div>
        </div>
        <div style="float: right;margin-top: 80px;margin-right: 50px;">
            <input type="submit" name="submit" value="上传" class="btn btn-info"/>
        </div>
        <div style="float: right;margin-top: 80px;margin-right: 30px;">
            <button type="button" class="btn btn-default" onclick="unshowup()">取消</button>
        </div>
    </form>
</div>