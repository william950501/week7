<?php session_start(); ?>  
<?php 
require_once 'functions.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$name = $_SESSION['user_name'];  
$identity = $_SESSION['user_role'];  

$morning = isset($_POST['morning']) ? count($_POST['morning']) * 150 : 0;
$afternoon = isset($_POST['afternoon']) ? count($_POST['afternoon']) * 100 : 0;
$lunch = isset($_POST['lunch']) ? count($_POST['lunch']) * 50 : 0;

$total = isFreeRole($identity) ? 0 : ($morning + $afternoon + $lunch);

$page_title = '資管一日營報名結果';
include 'header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">報名成功！</h2>
            <p>姓名：<?php echo htmlspecialchars($name); ?></p>
            <p>身分：<?php echo getRoleName($identity); ?></p>
            <p>上午場：<?php echo $morning > 0 ? '是 (150元)' : '否'; ?></p>
            <p>下午場：<?php echo $afternoon > 0 ? '是 (100元)' : '否'; ?></p>
            <p>午餐：<?php echo $lunch > 0 ? '是 (50元)' : '否'; ?></p>
            <p>總金額：<?php echo $total; ?> 元</p>
            <a href="index.php" class="btn btn-secondary">回首頁</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>