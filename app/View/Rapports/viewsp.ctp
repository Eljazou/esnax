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

    .row {
        width: 100%;
    }

    .box.box-primary {
        border: 2px solid #3c8dbc;
    }

    .form-group-view {
        margin-bottom: 15px;
    }

    .label-view {
        font-weight: bold;
    }

    .data-view {
        padding: 8px 12px;
        background-color: #f9f9f9;
        border-radius: 4px;
        min-height: 34px;
    }

    .text-area-view {
        white-space: pre-wrap;
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 4px;
        min-height: 100px;
    }

    /* style files  */
    .uploaded-files-container {
        margin: 10px 0;
    }

    .file-list-modern {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .file-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        padding: 10px 15px;
        border-radius: 6px;
        background-color: #f7f9fc;
        transition: all 0.2s ease;
        border: 1px solid #e6ebf5;
    }

    .file-item:hover {
        background-color: #eef2f9;
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .file-icon {
        flex: 0 0 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e3eaf7;
        border-radius: 5px;
        margin-right: 12px;
    }

    .file-icon i {
        font-size: 18px;
        color: #4375c2;
    }

    .fa-file-pdf {
        color: #e74c3c !important;
    }

    .fa-file-word {
        color: #285396 !important;
    }

    .fa-file-excel {
        color: #217346 !important;
    }

    .fa-file-image {
        color: #1abc9c !important;
    }

    .file-details {
        flex: 1;
    }

    .file-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #333;
        text-decoration: none;
        width: 100%;
    }

    .file-name {
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: calc(100% - 30px);
    }

    .file-action {
        opacity: 0.6;
        transition: opacity 0.2s;
    }

    .file-item:hover .file-action {
        opacity: 1;
    }

    .no-files {
        color: #999;
        font-style: italic;
        padding: 10px;
    }
</style>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Détail du rapport de <?php echo $rapport['User']['name'] . " de " . $rapport['Rapport']['date_debut'] . " à " . $rapport['Rapport']['date_fin'];  ?></h3>
                <div class="box-tools pull-right">
                    <?php echo $this->Html->link('<i class="fa-solid fa-pen-to-square"></i> Modifier', array('action' => 'edit', $rapport['Rapport']['id']), array('class' => 'btn btn-primary btn-sm', 'escape' => false)); ?>
                    <?php echo $this->Html->link('<i class="fa-solid fa-list"></i> Liste', array('action' => 'index'), array('class' => 'btn btn-default btn-sm', 'escape' => false)); ?>
                </div>
            </div>
            <div class="box-body">


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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-view">
                                        <label class="label-view">Moyenne de visite</label>
                                        <div class="data-view"><?php echo h($rapport['Rapport']['moyen_visite']); ?></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group-view">
                                        <label class="label-view">Taux de couverture</label>
                                        <div class="data-view"><?php echo h($rapport['Rapport']['taux_couverture']); ?></div>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-view">
                                        <label class="label-view">Nombre de visites solo</label>
                                        <div class="data-view"><?php echo h($rapport['Rapport']['visite_solo']); ?></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group-view">
                                        <label class="label-view">En double</label>
                                        <div class="data-view"><?php echo h($rapport['Rapport']['visite_double']); ?></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="col-md-12">
                            <div class="form-group-view">
                                <label class="label-view">Commentaire</label>
                                <div class="text-area-view"><?php echo nl2br(h($rapport['Rapport']['commentaire_activite'])); ?></div>
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
                            <div class="form-group-view">
                                <label class="label-view">Activité terrain</label>
                                <div class="text-area-view"><?php echo nl2br(h($rapport['Rapport']['activite_terrain'])); ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-view">
                                <label class="label-view">Feed back matériel et produits</label>
                                <div class="text-area-view"><?php echo nl2br(h($rapport['Rapport']['Feed_terrain'])); ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-view">
                                <label class="label-view">Activité de la concurrence</label>
                                <div class="text-area-view"><?php echo nl2br(h($rapport['Rapport']['concurrence_terrain'])); ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-view">
                                <label class="label-view">Commentaire</label>
                                <div class="text-area-view"><?php echo nl2br(h($rapport['Rapport']['commentaire_terrain'])); ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-view">
                                <label class="label-view">Pièces jointes</label>
                                <div class="text-area-view">
                                    <?php if (!empty($rapport['Rapport']['file_terrain'])): ?>
                                        <div class="uploaded-files-container">
                                            <ul class="file-list-modern">
                                                <?php
                                                // Tenter de décoder en JSON (pour les téléchargements multiples)
                                                $files = json_decode($rapport['Rapport']['file_terrain'], true);

                                                // Déterminer le type de fichier pour afficher l'icône appropriée
                                                function getFileIcon($fileName)
                                                {
                                                    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                    switch ($extension) {
                                                        case 'pdf':
                                                            return 'fa-file-pdf';
                                                        case 'doc':
                                                        case 'docx':
                                                            return 'fa-file-word';
                                                        case 'xls':
                                                        case 'xlsx':
                                                            return 'fa-file-excel';
                                                        case 'jpg':
                                                        case 'jpeg':
                                                        case 'png':
                                                            return 'fa-file-image';
                                                        default:
                                                            return 'fa-file';
                                                    }
                                                }

                                                // Si c'est un tableau (plusieurs fichiers)
                                                if (is_array($files)):
                                                    foreach ($files as $file):
                                                        $fileName = basename($file);
                                                        $fileIcon = getFileIcon($fileName);
                                                ?>
                                                        <li class="file-item">
                                                            <div class="file-icon">
                                                                <i class="fas <?php echo $fileIcon; ?>"></i>
                                                            </div>
                                                            <div class="file-details">
                                                                <a href="<?php echo $this->webroot . $file; ?>" target="_blank" class="file-link">
                                                                    <span class="file-name"><?php echo $fileName; ?></span>
                                                                    <span class="file-action"><i class="fas fa-download"></i></span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    <?php
                                                    endforeach;
                                                // Si ce n'est pas un tableau (un seul fichier - ancien format)
                                                elseif (!empty($rapport['Rapport']['file_terrain'])):
                                                    $fileName = basename($rapport['Rapport']['file_terrain']);
                                                    $fileIcon = getFileIcon($fileName);
                                                    ?>
                                                    <li class="file-item">
                                                        <div class="file-icon">
                                                            <i class="fas <?php echo $fileIcon; ?>"></i>
                                                        </div>
                                                        <div class="file-details">
                                                            <a href="<?php echo $this->webroot . $rapport['Rapport']['file_terrain']; ?>" target="_blank" class="file-link">
                                                                <span class="file-name"><?php echo $fileName; ?></span>
                                                                <span class="file-action"><i class="fas fa-download"></i></span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                <?php
                                                endif;
                                                ?>
                                            </ul>
                                        </div>
                                    <?php else: ?>
                                        <div class="no-files">
                                            <em>Aucune pièce jointe disponible</em>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('daterangepicker'); ?>