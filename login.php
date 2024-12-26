<?php

session_start();
$host ="localhost";
$user = "root";
$password ="1220";
$dbname ="new";

$newuserid=@$_POST['userid'];
$newuserpw=@$_POST['pw'];

$conn = new mysqli($host, $user, $password, $dbname);

$checksql = "select * from users where userid = '$newuserid'";
$result = mysqli_query($conn,$checksql);
$num = mysqli_num_rows($result);

if(!$num){
    echo "<script>
            alert(\"일치하는 아이디가 없습니다.\");
            histroy.back();
        </script>";
    exit();
} else{

    $row = mysqli_fetch_array($result);
    if($row['pw'] !=$newuserpw){
        "<script>
            alert(\"비밀번호가 일치하지 않습니다. \");
            histroy.back();
        </script>";
    exit();
    }else {
        $_SESSION['userid'] = $row['userid'];
        mysqli_close($conn);
        

        echo "<script>
            alert(\"로그인 성공!\");
            window.location.href = 'afterhome.html';
          </script>";
    
    }


}
?>