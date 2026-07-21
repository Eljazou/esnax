<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

	/* Everything below is scoped under #programme-produit-page so it can never
	   leak into (or fight with) Metronic's own component CSS elsewhere on the page. */

	#programme-produit-page {
		font-family: 'Plus Jakarta Sans', sans-serif;
	}

	/* ---------- Page card container ---------- */
	#programme-produit-page .box {
		background: #ffffff;
		border-radius: 20px;
		border: none;
		box-shadow: 0 12px 40px rgba(140, 126, 242, 0.03);
		padding: 20px;
		margin: 15px auto;
	}

	#programme-produit-page .box-header.with-border {
		display: flex;
		align-items: center;
		justify-content: space-between;
		border-bottom: 1px solid #f1f1f8;
		padding-bottom: 14px;
		margin-bottom: 20px;
	}

	#programme-produit-page .box-header .box-title {
		font-size: 22px;
		font-weight: 700;
		background: linear-gradient(135deg, #1a1d36 0%, #8c7ef2 100%);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		margin: 0;
	}

	#programme-produit-page .box-header .btn.bg-purple {
		background: linear-gradient(135deg, #a397ff 0%, #8c7ef2 100%);
		border: none;
		border-radius: 8px;
		padding: 8px 20px;
		font-weight: 600;
		font-size: 13px;
		color: #ffffff;
		box-shadow: 0 4px 12px rgba(140, 126, 242, 0.2);
	}

	#programme-produit-page .box-body h4.box-title {
		font-size: 14px;
		font-weight: 700;
		color: #51526c;
		text-transform: uppercase;
		letter-spacing: 0.8px;
		margin: 20px 0 15px 0;
	}

	/* ---------- Card grid ----------
	   CSS Grid instead of the old col-md-4 float grid: this is what actually
	   fixes the broken/wrapping layout under Metronic, since it no longer
	   depends on Bootstrap's float/clearfix behavior at all. */
	#programme-produit-page .brochure-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
		gap: 20px;
	}

	/* ---------- Product cards ---------- */
	#programme-produit-page .info-box {
		background: #ffffff;
		border: 1px solid #f0f1fa;
		border-radius: 14px;
		box-shadow: 0 6px 20px rgba(163, 151, 255, 0.03);
		padding: 15px;
		margin: 0;
		display: flex;
		flex-direction: column;
		align-items: center;
		text-align: center;
		transition: all 0.2s ease-in-out;
	}

	#programme-produit-page .info-box:hover {
		transform: translateY(-3px);
		box-shadow: 0 12px 28px rgba(140, 126, 242, 0.07);
		border-color: #e1e3fd;
	}

	#programme-produit-page .info-box > img:first-of-type {
		height: 75px;
		width: 100%;
		max-width: 120px;
		object-fit: contain;
		background: #ffffff;
		border: 1px solid #eef0fc;
		border-radius: 8px;
		padding: 8px;
		margin-bottom: 12px;
	}

	/* Side-by-side file preview thumbnails */
	#programme-produit-page .info-box .thumb-row {
		display: flex;
		justify-content: center;
		gap: 4px;
		margin-bottom: 10px;
	}

	#programme-produit-page .info-box .thumb-row img {
		border-radius: 4px;
		border: 1px solid #e2e8f0;
		object-fit: cover;
		height: 18px;
		width: auto;
	}

	#programme-produit-page .info-box-content {
		width: 100%;
	}

	#programme-produit-page .info-box-text {
		display: block;
		font-size: 13px;
		font-weight: 700;
		color: #1a1d36;
		text-transform: uppercase;
		margin-bottom: 2px;
	}

	#programme-produit-page .info-box-text.subtext {
		font-size: 11px;
		font-weight: 500;
		color: #92929d;
		text-transform: none;
		margin-bottom: 12px;
	}

	/* Action buttons row */
	#programme-produit-page .info-box-actions {
		display: flex;
		gap: 6px;
		justify-content: center;
		margin-top: 5px;
	}

	#programme-produit-page .info-box-actions .btn-primary.btn-sm {
		background: #f5f6ff;
		color: #8c7ef2;
		border: 1px solid #e1e3fd;
		border-radius: 6px;
		font-size: 10px;
		font-weight: 600;
		text-transform: uppercase;
		padding: 5px 10px;
		transition: all 0.15s ease;
	}

	#programme-produit-page .info-box-actions .btn-primary.btn-sm:hover {
		background: linear-gradient(135deg, #a397ff 0%, #8c7ef2 100%);
		color: #ffffff;
		border-color: transparent;
	}
</style>
<?php echo $this->Html->css('dataTables.bootstrap'); ?>
<?php //if (1 == 1) {//AuthComponent::user('role') != 'VMP' || AuthComponent::user('id') ==216) { 
?>
<div id="programme-produit-page">
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title"><?php echo __('Programme produit'); ?></h2>
            <?php
            if ($this->requestAction('/droits/getrole/Brochures/add') == 1)
                echo $this->Html->link(__('Ajouter'), array('action' => 'add'), array('class' => "btn bg-purple btn-flat"));
            ?>
        </div>
        <div class="box-body">
            <?php foreach ($categories as $kcat => $c):
                foreach ($lignes as $kligne => $ligne):
                    if (AuthComponent::user('ligne_id') != $kligne && AuthComponent::user('role') != 'Admin')
                        continue;
                    $brochures = $this->requestAction("/brochures/system_getbrochures/$kligne/$kcat");
                    if (empty($brochures))
                        continue; ?>
                    <h4 class="box-title"><?php echo $c . " - " . $ligne; ?></h4>
                    <div class="brochure-grid">
                        <?php foreach ($brochures as $b): ?>
                            <div class="info-box">
                                <?php echo $this->Html->image("brochures/" . $b['Brochure']['logo'], array("style" => 'width: 120px;')); ?>

                                <div class="thumb-row">
                                    <?php echo $this->Html->image("brochures/" . $b['Brochure']['file'], array("style" => 'width: 20px;')); ?>
                                    <?php echo $this->Html->image("brochures/" . $b['Brochure']['file2'], array("style" => 'width: 20px;')); ?>
                                </div>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo h($b['Brochure']['name']); ?></span>
                                    <span class="info-box-text subtext">Gamme :
                                        <?php if (isset($gammes[$b["Brochure"]["game_id"]])) echo $gammes[$b["Brochure"]["game_id"]]; ?></span>
                                    <span class="info-box-actions">
                                        <?php
                                        if ($this->requestAction('/droits/getrole/Brochures/view') == 1)
                                            echo '<a href="' . $this->Html->URL(array('action' => 'view', $b['Brochure']['id'])) . '" class="btn btn-primary btn-sm" title="Voir">Voir</a>';
                                        if ($this->requestAction('/droits/getrole/Brochures/edit') == 1)
                                            echo '<a href="' . $this->Html->URL(array('action' => 'edit', $b['Brochure']['id'])) . '" class="btn btn-primary btn-sm" title="Modifier">Modifier</a>';
                                        if ($this->requestAction('/droits/getrole/Brochures/archive') == 1)
                                            echo '<a href="' . $this->Html->URL(array('action' => 'archive', $b['Brochure']['id'], 0)) . '" class="btn btn-primary btn-sm" title="Archiver">Archiver</a>';
                                        ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
    //} else {
    if (AuthComponent::user('role') != 'VMP') {
    ?>
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title"><?php echo __('La liste des brochures'); ?></h2>
            </div>
            <div class="box-body">
                <div class="brochure-grid">
                    <?php foreach ($brochuresall as $b): ?>
                        <div class="info-box">
                            <?php echo $this->Html->image("brochures/" . $b['Brochure']['logo'], array("style" => 'width: 120px;')); ?>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo h($b['Brochure']['name']); ?></span>
                                <span class="info-box-text subtext">Gamme : <?php echo h($b['Game']['name']); ?></span>
                                <span class="info-box-actions">
                                    <a href="<?php echo $this->Html->url("/brochures/view/" . $b['Brochure']['id']); ?>" target="_blank" class="btn btn-primary btn-sm bg-light-blue">Visualiser</a>
                                    <?php
                                    if ($this->requestAction('/droits/getrole/Brochures/edit') == 1)
                                        echo '<a href="' . $this->Html->URL(array('action' => 'edit', $b['Brochure']['id'])) . '" class="btn btn-primary btn-sm" title="Modifier">Modifier</a>';
                                    if ($this->requestAction('/droits/getrole/Brochures/archive') == 1)
                                        echo '<a href="' . $this->Html->URL(array('action' => 'archive', $b['Brochure']['id'], 0)) . '" class="btn btn-primary btn-sm" title="Archiver">Archiver</a>';
                                    ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
