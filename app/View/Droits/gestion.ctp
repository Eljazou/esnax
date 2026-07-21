<style>
    :root{
        --accent:#8B7FD1;
        --accent-soft:#EFECFA;
        --accent-soft-hover:#E4DFF7;
        --accent-text:#6C5FC7;
        --text-dark:#2E2A3D;
        --text-muted:#918C9E;
        --border-soft:#EAE7F2;
        --page-bg:#F7F6FB;
    }

    body{ background:var(--page-bg); }

    /* ===== Header card ===== */
    .page-header-card{
        position:relative;
        background:#fff;
        border-radius:18px;
        padding:22px 26px;
        margin-bottom:18px;
        display:flex;
        align-items:center;
        gap:16px;
        border:1px solid var(--border-soft);
    }
    .page-header-icon{
        flex:0 0 auto;
        width:52px;height:52px;
        border-radius:14px;
        background:var(--accent-soft);
        display:flex;align-items:center;justify-content:center;
    }
    .page-header-icon svg{ width:24px;height:24px; }
    .page-header-text h3{
        margin:0;
        color:var(--text-dark);
        font-weight:700;
        font-size:22px;
    }
    .page-header-text p{
        margin:2px 0 0;
        color:var(--text-muted);
        font-size:13px;
    }
    .page-header-text .underline{
        display:inline-block;
        width:34px;height:3px;
        background:var(--accent);
        border-radius:3px;
        margin-top:6px;
    }

    /* ===== User selector card ===== */
    .user-select-card{
        background:#fff;
        border-radius:18px;
        padding:20px 26px;
        margin-bottom:18px;
        border:1px solid var(--border-soft);
    }
    .user-select-card label{
        display:block;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.03em;
        color:var(--text-muted);
        font-weight:700;
        margin-bottom:8px;
    }
    .user-select-wrap{ position:relative; max-width:420px; }
    .user-select-wrap svg.user-ic{
        position:absolute; left:14px; top:50%; transform:translateY(-50%);
        width:16px;height:16px; color:var(--accent-text); pointer-events:none;
    }
    #DroitUserId{
        width:100%;
        padding:11px 14px 11px 40px;
        border-radius:10px;
        border:1px solid var(--border-soft);
        background:#fff;
        color:var(--text-dark);
        font-size:14px;
        font-weight:600;
        appearance:none;
        -webkit-appearance:none;
        background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23918C9E' stroke-width='2'><polyline points='6 9 12 15 18 9'/></svg>");
        background-repeat:no-repeat;
        background-position:right 14px center;
        background-size:14px;
    }
    #DroitUserId:focus{ outline:none; border-color:var(--accent); box-shadow:0 0 0 3px var(--accent-soft); }

    /* ===== Droits grid ===== */
    .droits-grid{
        display:grid;
        grid-template-columns:repeat(4, 1fr);
        gap:16px;
    }
    @media (max-width:1400px){ .droits-grid{ grid-template-columns:repeat(3, 1fr); } }
    @media (max-width:1024px){ .droits-grid{ grid-template-columns:repeat(2, 1fr); } }
    @media (max-width:640px){ .droits-grid{ grid-template-columns:1fr; } }

    .droit-card{
        background:#fff;
        border-radius:14px;
        padding:16px;
        border:1px solid var(--border-soft);
        transition:border-color .15s ease;
    }
    .droit-card:hover{ border-color:#D9D3EE; }

    .droit-card-header{
        display:flex; align-items:center; gap:10px;
        margin-bottom:10px;
    }
    .droit-avatar{
        flex:0 0 auto;
        width:28px;height:28px;
        border-radius:8px;
        background:var(--accent-soft);
        color:var(--accent-text);
        display:flex;align-items:center;justify-content:center;
        font-size:12px;
        font-weight:700;
    }
    .droit-card-header .droit-name{
        font-size:13px;
        font-weight:700;
        color:var(--text-dark);
    }

    .droit-card select[multiple]{
        width:100%;
        border-radius:8px;
        border:1px solid var(--border-soft);
        background:#fff;
        font-size:12.5px;
        color:var(--text-dark);
        padding:4px;
        min-height:120px;
    }
    .droit-card select[multiple] option{
        padding:6px 8px;
        border-radius:5px;
        margin-bottom:1px;
        background:#fff;
        color:var(--text-dark);
    }
    .droit-card select[multiple] option:checked{
        background:linear-gradient(0deg, var(--accent-soft) 0%, var(--accent-soft) 100%);
        color:var(--accent-text);
        font-weight:600;
    }
    .droit-card select[multiple]:focus{ outline:none; border-color:var(--accent); }

    /* Sticky save footer */
    .droits-footer{
        position:sticky;
        bottom:0;
        margin-top:22px;
        padding:16px 0;
        display:flex;
        justify-content:flex-end;
    }
    .droits-footer .btn-save-purple{
        background:var(--accent);
        color:#fff;
        border:none;
        border-radius:10px;
        font-weight:700;
        font-size:14px;
        padding:12px 28px;
        box-shadow:0 4px 12px rgba(139,127,209,0.25);
    }
    .droits-footer .btn-save-purple:hover{ background:var(--accent-text); color:#fff; }
</style>

<div class="row">
	<div class="col-xs-12">
		<div class="page-header-card">
			<div class="page-header-icon">
				<svg viewBox="0 0 24 24" fill="none" stroke="#6C5FC7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg>
			</div>
			<div class="page-header-text">
				<h3><?php echo __('Gestion des droits'); ?></h3>
				<p><?php echo __('Configurez les permissions par utilisateur et par module'); ?></p>
				<span class="underline"></span>
			</div>
		</div>

		<?php echo $this->Form->create('Droit'); ?>
			<div class="user-select-card">
				<label for="DroitUserId">Utilisateur</label>
				<div class="user-select-wrap">
					<svg class="user-ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
					<select id="DroitUserId" name="data[Droit][user_id]" onchange="location = this.value;">
						<?php
						foreach ($users as $key => $value) {
							$selected = '';
							if ($key == $user_id)
								$selected = ' selected ';
							echo "<option $selected value='".$this->Html->url(array('action' => 'gestion',$key))."'>$value</option>";
						}
						?>
					</select>
				</div>
			</div>

			<div class="droits-grid">
			<?php
			foreach ($controllers as $key => $value) {
				$key = str_replace("Controller", "", $key);
				if($key=='Apimobile' || $key=="Apimobilev1")
					continue;

				$label = ($key=='Games') ? 'Gammes' : $key;
				$initial = strtoupper(substr($label, 0, 1));
				?>
				<div class="droit-card">
					<div class="droit-card-header">
						<span class="droit-avatar"><?php echo h($initial); ?></span>
						<span class="droit-name"><?php echo h($label); ?></span>
					</div>
					<select multiple name="data[Droit][droit][]">
						<?php
						foreach ($value as $k => $view)
						{
							$pos = strpos($view, "system");
							if($pos!==false)
								continue;
							$selected = '';
							foreach ($liste as $num => $name) {
								if ($name == "$key|$view") {
									$selected = " selected ";
									break;
								}
							}
							?>
							<option <?php echo $selected; ?> value="<?php echo "$key|$view"; ?>"><?php echo $view; ?></option>
						<?php } ?>
					</select>
				</div>
			<?php }
			?>
			</div>

			<div class="droits-footer">
				<?php echo $this->Form->end(array('label' => 'Enregistrer les droits', 'class' => 'btn-save-purple')); ?>
			</div>
	</div>
</div>
