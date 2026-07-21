<?php echo $this->Html->css('select2.min'); ?>
<style>
    :root {
        --metronic-accent: #7C3AED;
        --metronic-accent-dark: #6D28D9;
        --metronic-accent-soft: #F5F3FF;
        --metronic-border: #E8E2FF;
        --metronic-text: #1F2937;
        --metronic-muted: #6B7280;
        --metronic-bg: #F6F7FB;
    }

    body {
        background: var(--metronic-bg);
    }

    .panel.panel-primary {
        background: transparent;
        border: none;
        box-shadow: none;
    }

    .panel.panel-primary .col-lg-6 {
        float: left !important;
        margin: 0 !important;
        padding: 0 8px 0 0 !important;
        background: transparent !important;
        box-shadow: none !important;
    }

    .lr-card {
        background: #ffffff;
        border: 1px solid rgba(124, 58, 237, 0.12);
        border-radius: 18px;
        box-shadow: 0 12px 40px rgba(124, 58, 237, 0.08);
        padding: 18px 20px;
        margin-bottom: 18px;
    }

    .lr-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 4px;
    }

    .lr-icon-circle {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 14px;
        background: var(--metronic-accent-soft);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lr-icon-circle svg {
        width: 20px;
        height: 20px;
        stroke: var(--metronic-accent);
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .lr-title {
        margin: 0;
        font-size: 1.35rem;
        line-height: 1.4;
        font-weight: 700;
        color: var(--metronic-text);
    }

    .lr-subtitle {
        margin: 2px 0 0;
        font-size: 0.92rem;
        color: var(--metronic-muted);
    }

    .payment-form {
        padding: 0;
    }

    .payment-form label {
        display: block;
        margin-bottom: 0.35rem;
        font-size: 0.875rem;
        font-weight: 700;
        color: #374151;
        letter-spacing: 0.01em;
    }

    .payment-form .input {
        margin-bottom: 1rem;
    }

    .payment-form .form-control,
    .payment-form textarea.form-control,
    .payment-form select.form-control,
    .payment-form input[type="text"].form-control,
    .payment-form .form-select,
    .payment-form .form-control-solid,
    .payment-form .form-select-solid {
        min-height: 46px;
        height: 46px;
        padding: 0.75rem 0.95rem;
        border-radius: 12px !important;
        border: 1px solid var(--metronic-border) !important;
        background: #F8F7FF !important;
        color: var(--metronic-text);
        font-size: 0.92rem;
        box-shadow: none !important;
        transition: all 0.2s ease;
    }

    .payment-form .form-control:focus,
    .payment-form .form-select:focus,
    .payment-form .form-control-solid:focus,
    .payment-form .form-select-solid:focus {
        border-color: var(--metronic-accent) !important;
        background: #fff !important;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.12) !important;
    }

    .payment-form textarea.form-control {
        min-height: 92px;
        height: auto;
        resize: vertical;
    }

    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        min-height: 46px !important;
        border: 1px solid var(--metronic-border) !important;
        border-radius: 12px !important;
        background: #F8F7FF !important;
        box-shadow: none !important;
        padding: 3px 6px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
        font-size: 0.92rem;
        color: var(--metronic-text);
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: var(--metronic-accent) !important;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.12) !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: var(--metronic-accent) !important;
        border: none !important;
        border-radius: 8px !important;
        color: #fff !important;
        padding: 4px 10px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
        opacity: 0.9;
    }

    .payment-form .well {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }

    .payment-form input[type="submit"] {
        background: linear-gradient(135deg, var(--metronic-accent), var(--metronic-accent-dark)) !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 0.9rem 1.8rem !important;
        font-weight: 700 !important;
        font-size: 0.95rem !important;
        color: #fff !important;
        box-shadow: 0 10px 24px rgba(124, 58, 237, 0.24) !important;
        transition: transform 0.16s ease, box-shadow 0.16s ease, opacity 0.16s ease;
    }

    .payment-form input[type="submit"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(124, 58, 237, 0.28) !important;
        opacity: 0.96;
    }

    @media (max-width: 991px) {
        .panel.panel-primary .col-lg-6 {
            padding-right: 0 !important;
        }
    }
</style>
<div class="row">
    <div class="col-md-11 mx-auto">
        <div class="panel panel-primary">
            <div class="lr-card mb-5">
                <div class="lr-card-header">
                    <div class="lr-icon-circle">
                        <svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c1-3.8 4-6 6.5-6s5.5 2.2 6.5 6"/><path d="M17 4v6M14 7h6"/></svg>
                    </div>
                    <div>
                        <h3 class="lr-title"><?php echo __('Proposer un client'); ?></h3>
                        <p class="lr-subtitle">Renseignez les informations du nouveau client.</p>
                    </div>
                </div>
            </div>

            <?php $k='';if($type==null || $type=='Médecin'): ?>
            <div class="lr-card">
                <div class="panel-body form-horizontal payment-form p-0">
                    <?php echo $this->Form->create('Clientspropose'); ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="input select"><label for="ClientsproposeTypeId">Type</label>
                            <select onchange="location = this.value;" class="form-select form-select-solid" id="ClientsproposeTypeId">

                                <?php foreach ($types as $key => $value)
                                {
                                    $selected='';
                                    if($type==$value)
                                    {
                                        $selected="selected";
                                        $k= $this->Form->input('type_id', array('type' => 'hidden', 'value' => $key));
                                    }
                                    echo "<option $selected value='".$this->Html->url(array('action'=>'add',$value))."'>$value</option>";
                                } ?>
                            </select>
						</div>
                        <?php
                        echo $k;
                        echo $this->Form->input('region_id', array('id'=>"regions",'label' => 'Région', 'class' => 'form-control form-control-solid select2', 'required'=>"required" ));?>
                        <div class="input select" id="ville"></div>
                        <div id="secteur" class="input select" id="secteur"></div>
                        <?php echo $this->Form->input('category_id', array('label' => 'Spécialité', 'class' => 'form-control form-control-solid'));?>
                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Tendance</label>
                            <select name="data[Clientspropose][category1_id]" class="form-select form-select-solid" id="ClientsproposeCategoryId">
                                <option value="">Choisissez</option>
                                <?php
                                foreach ($categories as $key => $value) {
                                    echo "<option value='$key'>$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Titre</label>
                            <select name="data[Clientspropose][titre]" class="form-select form-select-solid" id="ClientsproposeCategoryId">
                                <option value="Docteur">Docteur</option>
                                <option value="Professeur">Professeur</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Activité</label>
                            <select name="data[Clientspropose][activite]" class="form-select form-select-solid" id="ClientsproposeCategoryId">
                                <option value="Prive">Privé</option>
                                <option value="Publique">Publique</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Exercice</label>
                            <select name="data[Clientspropose][exercice]" class="form-select form-select-solid" id="ClientsproposeCategoryId">
                                <option value="Centre de sante"> Centre de santé</option>
                                <option value="Cabinet prive">Cabinet privé</option>
                                <option value="Hopital">Hôpital</option>
                                <option value="Penitencier">Pénitencier</option>
                                <option value="Clinique">Clinique</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="ClientsproposeCategoryId">Patients par Jour</label>
                            <select name="data[Clientspropose][A]" class="form-select form-select-solid" id="ClientsproposeCategoryId">
                                <option value="A">Plus de 20</option>
                                <option value="B">Entre 10 et 20</option>
                                <option value="C">Moins de 10</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Adoption des produits Esnapharm</label>
                            <select name="data[Clientspropose][1]" class="form-select form-select-solid" id="ClientsproposeCategoryId">
                                <option value="1">Exclusif</option>
                                <option value="2">Fidèle</option>
                                <option value="3">Rare</option>
                                <option value="4">Non</option>
                            </select>
                        </div>
                        <div class="input select">
                            <label for="ClientsproposeCategoryId">Classification</label>
                            <select name="data[Clientspropose][potentialitev2]" class="form-select form-select-solid" id="ClientsproposeCategoryId">
                                <option value="PCM">PCM</option>
                                <option value="QAM">QAM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control form-control-solid'));
                        ?>
                        <div class="input select mt-3">
                            <?php
                            echo $this->Form->input('produits', array('name' => "data[Clientspropose][produits]", 'label' => 'La liste des produits', 'class' => 'form-control form-control-solid select2 produits', 'multiple' => "multiple"));
                            ?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(array('label' => 'Enregistrer la proposition du client', 'class' => 'btn btn-primary btn-lg px-10', 'div' => array('class' => 'd-flex justify-content-end col-md-12 mt-4 mb-0 p-0'))); ?>
                </div>
            </div>
            <?php endif;
            if( $type=='Pharmacie'): ?>
            <div class="lr-card">
                <div class="panel-body form-horizontal payment-form p-0">
                    <?php echo $this->Form->create('Clientspropose'); ?>
                        <div class="input select"><label for="ClientsproposeTypeId">Type</label>
                            <select onchange="location = this.value;" class="form-select form-select-solid" id="ClientsproposeTypeId">

                                <?php foreach ($types as $key => $value)
                                {
                                    $selected='';
                                    if($type==$value)
                                    {
                                        $selected="selected";
                                        $k= $this->Form->input('type_id', array('type' => 'hidden', 'value' => $key));
                                    }
                                    echo "<option $selected value='".$this->Html->url(array('action'=>'add',$value))."'>$value</option>";
                                } ?>
                            </select></div>
                        <?php
                        echo $k;
                        echo $this->Form->input('region_id', array('id'=>"regions",'label' => 'Region', 'class' => 'form-control select2', 'required'=>"required"));?>
                        <div class="input select" id="ville"></div>
                        <div id="secteur" class="input select" id="secteur"></div>
                        <?php
                        echo $this->Form->input('dirigent', array('label' => 'Dirigent', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->end(array('label' => 'Enregistrer la proposition du client', 'class' => 'btn btn-primary btn-lg px-10', 'div' => array('class' => 'd-flex justify-content-end col-md-12 mt-4 mb-0 p-0'))); ?>
                </div>
            </div>
            <?php endif;
            if( $type=='Grossiste'): ?>
            <div class="lr-card">
                <div class="panel-body form-horizontal payment-form p-0">
                    <?php echo $this->Form->create('Clientspropose'); ?>
                        <div class="input select"><label for="ClientsproposeTypeId">Type</label>
                            <select onchange="location = this.value;" class="form-select form-select-solid" id="ClientsproposeTypeId">

                               <?php foreach ($types as $key => $value)
                                {
                                    $selected='';
                                    if($type==$value)
                                    {
                                        $selected="selected";
                                        $k= $this->Form->hidden('type_id', array( 'value' => $key));
                                    }
                                    echo "<option $selected value='".$this->Html->url(array('action'=>'add',$value))."'>$value</option>";
                                } ?>
                            </select></div>
                        <?php
                        echo $k;
                        echo $this->Form->input('region_id', array('id'=>"regions",'label' => 'Region', 'class' => 'form-control form-control-solid select2', 'required'=>"required"));?>
                        <div class="input select" id="ville"></div>
                        <div id="secteur" class="input select" id="secteur"></div>
                        <?php
                        echo $this->Form->input('nom', array('label' => 'Nom', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('prenom', array('label' => 'Prénom', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('mail', array('label' => 'Mail', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('tel', array('label' => 'Téléphone', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('fixe', array('label' => 'Fixe', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('fax', array('label' => 'Fax', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->input('adress', array('label' => 'Adresse', 'class' => 'form-control form-control-solid'));
                        echo $this->Form->end(array('label' => 'Enregistrer la proposition du client', 'class' => 'btn btn-primary btn-lg px-10', 'div' => array('class' => 'd-flex justify-content-end col-md-12 mt-4 mb-0 p-0'))); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<?php
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('app.min');
	echo $this->Html->script('jquery.slimscroll.min');
	echo $this->Html->script('fastclick');
	echo $this->Html->script('demo');
	echo $this->Html->script('select2.full.min');
?>
<script>
$(function () {
        $(".produits").select2();
	});
	$(window).load(function(){
		$("#regions").prepend('<option value="" selected>Région</option>')
	});
    $(document).ready(function () {
        $("#regions").change(function () {
            var id = $("#regions").val();
            var image = "<center><img src='/img/loading.gif' style='width: 30px;' ></center>";
            $("#ville").empty();
            $(image).appendTo("#ville");
            $("#ville").show();
            $.post(
                    '/clientsproposes/system_get_ville/' + id,
                    {
                            //id: $("#ChembreBlocId").val()
                    },
                    function (data)
                    {
                            $("#ville").empty();
                            $(data).appendTo("#ville");
                            $("#ville").show();
                    },
                    'text' // type
            );
        });
    });
</script>