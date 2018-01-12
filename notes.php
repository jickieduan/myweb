<?php
    include ('head.php');
?>
<link rel="stylesheet" type="text/css" href="css/notes.css">
	<!-- S notes -->
	<div class="notes">
		<div class="n-con">
			<ul>
                <?php
                function html2text($str){
                    $str = preg_replace("/<style .*?<\\/style>/is", "", $str);
                    $str = preg_replace("/<script .*?<\\/script>/is", "", $str);
                    $str = preg_replace("/<br \\s*\\/>/i", "", $str);
                    $str = preg_replace("/<\\/?p>/i", "", $str);
                    $str = preg_replace("/<\\/?td>/i", "", $str);
                    $str = preg_replace("/<\\/?div>/i", "", $str);
                    $str = preg_replace("/<\\/?blockquote>/i", "", $str);
                    $str = preg_replace("/<\\/?li>/i", "", $str);
                    $str = preg_replace("/ /i", " ", $str);
                    $str = preg_replace("/ /i", " ", $str);
                    $str = preg_replace("/&/i", "&", $str);
                    $str = preg_replace("/&/i", "&", $str);
                    $str = preg_replace("/</i", "<", $str);
                    $str = preg_replace("/</i", "<", $str);
                    $str = preg_replace("/“/i", '"', $str);
                    $str = preg_replace("/&ldquo/i", '"', $str);
                    $str = preg_replace("/‘/i", "'", $str);
                    $str = preg_replace("/&lsquo/i", "'", $str);
                    $str = preg_replace("/'/i", "'", $str);
                    $str = preg_replace("/&rsquo/i", "'", $str);
                    $str = preg_replace("/>/i", ">", $str);
                    $str = preg_replace("/>/i", ">", $str);
                    $str = preg_replace("/”/i", '"', $str);
                    $str = preg_replace("/&rdquo/i", '"', $str);
                    $str = strip_tags($str);
                    $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
                    $str = preg_replace("/&#.*?;/i", "", $str);

                    return $str;
                }
                $type = $_GET['type'];
                    include ("server/conn.php");
                    $sql = "select * from note where type = '$type' GROUP by id ORDER BY time DESC";
                    $rs = $con->query($sql);
                    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $time = $row['time'];
                        $content = $row['content'];
                        $content= html2text($content);
                        echo "<li><a href='notesconter.php?id=".$id."'>";
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