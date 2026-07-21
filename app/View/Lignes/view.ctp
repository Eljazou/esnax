
<style type="text/css">
:root{
    --lb-purple: #6C63F5;
    --lb-purple-dark: #5750d9;
    --lb-purple-soft: #EEECFE;
    --lb-text: #2c2e3a;
    --lb-muted: #8a8fa3;
    --lb-border: #ececf5;
    --lb-blue: #3B82F6;
    --lb-amber: #F59E0B;
    --lb-red: #E24C6D;
}

.lb-wrapper{ font-family: inherit; color: var(--lb-text); }

/* ===== Main card ===== */
.lb-card{
    background: #fff;
    border: 1px solid var(--lb-border);
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(108,99,245,.08);
    overflow: hidden;
    margin-bottom: 22px;
}
.lb-card-header{
    background: linear-gradient(135deg, #7b6ff2 0%, #9b8ef5 100%);
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.lb-card-header h2{
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
}
.lb-card-body{ padding: 22px 24px; }

/* ===== Buttons (shared vocabulary across the app) ===== */
.btn-purple-solid{ background: var(--lb-purple); border-color: var(--lb-purple); color:#fff !important; border-radius:8px; font-weight:600; }
.btn-purple-solid:hover{ background: var(--lb-purple-dark); border-color: var(--lb-purple-dark); color:#fff !important; }
.btn-blue-solid{ background: var(--lb-blue); border-color: var(--lb-blue); color:#fff !important; border-radius:8px; font-weight:600; }
.btn-blue-solid:hover{ background:#2563EB; border-color:#2563EB; color:#fff !important; }
.btn-amber-solid{ background: var(--lb-amber); border-color: var(--lb-amber); color:#fff !important; border-radius:8px; font-weight:600; }
.btn-amber-solid:hover{ background:#D97706; border-color:#D97706; color:#fff !important; }
.btn-red-solid{ background: var(--lb-red); border-color: var(--lb-red); color:#fff !important; border-radius:8px; font-weight:600; }
.btn-red-solid:hover{ background:#c53658; border-color:#c53658; color:#fff !important; }

/* ===== Event message panel ===== */
.lb-event-panel{
    background: var(--lb-purple-soft);
    border-left: 4px solid var(--lb-purple);
    border-radius: 10px;
    padding: 16px 18px;
    font-size: 14.5px;
    color: var(--lb-text);
    margin-bottom: 14px;
}
.lb-event-panel i{ color: var(--lb-muted); }

/* ===== Section heading with action ===== */
.lb-section-head{
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
}
.lb-section-head h3{
    font-size: 16px;
    font-weight: 700;
    color: var(--lb-text);
    margin: 0;
}

/* ===== Tables ===== */
.lb-wrapper table.table{
    border-collapse: collapse;
    width: 100%;
    table-layout: fixed;
}
.lb-wrapper table.table thead th{
    background: #f7f6fd;
    color: #6b5ecb;
    font-weight: 700;
    font-size: 12.5px;
    text-transform: uppercase;
    letter-spacing: .03em;
    border: 1px solid var(--lb-border) !important;
    padding: 12px 14px;
}
.lb-wrapper table.table tbody td{
    border: 1px solid var(--lb-border) !important;
    padding: 12px 14px;
    font-size: 14px;
    vertical-align: top;
    text-align: left;
    word-wrap: break-word;
}
.lb-wrapper table.table-striped tbody tr:nth-of-type(odd){ background-color: #fbfaff; }
.lb-wrapper .actions{ display:flex; justify-content:flex-start; align-items:flex-start; gap:8px; }

.dt-buttons{ margin-top: 14px; }
.buttons-excel{
    background: #259d0f;
    color: #fff !important;
    padding: 8px 18px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    border: none;
}
.buttons-excel:hover{ background:#1e7d0c; color:#fff !important; }

/* ===== Modals ===== */
.modal .modal-content{ border-radius: 16px; border: none; }
.modal .modal-header{ border-bottom: 1px solid var(--lb-border); }
.modal .modal-title{ font-weight: 700; color: var(--lb-text); }
.modal .form-control{ border-radius: 8px; border-color: var(--lb-border); }
</style>

<script src="https://cdn.tiny.cloud/1/e9sni3xo7h7q3awked8o0gnr1up09pb0uxudx3b50ecfp3aa/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

<script>
tinymce.init({
    selector: '#mytextarea',
    plugins: [
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'tinymceai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
    ],
    tinymceai_token_provider: async () => {
        await fetch(`https://demo.api.tiny.cloud/1/e9sni3xo7h7q3awked8o0gnr1up09pb0uxudx3b50ecfp3aa/auth/random`, { method: "POST", credentials: "include" });
        return { token: await fetch(`https://demo.api.tiny.cloud/1/e9sni3xo7h7q3awked8o0gnr1up09pb0uxudx3b50ecfp3aa/jwt/tinymceai`, { credentials: "include" }).then(r => r.text()) };
    },
    uploadcare_public_key: '6c3bb8524de522a0e4b7',
});
</script>

<div class="lb-wrapper">

    <div class="lb-card">
        <div class="lb-card-header">
            <h2><?php echo $ligne['Ligne']['name']; ?></h2>
            <?php
            if ($this->requestAction('/droits/getrole/lignes/edit') == 1)
                echo $this->Html->link('Editer', array('action' => 'edit'), array('class' => 'btn btn-purple-solid btn-sm'));
            ?>
        </div>

        <!-- Message d'événement (Mobile App) Section -->
        <div class="lb-card-body" style="border-bottom: 1px solid var(--lb-border);">
            <h4 style="margin-top:0;"><strong>Message d'événement (Mobile App) :</strong></h4>
            <div class="lb-event-panel">
                <?php echo !empty($ligne['Ligne']['message_event']) ? h($ligne['Ligne']['message_event']) : '<i>Aucun message d\'événement défini</i>'; ?>
            </div>
            <?php if ($this->requestAction('/droits/getrole/lignes/edit') == 1): ?>
                <button type="button" class="btn btn-amber-solid" data-bs-toggle="modal" data-bs-target="#editEventModal">
                    <i class="fa fa-edit"></i> Mettre à jour le message d'événement
                </button>
            <?php endif; ?>
        </div>

        <div class="lb-card-body table-responsive">
            <div class="lb-section-head">
                <h3>La liste des explications par spécialité</h3>
                <?php if ($this->requestAction('/droits/getrole/lignes/ajouter_explication') == 1): ?>
                    <button type="button" class="btn btn-purple-solid" data-bs-toggle="modal" data-bs-target="#explication">
                        Ajoutez une explication
                    </button>
                <?php endif; ?>
            </div>
            <?php if (!empty($ligne['Lignespecialiteinfo'])): ?>
                <table class="table table-bordered table-striped" id="explications-table">
                    <colgroup>
                        <col style="width:14%">
                        <col style="width:16%">
                        <col style="width:60%">
                        <col style="width:10%">
                    </colgroup>
                    <tr>
                        <th>Spécialité</th>
                        <th>Titre</th>
                        <th>Text</th>
                        <th class="actions">#</th>
                    </tr>
                    <?php
                    foreach ($ligne['Lignespecialiteinfo'] as $s):
                        ?>
                        <tr>
                            <td><?php echo $categories[$s['category_id']]; ?></td>
                            <td><?php echo $s['titre']; ?></td>
                            <td><?php echo $s['text']; ?></td>
                            <td class="actions">
                                <?php
                                if ($this->requestAction('/droits/getrole/lignes/supprimer_explication') == 1)
                                    echo $this->Form->postLink(__('Supprimer'), array('action' => 'supprimer_explication', $s['id']), array('class' => 'btn btn-red-solid'), null, 'Etes-vous sur de vouloir supprimer # %s?', $s['id']);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <div class="lb-card">
        <div class="lb-card-body table-responsive">
            <h3 style="margin-top:0; margin-bottom:16px; font-size:16px; font-weight:700;">La liste des collaborateurs de la ligne</h3>
            <?php if (!empty($ligne['User'])): ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo __('Nom & prénom'); ?></th>
                            <th><?php echo __('E-mail'); ?></th>
                            <th><?php echo __('Role'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    foreach ($ligne['User'] as $user):
                        ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td class="actions">
                                <?php
                                if ($this->requestAction('/droits/getrole/users/view') == 1)
                                    echo $this->Html->link(__('Voir'), array('controller' => 'users', 'action' => 'view', $user['id']), array('class' => 'btn btn-blue-solid'));
                                if ($this->requestAction('/droits/getrole/users/edit') == 1)
                                    echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id']), array('class' => 'btn btn-amber-solid'));
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</div>

<div class="modal fade" id="explication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajoutez une explication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create('Lignespecialiteinfo', array("url" => array("controller" => "lignes", "action" => "ajouter_explication")));
                echo $this->Form->hidden('ligne_id', array('value' => $ligne['Ligne']['id']));
                echo $this->Form->input('category_id', array('label' => 'Catégorie', 'class' => 'form-control'));
                echo $this->Form->input('titre', array('label' => 'Titre', 'class' => 'form-control'));
                ?>
                <label>Text</label>
                <textarea id="mytextarea" name="data[Lignespecialiteinfo][text]">
                </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <?php echo $this->Form->end(array('label' => 'Ajouter', 'class' => 'btn btn-purple-solid')); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour modifier le message d'événement -->
<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Mettre à jour le message d'événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Ligne', array("url" => array("controller" => "lignes", "action" => "system_update_message_event"))); ?>
                <?php echo $this->Form->hidden('id', array('value' => $ligne['Ligne']['id'])); ?>
                <?php echo $this->Form->input('message_event', array('label' => 'Message d\'événement', 'class' => 'form-control', 'type' => 'textarea', 'value' => isset($ligne['Ligne']['message_event']) ? $ligne['Ligne']['message_event'] : '', 'style' => 'height: 120px;')); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <?php echo $this->Form->end(array('label' => 'Mettre à jour', 'class' => 'btn btn-purple-solid')); ?>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->css('dataTables.bootstrap');

echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    // Snapshot our jQuery instance right after our plugins load, before Metronic's own
    // bundles (plugins.bundle.js / scripts.bundle.js) can silently reassign window.jQuery.
    window.CRMJQ = jQuery;

    CRMJQ(function () {
        // Move modals to body to prevent z-index/backdrop stacking issues in Metronic wrappers
        CRMJQ('#editEventModal').appendTo("body");
        CRMJQ('#explication').appendTo("body");

        CRMJQ('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": 20,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "bSort": false,
            "iDisplayLength": 250,
            "aaSorting": [],
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
    });
</script>
