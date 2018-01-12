<?php
    include ('head.php');
    include ('server/conn.php');
    date_default_timezone_set("Asia/Shanghai"); #设置时区

    $url = 'https://api.seniverse.com/v3/weather/now.json?key=bqhffmiu7pmrsemg&location=kunming&language=zh-Hans&unit=c';
    $html = file_get_contents($url);
    $data = json_decode($html, true);
    $temperature = $data['results'][0]['now']['temperature'];
    $weather = $data['results'][0]['now']['text'];
    $cnweek = array ('天','一','二','三','四','五','六');
    $week = $cnweek[date("w")];
    $cnschoolweek = array ('一','二','三','四','五','六','七','八','九','十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十');
    $sql = "select * from datekeys where name = 'schoolweek'";
    $rs = $con->query($sql);
    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
        $schoolweeknum = (int)$row['value'];
    }
    $schoolweek = $cnschoolweek[$schoolweeknum];
    $sql = "select * from datekeys where name = 'countdown'";
    $rs = $con->query($sql);
    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
        $countdown = $row['value'];
    }
    if($week == '天'){
        $schoolweeknum ++;
        $sql = "UPDATE datekeys SET value = '$schoolweeknum' WHERE name = schoolweek";
        $rs = $con->query($sql);
    }
    if(date("G") == 0){
        $countdown ++;
        $sql = "UPDATE datekeys SET value = '$countdown' WHERE name = countdown";
        $rs = $con->query($sql);
    }


?>
<link rel="stylesheet" type="text/css" href="css/index.css">
<style>
    .con{
        background-image: url(img/bg.jpg);
    }
    .t-countdown{
        float: left;
        margin-top: 90px;
        margin-left: -20%;
    }
    .time .t-wandm{
        margin-top: -25px;
    }
    .n-title{
        width: 70%;
        float: left;
        height: 30px;
        font-size: 20px;
    }
    .n-time{
        width: 30%;
        float: left;
        height: 30px;
        color: #8e8d8c;
        text-align: right;
    }
    .n-introduction{
        width: 98%;
        margin-left: 1%;
        height: 100px;
        background-color: rgba(0,0,0,0);
        color: #000;
        float: left;
        overflow:hidden;
    }

</style>
	<!-- S con -->
	<div class="con">
		<div class="plate">
			<div class="time">
				<div class="t-week">第<span style="color: #ff6636;"><?php echo $schoolweek;?></span>周</div><br/>
                <div class="t-countdown" style="font-size: 20px;">距毕业还有：<span><?php echo $countdown;?></span>天</div><br/>
				<div class="t-datetime" >
					<div class="t-time" style="margin-left:20%;font-size: 70px;margin-top: -30px"><?php echo date("H:i")?></div><br/>
                    <div style="margin-top: -40px;float: right;margin-right: 20%;font-size: 20px;"><?php echo date("Y.m.d");?></div>
                    <div class="t-day" style="margin-top: -40px;font-size: 20px; margin-left: -30px;">星期<?php echo $week;?></div><br/>
				</div>
				<div class="t-wandm">
					<div class="t-weather">
						<span style="color: #2aabd2;"><?php echo "$weather";?></span>
                        <span style="color: #ff8a8a;"><?php echo "$temperature";?>℃</span>
					</div>
					<div class="t-motto">
真理惟一可靠的标准就是永远自相符合。 —— 欧文</div>
				</div>
			</div>
		</div>
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
        include ("server/conn.php");
        $sql = "select * from note GROUP by id ORDER BY time DESC";
        $rs = $con->query($sql);
        $i=0;
        while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
            if($i >= 3) break;
            $id = $row['id'];
            $title = $row['title'];
            $time = $row['time'];
            $content = $row['content'];
            $content= html2text($content);
            echo "<div class=\"plate\" style=\"margin-top: 30px;width: 98%;margin-left: 1%;\">";
            echo "<li><a href='notesconter.php?id=".$id."'>";
            echo "<div class='n-title'>$title</div>";
            echo "<div class='n-time'>$time</div></a>";
            echo "<div class='n-introduction'>$content</div>";
            echo "</li></div>";
            $i++;
        }
        ?>
	<!-- E con -->

</div>
	<!-- E main -->
</div>