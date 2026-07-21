<?php
echo $this->Html->css('dataTables.bootstrap');
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ede9ff;
    }

    body, .box, table, .form-control {
        font-family: 'Poppins', sans-serif;
    }

    .submit {
        display: inline;
    }

    table.dataTable thead > tr > th {
        padding-right: 0px;
    }

    /* ===== Cards ===== */
    .box.box-primary {
        border-radius: 18px !important;
        border: none !important;
        box-shadow: 0 4px 16px rgba(108, 99, 245, 0.06) !important;
        background: #fff !important;
        border-top: none !important;
    }

    .box.box-primary .box-header {
        border: none !important;
        padding: 22px 24px 6px;
    }

    .box.box-primary .box-title {
        font-size: 15.5px;
        font-weight: 700;
        color: #2b2b45;
    }

    .payment-form {
        padding: 18px 24px 26px !important;
    }

    .payment-form label {
        font-weight: 600;
        font-size: 13.5px;
        color: #2b2b45;
        margin-bottom: 8px;
    }

    .payment-form .form-control {
        border: 1.5px solid #e7e6f7 !important;
        border-radius: 10px !important;
        height: auto !important;
        padding: 10px 14px !important;
        font-size: 14px !important;
        box-shadow: none !important;
    }

    .payment-form .form-control:focus {
        border-color: var(--primary) !important;
        outline: none;
    }

    /* file input pill wrapper */
    .file-upload-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1.5px dashed #d9d6fb;
        background: #fbfaff;
        border-radius: 10px;
        padding: 8px 14px;
    }

    .file-upload-wrap svg {
        color: var(--primary);
        flex-shrink: 0;
    }

    .file-upload-wrap input[type="file"] {
        font-size: 13.5px;
        color: #8d8da8;
    }

    .file-upload-wrap input[type="file"]::file-selector-button,
    .file-upload-wrap input[type="file"]::-webkit-file-upload-button {
        background: var(--primary-light);
        color: var(--primary);
        border: none;
        border-radius: 20px;
        padding: 7px 18px;
        font-weight: 600;
        font-size: 13.5px;
        margin-right: 12px;
        cursor: pointer;
        transition: background .15s ease, color .15s ease;
    }

    .file-upload-wrap input[type="file"]:hover::file-selector-button,
    .file-upload-wrap input[type="file"]:hover::-webkit-file-upload-button {
        background: var(--primary);
        color: #fff;
    }

    .box-footer.text-center {
        border: none !important;
        padding: 6px 24px 24px !important;
    }

    .btn-submit-pill {
        background: linear-gradient(135deg, var(--primary), #5479f7) !important;
        border: none !important;
        border-radius: 24px !important;
        color: #fff !important;
        padding: 11px 32px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        box-shadow: 0 6px 16px rgba(108, 99, 245, .32) !important;
    }

    .btn-submit-pill:hover {
        background: linear-gradient(135deg, #5f56ee, #3f66e6) !important;
        color: #fff !important;
    }

    /* ===== Table ===== */
    .box.box-primary .box-body {
        padding: 22px 24px;
    }

    table.dataTable thead th {
        background: #f4f2ff;
        color: #5b52e0;
        font-weight: 700;
        font-size: 13px;
        border: none !important;
    }

    table.table-bordered td, table.table-bordered th {
        border-color: #eef0fa !important;
    }

    /* export button restyled to match design (kept green look for CSV, purple pill wrapper) */
    .buttons-csv {
        padding: 8px 20px;
        background: #fff;
        color: var(--primary);
        border: 1.5px solid var(--primary);
        display: inline-flex;
        width: auto;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .buttons-csv:hover {
        color: #fff;
        text-decoration: none;
        background: var(--primary);
    }

    .buttons-excel {
        padding: 8px 20px !important;
        background: #fff !important;
        color: var(--primary) !important;
        border: 1.5px solid var(--primary) !important;
        display: inline-flex !important;
        align-items: center;
        gap: 8px;
        border-radius: 20px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        float: none !important;
        margin: 0 0 14px !important;
    }

    .buttons-excel:hover {
        color: #fff !important;
        background: var(--primary) !important;
    }
</style>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Ajouter une liste</h3>
    </div>
    <div class="panel-body form-horizontal payment-form">
        <?php echo $this->Form->create('Type', array("type" => "file")); ?>
        <div class="col-md-4">
            <?php echo $this->Form->input('user_id', array('label' => 'Nom', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-4">
            <?php echo $this->Form->input('liste', array('required' => 'required', 'label' => 'Nom de la liste', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-4" style="padding-top: 30px;">
            <label style="display:block;">Fichier</label>
            <div class="file-upload-wrap">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M17 8l-5-5-5 5"/><path d="M12 3v12"/></svg>
                <?php echo $this->Form->file('file', array('style' => 'display: inline;')); ?>
            </div>
        </div>
    </div>
    <div class="box-footer text-center">
        <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn-submit-pill')); ?>
    </div>
</div>


<div class="box box-primary">
    <div class="box-body">
        <div class="col-lg-12" style="overflow: auto;">

            <?php if (!empty($alldata)): ?>
                <table class="table table-bordered example1" id="example1">
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>ID Client</th>
                            <th>Nom client</th>
                            <th>Etat</th>
                            <th>#</th>
                        </tr>
                    </thead>

                    <?php foreach ($alldata as $i => $v) {
                        echo "<tr><td>$i</td><td>" . $v["code"] . "</td><td>" . $v["nom"] . "</td><td>" . $v["etat"] . "</td><td>";
                        echo $this->Html->link("Voir", array("controller" => "clients", "action" => "view", $v["id"]));
                        echo "</td></tr>";
                    }
                    ?>


                </table>
            <?php endif; ?>

            <?php
            echo $this->Html->script('jquery-2.2.3.min');
            echo $this->Html->script('jquery.dataTables.min');
            echo $this->Html->script('jquery.slimscroll.min');
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
                $(function() {
                    $('#example1').DataTable({
                        "paging": false,
                        "searching": true,
                        "ordering": false,
                        dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ]
                    });
                });
            </script>
        </div>
    </div>
</div>
