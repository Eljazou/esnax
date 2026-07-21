<?php echo $this->Html->css('dataTables.bootstrap'); ?>

<style>
    :root{
        --purple-primary:#7C3AED;
        --purple-dark:#5B21B6;
        --purple-light:#EDE9FE;
        --purple-bg:#F5F3FF;
        --text-dark:#1F1147;
        --text-muted:#8A83A3;
        --border-soft:#EEEAFB;
    }

    @media (max-width:936px){
        .box-body{ overflow: scroll; overflow-y: hidden; }
    }

    /* ===== Header card ===== */
    .page-header-card{
        position:relative;
        overflow:hidden;
        background:linear-gradient(135deg,#8B5CF6 0%,#6D28D9 100%);
        border-radius:18px;
        padding:26px 30px;
        margin-bottom:22px;
        display:flex;
        align-items:center;
        gap:18px;
        box-shadow:0 10px 25px rgba(109,40,217,0.25);
    }
    .page-header-card .deco-circle{
        position:absolute;
        top:-40px; right:-30px;
        width:140px;height:140px;
        border-radius:50%;
        background:rgba(255,255,255,0.12);
    }
    .page-header-card .deco-circle.small{
        top:30px; right:60px;
        width:18px;height:18px;
        background:rgba(255,255,255,0.5);
    }
    .page-header-icon{
        flex:0 0 auto;
        width:56px;height:56px;
        border-radius:14px;
        background:rgba(255,255,255,0.18);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:26px;height:26px; }
    .page-header-text h3{
        margin:0;
        color:#fff;
        font-weight:700;
        font-size:22px;
    }
    .page-header-text p{
        margin:4px 0 0;
        color:rgba(255,255,255,0.85);
        font-size:13px;
    }
    .page-header-text .underline{
        display:inline-block;
        width:34px;height:3px;
        background:rgba(255,255,255,0.7);
        border-radius:3px;
        margin-top:8px;
    }

    /* ===== Table card ===== */
    .box{
        border:none;
        border-radius:18px;
        box-shadow:0 4px 18px rgba(109,40,217,0.08);
        overflow:hidden;
    }
    .box-body{ padding:20px 24px 8px; }

    /* DataTables top controls */
    div.dataTables_wrapper div.dataTables_length select,
    div.dataTables_wrapper div.dataTables_filter input{
        border:1px solid var(--border-soft);
        border-radius:8px;
        padding:5px 10px;
        color:var(--text-dark);
    }
    div.dataTables_wrapper div.dataTables_filter input{
        padding-left:30px;
        background:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238A83A3' stroke-width='2'><circle cx='11' cy='11' r='7'/><line x1='21' y1='21' x2='16.65' y2='16.65'/></svg>") no-repeat 8px center;
        background-size:14px;
    }
    div.dataTables_wrapper div.dataTables_info,
    div.dataTables_wrapper div.dataTables_length,
    div.dataTables_wrapper div.dataTables_filter label{
        color:var(--text-muted);
        font-size:13px;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button{
        border-radius:8px !important;
        margin:0 2px;
        border:1px solid transparent !important;
        color:var(--text-dark) !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current{
        background:var(--purple-primary) !important;
        border-color:var(--purple-primary) !important;
        color:#fff !important;
    }
    div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover{
        background:var(--purple-light) !important;
        color:var(--purple-dark) !important;
    }

    /* Table look */
    table.dataTable{ border-collapse:separate !important; border-spacing:0; }
    table.dataTable thead th{
        background:#fff;
        color:var(--text-muted);
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.03em;
        font-weight:700;
        border-bottom:2px solid var(--border-soft) !important;
        border-top:none !important;
        padding:12px 10px;
    }
    table.dataTable tbody td{
        vertical-align:middle;
        padding:14px 10px;
        border-top:1px solid var(--border-soft) !important;
        color:var(--text-dark);
        font-size:13px;
    }
    table.dataTable.table-striped>tbody>tr:nth-of-type(odd){ background-color:#FBFAFE; }
    table.dataTable tbody tr:hover{ background-color:var(--purple-bg) !important; }

    /* Name cell with avatar */
    .user-cell{ display:flex; align-items:center; gap:10px; }
    .avatar-circle{
        flex:0 0 auto;
        width:34px;height:34px;
        border-radius:50%;
        display:flex;align-items:center;justify-content:center;
        color:#fff; font-weight:700; font-size:13px;
        background:linear-gradient(135deg,#A78BFA,#7C3AED);
    }
    .user-cell a{ color:var(--text-dark); font-weight:600; }
    .user-cell a:hover{ color:var(--purple-primary); }

    /* Type badge */
    .type-badge{
        display:inline-block;
        padding:3px 12px;
        border-radius:20px;
        background:var(--purple-light);
        color:var(--purple-dark);
        font-size:12px;
        font-weight:600;
    }

    /* Montant */
    .montant-cell{ color:var(--purple-primary); font-weight:700; }

    /* Echeance */
    .echeance-cell{ display:flex; align-items:flex-start; gap:6px; color:var(--text-dark); }
    .echeance-cell svg{ width:14px;height:14px; margin-top:3px; flex:0 0 auto; color:var(--purple-primary); }
    .echeance-cell .sub{ display:block; font-size:12px; color:var(--text-muted); }

    /* Etat badges */
    .etat-badge{
        display:inline-flex; align-items:center; gap:6px;
        padding:4px 12px;
        border-radius:20px;
        font-size:12px;
        font-weight:600;
    }
    .etat-badge .dot{ width:6px;height:6px;border-radius:50%; }
    .etat-valide{ background:#E8F9EE; color:#1E9E5A; }
    .etat-valide .dot{ background:#1E9E5A; }
    .etat-refuse{ background:#FDECEC; color:#E0384D; }
    .etat-refuse .dot{ background:#E0384D; }
    .etat-encours{ background:#FFF3E0; color:#E08E23; }
    .etat-encours .dot{ background:#E08E23; }

    .muted-dash{ color:#C9C4DD; }

    /* Action buttons */
    .actions .btn{
        border-radius:8px;
        font-size:12px;
        font-weight:600;
        padding:6px 14px;
        border:none;
    }
    .actions .btn-purple{
        background:var(--purple-primary);
        color:#fff;
    }
    .actions .btn-purple:hover{ background:var(--purple-dark); color:#fff; }
    .actions .btn-outline-purple{
        background:#fff;
        color:var(--purple-primary);
        border:1px solid var(--purple-light);
    }
    .actions .btn-outline-purple:hover{ background:var(--purple-light); }

    /* Modal */
    #myModal .modal-content{ border-radius:16px; border:none; overflow:hidden; }
    #myModal .modal-header{
        background:linear-gradient(135deg,#8B5CF6 0%,#6D28D9 100%);
        border-bottom:none;
    }
    #myModal .modal-header .modal-title{ color:#fff; font-weight:700; }
    #myModal .modal-header .close{ color:#fff; opacity:.8; }
    #myModal textarea{ border-radius:10px; border:1px solid var(--border-soft); }
    #myModal .btn-primary{
        background:var(--purple-primary);
        border:none;
        border-radius:8px;
    }
    #myModal .btn-primary:hover{ background:var(--purple-dark); }
</style>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog col-md-10" style="margin:auto;float:none;width:32%;min-width:450px;top:10%;">
        <div class="modal-content" style="float:left;width: 100%;padding-bottom: 27px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Réponse</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action='' id="myform" method='post'>
                        <div class="col-md-12 input text">
                            <label class="col-md-12" style="padding:0px;">Votre réponse</label>
                            <textarea name="reponse" style="height:110px;max-width:100%;max-height:110px;" class="col-md-12 form-control" placeholder="Votre réponse"></textarea>
                        </div>
                        <div class="col-md-12 text-center" style="margin-top:10px;">
                            <input type="submit" value="Envoyer" class="btn btn-primary" style="float:right;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== Header ===== -->
<div class="page-header-card">
    <span class="deco-circle"></span>
    <span class="deco-circle small"></span>
    <div class="page-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 12h6M9 16h6M9 8h6"/>
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h9l7 7v9a2 2 0 0 1-2 2z"/>
        </svg>
    </div>
    <div class="page-header-text">
        <h3><?php echo __('Validation des prêts et des avances'); ?></h3>
        <p><?php echo __('Consultez et gérez les demandes de prêts et d\'avances'); ?></p>
        <span class="underline"></span>
    </div>
</div>

<div class="box">
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Echéance</th>
                    <th>Motif</th>
                    <th>Etat</th>
                    <th>Réponse</th>
                    <th>Date d'ajout</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php $i=0;

            foreach ($documents as $avence): ?>
                <?php
                    $initial = strtoupper(substr($avence['User']['name'], 0, 1));
                ?>
                <tr>
                    <td>
                        <div class="user-cell">
                            <span class="avatar-circle"><?php echo h($initial); ?></span>
                            <?php echo $this->Html->link($avence['User']['name'], array('controller' => 'users', 'action' => 'view', $avence['User']['id'])); ?>
                        </div>
                    </td>
                    <td><span class="type-badge"><?php echo h($avence['Avence']['type']); ?></span></td>
                    <td><span class="montant-cell"><?php echo h($avence['Avence']['montant']); ?>&nbsp;DH</span></td>
                    <td>
                        <?php if ($avence['Avence']['echeances'] != null): ?>
                        <div class="echeance-cell">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <span>
                                <?php echo $avence['Avence']['echeances']; ?> mois
                                <span class="sub"><?php echo round(($avence['Avence']['montant'] / $avence['Avence']['echeances']),2); ?> Dh/mois</span>
                            </span>
                        </div>
                        <?php endif; ?>&nbsp;
                    </td>
                    <td><?php echo h($avence['Avence']['motif']) ? h($avence['Avence']['motif']) : '<span class="muted-dash">—</span>'; ?>&nbsp;</td>
                    <td>
                        <?php if ($avence['Avence']['valide'] == 1): ?>
                            <span class="etat-badge etat-valide"><span class="dot"></span>Validé<?php if($avence['Avence']['etat']==1) echo " (Terminer)"; ?></span>
                        <?php elseif ($avence['Avence']['valide'] == 0): ?>
                            <span class="etat-badge etat-encours"><span class="dot"></span>En cours</span>
                        <?php elseif ($avence['Avence']['valide'] == -1): ?>
                            <span class="etat-badge etat-refuse"><span class="dot"></span>Réfusé</span>
                        <?php endif; ?>&nbsp;
                    </td>
                    <td><?php echo h($avence['Avence']['repense']) ? h($avence['Avence']['repense']) : '<span class="muted-dash">—</span>'; ?>&nbsp;</td>
                    <td><?php echo h($avence['Avence']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php
                        if ($this->requestAction('/droits/getrole/avences/valider') == 1 && $avence['Avence']['valide'] == 0) {
                            echo '<a class="v' . $i . ' btn btn-purple" onclick="valider(' . $i . ')" id="' . $this->Html->url(array('action' => 'valider', $avence['Avence']['id'], 1)) . '" style="cursor:pointer;margin-right:4px;">Valider</a>';
                            $i=$i+1;
                            echo '<a class="v' . $i . ' btn btn-outline-purple" onclick="valider(' . $i . ')" id="' . $this->Html->url(array('action' => 'valider', $avence['Avence']['id'], -1)) . '" style="cursor:pointer;">Archiver</a>';
                        }
						if ($this->requestAction('/droits/getrole/avences/valider') == 1 && $avence['Avence']['valide'] == 1 && $avence['Avence']['etat'] == 0)
							echo $this->Html->link("Terminer",array('action' => 'valider', $avence['Avence']['id'], 1,1), array('class'=>'btn btn-outline-purple'));
                        ?>
                    </td>
                </tr>
            <?php $i++; endforeach; ?>
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
    $(function () {
        $("#example1").DataTable({
            "language": {
                "lengthMenu": "Afficher _MENU_ entrées",
                "zeroRecords": "Aucun résultat trouvé",
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                "infoEmpty": "Aucune entrée disponible",
                "infoFiltered": "(filtré depuis _MAX_ entrées au total)",
                "search": "Rechercher\u00a0:",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            }
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false
        });
    });

    function valider(id) {
        var action = $('.v' + id).attr('id');
        var title = $('.v' + id).text();
        $('#myModalLabel').text(title);
        $('#myform').attr('action', action);
        $("#myModal").modal("show");
    }
</script>
