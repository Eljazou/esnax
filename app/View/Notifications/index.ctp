<?php
// Helper to format relative date
function time_ago($datetime)
{
  $now = new DateTime();
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);
  if ($diff->d === 0 && $diff->h === 0) {
    if ($diff->i < 1)
      return "À l'instant";
    return "Il y a " . $diff->i . " min";
  }
  if ($diff->d === 0)
    return "Il y a " . $diff->h . "h";
  if ($diff->d === 1)
    return "Hier";
  if ($diff->d < 7)
    return "Il y a " . $diff->d . " jours";
  return date('d/m/Y', strtotime($datetime));
}

// Calculate notification counts for filters
$countTotal = 0;
$countCrm = 0;
$countRempl = 0;
$countOther = 0;
$countUnread = 0;
$countRead = 0;
$vms = array();

if (!empty($notifications)) {
  $countTotal = count($notifications);
  foreach ($notifications as $notif) {
    $n = $notif['Notification'];
    $titre = $n['titre'];
    $isCrm = (strpos($titre, 'Requête CRM') !== false);
    $isRemp = (stripos($titre, 'remplacement') !== false || stripos($titre, 'remplaçant') !== false);

    if ($isCrm) {
      $countCrm++;
    } elseif ($isRemp) {
      $countRempl++;
    } else {
      $countOther++;
    }

    if ($n['vue'] == 0) {
      $countUnread++;
    } else {
      $countRead++;
    }

    // Extract unique VMs
    if (!empty($notif['Sender']['id']) && !empty($notif['Sender']['name'])) {
      $vms[$notif['Sender']['id']] = $notif['Sender']['name'];
    }
  }
  asort($vms);
}
?>
<?php echo $this->Html->css('select2.min'); ?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

  /* ── Reset inside our section ── */
  .notif-page * {
    box-sizing: border-box;
  }

  .notif-page {
    font-family: 'Inter', sans-serif;
  }

  /* ── Page wrapper ── */
  .notif-page {
    padding: 28px 24px 60px;
    background: #f0f2f8;
    min-height: 100vh;
  }

  /* ── Header row ── */
  .notif-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
  }

  .notif-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .notif-header-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: linear-gradient(135deg, #6c63ff, #48cfad);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 20px rgba(108, 99, 255, .35);
  }

  .notif-header-icon i {
    color: #fff;
    font-size: 20px;
  }

  .notif-header h2 {
    font-size: 22px;
    font-weight: 800;
    color: #1a1d2e;
    margin: 0;
    line-height: 1;
  }

  .notif-header p {
    font-size: 12px;
    color: #8a93b2;
    margin: 3px 0 0;
    font-weight: 500;
  }

  .notif-badge-count {
    background: linear-gradient(135deg, #6c63ff, #48cfad);
    color: #fff;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    box-shadow: 0 4px 14px rgba(108, 99, 255, .3);
  }

  /* ── Filter Container ── */
  .notif-filters-container {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    margin-bottom: 24px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, .03);
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .filter-group {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
  }

  .filter-label {
    font-size: 13px;
    font-weight: 700;
    color: #8a93b2;
    min-width: 90px;
  }

  .filter-pills {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    flex: 1;
  }

  .filter-btn {
    border: none;
    outline: none;
    background: #f0f2f8;
    color: #5c6a85;
    padding: 8px 16px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all .2s ease;
  }

  .filter-btn:hover {
    background: #e2e5f0;
    color: #1a1d2e;
    transform: translateY(-1px);
  }

  .filter-btn.active {
    background: #6c63ff;
    color: #fff;
    box-shadow: 0 4px 12px rgba(108, 99, 255, .25);
  }

  .filter-badge {
    background: rgba(0, 0, 0, 0.08);
    color: inherit;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 10px;
    font-weight: 700;
  }

  .filter-btn.active .filter-badge {
    background: rgba(255, 255, 255, 0.2);
  }

  /* Specific colors for categories when active */
  .filter-btn.filter-crm.active {
    background: linear-gradient(135deg, #ffb347, #ff7c00);
    color: #fff;
    box-shadow: 0 4px 12px rgba(255, 124, 0, .25);
  }

  .filter-btn.filter-rempl.active {
    background: linear-gradient(135deg, #48cfad, #009688);
    color: #fff;
    box-shadow: 0 4px 12px rgba(0, 150, 136, .25);
  }

  .filter-btn.filter-other.active {
    background: linear-gradient(135deg, #6c63ff, #4338ca);
    color: #fff;
    box-shadow: 0 4px 12px rgba(108, 99, 255, .25);
  }

  .filter-btn.filter-unread.active {
    background: linear-gradient(135deg, #ff4d4f, #d42224);
    color: #fff;
    box-shadow: 0 4px 12px rgba(255, 77, 79, .25);
  }

  .filter-btn.filter-read.active {
    background: linear-gradient(135deg, #48cfad, #1a8c70);
    color: #fff;
    box-shadow: 0 4px 12px rgba(72, 207, 173, .25);
  }

  .filter-btn.filter-vm.active {
    background: linear-gradient(135deg, #a78bfa, #7c3aed);
    color: #fff;
    box-shadow: 0 4px 12px rgba(124, 58, 237, .25);
  }

  /* Filter Empty State styling */
  .filter-no-results {
    display: none;
    text-align: center;
    padding: 40px 20px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
    color: #8a93b2;
    font-weight: 500;
  }

  /* ── Cards list ── */
  .notif-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  /* ── Single card ── */
  .notif-card {
    background: #fff;
    border-radius: 18px;
    padding: 18px 20px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
    border-left: 4px solid #e0e4f0;
    transition: transform .22s ease, box-shadow .22s ease;
    animation: slideIn .35s ease both;
    position: relative;
    overflow: hidden;
  }

  /* .notif-card::before {
    content: '';
    position: absolute; inset: 0;
    opacity: 0;
    transition: opacity .22s;
} */
  .notif-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(0, 0, 0, .10);
  }

  .notif-card:hover::before {
    opacity: 1;
  }

  /* Unread glow ring */
  .notif-card.unread {
    border-left-color: inherit;
  }

  .notif-card.unread::after {
    content: '';
    position: absolute;
    top: 16px;
    right: 16px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #ff4d4f;
    box-shadow: 0 0 0 3px rgba(255, 77, 79, .18);
    animation: pulse 1.8s infinite;
  }

  /* ── Type themes ── */
  .notif-card.type-crm {
    border-left-color: #ffb347;
    background: linear-gradient(to right, #fffdf5 0%, #fff 60%);
  }

  .notif-card.type-crm .notif-icon-wrap {
    background: linear-gradient(135deg, #ffb347, #ff7c00);
  }

  .notif-card.type-crm .notif-title {
    color: #b05e00;
  }

  .notif-card.type-remplacement {
    border-left-color: #48cfad;
    background: linear-gradient(to right, #f2fdf9 0%, #fff 60%);
  }

  .notif-card.type-remplacement .notif-icon-wrap {
    background: linear-gradient(135deg, #48cfad, #009688);
  }

  .notif-card.type-remplacement .notif-title {
    color: #0a6e5a;
  }

  .notif-card.type-default {
    border-left-color: #6c63ff;
    background: linear-gradient(to right, #f4f3ff 0%, #fff 60%);
  }

  .notif-card.type-default .notif-icon-wrap {
    background: linear-gradient(135deg, #6c63ff, #3b37c9);
  }

  .notif-card.type-default .notif-title {
    color: #3b37c9;
  }

  /* ── Icon wrap ── */
  .notif-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(0, 0, 0, .15);
  }

  .notif-icon-wrap i {
    color: #fff;
    font-size: 17px;
  }

  /* ── Text block ── */
  .notif-body {
    flex: 1;
    min-width: 0;
  }

  .notif-top {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 7px;
  }

  .notif-title {
    font-size: 14px;
    font-weight: 700;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .notif-meta {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    color: #aab0cc;
    white-space: nowrap;
    font-weight: 500;
    flex-shrink: 0;
  }

  .notif-meta i {
    font-size: 10px;
  }

  .notif-message {
    font-size: 13px;
    color: #4a5270;
    line-height: 1.65;
  }

  .notif-message a {
    display: inline-block;
    padding: 1px 9px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    font-size: 12px;
    transition: all .18s;
    margin: 0 2px;
  }

  .type-crm .notif-message a {
    background: #fff0d6;
    color: #b05e00;
  }

  .type-crm .notif-message a:hover {
    background: #ff9800;
    color: #fff;
  }

  .type-remplacement .notif-message a {
    background: #d3f4ec;
    color: #0a6e5a;
  }

  .type-remplacement .notif-message a:hover {
    background: #009688;
    color: #fff;
  }

  .type-default .notif-message a {
    background: #e6e4ff;
    color: #3b37c9;
  }

  .type-default .notif-message a:hover {
    background: #6c63ff;
    color: #fff;
  }

  .notif-read-by {
    margin-top: 8px;
    font-size: 11px;
    color: #5c6a85;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #f1f3f9;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 500;
  }

  .type-crm .notif-read-by {
    background: #fff3e0;
    color: #e65100;
  }

  .type-remplacement .notif-read-by {
    background: #e0f2f1;
    color: #004d40;
  }

  .type-default .notif-read-by {
    background: #ede7f6;
    color: #4a148c;
  }

  /* ── Empty state ── */
  .notif-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 70px 20px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
    text-align: center;
  }

  .notif-empty-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #e8e6ff, #c3f4e8);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #6c63ff;
    margin-bottom: 20px;
  }

  .notif-empty h4 {
    color: #1a1d2e;
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 6px;
  }

  .notif-empty p {
    color: #8a93b2;
    font-size: 14px;
    margin: 0;
  }

  /* ── Animations ── */
  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(16px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes pulse {

    0%,
    100% {
      box-shadow: 0 0 0 3px rgba(255, 77, 79, .18);
    }

    50% {
      box-shadow: 0 0 0 6px rgba(255, 77, 79, .08);
    }
  }

  /* Stagger animation delay for each card */
  .notif-list li:nth-child(1) .notif-card {
    animation-delay: .03s;
  }

  .notif-list li:nth-child(2) .notif-card {
    animation-delay: .07s;
  }

  .notif-list li:nth-child(3) .notif-card {
    animation-delay: .11s;
  }

  .notif-list li:nth-child(4) .notif-card {
    animation-delay: .15s;
  }

  .notif-list li:nth-child(5) .notif-card {
    animation-delay: .19s;
  }

  .notif-list li:nth-child(6) .notif-card {
    animation-delay: .23s;
  }

  .notif-list li:nth-child(7) .notif-card {
    animation-delay: .27s;
  }

  .notif-list li:nth-child(8) .notif-card {
    animation-delay: .31s;
  }

  .read-at-time {
    font-size: 10px;
    opacity: 0.85;
    margin-left: 4px;
    font-weight: 400;
  }

  /* Custom Select2 Styling to match premium theme */
  .filters-row-inline {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: center;
  }

  .filter-col {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 220px;
    max-width: 300px;
  }

  .filter-label {
    font-size: 13px;
    font-weight: 700;
    color: #8a93b2;
    white-space: nowrap;
    margin: 0;
  }

  .filter-select-container {
    flex: 1;
  }

  .notif-filters-container .select2-container--default .select2-selection--single {
    background: #f0f2f8;
    border: none;
    border-radius: 30px;
    height: 36px;
    padding: 0 16px;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
  }

  .notif-filters-container .select2-container--default .select2-selection--single:hover {
    background: #e2e5f0;
  }

  .notif-filters-container .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #5c6a85;
    font-size: 12px;
    font-weight: 600;
    padding-left: 0;
    padding-right: 20px;
    line-height: 36px;
  }

  .notif-filters-container .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 34px;
    right: 12px;
  }

  .notif-filters-container .select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #5c6a85 transparent transparent transparent;
  }

  .select2-container--open .select2-dropdown {
    border: 1px solid #e2e5f0;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    background: #fff;
    padding: 6px;
    z-index: 9999;
  }

  .select2-container--default .select2-results__option {
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 13px;
    color: #4a5270;
    font-weight: 500;
    transition: background 0.15s ease;
  }

  .select2-container--default .select2-results__option--highlighted[aria-selected] {
    background: #6c63ff !important;
    color: #fff !important;
  }

  .select2-container--default .select2-results__option[aria-selected=true] {
    background: #f0f2f8;
    color: #1a1d2e;
    font-weight: 600;
  }

  .select2-search--dropdown {
    padding: 4px 4px 8px 4px;
  }

  .select2-search--dropdown .select2-search__field {
    border: 1px solid #e2e5f0;
    border-radius: 8px;
    padding: 6px 10px;
    font-size: 12px;
    outline: none;
    background: #f8fafc;
  }
</style>

<section class="content notif-page">

  <!-- Header -->
  <div class="notif-header">
    <div class="notif-header-left">
      <div class="notif-header-icon"><i class="fa fa-bell"></i></div>
      <div>
        <h2>Notifications</h2>
        <p>Centre d'alertes et d'activités</p>
      </div>
    </div>
    <?php if (!empty($notifications)): ?>
      <span class="notif-badge-count">
        <?php echo count($notifications); ?> notification<?php echo count($notifications) > 1 ? 's' : ''; ?>
      </span>
    <?php endif; ?>
  </div>

  <!-- Filters Panel -->
  <?php if (!empty($notifications)): ?>
    <div class="notif-filters-container">
      <div class="filters-row-inline">
        
        <div class="filter-col">
          <span class="filter-label">Catégorie :</span>
          <div class="filter-select-container">
            <select class="form-control select2-filter" id="type-filter-select" style="width: 100%;">
              <option value="all">Toutes (<?php echo $countTotal; ?>)</option>
              <option value="crm">Requête CRM (<?php echo $countCrm; ?>)</option>
              <option value="remplacement">Remplacement (<?php echo $countRempl; ?>)</option>
              <option value="other">Général (<?php echo $countOther; ?>)</option>
            </select>
          </div>
        </div>

        <?php if (!empty($vms)): ?>
          <div class="filter-col">
            <span class="filter-label">VM / Délégué :</span>
            <div class="filter-select-container">
              <select class="form-control select2-filter" id="vm-filter-select" style="width: 100%;">
                <option value="all">Tous (<?php echo $countTotal; ?>)</option>
                <?php foreach ($vms as $vmId => $vmName): ?>
                  <option value="<?php echo $vmId; ?>"><?php echo h($vmName); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        <?php endif; ?>

        <div class="filter-col">
          <span class="filter-label">Statut :</span>
          <div class="filter-select-container">
            <select class="form-control select2-filter" id="status-filter-select" style="width: 100%;">
              <option value="all">Tous (<?php echo $countTotal; ?>)</option>
              <option value="unread">Non lus (<?php echo $countUnread; ?>)</option>
              <option value="read">Lus (<?php echo $countRead; ?>)</option>
            </select>
          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>

  <?php if (empty($notifications)): ?>
    <!-- Empty state -->
    <div class="notif-empty">
      <div class="notif-empty-icon"><i class="fa fa-bell-slash-o"></i></div>
      <h4>Tout est tranquille ici</h4>
      <p>Aucune notification pour le moment. Revenez plus tard !</p>
    </div>

  <?php else: ?>
    <ul class="notif-list">
      <?php foreach ($notifications as $notif):
        $n = $notif['Notification'];
        $titre = $n['titre'];

        $isCrm = (strpos($titre, 'Requête CRM') !== false);
        $isRemp = (stripos($titre, 'remplacement') !== false || stripos($titre, 'remplaçant') !== false);

        if ($isCrm) {
          $typeClass = 'type-crm';
          $icon = 'fa-bullhorn';
          $dataType = 'crm';
        } elseif ($isRemp) {
          $typeClass = 'type-remplacement';
          $icon = 'fa-exchange';
          $dataType = 'remplacement';
        } else {
          $typeClass = 'type-default';
          $icon = 'fa-bell';
          $dataType = 'other';
        }

        $isUnread = ($n['vue'] == 0);
        $dateAgo = time_ago($n['created']);
        $dataStatus = $isUnread ? 'unread' : 'read';
        ?>
        <li data-type="<?php echo $dataType; ?>" data-status="<?php echo $dataStatus; ?>" data-vm="<?php echo !empty($notif['Sender']['id']) ? $notif['Sender']['id'] : 'system'; ?>">
          <div class="notif-card <?php echo $typeClass; ?><?php echo $isUnread ? ' unread' : ''; ?>">
            <div class="notif-icon-wrap">
              <i class="fa <?php echo $icon; ?>"></i>
            </div>
            <div class="notif-body">
              <div class="notif-top">
                <span class="notif-title"><?php echo h($titre); ?></span>
                <span class="notif-meta">
                  <i class="fa fa-clock-o"></i> <?php echo $dateAgo; ?>
                </span>
              </div>
              <div class="notif-message"><?php echo $n['message']; ?></div>
              <?php if (!empty($n['first_read_by'])): ?>
                <div class="notif-read-by">
                  <i class="fa fa-eye"></i> Lu par : <strong><?php echo h($n['first_read_by']); ?></strong>
                  <?php if (!empty($n['first_read_at'])): ?>
                    <span class="read-at-time">(<?php echo time_ago($n['first_read_at']); ?>)</span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      var select2Url = "<?php echo $this->Html->url('/js/select2.full.min.js'); ?>";
      var typeFilter = 'all';
      var vmFilter = 'all';
      var statusFilter = 'all';

      var typeSelect = document.getElementById('type-filter-select');
      var vmSelect = document.getElementById('vm-filter-select');
      var statusSelect = document.getElementById('status-filter-select');
      var list = document.querySelector('.notif-list');

      function initSelect2() {
        if (typeof $.fn.select2 !== 'undefined') {
          $('.select2-filter').select2();
        }
      }

      function loadScript(url, callback) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.onload = callback;
        script.src = url;
        document.getElementsByTagName("head")[0].appendChild(script);
      }

      // Check if select2 is already loaded, otherwise load it
      if (typeof $.fn.select2 === 'undefined') {
        loadScript(select2Url, function() {
          initSelect2();
        });
      } else {
        initSelect2();
      }

      function updateFilterBadges() {
        var items = document.querySelectorAll('.notif-list li');
        
        // Category filters counts
        var catCounts = { all: 0, crm: 0, remplacement: 0, other: 0 };
        // VM filters counts
        var vmCounts = { all: 0 };
        <?php foreach ($vms as $vmId => $vmName): ?>
          vmCounts["<?php echo $vmId; ?>"] = 0;
        <?php endforeach; ?>
        // Status filters counts
        var statusCounts = { all: 0, unread: 0, read: 0 };

        items.forEach(function(item) {
          var type = item.getAttribute('data-type');
          var status = item.getAttribute('data-status');
          var vm = item.getAttribute('data-vm');

          // Category matches status and vm
          var matchStatusForCat = (statusFilter === 'all' || status === statusFilter);
          var matchVmForCat = (vmFilter === 'all' || vm === vmFilter);
          if (matchStatusForCat && matchVmForCat) {
            catCounts.all++;
            if (catCounts[type] !== undefined) {
              catCounts[type]++;
            }
          }

          // Status matches type and vm
          var matchTypeForStatus = (typeFilter === 'all' || type === typeFilter);
          var matchVmForStatus = (vmFilter === 'all' || vm === vmFilter);
          if (matchTypeForStatus && matchVmForStatus) {
            statusCounts.all++;
            if (statusCounts[status] !== undefined) {
              statusCounts[status]++;
            }
          }

          // VM matches type and status
          var matchTypeForVm = (typeFilter === 'all' || type === typeFilter);
          var matchStatusForVm = (statusFilter === 'all' || status === statusFilter);
          if (matchTypeForVm && matchStatusForVm) {
            vmCounts.all++;
            if (vmCounts[vm] !== undefined) {
              vmCounts[vm]++;
            }
          }
        });

        // Update Category select options
        if (typeSelect) {
          typeSelect.querySelector('option[value="all"]').textContent = "Toutes (" + catCounts.all + ")";
          typeSelect.querySelector('option[value="crm"]').textContent = "Requête CRM (" + catCounts.crm + ")";
          typeSelect.querySelector('option[value="remplacement"]').textContent = "Remplacement (" + catCounts.remplacement + ")";
          typeSelect.querySelector('option[value="other"]').textContent = "Général (" + catCounts.other + ")";
        }

        // Update Select2 options for VMs
        if (vmSelect) {
          var allOption = vmSelect.querySelector('option[value="all"]');
          if (allOption) {
            allOption.textContent = "Tous (" + vmCounts.all + ")";
          }
          <?php foreach ($vms as $vmId => $vmName): ?>
            var opt = vmSelect.querySelector('option[value="<?php echo $vmId; ?>"]');
            if (opt) {
              var count = vmCounts["<?php echo $vmId; ?>"] || 0;
              opt.textContent = "<?php echo addslashes(h($vmName)); ?> (" + count + ")";
            }
          <?php endforeach; ?>
        }

        // Update Status select options
        if (statusSelect) {
          statusSelect.querySelector('option[value="all"]').textContent = "Tous (" + statusCounts.all + ")";
          statusSelect.querySelector('option[value="unread"]').textContent = "Non lus (" + statusCounts.unread + ")";
          statusSelect.querySelector('option[value="read"]').textContent = "Lus (" + statusCounts.read + ")";
        }

        // Notify Select2 to update its displayed text
        if (typeof $.fn.select2 !== 'undefined') {
          $('.select2-filter').trigger('change.select2');
        }
      }

      function filterNotifications() {
        var visibleCount = 0;
        var items = document.querySelectorAll('.notif-list li');
        
        items.forEach(function(item) {
          var type = item.getAttribute('data-type');
          var status = item.getAttribute('data-status');
          var vm = item.getAttribute('data-vm');

          var matchType = (typeFilter === 'all' || type === typeFilter);
          var matchVm = (vmFilter === 'all' || vm === vmFilter);
          var matchStatus = (statusFilter === 'all' || status === statusFilter);

          if (matchType && matchVm && matchStatus) {
            item.style.display = '';
            visibleCount++;
          } else {
            item.style.display = 'none';
          }
        });

        var emptyState = document.getElementById('filter-empty');
        if (visibleCount === 0) {
          if (!emptyState) {
            emptyState = document.createElement('div');
            emptyState.id = 'filter-empty';
            emptyState.className = 'filter-no-results';
            emptyState.style.display = 'block';
            emptyState.innerHTML = 
              '<div class="notif-empty-icon"><i class="fa fa-bell-slash-o"></i></div>' +
              '<h4>Aucun résultat</h4>' +
              '<p>Aucune notification ne correspond aux filtres sélectionnés.</p>';
            if (list) {
              list.parentNode.insertBefore(emptyState, list.nextSibling);
            }
          } else {
            emptyState.style.display = 'block';
          }
        } else {
          if (emptyState) {
            emptyState.style.display = 'none';
          }
        }

        // Update counts on filter buttons dynamically based on active filter criteria
        updateFilterBadges();
      }

      if (typeSelect) {
        $(typeSelect).on('change', function() {
          typeFilter = this.value;
          filterNotifications();
        });
      }

      if (vmSelect) {
        $(vmSelect).on('change', function() {
          vmFilter = this.value;
          filterNotifications();
        });
      }

      if (statusSelect) {
        $(statusSelect).on('change', function() {
          statusFilter = this.value;
          filterNotifications();
        });
      }

      // Initial badge calculation
      updateFilterBadges();
    });
    </script>
  <?php endif; ?>

</section>