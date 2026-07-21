<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
    :root{
        --accent:#9b90e0;
        --accent-dark:#7e71cf;
        --accent-light:#f4f2fc;
        --accent-pale:#ece7fb;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.06);
    }

    .box{
        background:#fff; border:1px solid var(--border-color); border-radius:var(--radius-lg);
        box-shadow:var(--shadow-card); margin-bottom:20px;
    }
    .box .box-header{ border-bottom:none; padding:20px 24px 10px 24px; }
    .box .box-body{ padding:0 24px 24px 24px; }

    .box-title{ margin:0; font-size:16px; font-weight:700; color:var(--text-dark); display:flex; align-items:center; }
    .box-title:before{
        content:"\f0c0"; font-family:"FontAwesome"; display:inline-flex; align-items:center; justify-content:center;
        width:32px; height:32px; border-radius:50%; margin-right:10px; font-size:14px;
        background:var(--accent-light); color:var(--accent-dark);
    }

    table.display{ width:100% !important; border-collapse:separate !important; border-spacing:0; }
    table.display thead th{
        background:var(--accent-pale) !important; color:var(--accent-dark) !important;
        font-size:12.5px; font-weight:700; text-transform:uppercase; letter-spacing:.03em;
        border:none !important; padding:12px 14px !important;
    }
    table.display thead th:first-child{ border-top-left-radius:var(--radius-sm); }
    table.display thead th:last-child{ border-top-right-radius:var(--radius-sm); }
    table.display tbody td{
        border:none !important; border-bottom:1px solid var(--border-color) !important;
        padding:12px 14px !important; font-size:13.5px; color:var(--text-dark); vertical-align:middle;
    }
    table.display tbody tr:hover td{ background:var(--accent-light); }
    table.display tbody tr:last-child td{ border-bottom:none !important; }
    table.display a{ color:var(--text-dark); font-weight:600; text-decoration:none; }
    table.display a:hover{ color:var(--accent-dark); text-decoration:underline; }

    /* ---------- Réaffecter form ---------- */
    table.display .form-group{ display:flex; align-items:center; gap:8px; margin:0; }
    table.display select#ApartientSuperviseurs{
        border:1px solid var(--border-color); border-radius:var(--radius-sm);
        background:#fafafa; padding:7px 10px; font-size:13px; color:var(--text-dark);
        min-height:36px; min-width:160px;
    }
    table.display select#ApartientSuperviseurs:focus{ border-color:var(--accent); background:#fff; outline:none; }
    table.display .box-footer{
        background:transparent !important; border-top:none !important; padding:0 !important; display:inline-block;
    }
    table.display .btn-primary{
        background:var(--accent) !important; border:none !important; border-radius:var(--radius-sm) !important;
        color:#fff !important; padding:7px 16px !important; font-size:13px !important; font-weight:600;
        box-shadow:none !important;
    }
    table.display .btn-primary:hover{ background:var(--accent-dark) !important; }

    .dataTables_wrapper .dataTables_filter input{
        border:1px solid var(--border-color) !important; border-radius:20px !important;
        padding:8px 14px !important; font-size:13.5px !important; background:#fafafa !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus{ border-color:var(--accent) !important; background:#fff !important; outline:none; }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        border-radius:var(--radius-sm) !important; border:1px solid var(--border-color) !important;
        margin-left:6px !important; padding:7px 13px !important; color:var(--text-dark) !important;
        background:#fff !important; font-size:13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        background:var(--accent) !important; border-color:var(--accent) !important; color:#fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
        background:var(--accent-light) !important; color:var(--accent-dark) !important; border-color:var(--accent) !important;
    }
</style>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Utilisateurs'); ?></h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>Nom & prénom</th>
                    <th>E-mail</th>
                    <th>rôle</th>
                    <th>Affecté à </th>
                    <th>Réaffecter</th>
                </tr>
            </thead>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $this->Html->link($user['User']['name'], array('action' => 'view', $user['User']['id'])); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                    <td><?php   if($user['User']['role']=='Super viseur')
								echo 'Superviseur';
							else if($user['User']['role']=='Ressource humain')
								echo 'Ressources humaines';
							else 
								echo h($user['User']['role']); ?>&nbsp;</td>
                    <td><?php if(!isset($user['User']['super_id']))
                                echo '--';
                              else
                                  echo $this->Html->link($user['User']['name_id'],array('action'=>'view',$user['User']['super_id']));
                     ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Form->create('Prospectaffectation');
                        echo $this->Form->hidden('user1_id',array('value'=>$user['User']['id']));?>
                        <div class="form-group">
							<select name="data[Prospectaffectation][superviseurs]" id="ApartientSuperviseurs">
								<?php foreach ($superviseurs as $k=>$v):
										$s='';
										if(isset($user['User']['super_id']))
										{
											if($user['User']['super_id']==$k)
												$s="selected";
										}
								?>
									<option <?php echo $s ; ?> value="<?php echo $k ; ?>"><?php echo $v ; ?></option>
								<?php endforeach ; ?>
							</select>
						</div>
                        <?php echo $this->Form->end(array('label' => 'Valider','class'=>'btn btn-primary','div' => array('class' => 'box-footer')));
                        ?>&nbsp;
						
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
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
			"iDisplayLength": 50,
            "autoWidth": false
        });
    });
</script>
