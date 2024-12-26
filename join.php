<?php

session_start();

$host = "localhost";  
$user = "root";         
$password = "1220";           
$dbname = "new";     

$conn = new mysqli($host, $user, $password, $dbname);

// 데이터베이스 연결 오류 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newuserid = $_POST['userid'];
    $newuserpw = $_POST['pw'];

    // 빈 값 체크
    if (!empty($newuserid) && !empty($newuserpw)) {
        // 기존 사용자 확인
        $checkSql = "SELECT * FROM users WHERE userid = '$newuserid'";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            // 이미 존재하는 회원인 경우 메시지 출력
            echo "이미 존재하는 회원입니다. 다른 아이디를 사용해주세요.";
        } else {
            // 사용자 정보를 데이터베이스에 삽입
            $sql = "INSERT INTO users (userid, pw) VALUES ('$newuserid', '$newuserpw')";

            if ($conn->query($sql) === TRUE) {
                // 회원가입 성공 메시지 출력
                echo "회원가입 성공";
            } else {
                // 쿼리 실패 시 오류 출력
                echo "회원가입에 실패했습니다. 오류: " . $conn->error;
            }
        }
    } else {
        echo "회원가입에 실패했습니다. 모든 정보를 입력해주세요.";
    }
}

$conn->close();
?>