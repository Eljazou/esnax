<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<style>
    .col-md-8 label{float: left;margin-top: 6px;font-weight: normal;}
    @media (max-width: 810px) {
        .panel-heading{width:100% !important;}
    }
</style>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading col-lg-10 col-md-10 col-xs-12" style="width:83.33%;">
            <h3 class="panel-title"></h3>
        </div>
        <div class="panel-body col-lg-10 col-md-10">
            <?php
            echo $this->Form->create('Feuilleroute');
            echo $this->Form->hidden("date",array("value"=>$date));
            ?>
            <div class="col-md-12" style="float:left !important;margin:auto !important;min-height:52px;padding-top:5px;">
                <b>Feuille de route de la date : <?php echo $date; ?></b>
            </div>
            <div class="col-md-12">
                <div class="">
                    <div class="box-body" style="height: 443px;overflow-y: scroll;overflow-x: auto;">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Secteur</th>
                                    <th>Adresse</th>
                                    <th>Sélections</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($clients as $value):
                                ?>
                                <tr >
                                    <td><?php echo $this->Html->link($value["Client"]["nom"], array('controller' => 'clients', 'action' => 'view', $value["Client"]["id"])); ?></td>
                                    <td>Pharmacie</td>
                                    <td><?php echo $value["Secteur"]["secteur"]; ?></td>
                                    <td><?php echo $value["Client"]["adress"]; ?></td>
                                    <td>
                                        <input type="checkbox" name="data[client_id][]" value="<?php echo $value["Client"]["id"]; ?>" class="flat-red">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(array('label' => 'Enregistrer la feuille de route des pharmacie', 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-xs-12 col-md-12', 'style' => 'margin:15px 0px;'))); ?>
        </div>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('jquery.flot.min');
echo $this->Html->script('jquery.flot.resize.min');
echo $this->Html->script('jquery.flot.pie.min');
echo $this->Html->script('jquery.flot.categories.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
?>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> 
<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 250,
            "aaSorting": []
        });
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "iDisplayLength": 250,
            "aaSorting": []
        });
    });
</script>