<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2018/1/2
 * Time: 12:54
 */
if(!isset($_COOKIE['user'])){
    header('location:login.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Learning Time</title>
    <link rel="stylesheet" type="text/css" href="css/set.css">
    <link rel="stylesheet" type="text/css" href="css/kuangjia.css">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/kuangjia.js"></script>
    <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="ueditor/ueditor.all.js"></script>


</head>
<body>
<!-- S top -->
<div class="bod">
    <div class="top">
        <div class="t-logotext">
            Learning Time
        </div>
        <div style="float: right;margin-top: -50px;margin-right: 10px;font-size: 15px;color: #FFFFFF;" class="user">
            <?php
            $nick = $_COOKIE['user']['nick'];
            echo "欢迎您，$nick &nbsp;&nbsp;<a href='login.php?out=1'>退出</a>"
            ?>
        </div>
    </div>
    <!-- E top -->
    <!-- 内容 -->
    <div class="main">
        <!-- S nav -->
        <div class="nav">
            <ul>
                <li class="nav-item">
                    <!-- href="javascript:;" == href="#"-->
                    <a href="index.php">
                        <!-- class中有空格表示一个class拥有多个类名-->
                        <img src="imags/zhuye.png" class="my-icon nav-icon" />
                        <span>主页</span>
                    </a>
                </li>
                <li class="nav-item">
                    <!-- href="javascript:;" == href="#"-->
                    <a href="javascript:;">
                        <!-- class中有空格表示一个class拥有多个类名-->
                        <img src="imags/kecheng.png" class="my-icon nav-icon" />
                        <span>课程</span>
                        <img src="imags/jt.png" class="my-icon nav-more" />
                    </a>
                    <ul>
                        <li><a href="schedule.php"><span>安排</span></a></li>
                        <li><a href="schoolcolender.php"><span>校历</span></a></li>
                        <li><a href="curriculum.php"><span>课程表</span></a></li>
                        <li><a href="addcourse.php"><span>添加课程</span></a></li>
                        <li class="nav-item-2">
                            <a href="javascript:;"><span>大三下</span></a>
                            <ul>
                                <?php
                                include ('server/conn.php');
                                $sql = "select * from course where class = '大三下'";
                                $rs = $con->query($sql);
                                while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                                    $type = $row['type'];
                                    echo "<li><a href='course.php?class=大三下&type=$type'><span>$type</span></a></li>";
                                }
                                ?>
                            </ul>
                        </li><li class="nav-item-2">
                            <a href="javascript:;"><span>大四上</span></a>
                            <ul>
                                <?php
                                include ('server/conn.php');
                                $sql = "select * from course where class = '大四上'";
                                $rs = $con->query($sql);
                                while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                                    $type = $row['type'];
                                    echo "<li><a href='course.php?class=大四上&type=$type'><span>$type</span></a></li>";
                                }
                                ?>
                            </ul>
                        </li><li class="nav-item-2">
                            <a href="javascript:;"><span>大四下</span></a>
                            <ul>
                                <?php
                                $sql = "select * from course where class = '大四下'";
                                $rs = $con->query($sql);
                                while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                                    $type = $row['type'];
                                    echo "<li><a href='course.php?class=大四下&type=$type'><span>$type</span></a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <!-- href="javascript:;" == href="#"-->
                    <a href="javascript:;">
                        <!-- class中有空格表示一个class拥有多个类名-->
                        <img src="imags/biji.png" class="my-icon nav-icon" />
                        <span>笔记</span>
                        <img src="imags/jt.png" class="my-icon nav-more" />
                    </a>
                    <ul>
                        <li class="nav-item-2">
                            <a href="javascript:;"><span>学习笔记</span></a>
                            <ul>
                                <li><a href="addnote.php"><span>添加笔记</span></a> </li>
                                <?php
                                    $sql = "select * from type where class = 0";
                                    $rs = $con->query($sql);
                                    while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                                        $type = $row['type'];
                                        echo "<li><a href='notes.php?type=".$type."'><span>$type</span></a></li>";
                                    }
                                ?>
                                <li><a href="addtype.php"><span>添加类型</span></a> </li>
                            </ul>
                        </li>
                        <li class="nav-item-2">
                            <a href="javascript:;"><span>英语笔记</span></a>
                            <ul>
                                <li><a href="javascript:;"><span>单词</span></a></li>
                                <li><a href="javascript:;"><span>句子</span></a></li>
                                <li><a href="javascript:;"><span>段落</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <!-- href="javascript:;" == href="#"-->
                    <a href="javascript:;">
                        <!-- class中有空格表示一个class拥有多个类名-->
                        <img src="imags/jilu.png" class="my-icon nav-icon" />
                        <span>记录</span>
                        <img src="imags/jt.png" class="my-icon nav-more" />
                    </a>
                    <ul>
                        <li><a href="addessay.php"><span>添加记录</span></a> </li>
                        <?php
                        include ('server/conn.php');
                        $sql = "select * from type where class = 1";
                        $rs = $con->query($sql);
                        while($row=$rs->fetch(PDO::FETCH_ASSOC)) {
                            $type = $row['type'];
                            echo "<li><a href='essay.php?type=".$type."'><span>$type</span></a></li>";
                        }
                        ?>
                    </ul>
                <li class="nav-item">
                    <!-- href="javascript:;" == href="#"-->
                    <a href="javascript:;">
                        <!-- class中有空格表示一个class拥有多个类名-->
                        <img src="imags/xiangmu.png" class="my-icon nav-icon" />
                        <span>项目</span>
                        <img src="imags/jt.png" class="my-icon nav-more" />
                    </a>
                    <ul>
                        <li><a href="javascript:;"><span>当前进度</span></a></li>
                        <li><a href="javascript:;"><span>已完成项目</span></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <!-- href="javascript:;" == href="#"-->
                    <a href="javascript:;">
                        <!-- class中有空格表示一个class拥有多个类名-->
                        <img src="imags/guanyu.png" class="my-icon nav-icon" />
                        <span>关于</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- E nav -->
