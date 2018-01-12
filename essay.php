<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/2
 * Time: 13:54
 */
?>
<?php
include ('head.php');
?>
<link rel="stylesheet" type="text/css" href="css/notes.css">
<!-- S notes -->
<div class="notes">
    <div class="n-con">
        <ul>
            <?php
            $type = $_GET['type'];
            include ("server/conn.php");
            $sql = "select * from essay where type = '$type' GROUP by id ORDER BY time DESC";
            $rs = $con->query($sql);
            while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $title = $row['title'];
                $time = $row['time'];
                $content = substr($row['content'],0,100);
                echo "<li><a href='essaycontent.php?id=".$id."'>";
                echo "<div class='n-title'>$title</div>";
                echo "<div class='n-time'>$time</div></a>";
                echo "<div class='n-introduction'>$content</div>";
                echo "</li>";

            }
            ?>
        </ul>
    </div>
</div>
<!-- E notes -->
</div>
<!-- E main -->
</div>
