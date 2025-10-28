<?php session_start(); ?>  
<?php 
require_once 'functions.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$name = $_SESSION['user_name']; 
$identity = $_SESSION['user_role']; 
$meal = $_POST['meal'] ?? 'no'; 

$total = (isFreeRole($identity) || $meal === 'no') ? 0 : 60;

$page_title = '迎新茶會報名結果';
include 'header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">報名成功！</h2>
            <p>姓名：<?php echo htmlspecialchars($name); ?></p>
            <p>身分：<?php echo getRoleName($identity); ?></p>
            <p>用餐：<?php echo $meal == 'yes' ? '是' : '否'; ?></p>
            <p>總金額：<?php echo $total; ?> 元</p>
            <a href="index.php" class="btn btn-secondary">回首頁</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>