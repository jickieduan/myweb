<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/2
 * Time: 13:53
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
<form action="server/addessay_server.php?addessay=1" method="post" onsubmit="return addnote()">
    <div class="con">
        <div class="title">
            <input type="text" class="t-value" name="title" id="title">
            <div class="type">
                <span>属于:</span>
                <select class="t-select" name="type">
                    <?php
                    include ('server/conn.php');
                    $sql = "select * from type where class = 1";
                    $rs = $con->query($sql);
                    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                        $type = $row['type'];
                        echo "<option value=\"$type\">$type</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div style="width: 99.9%;height: 800px;float: left; overflow: auto;">
            <script id="container" name="content" type="text/plain" style="width: 99.9%;height: 800px;">
            </script>
            <script type="text/javascript">
            var ue = UE.getEditor('container');
            </script>
        </div>
        <div class="but" style="margin-top: 80px;">
            <input type="submit" id="upload" value="提  交">
        </div>
    </div>
</form>
    </div>
    <!-- E main -->
    </div>
