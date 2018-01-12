<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/4
 * Time: 23:27
 */
?>
<?php
include ("head.php");
?>
<script>
    function addnote() {
        var name = $('#title').val();
        var content = ue.getContent();
        if (name == "") {
            alert("标题不能为空！");
            return false;
        }
        else if (content == "") {
            alert("内容不能为空！");
            return false;
        }
        else {
            return true;
        }
    }
</script>
<link rel="stylesheet" type="text/css" href="css/addnote.css">
<?php
include ('server/conn.php');
$id = $_GET['id'];
$sql = "select * from note where id = $id";
$rs = $con->query($sql);
while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
    $title = $row['title'];
    $type = $row['type'];
    $content = $row['content'];
}
echo"<form action=\"server/updatenotes_server.php?id=$id\" method=\"post\" onsubmit=\"return addnote()\">";
echo "<div class=\"con\">";
echo "<div class=\"title\">";
echo "<input type=\"text\" class=\"t-value\" name=\"title\" id=\"title\" value='$title'>";
echo " <div class=\"type\">";
echo "<span>属于:</span>";
echo "<select class=\"t-select\" name=\"type\">";
$sql = "select * from type where class = 0";
$rs = $con->query($sql);
while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
    $tname = $row['type'];
    if($tname == $type){
        echo "<option value=\"$tname\" selected='selected'>$tname</option>";
    }else{
        echo "<option value=\"$tname\">$tname</option>";
    }
}
echo "</select>";
echo "</div></div>";
echo "<div style=\"width: 99.9%;height: 800px;float: left; overflow: auto;\">";
echo "<script id=\"container\" name=\"content\" type=\"text/plain\" style=\"width: 99.9%;height: 800px;\">";
echo "$content";
echo "</script>";
?>
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
</div>
<div class="but" style="margin-top: 80px;">
    <input type="submit" id="upload" value="确认修改">
</div>
</div>
</form>
</div>
<!-- E main -->
</div>

