<?php session_start(); ?>  
<?php 
require_once 'functions.php';
if (!isset($_SESSION['user_id'])) {  
    $redirect_url = $_SERVER['REQUEST_URI'];
    header('Location: login.php?redirect_url=' . urlencode($redirect_url));
    exit;
}
$page_title = '資管一日營報名'; 
include 'header.php'; 
?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">資管一日營報名</h2>
            <form action="conference_process.php" method="POST">
                <div class="mb-3">  
                    <label class="form-label">身分</label>
                    <input type="text" class="form-control" value="<?php echo getRoleName($_SESSION['user_role']); ?>" readonly>
                </div>
                <div class="mb-3"> 
                    <label class="form-label">選項（學生加費）</label><br>
                    <input type="checkbox" id="morning" name="morning[]" value="150"> 上午場 (150元)<br>
                    <input type="checkbox" id="afternoon" name="afternoon[]" value="100"> 下午場 (100元)<br>
                    <input type="checkbox" id="lunch" name="lunch[]" value="50"> 午餐 (50元)<br>
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>