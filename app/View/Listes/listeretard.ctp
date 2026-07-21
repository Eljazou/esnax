<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{color:#fff !important;}
    @media (max-width:896px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }
    .dt-button{width:auto;float:left;margin:5px;font-size:16px;line-height:22px;padding:3px 8px;background:#337ab7;color:#fff; }
    .dt-button:hover{color:#fff;background:#1a486f;}

    /* ===== LaboRate-style restyle ===== */
    :root{
        --lr-accent:#6C5CE7;
        --lr-accent-dark:#5b4bd6;
        --lr-accent-soft:#EFECFD;
        --lr-text:#1F2430;
        --lr-muted:#8A8FA3;
        --lr-border:#EEF0F5;
        --lr-bg:#F6F7FB;
    }

    body{ background: var(--lr-bg); }

    .lr-card{
        background:#fff;
        border-radius:18px;
        box-shadow:0 4px 24px rgba(31,36,48,0.06);
        padding:28px 28px 12px 28px;
        border:1px solid var(--lr-border);
    }

    .lr-card-header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap:wrap;
        gap:16px;
        margin-bottom:22px;
    }

    .lr-header-left{
        display:flex;
        align-items:center;
        gap:16px;
    }

    .lr-icon-circle{
        width:52px;
        height:52px;
        border-radius:50%;
        background:var(--lr-accent-soft);
        color:var(--lr-accent);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
        flex-shrink:0;
    }

    .lr-title{
        margin:0;
        font-size:22px;
        font-weight:700;
        color:var(--lr-text);
    }

    .lr-subtitle{
        margin:2px 0 0 0;
        font-size:13.5px;
        color:var(--lr-muted);
    }

    .lr-header-right{
        display:flex;
        align-items:center;
        gap:12px;
        flex-wrap:wrap;
    }

    .lr-search-wrap{
        position:relative;
    }

    .lr-search-wrap i{
        position:absolute;
        left:14px;
        top:50%;
        transform:translateY(-50%);
        color:var(--lr-muted);
        font-size:14px;
    }

    #lr-search-input{
        border:1px solid var(--lr-border);
        background:#fff;
        border-radius:12px;
        padding:10px 14px 10px 36px;
        font-size:14px;
        color:var(--lr-text);
        min-width:230px;
        outline:none;
        transition:border-color .15s ease, box-shadow .15s ease;
    }

    #lr-search-input:focus{
        border-color:var(--lr-accent);
        box-shadow:0 0 0 3px var(--lr-accent-soft);
    }

    .lr-btn-primary{
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:var(--lr-accent);
        color:#fff !important;
        border:none;
        border-radius:12px;
        padding:10px 18px;
        font-size:14px;
        font-weight:600;
        text-decoration:none !important;
        cursor:pointer;
        transition:background .15s ease;
    }

    .lr-btn-primary:hover{
        background:var(--lr-accent-dark);
        color:#fff !important;
    }

    /* Table restyle */
    .lr-table-wrap{
        border:1px solid var(--lr-border);
        border-radius:14px;
        overflow:hidden;
    }

    table.lr-table{
        width:100%;
        border-collapse:collapse;
        margin-bottom:0 !important;
    }

    table.lr-table thead th{
        background:#FAFAFC;
        color:var(--lr-text);
        font-size:13px;
        font-weight:700;
        text-transform:none;
        border-bottom:1px solid var(--lr-border) !important;
        border-top:none !important;
        padding:14px 16px;
        white-space:nowrap;
    }

    table.lr-table thead th .lr-sort{
        color:#C9CCDA;
        margin-left:4px;
        font-size:11px;
    }

    table.lr-table tbody td{
        padding:14px 16px;
        font-size:14px;
        color:var(--lr-text);
        border-top:1px solid var(--lr-border) !important;
        vertical-align:middle;
    }

    table.lr-table tbody tr:hover{
        background:#FAFAFF;
    }

    table.lr-table tbody tr td a{
        color:var(--lr-accent);
        font-weight:600;
        text-decoration:none;
    }

    table.lr-table tbody tr td a.btn-primary{
        background:var(--lr-accent);
        color:#fff !important;
        border:none;
        border-radius:8px;
        padding:6px 12px;
        font-weight:600;
        font-size:13px;
    }

    /* Empty state */
    .lr-empty-state{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        padding:70px 20px;
        text-align:center;
    }

    .lr-empty-state .lr-empty-icon{
        width:64px;
        height:64px;
        border-radius:16px;
        background:var(--lr-accent-soft);
        color:var(--lr-accent);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:26px;
        margin-bottom:16px;
    }

    .lr-empty-state h4{
        margin:0 0 4px 0;
        font-size:16px;
        font-weight:700;
        color:var(--lr-text);
    }

    .lr-empty-state p{
        margin:0;
        font-size:13.5px;
        color:var(--lr-muted);
    }

    /* Footer bar (row count) */
    .lr-table-footer{
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:14px 4px;
        font-size:13px;
        color:var(--lr-muted);
    }

    /* Hide default DataTables chrome we no longer need */
    #example1_wrapper .dataTables_filter,
    #example1_wrapper .dataTables_info,
    #example1_wrapper .dataTables_length{
        display:none !important;
    }

    #example1_wrapper .dt-buttons{
        margin-top:0;
    }
</style>
<?php
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
?>
<div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="gridModalLabel">Merci de remplire la potentialité du client</h4>
            </div>
            <?php echo $this->Form->create('Clientspropose', array('url'=> array('action' => 'system_add_info' ))); ?>
            <input type="hidden" name="data[Clientspropose][client_id]" class="inputid" value="40">
            <div class="modal-body">
                <div class="container-fluid bd-example-row">
                    <div class="row">
                        <div class="col-md-12" style="padding:0px;padding-bottom:5px;">
                            <div class="col-md-4" style="">
                                <b>Patients par jour</b>
                                <select name="data[Clientspropose][A]" class="form-control" id="ClientsproposeCategoryId">
                                    <option value="A">Plus de 20</option>
                                    <option value="B">Entre 10 et 20</option>
                                    <option value="C">Moins de 10</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="">
                                <b>Adoption des produits Esnapharm</b>
                                <select name="data[Clientspropose][1]" class="form-control" id="ClientsproposeCategoryId">
                                    <option value="1">Exclusif</option>
                                    <option value="2">Fidèle</option>
                                    <option value="3">Rare</option>
                                    <option value="4">Non</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="">
                                <b>Classification</b>
                                <select name="data[Clientspropose][potentialitev2]" class="form-control" id="ClientsproposeCategoryId">
                                    <option value="PCM">PCM</option>
                                    <option value="QAM">QAM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding:0px;">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top:5px;padding-bottom:5px;">
                                <h3 class="panel-title" style="padding:0px;"></h3>
                            </div>
                            <?php
                            echo $this->Form->input('produits', array('name' => "data[Clientspropose][produits]", 'label' => 'La liste des produits', 'class' => 'form-control select2', 'multiple' => "multiple"));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo $this->Html->url(array('controller' => 'visites', 'action' => 'add', 40)); ?>" class="btn btn-default lienid">Plus tard</a>
                <input type="submit" class="btn btn-primary" value="Envoyer">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-11" style="float:none;margin:auto;">
        <div class="lr-card">
            <div class="lr-card-header">
                <div class="lr-header-left">
                    <div class="lr-icon-circle"><i class="fa fa-users"></i></div>
                    <div>
                        <h3 class="lr-title">La liste des clients</h3>
                        <p class="lr-subtitle">Gérez et consultez tous les clients enregistrés dans le système.</p>
                    </div>
                </div>
                <div class="lr-header-right">
                    <div class="lr-search-wrap">
                        <i class="fa fa-search"></i>
                        <input type="text" id="lr-search-input" placeholder="Rechercher un client...">
                    </div>
                </div>
            </div>

            <div class="box-body" style="padding:0;">
                <div class="lr-table-wrap">
                    <table class="table table-bordered lr-table" id="example1">
                        <thead>
                            <tr>
                                <th>Liste <i class="fa fa-sort lr-sort"></i></th>
                                <th>Nom <i class="fa fa-sort lr-sort"></i></th>
                                <th>Type <i class="fa fa-sort lr-sort"></i></th>
                                <th>Spécialité <i class="fa fa-sort lr-sort"></i></th>
                                <th>Pot <i class="fa fa-sort lr-sort"></i></th>
                                <th>Secteur <i class="fa fa-sort lr-sort"></i></th>
                                <th>Nb° de Retards <i class="fa fa-sort lr-sort"></i></th>
                                <th>Action <i class="fa fa-sort lr-sort"></i></th>
                                <?php
                                if ($this->requestAction('/droits/getrole/listes/envoyer_client_retard') == 1)
                                    echo "<th>Envoyer au SP <i class='fa fa-sort lr-sort'></i></th>";
                                else
                                    echo '<th></th>';
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($clients as $value):
                                ?>
                                <tr>
                                    <td>&nbsp;<?php echo $value["Client"]["info"]["liste_name"]; ?></td>
                                    <td>&nbsp;<?php echo $this->Html->link($value["Client"]["nom"] . ' ' . $value["Client"]["prenom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"]), array("target" => "_blank")); ?></td>
                                    <td><?php echo $types[$value["Client"]["type_id"]]; ?>&nbsp;</td>
                                    <td><?php echo $cats[$value["Client"]["category_id"]]; ?>&nbsp;</td>
                                    <td><?php echo $value["Client"]["potentialite"]; ?>&nbsp;</td>
                                    <td><?php echo $secteurs[$value["Client"]["secteur_id"]]; ?>&nbsp;</td>
                                    <td><?php echo $value["Client"]["info"]["retard"]; ?> &nbsp;</td>
                                    <td><?php
                                        if ($this->requestAction('/droits/getrole/Visites/add') == 1)
                                            if ($value['Client']['potentialite'] == 'NR') {
                                                echo "<a data-toggle='modal' data-target='#gridSystemModal' style='cursor:pointer;' onclick='listeid(" . $value["Client"]['id'] . ")'>Visiter</a>";
                                            } else
                                                echo $this->Html->link('Visiter', array('controller' => 'visites', 'action' => 'add', $value["Client"]['id']), array("target" => "_blank"));
                                        ?>&nbsp;</td>
                                    <td><?php
                                        if ($this->requestAction('/droits/getrole/listes/envoyer_client_retard') == 1)
                                            echo $this->Html->link('Envoyer au SP', array('controller' => 'listes', 'action' => 'envoyer_client_retard', $user_id, $value["Client"]['id']), array('class' => 'btn btn-primary'));
                                        ?>&nbsp;</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="lr-table-footer">
                    <span><?php echo count($clients); ?> client(s) au total</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (AuthComponent::user('role') == 'Super viseur'): ?>
    <div class="row" style="margin-top:20px;">
        <div class="col-md-11" style="float:none;margin:auto;">
            <div class="lr-card">
                <div class="lr-card-header">
                    <div class="lr-header-left">
                        <div class="lr-icon-circle"><i class="fa fa-road"></i></div>
                        <div>
                            <h3 class="lr-title">La liste des feuilles de route</h3>
                            <p class="lr-subtitle">Consultez l'historique de vos feuilles de route.</p>
                        </div>
                    </div>
                    <?php
                    if ($this->requestAction('/droits/getrole/listes/feuilleroute') == 1)
                        echo $this->Html->link('<i class="fa fa-plus"></i> Créer une feuille de route', array('action' => 'feuilleroute', AuthComponent::user('id')), array('class' => 'lr-btn-primary', 'escape' => false));
                    ?>
                </div>

                <div class="box-body" style="padding:0;">
                    <?php
                    $feuilles = $this->requestAction('/listes/system_get_list_feuille_route/' . AuthComponent::user('id') . '/' . $date_debut);
                    ?>
                    <div class="lr-table-wrap">
                        <table class="table table-bordered lr-table">
                            <thead>
                                <tr>
                                    <th>Date <i class="fa fa-sort lr-sort"></i></th>
                                    <th>Nombre de clients <i class="fa fa-sort lr-sort"></i></th>
                                    <th>Action <i class="fa fa-sort lr-sort"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($feuilles)): ?>
                                    <?php foreach ($feuilles as $value): ?>
                                        <tr>
                                            <td
                                                <?php if ($value['Feuilleroute']["date"] == date('Y-m-d')) echo 'style="background:#E7F8E5;"'; ?> >
                                                    <?php echo strftime("%A %d %B %Y", strtotime($value['Feuilleroute']["date"])); ?>
                                            </td>
                                            <td><?php echo $value[0]["num"] ?></td>
                                            <td><?php echo $this->Html->link('Voir', array('action' => 'detail_feuille_route', $value['Feuilleroute']["user_id"], $value['Feuilleroute']["date"]), array('class' => 'btn btn-primary')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
?>

<script>
    function listeid(id) {
        $(".inputid").attr("value", id);
        $(".lienid").attr("href", "/visites/add/" + id);
    }
    $(function () {
        $("#ClientsproposeProduits").select2();
    });
</script>

<?php
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
        var table = $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 50,
            "aaSorting": [],
            "language": {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            }

            <?php if (!AuthComponent::user('role') == 'VMP' && !AuthComponent::user('role') == 'Coordinateur') {
                ?>,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ]
            <?php } ?>
        });

        // wire the custom LaboRate-style search box to DataTables
        $('#lr-search-input').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>
