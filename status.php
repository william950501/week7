<?php session_start(); ?>  
<?php
require_once 'functions.php';
if (!isset($_SESSION['user_id'])) {  
    $redirect_url = $_SERVER['REQUEST_URI'];
    header('Location: login.php?redirect_url=' . urlencode($redirect_url));
    exit;
}
$page_title = '迎新茶會報名'; 
include 'header.php'; 
?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">迎新茶會報名</h2>
            <form action="status_process.php" method="POST">
                <div class="mb-3"> 
                    <label class="form-label">身分</label>
                    <input type="text" class="form-control" value="<?php echo getRoleName($_SESSION['user_role']); ?>" readonly>
                </div>
                <div class="mb-3"> 
                    <label class="form-label">是否用餐</label><br>
                    <input type="radio" id="meal_yes" name="meal" value="yes" required>
                    <label for="meal_yes">是（學生加60元）</label><br>
                    <input type="radio" id="meal_no" name="meal" value="no" required>
                    <label for="meal_no">否（免費）</label>
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>