<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $redirect_url = $_SERVER['REQUEST_URI'];
    header('Location: login.php?redirect_url=' . urlencode($redirect_url));
    exit;
}

require_once 'db.php';

$order = $_POST["order"] ?? "pdate";
$direction = $_POST["direction"] ?? "DESC"; 

try {
    $sql = "SELECT postid, company, content, pdate FROM job";
    $valid_orders = ['company', 'content', 'pdate'];
    if (in_array($order, $valid_orders)) {
        $sql .= " ORDER BY " . $order . " " . ($direction === "ASC" ? "ASC" : "DESC");
    } else {
        $sql .= " ORDER BY pdate DESC";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("PDO Error: " . $e->getMessage());
    echo "查詢失敗，請聯繫管理員。";
    exit;
}

$page_title = '工作清單';
include 'header.php';
?>

<div class="container mt-4">
    <h2 class="text-center">工作清單</h2>
    
    <form action="job.php" method="post" class="row g-3 mb-3">
        <div class="col-auto">
            <label for="order" class="col-form-label">排序欄位：</label>
        </div>
        <div class="col-auto">
            <select name="order" class="form-select" aria-label="選擇排序欄位">
                <option value="company" <?=($order=="company")?"selected":""?>>求才廠商</option>
                <option value="content" <?=($order=="content")?"selected":""?>>求才內容</option>
                <option value="pdate" <?=($order=="pdate")?"selected":""?>>刊登日期</option>
            </select>
        </div>
        <div class="col-auto">
            <label for="direction" class="col-form-label">排序方向：</label>
        </div>
        <div class="col-auto">
            <select name="direction" class="form-select" aria-label="選擇排序方向">
                <option value="ASC" <?=($direction=="ASC")?"selected":""?>>升序</option>
                <option value="DESC" <?=($direction=="DESC")?"selected":""?>>降序</option>
            </select>
        </div>
        <div class="col-auto">
            <input class="btn btn-primary" type="submit" value="搜尋">
        </div>
    </form>
    
    <?php if (empty($jobs)): ?>
        <p class="text-center">目前沒有工作資訊。</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>求才廠商</th>
                    <th>求才內容</th>
                    <th>日期</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($job['postid']); ?></td>
                        <td><?php echo htmlspecialchars($job['company']); ?></td>
                        <td><?php echo htmlspecialchars($job['content']); ?></td>
                        <td><?php echo htmlspecialchars($job['pdate']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>