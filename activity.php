<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'M') {
    header('Location: login.php');
    exit;
}

require_once 'db.php';

$order = $_POST["order"] ?? "id";
$direction = $_POST["direction"] ?? "DESC";

try {
    $sql = "SELECT id, name, description FROM event";
    $valid_orders = ['id', 'name'];
    if (in_array($order, $valid_orders)) {
        $sql .= " ORDER BY " . $order . " " . ($direction === "ASC" ? "ASC" : "DESC");
    } else {
        $sql .= " ORDER BY id DESC";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("PDO Error: " . $e->getMessage());
    echo "查詢失敗";
    exit;
}

$page_title = '活動管理';
include 'header.php';
?>

<div class="container mt-4">
    <h2 class="text-center">活動管理</h2>
    
    <div class="mb-3 text-end">
        <a href="activity_insert.php" class="btn btn-success">新增活動</a>
    </div>

    <form action="activity.php" method="post" class="row g-3 mb-3">
        <div class="col-auto">
            <label class="col-form-label">排序欄位：</label>
        </div>
        <div class="col-auto">
            <select name="order" class="form-select">
                <option value="id" <?=($order=="id")?"selected":""?>>編號</option>
                <option value="name" <?=($order=="name")?"selected":""?>>活動名稱</option>
            </select>
        </div>
        <div class="col-auto">
            <label class="col-form-label">排序方向：</label>
        </div>
        <div class="col-auto">
            <select name="direction" class="form-select">
                <option value="ASC" <?=($direction=="ASC")?"selected":""?>>升序</option>
                <option value="DESC" <?=($direction=="DESC")?"selected":""?>>降序</option>
            </select>
        </div>
        <div class="col-auto">
            <input class="btn btn-primary" type="submit" value="排序">
        </div>
    </form>

    <?php if (empty($events)): ?>
        <p class="text-center">目前沒有活動</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>活動名稱</th>
                    <th>描述</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?=htmlspecialchars($event['id'])?></td>
                        <td><?=htmlspecialchars($event['name'])?></td>
                        <td><?=htmlspecialchars($event['description'])?></td>
                        <td>
                            <a href="activity_delete.php?id=<?=$event['id']?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('確定刪除？')">刪除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>