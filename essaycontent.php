<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/2
 * Time: 14:01
 */
?>
<?php
include ('head.php');
?>
<link rel="stylesheet" type="text/css" href="css/notesconter.css">
<!-- S notesconter -->
<div class="notesconter">
    <div class="out" style="float: right;margin-top: 0px;margin-right: 10px;font-size: 15px;">
        <?php
        $id = $_GET['id'];
        echo " <a href='updateessay.php?id=".$id."'>修改</a> &nbsp;";
        ?>
        <a href="#" onClick="javascript :history.back(-1);">返回</a>
    </div>
    <div class="n-conter">
        <?php
        include ("server/conn.php");
        $id = $_GET['id'];
        $sql = "select * from essay where id = ".$id;
        $rs = $con->query($sql);
        while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
            $title = $row['title'];
            $content = $row['content'];
            $time = $row['time'];
            echo "<div class=\"n-title\"><h1>$title</h1></div>";
            echo "<div class=\"n-time\">$time</div>";
            echo "<div class=\"n-conters\">$content</div>";
        }
        ?>
    </div>
</div>
<!-- E notesconter -->
</div>
<!-- E main -->
</div>
