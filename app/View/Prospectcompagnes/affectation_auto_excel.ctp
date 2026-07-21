<?php
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('demo');
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style type="text/css">
    .btn_search{
        font-family: raleway;
        width: 271px;
        border-radius: 25px;
        background-color: #009688;
        color: white;
        font-size: 18px;
        font-weight: 500;
        transition: .3s;
    }
    .btn_search:hover{
        background-color: #15e0cd;
    }
    .input_txt{
        border-radius: 25px;
        margin-bottom: 14px;
    }

    /* ===== Design system restyle (pcl) ===== */
    .pcl-wrapper{
        font-family:'Poppins',sans-serif;
        color:#3a3a4a;
    }
    .pcl-wrapper .box{
        background:#fff !important;
        border:none !important;
        border-top:none !important;
        border-radius:18px !important;
        box-shadow:0 4px 24px rgba(108,99,245,0.08) !important;
        overflow:hidden;
    }
    .pcl-wrapper .box-header.with-border{
        border:none !important;
        display:flex;
        align-items:center;
        gap:14px;
        padding:22px 26px;
        background:linear-gradient(90deg,#f4f2ff 0%,#fbfaff 100%);
    }
    .pcl-icon-badge{
        width:44px;
        height:44px;
        min-width:44px;
        border-radius:13px;
        background:linear-gradient(135deg,#efeeff,#e3e0ff);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .pcl-icon-badge svg{
        width:20px;
        height:20px;
        stroke:#6C63F5;
    }
    .pcl-wrapper .panel-title,
    .pcl-wrapper .box-title{
        font-size:16px;
        font-weight:600;
        color:#2d2b45;
        margin:0;
    }
    .pcl-wrapper .box-body{
        padding:24px 26px;
    }
    .pcl-wrapper .box-footer{
        background:#fff !important;
        border-top:1px solid #eeecf9 !important;
        padding:20px 26px !important;
    }
    .pcl-wrapper .form-group label{
        font-size:13.5px;
        font-weight:600;
        color:#454358;
    }
    .pcl-wrapper .form-control,
    .pcl-wrapper .select2-container .select2-selection{
        border-radius:12px !important;
        border:1.5px solid #e7e5f7 !important;
        box-shadow:none !important;
        min-height:42px;
    }
    .pcl-wrapper .select2-selection__rendered{
        line-height:40px !important;
        padding-left:14px !important;
    }
    .pcl-wrapper .select2-selection__arrow{
        height:40px !important;
    }
    .pcl-wrapper .btn_search{
        font-family:'Poppins',sans-serif !important;
        background:linear-gradient(90deg,#6C63F5,#8c7ef2) !important;
        border:none !important;
        border-radius:999px !important;
        font-weight:600 !important;
        font-size:14.5px !important;
        box-shadow:0 6px 18px rgba(108,99,245,0.3) !important;
    }
    .pcl-wrapper .btn_search:hover{
        opacity:.92;
        background:linear-gradient(90deg,#6C63F5,#8c7ef2) !important;
    }
    .pcl-wrapper table.table-bordered thead tr:first-child th,
    .pcl-wrapper table.table-bordered tr:first-child th{
        background:#faf9ff !important;
        color:#4a4863 !important;
        font-weight:600 !important;
        border-bottom:2px solid #ece9fb !important;
    }
    .pcl-wrapper table.table-bordered td{
        font-size:13.5px;
        color:#454358;
        vertical-align:middle;
        border-color:#eeecf9 !important;
    }
    .pcl-wrapper table.table-striped tbody tr:nth-child(odd){
        background:#fbfaff;
    }
    .pcl-warning-banner{
        background:#fdecec;
        border-radius:14px;
        padding:18px 22px;
        margin-bottom:16px;
    }
    .pcl-warning-banner h2{
        color:#e6524d !important;
        font-size:15px;
        margin:0;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<div class="pcl-wrapper">
    <div class="row">
        <div class="col-md-12">
            
            <?php if(empty($prospects)) : ?>
                <div class="box box-info" style="margin-bottom:22px;">
                    <div class="box-header with-border">
                        <div class="pcl-icon-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <h2 class="panel-title">Générer une liste d'appel pour un conseiller</h2>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php 
                                echo $this->Form->create('Prospectcompagne');
                                echo $this->Form->input('user_id', array('label' => "Conseiller",'class' => 'form-control choix_multi select2'));
                                echo $this->Form->hidden('recherche', array('value' => "1"));
                                ?>      
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('prospectcompagne_id', array('label' => "Campagne",'class' => 'form-control choix_multi select2')); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix text-center">
                        <button type="submit" class="btn btn_search">Rechercher</button>
                    </div>
                </div>
            <?php else :  ?>
                <div class="box box-info" style="margin-bottom:22px;">
                    <div class="box-header with-border">
                        <div class="pcl-icon-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </div>
                        <div style="flex:1;">
                            <div class="pcl-warning-banner" style="margin-bottom:0;">
                                <h2>Veuillez noter que le téléchargement d'un fichier Excel entraînera l'écrasement définitif de la liste des prospects ci-dessous.</h2>
                            </div>
                        </div>
                    </div>
                    <div style="padding:0 26px;margin-top:16px;">
                        <div class="box- clearfix text-right">
                            <?php echo $this->Html->link('Télécharger exemple de fichier','/files/exemple/exempleappel.xlsx',array('class' => 'btn btn_search', 'download' => 'exempleappel.xlsx'));?>
                        </div>
                    </div>
                    <?php echo $this->Form->create('Prospectcompagne', array('type' => 'file')); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo $this->Form->input('user_id', array('label' => "Conseiller",'class' => 'form-control choix_multi select2'));?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('prospectcompagne_id', array('label' => "Campagne",'class' => 'form-control choix_multi select2'));?> 
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label>Fichier Excel</label>
                                    <?php echo $this->Form->file('file', array('class' => 'form-control'));?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix text-center">
                        <button type="submit" class="btn btn_search">Mise à jour</button>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($clientnonreconnus)): ?>
                <div class="box box-info" style="margin-bottom:22px;">
                    <div class="box-header with-border">
                        <div class="pcl-icon-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <h3 class="box-title">La liste des clients non reconnus</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Code wavesoft</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientnonreconnus as $k=>$v): ?>
                                        <tr>
                                            <td><?php echo $v; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="pcl-icon-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="9" x2="9" y2="21"/></svg>
                    </div>
                    <h3 class="box-title">La liste des prospects</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Code wavesoft</th>
                                    <th>Campagne</th>
                                    <th>Société</th>
                                    <th>Type</th>
                                    <th>FIX</th>
                                    <th>Portable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($prospects as $p): ?>
                                    <tr>
                                        <td><?php echo $p['Client']['code_wavsoft'] ?></td>
                                        <td><?php echo $p['Prospectcompagne']['name'] ?></td>
                                        <td><?php echo $p['Client']['nom'] ?></td>
                                        <td><?php echo $p['Client']['type_pharmacie'] ?></td>
                                        <td><?php echo $p['Client']['fixe'] ?></td>
                                        <td><?php echo $p['Client']['tel'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
echo $this->Html->css('datepicker3');
echo $this->Html->script('bootstrap-datepicker'); 
echo $this->Html->script('bootstrap-datepicker.fr'); 
?>

<script>
    $(function () {
        $('.choix_multi').select2();
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'fr'
        });
        $(".date").datepicker("option", "showAnim", "drop");
      
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>