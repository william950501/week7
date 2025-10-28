<?php
session_start();
require_once 'db.php'; 

$stmt = $conn->prepare("SELECT name, description FROM event");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = '首頁 - 活動報名系統';
include 'header.php';
?>

<div class="container mt-4">
    <div class="row">
        <?php if (empty($events)): ?>
            <div class="col-12">
                <p class="text-center">目前沒有活動資訊。</p>
            </div>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($event['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($event['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>