<?php
/**
 * Created by PhpStorm.
 * User: 俊
 * Date: 2017/12/21
 * Time: 16:46
 */
?>
<?php
include ("server/conn.php");
if(isset($_POST['sign'])) {
    $id = $_POST['id'];
    $password = md5($_POST['password']);
    $sql = "select * from user where id = '$id'";
    $rs = $con->query($sql);
    $rowCount = $rs->rowCount();
    if ($rowCount) {
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        $dbpassword = $row['password'];
        $nick = $row['nick'];
        if ($password == $dbpassword) {
            if(isset($_POST['remember'])){
                setcookie('user[id]',$id,time()+3600*24*7);
                setcookie('user[password]',$password,time()+3600*24*7);
                setcookie('user[nick]',$nick,time()+3600*24*7);
            }
            else{
                setcookie('user[id]',$id);
                setcookie('user[password]',$password);
                setcookie('user[nick]',$nick);
            }
            header("location:index.php");
        }
    }
    else{
        echo "<script>alert('用户名或密码错误，请重新输入！');</script>";
    }
}
if(isset($_GET['out'])){
    setcookie('user[name]',"",time()-3600);
    setcookie('user[password]',"",time()-3600);
    setcookie('user[nick]',"",time()-3600);
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html >
<head>
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="js/jquery-3.2.1.js"></script>
    <script>
        function CheckLogin() {
            var id = $('#id').val();
            var password = $('#password').val();
            if (id == ""){
                alert("请输入用户名！");
                $('#id').focus();
                return false;
            }
            if (password == ""){
                alert("密码不能为空！");
                $('#password').focus();
                return false;
            }
        }
    </script>
</head>
<body style=" background: #EDEDED">
<div style="width: 400px; height: 200px; margin: 0 auto; margin-top: 200px;">
    <form class="form-horizontal" action="" method="post" onsubmit="return CheckLogin();">
        <h3><b>Login</b></h3>
        <div class="form-group" style="margin-top: 30px">
            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" placeholder="Name" name="id">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" value="remember"> Remember me
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="sign">Sign in</button>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>
    </form>
</div>
</body>
</html>
