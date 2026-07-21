<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Sortie grossiste'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php echo $this->Form->create('Grovente'); 
                    echo $this->Form->input('date',array('type' => 'text','id' => 'datepicker','class'=>'form-control'));
                    echo $this->Form->hidden('grosiste_id',array('value'=>$grossiste_id));
                    ?>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                            </tr>
                        </thead>
                        <?php $i=0;foreach ($groproduits as $id=>$produit): ?>
                            <tr>
                                <td><?php echo $produit; 
                                echo $this->Form->hidden('groproduit_id',array('value'=>$id,"name"=>"data[$i][Grovente][groproduit_id]")); ?>&nbsp;</td>
                                <td><?php echo $this->Form->input('quantite',array('label' => false,"name"=>"data[$i][Grovente][quantite]",'class'=>'form-control')); ?>&nbsp;</td>
                            </tr>
                        <?php $i++;endforeach; ?>
                    </table>
                    <?php echo $this->Form->end(array('label' => 'Envoyer','class'=>'btn btn-primary btn-large','div' => array('class' => 'well text-center'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    (function (factory) {
        if (typeof define === "function" && define.amd) {
            define(["../widgets/datepicker"], factory);
        } else {
            factory(jQuery.datepicker);
        }
    }(function (datepicker) {
        datepicker.regional.fr = {
            closeText: "Fermer",
            prevText: "Précédent",
            nextText: "Suivant",
            currentText: "Aujourd'hui",
            monthNames: ["janvier", "février", "mars", "avril", "mai", "juin",
                "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            monthNamesShort: ["janv.", "févr.", "mars", "avr.", "mai", "juin",
                "juil.", "août", "sept.", "oct.", "nov.", "déc."],
            dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
            dayNamesShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
            dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
            weekHeader: "Sem.",
            dateFormat: "yy-mm-dd",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""};
        datepicker.setDefaults(datepicker.regional.fr);

        return datepicker.regional.fr;

    }));
    $("#datepicker").datepicker({changeMonth: true, changeYear: true}, $.datepicker.regional['fr']);
    $("#datepicker").datepicker("setDate", new Date());




</script>

