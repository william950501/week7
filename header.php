<?php 
$page_title = isset($page_title) ? $page_title : '活動報名系統'; 
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">活動報名系統</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">首頁</a></li>
                    <li class="nav-item"><a class="nav-link" href="status.php">迎新茶會</a></li>
                    <li class="nav-item"><a class="nav-link" href="conference.php">資管一日營</a></li>
                    <li class="nav-item"><a class="nav-link" href="job.php">求才資訊</a></li> 
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'M'): ?>
    <li class="nav-item">
        <a class="nav-link" href="activity.php">活動管理</a>
    </li>
<?php endif; ?>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a class="nav-link" href="logout.php">登出 (<?php echo $_SESSION['user_name']; ?>)</a>
                        <?php else: ?>
                            <a class="nav-link" href="login.php">登入</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>