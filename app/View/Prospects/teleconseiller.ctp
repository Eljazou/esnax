<?php echo $this->Html->css('dataTables.bootstrap'); ?>	
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    @media (max-width:932px){
        .box-body{
            overflow: scroll;
            overflow-y: hidden;
        }
    }
    .table-striped > tbody{
        background-color: #f9f9f9;
    }
    .table-striped > thead{
        background-color: #ffffff;
    }

    /* ===== Design system restyle (tc) ===== */
    .tc-wrapper{
        font-family:'Poppins',sans-serif;
        color:#3a3a4a;
    }
    .tc-wrapper .box{
        background:#fff;
        border:none;
        border-radius:18px;
        box-shadow:0 4px 24px rgba(108,99,245,0.08);
    }
    .tc-banner{
        background:linear-gradient(90deg,#f4f2ff 0%,#fbfaff 100%);
        border-radius:18px 18px 0 0;
        padding:24px 26px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:16px;
        flex-wrap:wrap;
        border:none !important;
    }
    .tc-banner-left{
        display:flex;
        align-items:center;
        gap:14px;
    }
    .tc-icon-badge{
        width:48px;
        height:48px;
        min-width:48px;
        border-radius:50%;
        background:linear-gradient(135deg,#e3e0ff,#d3cdfb);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .tc-icon-badge svg{
        width:22px;
        height:22px;
        stroke:#6C63F5;
    }
    .tc-banner-title{
        font-size:20px;
        font-weight:700;
        color:#2d2b45;
        margin:0;
    }
    .tc-banner-sub{
        font-size:13px;
        color:#8b87a8;
        margin-top:2px;
    }
    .tc-wrapper .btn.bg-purple{
        background:linear-gradient(90deg,#6C63F5,#8c7ef2) !important;
        border:none !important;
        border-radius:999px !important;
        padding:9px 20px !important;
        font-weight:600;
        font-size:13.5px;
        box-shadow:0 6px 16px rgba(108,99,245,0.28) !important;
        color:#fff !important;
    }
    .tc-wrapper .box-body{
        padding:20px 24px 24px 24px;
    }
    .tc-wrapper table.dataTable thead th{
        background:#faf9ff;
        color:#4a4863;
        font-weight:600;
        font-size:13.5px;
        border-bottom:2px solid #ece9fb;
    }
    .tc-wrapper table.dataTable tbody td{
        font-size:14px;
        color:#454358;
        vertical-align:middle;
    }
    .tc-wrapper table.dataTable.table-striped tbody tr.odd{
        background:#fbfaff;
    }
    .tc-wrapper table.dataTable tbody tr:hover{
        background:#f4f2ff;
    }
    .tc-avatar-img{
        border-radius:12px !important;
        height:56px !important;
        width:56px;
        object-fit:cover;
        box-shadow:0 2px 8px rgba(108,99,245,0.15);
    }
    .tc-role-badge{
        display:inline-block;
        background:#f1effe;
        color:#6C63F5;
        border-radius:999px;
        padding:4px 14px;
        font-size:12.5px;
        font-weight:600;
    }
    .tc-wrapper .btn-info.dropdown-toggle{
        background:transparent;
        color:#6C63F5;
        border:1.5px solid #d8d3fb;
        border-radius:999px;
        font-weight:600;
        font-size:13px;
        padding:6px 14px;
        box-shadow:none;
    }
    .tc-wrapper .btn-info.dropdown-toggle:hover,
    .tc-wrapper .btn-info.dropdown-toggle:focus{
        background:#f1effe;
        color:#6C63F5;
    }
    .tc-wrapper .dropdown-menu{
        border-radius:12px;
        border:1px solid #eeecf9;
        box-shadow:0 8px 24px rgba(108,99,245,0.12);
        padding:6px;
    }
    .tc-wrapper .dropdown-menu li a{
        border-radius:8px;
        font-size:13.5px;
        color:#454358;
    }
    .tc-wrapper .dropdown-menu li a:hover{
        background:#f4f2ff;
        color:#6C63F5;
    }
    .tc-wrapper .btn-box-tool{
        color:#6C63F5;
    }
    .tc-wrapper .dataTables_filter input{
        border-radius:999px;
        border:1.5px solid #e7e5f7;
        padding:8px 16px;
        font-size:14px;
    }
    .tc-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:999px !important;
        border:1px solid #e7e5f7 !important;
        margin:0 3px;
        color:#6a6785 !important;
    }
    .tc-wrapper .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:#6C63F5 !important;
        border-color:#6C63F5 !important;
        color:#fff !important;
    }
</style>
<div class="tc-wrapper">
<div class="box">
    <div class="box-header tc-banner">
        <div class="tc-banner-left">
            <div class="tc-icon-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <h3 class="tc-banner-title"><?php echo __('La liste des teleconseillers'); ?></h3>
                <div class="tc-banner-sub">Consultez et gérez les téléconseillers</div>
            </div>
        </div>
        <?php
        if ($this->requestAction('/droits/getrole/users/add') == 1 )
            echo $this->Html->link(__('Ajouter'), array("controller"=>"users",'action' => 'add'), array('class="btn bg-purple btn-flat margin"'));
        
        ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom & prénom</th>
                    <th>E-mail</th>
                    <th>Code wavesoft</th>
                    <th>Rôle</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php
            $i = 0;
            foreach ($users as $user):
                ?>
                <tr>
                    <td><?php echo $this->Html->image('users/' . $user['User']['image'], array('class' => 'tc-avatar-img', 'style' => 'height: 100px;')); ?></td>
                    <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['code_wavsoft']); ?>&nbsp;</td>
                    <td><span class="tc-role-badge"><?php echo h($user['User']['role']); ?></span>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                
								<li> <?php
                                    if ($this->requestAction('/droits/getrole/Rapportprocpects/fuille_route_conseiller') == 1)
                                        echo $this->Html->link(__('Feuille de route'), array("controller"=>"Rapportprocpects",'action' => 'fuille_route_conseiller', $user['User']['id']));
                                    ?></li>
                                <li> <?php
                                    if ($this->requestAction('/droits/getrole/listes/listeretard') == 1)
                                        echo $this->Html->link(__('Liste retard'), array("controller" => "listes", 'action' => 'listeretard', $user['User']['id']));
                                    ?></li>
                                <li>  <?php
                                    if ($this->requestAction('/droits/getrole/users/admin_bloquer_user') == 1) {
                                        if ($user['User']['archive'] == 1)
                                            echo $this->Html->link(__('Bloquer'), array("controller"=>"users",'action' => 'admin_bloquer_user', $user['User']['id'], -1));
                                        
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <?php if ($user['User']['role'] == 'Super viseur' && !isset($tous)): ?>
                            <button type="button" onclick="boxtog(<?php echo $i; ?>)" class="btn btn-box-tool" style="float: right;font-size:16px;"><i id="icon<?php echo $i; ?>" class="fa fa-plus" style="color:#aaa;"></i></button>
                        <?php endif; ?>
                    </td>
                </tr>
                
            <?php endforeach; ?>
        </table>
    </div>
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
        });
    });
    function boxtog(id) {
        $('.boxlistes' + id).toggle(300);
        var clas = $("#icon" + id).attr("class");
        if (clas == 'fa fa-minus') {
            $("#icon" + id).attr("class", "fa fa-plus");
        }
        if (clas == 'fa fa-plus') {
            $("#icon" + id).attr("class", "fa fa-minus");
        }
    }
</script>
