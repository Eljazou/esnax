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

    /* style file input  */

    .file-upload-container {
        margin-bottom: 20px;
        font-family: 'Arial', sans-serif;
    }

    .file-upload-container .file-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .custom-file-input {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        border: 2px dashed #2196F3;
        border-radius: 8px;
        background-color: #f0f8ff;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
    }

    .custom-file-input:hover {
        background-color: #e3f2fd;
        border-color: #1976D2;
    }

    .custom-file-input i {
        font-size: 32px;
        color: #2196F3;
        margin-bottom: 10px;
    }

    .custom-file-input span.placeholder {
        color: #757575;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .custom-file-input span.file-info {
        font-size: 13px;
        color: #9e9e9e;
    }

    .custom-file-input input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-name-display {
        margin-top: 10px;
        padding: 5px 10px;
        color: #4CAF50;
        font-size: 13px;
        font-weight: 500;
        display: none;
    }

    /* end style file input */
</style>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="box ">
            <div class="box-header with-border">
                <h3 class="box-title">Ajouter un rapport</h3>
            </div>
            <div class="box-body">
                <?php echo $this->Form->create('Rapport', array('type' => 'file')); ?>
                <div class="col-md-12" style="margin-bottom: 24px;">
                    <div class="">
                        <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: normal;width: auto;text-align:left;float:left;">Rapport concernant la date :</label>
                        <div class="col-md-4">
                            <div class="input-group col-lg-12">
                                <div class="input-group-addon">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <input type="text" name="data[Rapport][date]" class="form-control pull-right" name="date" id="reservationtime" placeholder="Date">
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <label class="box-title" style="margin-top: 7px;padding-left:10px;font-size: 16px;margin-bottom: 0px;font-weight: normal;width: auto;text-align:left;float:left;">Titre Rapport :</label>
                        <div class="col-md-4">
                            <div class="input-group col-lg-12">
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
                                        <input name="data[Rapport][moyen_visite]" type="text" class="form-control" id="moyen-visite" required="required">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Taux de couverture</label>
                                        <input name="data[Rapport][taux_couverture]" type="text" class="form-control" id="taux">
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
                                        <input name="data[Rapport][visite_solo]" type="number" class="form-control" id="moyen-visite">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>En double</label>
                                        <input name="data[Rapport][visite_double]" type="number" class="form-control" id="taux">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Commentaire</label>
                                <textarea name="data[Rapport][commentaire_activite]" id="" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Analyse/suivi des ventes </h3>
                    </div>
                    <div class="box-body">

                        <div class="cart">
                            <div class="cart-header">
                                <h2 class="title-cart">
                                    Taux de réalisation global VS objectif
                                </h2>
                            </div>
                            <div class="myrow">
                                <div class="all_taux_objectif">
                                    <div class="col-md-12 my-group">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="data[taux_realis_objectif][0][produit_id]" class="form-control">
                                                    <option value="">Sélectionnez un produit</option>
                                                    <?php foreach ($produits as $key => $value) : ?>
                                                        <option value="<?= $key ?>"><?= $value ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="data[taux_realis_objectif][0][input1]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="data[taux_realis_objectif][0][input2]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success add-product">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Commentaire</label>
                                <textarea name="data[Rapport][commentaire_produit]" id="" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
				 -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Feed back terrain</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Activité terrain</label>
                                <textarea name="data[Rapport][activite_terrain]" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Feed back matériel et produits</label>
                                <textarea name="data[Rapport][Feed_terrain]" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Activité de la concurrence</label>
                                <textarea name="data[Rapport][concurrence_terrain]" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Commentaire</label>
                                <textarea name="data[Rapport][commentaire_terrain]" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="file-upload-container">
                                <label class="file-label">Pièces jointes (Rapports de terrain)</label>

                                <div id="drop-zone" style="border: 1.5px dashed #aaa; border-radius: 8px; padding: 32px 20px; text-align:center; cursor:pointer; background: #f9f9f9; position:relative;">
                                    <i class="fas fa-cloud-upload-alt" style="font-size:32px; color:#2196F3; display:block; margin-bottom:10px;"></i>
                                    <p style="margin:0 0 4px; font-size:14px; font-weight:600;">Cliquez ou glissez vos fichiers ici</p>
                                    <p style="margin:0; font-size:12px; color:#888;">PDF, DOC, XLS — max 5 MB par fichier</p>
                                    <input type="file" id="file-terrain" name="data[Rapport][file_terrain][]" multiple
                                        accept=".pdf,.doc,.docx,.xls,.xlsx"
                                        style="position:absolute; top:0; left:0; width:100%; height:100%; opacity:0; cursor:pointer;">
                                </div>

                                <div id="file-list" style="margin-top:10px; display:flex; flex-direction:column; gap:6px;"></div>

                                <button type="button" onclick="document.getElementById('file-terrain').click()"
                                    class="btn btn-default btn-sm" style="margin-top:10px;">
                                    + Ajouter d'autres fichiers
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Suivi des actions et demandes </h3>
                    </div>
                    <div class="box-body">
                        <div class="cart">
                            <div class="cart-header">
                                <h2 class="title-cart">
                                    POA d’amélioration
                                </h2>
                            </div>
                            <div class="myrow">
                                <div class="all_action">
                                    <div class="col-md-12 my-group-action">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Action <span>1</span> :</label>
                                                <textarea name="data[poa][0][action]" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success add-action">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Commentaire</label>
                                <textarea name="data[Rapport][commentaire_action]" id="" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				 -->


                <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'btn btn-success btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php
echo $this->Html->script('daterangepicker'); ?>


<script>
    (function() {
        const input = document.getElementById('file-terrain');
        const dropZone = document.getElementById('drop-zone');
        const fileList = document.getElementById('file-list');
        let allFiles = [];

        function updateInput() {
            const dt = new DataTransfer();
            allFiles.forEach(f => dt.items.add(f));
            input.files = dt.files;
        }

        function renderList() {
            fileList.innerHTML = '';
            allFiles.forEach(function(file, i) {
                const ext = file.name.split('.').pop().toUpperCase();
                const size = file.size < 1024 * 1024 ?
                    (file.size / 1024).toFixed(0) + ' KB' :
                    (file.size / (1024 * 1024)).toFixed(1) + ' MB';

                const row = document.createElement('div');
                row.style.cssText = 'display:flex;align-items:center;gap:10px;padding:8px 12px;background:#fff;border:1px solid #ddd;border-radius:6px;';
                row.innerHTML =
                    '<span style="font-size:11px;font-weight:600;padding:2px 6px;background:#eee;border-radius:3px;">' + ext + '</span>' +
                    '<span style="flex:1;font-size:13px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">' + file.name + '</span>' +
                    '<span style="font-size:12px;color:#888;">' + size + '</span>' +
                    '<button type="button" data-i="' + i + '" style="background:none;border:none;cursor:pointer;font-size:18px;line-height:1;color:#999;">&times;</button>';

                row.querySelector('button').addEventListener('click', function() {
                    allFiles.splice(parseInt(this.dataset.i), 1);
                    updateInput();
                    renderList();
                });
                fileList.appendChild(row);
            });
        }

        function addFiles(files) {
            Array.from(files).forEach(function(f) {
                if (!allFiles.find(function(x) {
                        return x.name === f.name && x.size === f.size;
                    }))
                    allFiles.push(f);
            });
            updateInput();
            renderList();
        }

        input.addEventListener('change', function() {
            addFiles(this.files);
        });
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
        });
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            addFiles(e.dataTransfer.files);
        });
    })();
</script>

<script>
    $(document).ready(function() {


        var now = new Date();

        var day = now.getDay(); // 0 = Sunday, 1 = Monday, 5 = Friday, 6 = Saturday

        var isAllowed = false;

        // Friday (5), Saturday (6), Sunday (0)
        if (day === 1 || day === 5 || day === 6 || day === 0) {
            isAllowed = true;
        }


        var role = <?php echo json_encode(AuthComponent::user('role')); ?>;
        console.log("User role:", role);
        console.log("Is allowed to add report?", isAllowed);
        if (!isAllowed && role != 'Admin') {

            // Hide entire page content
            $('.content-header').children().hide();

            // Show alert message
            $('.content-header').append(
                '<div class="callout callout-info">' +
                '<h4>Accès bloqué</h4>' +
                '<p>L\'ajout d\'un rapport hebdomadaire est autorisé du vendredi jusqu\'au lundi matin</p>' +
                '</div>'
            );
        }







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



        let index_product = 1; // Start index_product for new rows

        $(".add-product").click(function() {
            let newRow = $(".my-group").first().clone(); // Clone the first row

            // Update name attributes with the new index_product
            newRow.find("select, input").each(function() {
                let name = $(this).attr("name");
                if (name) {
                    name = name.replace(/\[\d+\]/, "[" + index_product + "]"); // Replace index_product dynamically
                    $(this).attr("name", name);
                }
                $(this).val(""); // Clear input values
            });

            $(".all_taux_objectif").append(newRow); // Append new row
            index_product++; // Increment index_product
        });


        let index_action = 1; // Start index_action for new actions

        $(".add-action").click(function() {
            let newRow = $(".my-group-action").first().clone(); // Clone the first row

            // Update the textarea name with the new index_action
            newRow.find("textarea").each(function() {
                let name = $(this).attr("name");
                if (name) {
                    name = name.replace(/\[\d+\]/, "[" + index_action + "]"); // Update index_action
                    $(this).attr("name", name);
                }
                $(this).val(""); // Clear textarea value
            });

            // Update the label number
            newRow.find("label span").text(index_action + 1);

            $(".all_action").append(newRow); // Append new row
            index_action++; // Increment index_action
        });



    });
</script>

<script>
    document.getElementById('file-terrain').addEventListener('change', function() {
        const fileNameDisplay = document.getElementById('file-terrain-name');
        fileNameDisplay.innerHTML = '';

        if (this.files.length > 0) {
            fileNameDisplay.style.display = 'block';

            for (let i = 0; i < this.files.length; i++) {
                const fileElement = document.createElement('div');
                fileElement.innerHTML = '<i class="fas fa-check-circle"></i> ' + this.files[i].name;
                fileNameDisplay.appendChild(fileElement);
            }
        } else {
            fileNameDisplay.style.display = 'none';
        }
    });
</script>