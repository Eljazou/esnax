<?php  ?>

<style type="text/css">
    /* ===== Design system (nv) — purple theme, matching the CRM VMP redesign ===== */
    .nv{ font-family:'Poppins',sans-serif; }

    .nv-card{
        background:#fff; border:none; border-radius:18px;
        box-shadow:0 4px 24px rgba(108,99,245,.08);
        max-width:640px; margin:32px auto; padding:0; overflow:hidden;
    }
    .nv-card-header{
        display:flex; align-items:center; gap:12px; padding:24px 30px 18px; position:relative;
    }
    .nv-card-header:before{
        content:''; width:7px; height:22px; min-width:7px; border-radius:4px;
        background:linear-gradient(180deg,#6C63F5,#8c7ef2);
    }
    .nv-card-header h3{ font-size:18px; font-weight:700; color:#2d2b45; margin:0; }
    .nv-card-body{ padding:8px 30px 30px; }

    .nv-field-label{ display:flex; align-items:center; gap:8px; font-size:13px; font-weight:700;
        letter-spacing:.3px; text-transform:uppercase; color:#6a6785; margin:20px 0 8px; }
    .nv-field-label svg{ width:15px; height:15px; stroke:#6C63F5; }
    .nv-field-label:first-child{ margin-top:0; }

    .nv .form-control,
    .nv .select2-container .select2-selection{
        border-radius:12px !important; border:1.5px solid #e7e5f7 !important;
        box-shadow:none !important; min-height:44px; font-size:14px; color:#2d2b45;
    }
    .nv .form-control:focus{
        border-color:#6C63F5 !important; box-shadow:0 0 0 3px rgba(108,99,245,.12) !important;
    }

    /* select2 restyle: pills / tags instead of native multi-select scroll box */
    .nv .select2-container{ width:100% !important; }
    .nv .select2-container--default .select2-selection--multiple{
        border-radius:12px !important; border:1.5px solid #e7e5f7 !important;
        min-height:44px; padding:4px 6px;
    }
    .nv .select2-container--default.select2-container--focus .select2-selection--multiple{
        border-color:#6C63F5 !important; box-shadow:0 0 0 3px rgba(108,99,245,.12);
    }
    .nv .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background:#efeeff; border:none; border-radius:999px; color:#4a3fd8;
        font-size:12.5px; font-weight:600; padding:4px 10px 4px 8px; margin-top:5px;
    }
    .nv .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        color:#8c7ef2; margin-right:6px; border:none;
    }
    .nv .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover{
        color:#4a3fd8; background:transparent;
    }
    .nv .select2-container--default .select2-search--inline .select2-search__field{
        font-family:'Poppins',sans-serif; font-size:13.5px;
    }
    .nv .select2-dropdown{
        border-radius:12px !important; border:1.5px solid #e7e5f7 !important;
        box-shadow:0 10px 30px rgba(108,99,245,.15); overflow:hidden;
    }
    .nv .select2-results__option--highlighted[aria-selected]{
        background:#6C63F5 !important; color:#fff !important;
    }
    .nv .select2-search--dropdown .select2-search__field{
        border-radius:8px !important; border:1.5px solid #e7e5f7 !important; padding:6px 10px;
    }

    /* choix d'ajustement block */
    .nv .info{ color:#8c7ef2; font-size:12px; font-weight:500; margin-left:6px; }
    .nv .check_input{ display:flex; align-items:center; gap:10px; margin-bottom:10px; }
    .nv .ajusment_input{ margin-bottom:0 !important; }
    .nv .check{
        margin:0; display:none; align-items:center;
    }
    .nv .check .form-check-input,
    .nv .input_check{
        width:20px; height:20px; border-radius:6px; border:1.5px solid #d8d5f5;
        cursor:pointer; accent-color:#6C63F5;
    }

    .nv .btns_inputs_choix{ display:flex; align-items:center; gap:10px; margin:14px 0 4px; }
    .nv .btn-min, .nv .btn-remove{
        font-size:20px; font-weight:700; padding:0; height:36px; width:36px; min-width:36px;
        border:none; border-radius:10px; color:#fff; cursor:pointer;
        display:flex; align-items:center; justify-content:center; transition:.2s;
        background:linear-gradient(135deg,#6C63F5,#8c7ef2); box-shadow:0 6px 16px rgba(108,99,245,.25);
    }
    .nv .btn-min:hover, .nv .btn-remove:hover{
        transform:translateY(-1px); box-shadow:0 8px 20px rgba(108,99,245,.35);
    }
    .nv .btn-min:focus, .nv .btn-remove:focus{ outline:none; }
    .nv .btn-remove{ display:none; background:linear-gradient(135deg,#e0453f,#f2726d); box-shadow:0 6px 16px rgba(224,69,63,.25); }
    .nv .btn-remove:hover{ box-shadow:0 8px 20px rgba(224,69,63,.35); }
    .nv .btn-remove svg, .nv .btn-min svg{ width:16px; height:16px; }

    .nv-submit-wrap{ text-align:center; margin-top:26px; }
    .nv .btn-primary{
        background:linear-gradient(90deg,#6C63F5,#8c7ef2) !important; border:none !important;
        border-radius:999px !important; padding:11px 34px !important; font-weight:600 !important;
        font-size:14.5px !important; color:#fff !important;
        box-shadow:0 6px 18px rgba(108,99,245,.3) !important;
    }
    .nv .btn-primary:hover{ opacity:.94; }
</style>

<div class="nv">
    <div class="nv-card">
        <div class="nv-card-header">
            <h3><?php echo __('Ajouter une validation'); ?></h3>
        </div>
        <div class="nv-card-body">
            <?php
            echo $this->Form->create('Notevalidation', array('onsubmit' => 'return assemble_choix();'));
            ?>
            <div class="nv-field-label">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Utilisateurs
            </div>
            <?php echo $this->Form->input('users', array("label" => false, "multiple" => "multiple", 'class' => 'form-control select2')); ?>

            <div class="nv-field-label">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                Choix d'ajustement
                <span class="info">(Appuyez sur Entrée pour ajouter un nouveau choix.)</span>
            </div>
            <input type="hidden" name="data[Notevalidation][choix]" id="note_choix">

            <div class="inputs_choix">
                <div class="check_input check_input0">
                    <div class="checkbox check">
                        <input type="checkbox" class="input_check" titre="0">
                    </div>
                    <input type="text" class="ajusment_input form-control ajusment_input0">
                </div>
            </div>
            <div class="btns_inputs_choix">
                <button type="button" class="btn-min" onclick="show_check()">−</button>
                <button type="button" class="btn-remove" onclick="remove()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </button>
            </div>

            <div class="nv-field-label">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                Niveau
            </div>
            <?php echo $this->Form->input('niveau', array('label' => false, 'class' => 'form-control')); ?>

            <div class="nv-field-label">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>
                Mail de validation
            </div>
            <?php echo $this->Form->input('messagevalidation', array("value" => "Responsable (R) a valider la note de frais a (VM) du mois (M)", 'label' => false, 'class' => 'form-control')); ?>

            <div class="nv-field-label">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>
                Mail de refus
            </div>
            <?php echo $this->Form->input('messageannulation', array("value" => "Responsable (R) a refusé la note de frais a (VM) du mois (M)", 'label' => false, 'class' => 'form-control')); ?>

            <div class="nv-submit-wrap">
                <button class="btn btn-primary btn-large">Envoyer</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<?php
// NOTE ON SCRIPTS REMOVED FROM THIS VIEW (do not re-add):
// - jquery-2.2.3.min, the CDN jquery-1.12.4 + jquery-ui, and the AdminLTE
//   bundle (bootstrap.min/app.min/jquery.slimscroll.min/fastclick/demo) were
//   all reloading jQuery on top of Metronic's own bundle. Each reload
//   silently overwrote window.$, so select2() ended up initialized on (or
//   attached to) a jQuery instance that wasn't the one Metronic/the page
//   actually used — the <select multiple> never got transformed into the
//   select2 widget and fell back to the native browser multi-select box
//   with its own scrollbar (the bug from the screenshot).
// - Only select2.full.min is loaded here; it runs on Metronic's jQuery.
echo $this->Html->script('select2.full.min');
?>
<script>
    $(function () {
        $(".select2").select2({
            width: '100%',
            placeholder: 'Choisissez...',
            allowClear: true
        });
    });

    $(document).ready(function () {
        $(document).on('keypress', '.ajusment_input', function (e) {
            var inputs = $(".ajusment_input");
            if (e.which === 13) {
                var clonedElement = $('.check_input:last').clone();

                clonedElement.removeClass('check_input' + (inputs.length - 1)).addClass('check_input' + inputs.length);
                clonedElement.find('.checkbox').find('input').attr('titre', inputs.length);

                $('.inputs_choix').append(clonedElement);
                clonedElement.find('.ajusment_input').focus();
                $('.ajusment_input:last').val('');

                $(".check").fadeOut();
                $(".btn-min").css('display', 'flex');
                $(".btn-remove").hide();
                e.preventDefault();
            }
        });
    });

    function assemble_choix() {
        var inputs = $(".ajusment_input");
        var arry_val = [];

        for (var i = 0; i < inputs.length; i++) {
            arry_val.push($(inputs[i]).val());
        }

        var convert_array_val = arry_val.join(';');
        $('#note_choix').val(convert_array_val);

        return true;
    }

    function show_check() {
        $(".check").fadeIn();
        $(".btn-min").hide();
        $(".btn-remove").css('display', 'flex');
    }

    function remove() {
        var count_inputs = $(".ajusment_input").length;

        if (count_inputs == 1) {
            $(".ajusment_input0").val('');
            $(".input_check").prop('checked', false);
            $(".check").fadeOut();
            $(".btn-min").css('display', 'flex');
            $(".btn-remove").hide();
        } else {
            for (var i = count_inputs - 1; i >= 0; i--) {
                if ($('.input_check').eq(i).is(':checked')) {
                    var titre = $('.input_check').eq(i).attr('titre');
                    $(".check_input" + titre).remove();
                }
            }
            for (var i = 0; i <= count_inputs; i++) {
                $('.check_input').eq(i).attr('class', 'check_input check_input' + i);
                $('.check_input').eq(i).find('.checkbox').find('input').attr('titre', i);
            }
        }
    }
</script>
