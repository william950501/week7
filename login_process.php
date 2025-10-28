<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "practice"; 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $_SESSION['login_error'] = "資料庫連線失敗：" . $conn->connect_error;
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $redirect_url = $_POST['redirect_url'] ?? 'index.php';

    if (empty($account) || empty($password)) {
        $_SESSION['login_error'] = '請輸入帳號和密碼！';
        header('Location: login.php');
        exit;
    }

    $account = mysqli_real_escape_string($conn, $account);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM user WHERE account = '$account'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
       
        if ($user['password'] === $password) {
          
            $_SESSION['user_id'] = $user['account'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: ' . $redirect_url);
            exit;
        } else {
            $_SESSION['login_error'] = '帳號或密碼錯誤！';
        }
    } else {
        $_SESSION['login_error'] = '帳號或密碼錯誤！';
    }

    $conn->close();
    header('Location: login.php');
    exit;
}
?>