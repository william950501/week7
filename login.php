<?php
session_start();
include 'header.php';

$page_title = '登入';
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']); 
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">登入</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" action="login_process.php">
                <div class="mb-3">
                    <label class="form-label">帳號</label>
                    <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">密碼</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_GET['redirect_url'] ?? 'index.php'); ?>">
                <button type="submit" class="btn btn-primary w-100">登入</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>