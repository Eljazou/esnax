<?php
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('metronic/css/style.bundle.css');
echo $this->Html->script('metronic/widgets.bundle.js');
echo $this->Html->script('metronic/scripts.bundle.js');
?>
<style>
    .metronic-page-shell {
        background: #f5f7fb;
        padding: 20px 0;
    }

    .metronic-card {
        background: #ffffff;
        border: 1px solid #e9edf7;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(22, 32, 77, 0.06);
        overflow: hidden;
    }

    .metronic-card .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eef1f8;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .page-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .page-icon {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #f2efff;
        color: #7c6ff0;
        font-size: 18px;
    }

    .page-title-wrap h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #1f2940;
    }

    .page-subtitle {
        margin: 2px 0 0;
        font-size: 12.5px;
        color: #8891a8;
    }

    .metronic-card .card-body {
        padding: 18px 20px 22px;
    }

    #example1 {
        margin: 0 !important;
        border-collapse: collapse;
    }

    #example1 thead th,
    #example1 tfoot th {
        background: #faf9ff !important;
        color: #1f2940 !important;
        border-bottom: 1px solid #ececf6 !important;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        padding: 14px 12px !important;
    }

    #example1 tbody td {
        padding: 12px;
        font-size: 13px;
        color: #364152;
        border-bottom: 1px solid #f2f4fb !important;
        vertical-align: top;
    }

    #example1 tbody tr:nth-child(even) td {
        background: #fbfbff;
    }

    #example1 tbody tr:hover td {
        background: #f4f1ff;
    }

    .btn-metronic-add {
        background: #7c6ff0 !important;
        color: #fff !important;
        border-radius: 10px !important;
        border: 0 !important;
        padding: 10px 18px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        box-shadow: 0 6px 16px rgba(124, 111, 240, 0.24);
    }

    .btn-metronic-add:hover {
        background: #6657df !important;
        color: #fff !important;
    }

    .btn-metronic-delete {
        background: #fff5f8 !important;
        color: #d43d6a !important;
        border: 1px solid #f6d5df !important;
        border-radius: 8px !important;
        padding: 8px 12px !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
    }

    .btn-metronic-delete:hover {
        background: #ffeaf1 !important;
        color: #c92f5a !important;
    }
</style>
<div class="metronic-page-shell">
    <div class="card metronic-card card-flush">
        <div class="card-header">
            <div class="page-title-wrap">
                <span class="page-icon"><i class="fa fa-shield"></i></span>
                <div>
                    <h3>Les règles de validation</h3>
                    <div class="page-subtitle">Gestion des règles, niveaux et messages</div>
                </div>
            </div>

            <?php
            if ($this->requestAction(array('controller' => 'droits', 'action' => 'getrole', 'notevalidations', 'index')) == 1) {
                echo $this->Html->link(__('Ajouter'), array('action' => 'add'), array('class' => 'btn btn-metronic-add'));
            }
            ?>
        </div>

        <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped table-row-bordered align-middle gs-0 gy-2">
                        <thead>
                            <tr>
                                <th>Responsables</th>
                                <th>Choix</th>
                                <th>Niveau de validation</th>
                                <th>Mail de validation</th>
                                <th>Mail de refus</th>
                                <th>Date d'ajout</th>
                                <th class="actions">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($notevalidations as $notevalidation): ?>
                            <tr>
                                <td>
                                    <?php
                                    $rs = explode(";", $notevalidation['Notevalidation']['users']);
                                    foreach ($rs as $k => $v) {
                                        echo $users[$v] . "<br>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $rs = explode(";", $notevalidation['Notevalidation']['choix']);
                                    foreach ($rs as $k => $v) {
                                        echo $v . "<br>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo h($notevalidation['Notevalidation']['niveau']); ?>&nbsp;</td>
                                <td><?php echo h($notevalidation['Notevalidation']['messagevalidation']); ?>&nbsp;</td>
                                <td><?php echo h($notevalidation['Notevalidation']['messageannulation']); ?>&nbsp;</td>
                                <td><?php echo h($notevalidation['Notevalidation']['created']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php
                                    echo $this->Form->postLink(
                                        __('Supprimer'),
                                        array('action' => 'delete', $notevalidation['Notevalidation']['id']),
                                        array('class' => 'btn btn-metronic-delete'),
                                        __('Etes-vous sur de vouloir supprimer ?')
                                    );
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	<?php echo $this->Html->script('jquery-2.2.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('app.min');
        echo $this->Html->script('jquery.dataTables.min');
        echo $this->Html->script('jquery.slimscroll.min');
        echo $this->Html->script('fastclick');
        echo $this->Html->script('demo');
        ?>
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
            "ordering": false,
            "info": false,
            "autoWidth": true,
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