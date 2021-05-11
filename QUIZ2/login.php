<?php 
session_start();

//atur koneksi ke database
$connect = mysqli_connect("localhost", "root", "", "login");
//atur variabel
$error = "";
$username = "";
$remember = "";

if(isset($_COOKIE['cookie_username'])){
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    $query = "select * from user where username = '$cookie_username'";
    $query2 = mysqli_query($connect,$query);
    $run   = mysqli_fetch_array($query2);
    if($run['password'] == $cookie_password){
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
    }
}

if(isset($_SESSION['session_username'])){
    header("location:index.php");
    exit();
}

if(isset($_POST['login'])){
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $remember   = $_POST['remember'];

    if($username == '' or $password == ''){
        $error .= "<li>Silakan masukkan username dan juga password.</li>";
    }else{
        $query = "select * from user where username = '$username'";
        $query2 = mysqli_query($connect,$query);
        $run   = mysqli_fetch_array($query2);

        if($run['username'] == ''){
            $error .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        }elseif($run['password'] != ($password)){
            $error .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }       
        
        if(empty($error)){
            $_SESSION['session_username'] = $username; //server
            $_SESSION['session_password'] = $password;

            if($remember == 1){
                $cookie_name = "cookie_username";
                $cookie_value = $username;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                $cookie_name = "cookie_password";
                $cookie_value = $password;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");
            }
            header("location:index.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="container my-4">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading" >
                <div class="panel-title"><h3>Login dan Masuk Ke Sistem</h3> <br> Username : ichwan <br> Password : zaky</div>
            </div>      
            <div style="padding-top:30px" class="panel-body bg-primary" >
                <?php if($error){ ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <ul><?php echo $error ?></ul>
                    </div>
                <?php } ?>                
                <form id="loginform" class="form-horizontal" action="" method="post" role="form">       
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="input-group">
                        <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1" <?php if($remember == '1') echo "checked"?>>Remember Me
                        </label>
                        </div>
                    </div>
                    <br>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" class="btn btn-success" value="Login"/>
                        </div>
                    </div>
                </form>    
            </div>                     
        </div>  
    </div>
</div>
</body>
</html>