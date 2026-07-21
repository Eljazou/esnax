<?php echo $this->Html->css('daterangepicker'); ?>
<?php echo $this->Html->css('select2.min'); ?>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
?>

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">

<style>
    .box-primary .box-header {
        background: #3c8dbc;
        color: white;
    }

    .cart {
        padding: 5px 10px;
        position: relative;
        display: flex;
        justify-content: center;
        padding: 32px 21px 0px;
        border-radius: 7px;
        margin-bottom: 34px;
        flex-wrap: wrap;
        background: #f8f8f8;
        margin-top: 16px;
    }

    .cart-header {
        position: absolute;
        z-index: 2;
        top: -14px;
        background: #f8f8f8;
        padding: 7px 15px 9px 0;
        border-radius: 7px;

    }

    .title-cart {
        margin: 0;
        font-size: 19px;
        font-weight: 700;
    }

    .myrow {
        width: 100%;
    }

    .my-group {
        display: flex;
        align-items: flex-end;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .add-product,
    .add-action {
        margin-bottom: 14px;
        margin-left: 30px;
    }

    .box.box-primary {
        border: 2px solid #3c8dbc;
        z-index: 9;
    }
</style>

<div class="myrow">
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="box ">
            
            <div class="box-body">
                <?php echo $this->Form->create('Rapport'); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>

                <div class="col-md-12" style="margin-bottom: 24px;">
                    <div class="">
                        <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: normal;width: auto;text-align:left;float:left;">Rapport concernant la date :</label>
                        <div class="col-md-4">
                            <div class="input-group col-lg-12" >
                                <div class="input-group-addon">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <input type="text" name="data[Rapport][date]" class="form-control pull-right" name="date" id="reservationtime" placeholder="Date" value="<?php echo $this->request->data['Rapport']['date_debut'].' -- '.$this->request->data['Rapport']['date_fin']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: normal;width: auto;text-align:left;float:left;">Titre Rapport :</label>
                        <div class="col-md-4">
                            <div class="input-group col-lg-12" >
                                <input name="data[Rapport][titre]" class="form-control" type="text" id="RapportTitre">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Activité CRM</h3>
                    </div>
                    <div class="box-body">
                        <div class="cart">
                            <div class="cart-header">
                                <h2 class="title-cart">
                                    Equipe
                                </h2>
                            </div>
                            <div class="myrow">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Moyenne de visite</label>
                                        <input name="data[Rapport][moyen_visite]" type="text" class="form-control" id="moyen-visite" value="<?php echo h($this->request->data['Rapport']['moyen_visite']); ?>">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Taux de couverture</label>
                                        <input name="data[Rapport][taux_couverture]" type="text" class="form-control" id="taux" value="<?php echo h($this->request->data['Rapport']['taux_couverture']); ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="cart">
                            <div class="cart-header">
                                <h2 class="title-cart">
                                    Responsable régional
                                </h2>
                            </div>
                            <div class="myrow">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre de visites solo</label>
                                        <input name="data[Rapport][visite_solo]" type="number" class="form-control" id="moyen-visite" value="<?php echo h($this->request->data['Rapport']['visite_solo']); ?>">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En double</label>
                                        <input name="data[Rapport][visite_double]" type="number" class="form-control" id="taux" value="<?php echo h($this->request->data['Rapport']['visite_double']); ?>">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Commentaire</label>
                                <textarea name="data[Rapport][commentaire_activite]" class="form-control"><?php echo h($this->request->data['Rapport']['commentaire_activite']); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Feed back terrain</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Activité terrain</label>
                                <textarea name="data[Rapport][activite_terrain]" class="form-control"><?php echo h($this->request->data['Rapport']['activite_terrain']); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Feed back matériel et produits</label>
                                <textarea name="data[Rapport][Feed_terrain]" class="form-control"><?php echo h($this->request->data['Rapport']['Feed_terrain']); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Activité de la concurrence</label>
                                <textarea name="data[Rapport][concurrence_terrain]" class="form-control"><?php echo h($this->request->data['Rapport']['concurrence_terrain']); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Commentaire</label>
                                <textarea name="data[Rapport][commentaire_terrain]" class="form-control"><?php echo h($this->request->data['Rapport']['commentaire_terrain']); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				
				<?php echo $this->Form->end(array('label' => 'Enregistrer les modifications', 'class' => 'btn btn-success btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php
echo $this->Html->script('daterangepicker'); ?>

<script>
    $(document).ready(function() {
        $('#reservationtime').daterangepicker({
            format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": " -- ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sam"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            },
            clickApply: function(e) {
                this.updateInputText();
            }
        });
    });
</script>