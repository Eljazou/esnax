<div class="box">
    <div class="box-header with-border">
        <h2><?php echo __('Commande'); ?></h2>
		<?php if($commande['Commande']['archive']==0)
						echo '<span class="badge bg-yellow" style="float: right;margin-top: -31px;font-size: 16px;">En cours de validation</span>';
					if($commande['Commande']['archive']==1)
						echo '<span class="badge bg-green" style="float: right;margin-top: -31px;font-size: 16px;">Validé</span>'; ?>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <table class="col-md-4 table">
                <?php if (AuthComponent::user('id') != $commande['User']['id']): ?>
                    <tr>
                        <th><?php echo __('Utilisateur'); ?></th>
                        <td>
                            <?php echo $this->Html->link($commande['User']['name'], array('controller' => 'users', 'action' => 'view', $commande['User']['id'])); ?>
                            &nbsp;
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th><?php echo __('Type paiement'); ?></th>
                    <td>
                        <?php echo $commande['Commande']['paiement']; ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Réduction 2%'); ?></th>
                    <td>
                        <?php
                        if ($commande['Commande']['surplace'] != null || $commande['Commande']['surplace'] != '')
                            echo 'Oui';
                        else
                            echo "Non";
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Client'); ?></th>
                    <td><?php
                        if ($commande['Commande']['client_id'] != null)
                            echo $this->Html->link($commande['Client']['nom'] . ' ' . $commande['Client']['prenom'], array('controller' => 'clients', 'action' => 'view', $commande['Client']['id']));
                        else {
                            echo $commande['Commande']['nom'];
                            if (AuthComponent::user('role') != 'VMP' && AuthComponent::user('role') != 'Coordinateur')
                            {
                                ?>
                                <div class="form-group">
                                    <label for="DroitUserId">Clients</label>
                                    <select name="data[Droit][user_id]" class="form-control" onchange="location = this.value;">
                                        <?php
                                        foreach ($clients as $c) {
                                            echo "<option  value='" . $this->Html->url(array('action' => 'view', $commande['Commande']['id'],$c['Client']['id'])) . "'>".$c['Client']['nom']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                              }
                        }
                        ?></td>
                </tr>
                <tr>
                    <th><?php echo __('Téléphone'); ?></th>
                    <td><?php
                        if ($commande['Commande']['client_id'] != null)
                            echo $commande['Client']['tel'];
                        else
                            echo $commande['Commande']['tel'];
                        ?></td>
                </tr>
                <tr>
                    <th><?php echo __('E-mail'); ?></th>
                    <td><?php echo h($commande['Client']['mail']); ?></td>
                </tr>
                <tr>
                    <th><?php echo __('Adresse'); ?></th>
                    <td><?php echo h($commande['Client']['adress']); ?></td>
                </tr>
                <tr>
                    <th><?php echo __('Date de création'); ?></th>
                    <td>
                        <?php echo h($commande['Commande']['created']); ?>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <th><?php echo __('Total HT'); ?></th>
                    <td id="ht"></td>
                </tr>
                <tr>
                    <th><?php echo __('Total TTC'); ?></th>
                    <td id="ttc"></td>
                </tr>
            </table>
        </div>
        <?php
        if ($this->requestAction('/droits/getrole/commandes/archivevmp') == 1) {
            if ($commande['Commande']['archive'] == 0 && AuthComponent::user('id')==$commande['User']['id'])
                echo $this->Html->link('Archiver', array('action' => 'archivevmp', $commande['Commande']['id'], -1), array('style' => "float:right;", 'class' => "btn btn-primary btn-large"));
        }
        if ($commande['Commande']['archive'] == 0)
        //echo $this->Html->link('Editer', array('action' => 'edit', $commande['Commande']['id']), array('style' => "float:right;", 'class' => "btn btn-primary btn-large"));
            if ($this->requestAction('/droits/getrole/commandes/archive') == 1) {
                if ($commande['Commande']['archive'] == 0)
                    echo $this->Html->link('Valider', array('action' => 'archive', $commande['Commande']['id'], 1), array( 'class' => "btn btn-primary btn-large"));
                echo $this->Html->link('Archiver', array('action' => 'archive', $commande['Commande']['id'], -1), array('style' => "float:right;", 'class' => "btn btn-primary btn-large"));
            }
        ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <h3><?php echo __('Résumé de commande'); ?></h3>
    </div>
    <div class="box-body">
<?php if (!empty($commande['Comander'])): ?>
            <table class="table table-bordered">
                <tr>
                    <th><?php echo __('Produit'); ?></th>
                    <th><?php echo __('Quantite'); ?></th>
                    <th><?php echo __('Prix'); ?></th>
                    <th class="actions"></th>
                </tr>
    <?php
    $prixtotalht = 0;
    foreach ($commande['Comander'] as $comander):
        ?>
                    <tr>
                        <td><?php echo $this->requestAction('/produits/system_get_name_produit/' . $comander['produit_id']); ?></td>
                        <td>
        <?php echo $comander['quantite']; ?>
                        </td>
                        <td><?php $prixtotalht = $prixtotalht + $comander['prix'];
        echo $comander['prix']; ?> DH </td>
                        <td class="actions">
                            <?php //echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete_element', $comander['id'], $commande['Commande']['id']), null, __('vous étes sur # %s?', $comander['id']));  ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>

<script>
    document.getElementById('ht').innerHTML = "<?php
        if ($commande['Commande']['surplace'] != null || $commande['Commande']['surplace'] != '')
            $prixtotalht = $prixtotalht * 0.98;
        echo round($prixtotalht, 2);
        ?> Dhs";
    document.getElementById('ttc').innerHTML = "<?php echo round($prixtotalht * 1.2, 2); ?> Dhs";

</script>