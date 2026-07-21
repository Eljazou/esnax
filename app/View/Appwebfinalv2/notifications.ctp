<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
/* Premium Notifications Page Style */
body {
    background-color: #f7faf8;
    margin: 0;
    padding: 0;
    font-family: 'Inter', sans-serif;
}

.notif-header {
    background: #ffffff;
    padding: 24px 20px 20px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 20px rgba(0, 50, 30, 0.05);
    border-bottom: 1px solid #d4e0d9;
}

.header-top {
    display: flex;
    align-items: center;
    gap: 16px;
}

.btn-back {
    width: 40px; height: 40px;
    border-radius: 12px;
    background: #f4f8f6;
    display: flex; align-items: center; justify-content: center;
    color: #1a2e24;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-back:hover {
    background: #e6f5ee;
    color: #006241;
}

.header-title {
    font-size: 20px;
    font-weight: 700;
    color: #1a2e24;
    margin: 0;
}

.notif-list-container {
    padding: 20px;
    padding-bottom: 100px;
}

.notif-item {
    background: #ffffff;
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 12px;
    box-shadow: 0 4px 16px rgba(0, 50, 30, 0.03);
    border: 1px solid #eef3f0;
    display: flex;
    gap: 12px;
    position: relative;
    overflow: hidden;
}

.notif-item.unread {
    border-left: 4px solid #00875A;
    background: #fafdfb;
}

.notif-icon-wrap {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #e6f5ee;
    color: #00875A;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.notif-item.unread .notif-icon-wrap {
    background: #00875A;
    color: #ffffff;
}

.notif-content {
    flex: 1;
}

.notif-title-text {
    font-size: 14px;
    font-weight: 700;
    color: #1a2e24;
    margin-bottom: 4px;
}

.notif-message-text {
    font-size: 13px;
    color: #5a6b63;
    line-height: 1.5;
}

.notif-time {
    font-size: 11px;
    color: #8a9b93;
    margin-top: 8px;
    display: block;
}

.notif-empty {
    text-align: center;
    padding: 60px 20px;
    color: #8a9b93;
}

.notif-empty i {
    font-size: 48px;
    margin-bottom: 16px;
    color: #d4e0d9;
}
</style>

<div class="notif-header">
    <div class="header-top">
        <a href="<?php echo $this->Html->url(array("action" => "index", $code)); ?>" class="btn-back">
            <i data-lucide="arrow-left"></i>
        </a>
        <h1 class="header-title">Notifications</h1>
    </div>
</div>

<div class="notif-list-container">
    <?php if (empty($notifications)): ?>
        <div class="notif-empty">
            <i data-lucide="bell-off" style="width: 48px; height: 48px; margin: 0 auto 16px auto;"></i>
            <p>Aucune notification pour le moment.</p>
        </div>
    <?php else: ?>
        <?php foreach ($notifications as $notif):
            $n = $notif['Notification'];
            $isUnread = ($n['vue'] == 0);
            
            // Icon choosing
            $icon = "bell";
            if (strpos($n['titre'], 'Requête CRM') !== false) {
                $icon = "message-square";
            } elseif (stripos($n['titre'], 'Remplacement') !== false) {
                $icon = "users";
            } elseif (stripos($n['titre'], 'événement') !== false || stripos($n['titre'], 'Explication') !== false) {
                $icon = "calendar";
            }
            ?>
            <div class="notif-item <?php echo $isUnread ? 'unread' : ''; ?>">
                <div class="notif-icon-wrap">
                    <i data-lucide="<?php echo $icon; ?>"></i>
                </div>
                <div class="notif-content">
                    <div class="notif-title-text"><?php echo h($n['titre']); ?></div>
                    <div class="notif-message-text"><?php echo $n['message']; ?></div>
                    <span class="notif-time"><?php echo date('d/m/Y H:i', strtotime($n['created'])); ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

