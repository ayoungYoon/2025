<?php
session_start();

$host = "localhost";  
$user = "root";         
$password = "1220";           
$dbname = "new";     

$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newuserid = $_POST['userid'];
    $newuserpw = $_POST['pw'];


    if (!empty($newuserid) && !empty($newuserpw)) {
        
        $checkSql = "SELECT * FROM users WHERE userid = '$newuserid'";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            
            echo "이미 존재하는 회원입니다. 다른 아이디를 사용해주세요.";
        } else {
            
            $sql = "INSERT INTO users (userid, pw) VALUES ('$newuserid', '$newuserpw')";

            if ($conn->query($sql) === TRUE) {
                
                echo "<script>
                        alert('회원가입이 완료되었습니다. 환영합니다, " . htmlspecialchars($newuserid) . "님!');
                        window.location.href = 'login.html';
                      </script>";
            } else {
                
                echo "회원가입에 실패했습니다. 오류: " . $conn->error;
            }
        }
    } else {
        echo "회원가입에 실패했습니다. 모든 정보를 입력해주세요.";
    }
}

$conn->close();
?>
