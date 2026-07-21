<?php echo $this->Html->css('dataTables.bootstrap');?>
<style>
    body { background: #f4f5fa; }

    .box {
        background: #fff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(99, 60, 200, 0.08);
        overflow: hidden;
    }

    .box-header {
        background: linear-gradient(135deg, #7b5ce8 0%, #9b6ef0 100%);
        padding: 24px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: none;
    }

    .box-header .title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .box-header .icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .box-header .icon-circle svg {
        width: 22px;
        height: 22px;
        stroke: #fff;
    }

    .box-header h3.box-title {
        color: #fff;
        font-size: 20px;
        font-weight: 700;
        margin: 0;
    }

    .box-header .subtitle {
        color: rgba(255,255,255,0.85);
        font-size: 13px;
        margin-top: 2px;
    }

    .btn-add-modern {
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.4);
        color: #fff !important;
        border-radius: 10px;
        padding: 9px 18px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
        text-decoration: none !important;
    }

    .btn-add-modern:hover {
        background: rgba(255,255,255,0.3);
        color: #fff !important;
    }

    .btn-add-modern svg {
        width: 16px;
        height: 16px;
        stroke: #fff;
    }

    .box-body {
        padding: 24px 28px 28px;
        overflow: scroll;
        overflow-y: hidden;
    }

    table.table {
        border-collapse: separate;
        border-spacing: 0;
    }

    table.table thead th {
        background: #f7f6fd;
        color: #6b5ecb;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: none !important;
        padding: 10px 16px;
    }

    table.table tbody td {
        border: none !important;
        border-bottom: 1px solid #f0eefa !important;
        padding: 8px 16px;
        font-size: 14px;
        color: #3a3a4a;
        vertical-align: middle;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fbfaff;
    }

    table.table-bordered {
        border: none;
    }

    .game-badge {
        display: inline-block;
        background: #efeafc;
        color: #6b46e5;
        font-weight: 700;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 20px;
    }

    .ref-cell {
        color: #9a95b5;
        font-weight: 600;
    }

    .btn-group .btn-info {
        background: #fff;
        border: 1px solid #e6e2fa;
        color: #7b5ce8;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(99,60,200,0.08);
        padding: 7px 12px;
    }

    .btn-group .btn-info:hover,
    .btn-group .btn-info:focus {
        background: #7b5ce8;
        color: #fff;
        border-color: #7b5ce8;
    }

    .btn-group .btn-info svg {
        width: 15px;
        height: 15px;
        vertical-align: -2px;
    }

    .dropdown-menu {
        border-radius: 10px;
        border: 1px solid #eee7fc;
        box-shadow: 0 8px 24px rgba(99,60,200,0.15);
        padding: 6px;
        overflow: hidden;
    }

    .dropdown-menu li a {
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 13px;
        color: #4a4a5a;
    }

    .dropdown-menu li a:hover {
        background: #f4f0ff;
        color: #6b46e5;
    }

    .dt-button {
        width: auto;
        float: left;
        margin: 0 0 18px 0;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        padding: 9px 16px;
        background: #337ab7;
        color: #fff;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .dt-button:hover {
        color: #fff;
        background: #1a486f;
    }

    div.dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #e6e2fa;
        padding: 6px 12px;
    }
</style>

<div class="box">
    <div class="box-header">
        <div class="title-wrap">
            <div class="icon-circle">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                    <line x1="8" y1="15" x2="8" y2="15.01"></line>
                    <line x1="12" y1="15" x2="12" y2="15.01"></line>
                </svg>
            </div>
            <div>
                <h3 class="box-title"><?php echo __('Games'); ?></h3>
                <div class="subtitle"><?php echo __("Consultez et gérez les gammes disponibles"); ?></div>
            </div>
        </div>
        <?php if ($this->requestAction('/droits/getrole/games/add') == 1):
            echo $this->Html->link(
                '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' . __('Ajouter'),
                array('action' => 'add'),
                array('class' => "btn-add-modern", 'escape' => false)
            );
        endif; ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Réf</th>
                    <th>La gamme</th>
                    <th class="actions">#</th>
                </tr>
            </thead>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td class="ref-cell"><?php echo h($game['Game']['id']); ?>&nbsp;</td>
                    <td><span class="game-badge"><?php echo h($game['Game']['name']); ?></span>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false" onclick="return toggleLegacyDropdown(this);">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="display:none;">
                                <li>
									<?php echo $this->Html->link(__('Voir'), array('action' => 'view', $game['Game']['id'])); ?>
								</li>
                                <li>
									<?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $game['Game']['id'])); ?>
								</li>
                                <li>
									<?php echo $this->Html->link(__('Archiver'), array('action' => 'archive', $game['Game']['id'],0)); ?>
								</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script>
function toggleLegacyDropdown(button) {
    var $button = jQuery(button);
    var $menu = $button.next('.dropdown-menu');
    if (!$menu.length) {
        $menu = $button.siblings('.dropdown-menu');
    }

    var isOpen = $button.attr('aria-expanded') === 'true';

    jQuery('.btn-group.dropdown .dropdown-toggle').not($button).attr('aria-expanded', 'false');
    jQuery('.btn-group.dropdown .dropdown-menu').not($menu).hide();

    if (isOpen) {
        $button.attr('aria-expanded', 'false');
        $menu.hide();
    } else {
        $button.attr('aria-expanded', 'true');
        $menu.show();
    }

    return false;
}

jQuery(function () {
    jQuery(document).on('click', function (e) {
        if (!jQuery(e.target).closest('.btn-group.dropdown').length) {
            jQuery('.btn-group.dropdown .dropdown-menu').hide();
            jQuery('.btn-group.dropdown .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
			dom: 'Bfrtip',
			buttons: [
				 'excel'
			]
        });
    });
</script>