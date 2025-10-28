<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'M') {
    header('Location: login.php');
    exit;
}

$page_title = '新增活動';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($name)) {
        $error = "活動名稱不能為空！";
    } else {
        require_once 'db.php';
        try {
            $stmt = $conn->prepare("INSERT INTO event (name, description) VALUES (?, ?)");
            $stmt->execute([$name, $description]);
            header('Location: activity.php?success=1');
            exit;
        } catch (PDOException $e) {
            $error = "新增失敗：" . $e->getMessage();
        }
    }
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">新增活動</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?=$error?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">活動名稱</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">描述</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">新增</button>
                <a href="activity.php" class="btn btn-secondary">返回</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>