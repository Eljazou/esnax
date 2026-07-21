<?php echo $this->Html->css('dataTables.bootstrap');
?>	
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Commandes'); ?></h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>VMP</th>
                    <th>Client</th>
                    <th>Paiement</th>
                    <th>Réduction 2%</th>
                    <th><?php echo __('Quantité des produits'); ?></th>
                    <th><?php echo __('Total en Dhs'); ?></th>
                    <th>Date de création</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?php echo $this->Html->link($commande['User']['name'], array('controller' => 'users', 'action' => 'view', $commande['User']['id'])); ?></td>
                    <td><?php echo $this->Html->link($commande['Client']['nom'].' '.$commande['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $commande['Client']['id'])); ?></td>
                    <td><?php echo h($commande['Commande']['paiement']); ?>&nbsp;</td>
                    <td><?php if($commande['Commande']['surplace']==null || $commande['Commande']['surplace']=='') echo 'Non';else echo "Oui"; ?>&nbsp;</td>
                    <td><?php $info=$this->requestAction('/commandes/system_get_total_and_quantite/'.$commande['Commande']['id']);
                        $info=explode('||',$info);
                             echo $info[1]; ?></td>
                    <td><?php echo $info[0]*1.2; ?> Dhs</td>
                    <td><?php echo h($commande['Commande']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
							</button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?php echo $this->Html->link(__('Voir'), array('action' => 'view', $commande['Commande']['id'])); ?></li>
                                <li><?php echo $this->Html->link(__('Editer'), array('action' => 'edit', $commande['Commande']['id'])); ?></li>
                                <li><?php 
                                if($commande['Commande']['archive']==0 && $this->requestAction('/droits/getrole/commandes/archive')==1)
                                {
                                    echo $this->Html->link(__('Valider'), array('action' => 'archive', $commande['Commande']['id'],1));
                                    echo $this->Html->link(__('Archiver'), array('action' => 'archive', $commande['Commande']['id'],-1));
                                }
                                ?></li>
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
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>