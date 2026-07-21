<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php echo $this->Html->css('dataTables.bootstrap');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
<style>
    .mb-2 {
        margin-bottom: 20px;
    }
</style>
<div class="row">
    <section class="content-header mb-2">
        <h1>
            Liste des Questions
        </h1>
        <div class="breadcrumb">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Scanner le code Qr
            </button>
        </div>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Liste des superviseurs ayant envoyé le rapport : <?php echo $listeusers ?> </h3>

            </div>
            <?php foreach ($users as $user => $questions): ?>
                <div class="box-body">
                    <h3 class="box-title"><?php echo $user ?></h3>
                    <table class="table table-bordered table-striped mytable">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>sous titre</th>
                                <th>Question</th>
                                <th>Repense</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($questions as $question): ?>
                                <tr>
                                    <td><?php echo h($question['titre']); ?></td>
                                    <td><?php echo h($question['soustitre']); ?></td>
                                    <td><?php echo $this->Html->link($question['question'], array("action" => "detail", $question['id']), array("target" => "_blank")); ?></td>
                                    <td><?php echo h($question['repense']); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php echo $this->Form->postLink(
                                                '<i class="fa fa-trash"></i>',
                                                ['action' => 'delete', $question['id']],
                                                [
                                                    'escape' => false,
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Supprimer',
                                                    'confirm' => 'Êtes-vous sûr de vouloir supprimer cet ensemble de questions ?'
                                                ]
                                            ); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>

        </div>
    </section>

</div>



<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Scanner le code QR</h4>
            </div>
            <div class="modal-body text-center">
                <?php echo $this->Html->image('qr-code.png', array('class' => 'logo', "style" => "max-width: 300px;"));   ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Annuler</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
//echo $this->Html->script('bootstrap.min');
//echo $this->Html->script('app.min');
?>
<?php
echo $this->Html->script('jquery.dataTables.min');

?>

<!-- -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<style>
    .dt-button {
        width: auto;
        float: left;
        margin: 5px;
        font-size: 16px;
        line-height: 22px;
        padding: 3px 8px;
        background: #337ab7;
        color: #fff;
    }

    .dt-button:hover {
        color: #fff;
        background: #1a486f;
    }

    div.form,
    div.index,
    div.view {
        float: left;
        width: 98%;
        border-left: 1px solid #666;
        padding: 10px 1%;
    }

    .dt-buttons {
        width: 66%;
        float: left;
    }
</style>
<script>
    $(function() {
        $('.mytable').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true, // Let DataTables adjust column widths automatically
            "scrollY": "300px", // Set the scrollable height
            "scrollCollapse": true, // Allow the table to collapse if there are fewer rows
            "fixedHeader": true, // Enable fixed header
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
</script>