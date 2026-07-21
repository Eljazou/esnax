<?php
echo $this->Html->css('dataTables.bootstrap');
?>
<?php
// ---- Palette + icônes décoratives uniquement (aucune donnée modifiée) ----
$ptg_palette = array(
    array('main' => '#6C63F5', 'soft' => '#EEECFE'),
    array('main' => '#EC4899', 'soft' => '#FCE7F3'),
    array('main' => '#F59E0B', 'soft' => '#FEF3C7'),
    array('main' => '#3B82F6', 'soft' => '#DBEAFE'),
    array('main' => '#10B981', 'soft' => '#D1FAE5'),
    array('main' => '#8B5CF6', 'soft' => '#EDE9FE'),
    array('main' => '#9CA3AF', 'soft' => '#F3F4F6'),
    array('main' => '#14B8A6', 'soft' => '#CCFBF1'),
);
$ptg_icons = array(
    '<path d="M12 2l7 4v6c0 5-3.5 8.5-7 10-3.5-1.5-7-5-7-10V6l7-4z"></path>', // shield
    '<path d="M12 2s6 7 6 12a6 6 0 0 1-12 0c0-5 6-12 6-12z"></path>', // droplet
    '<path d="M12 2l7 4v6c0 5-3.5 8.5-7 10-3.5-1.5-7-5-7-10V6l7-4z"></path><polyline points="9 12 11 14 15 10"></polyline>', // shield-check
    '<path d="M9 2v6L4 18a2 2 0 0 0 2 3h12a2 2 0 0 0 2-3L15 8V2"></path><line x1="9" y1="2" x2="15" y2="2"></line>', // flask
    '<path d="M12 21c-4-1-8-5-8-11 4 0 8 4 8 11z"></path><path d="M12 21c4-1 8-5 8-11-4 0-8 4-8 11z"></path>', // leaf
    '<circle cx="12" cy="12" r="2"></circle><ellipse cx="12" cy="12" rx="9" ry="4"></ellipse><ellipse cx="12" cy="12" rx="9" ry="4" transform="rotate(60 12 12)"></ellipse><ellipse cx="12" cy="12" rx="9" ry="4" transform="rotate(120 12 12)"></ellipse>', // atom
    '<path d="M12 21c-4-2-8-6-8-11 4 0 6 2 8 4 2-2 4-4 8-4 0 5-4 9-8 11z"></path>', // sprout-ish
    '<line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>', // cross
);
$ptg_n = count($ptg_palette);
?>

<style>
/* ================== MODERN RESTYLE (CSS/SVG only — no PHP logic touched) ================== */
.ptg-wrapper{
	--ptg-purple: #6C63F5;
	--ptg-purple-dark: #5750d9;
	--ptg-purple-soft: #EEECFE;
	--ptg-text: #2c2e3a;
	--ptg-muted: #8a8fa3;
	--ptg-border: #ececf5;
}

/* page header block above the table */
.ptg-page-header{
	position: relative;
	display: flex;
	align-items: flex-start;
	gap: 16px;
	padding: 24px 26px 20px 26px;
	overflow: hidden;
}
.ptg-page-icon{
	width: 54px;
	height: 54px;
	min-width: 54px;
	border-radius: 16px;
	background: linear-gradient(135deg, var(--ptg-purple), var(--ptg-purple-dark));
	color: #fff;
	display: flex;
	align-items: center;
	justify-content: center;
	box-shadow: 0 6px 18px rgba(108,99,245,0.3);
}
.ptg-page-icon svg{ width: 26px; height: 26px; }
.ptg-page-title{
	font-size: 22px;
	font-weight: 800;
	color: var(--ptg-text);
	margin: 0;
}
.ptg-page-sub{
	font-size: 14px;
	color: var(--ptg-muted);
	margin-top: 4px;
}
.ptg-page-underline{
	width: 34px;
	height: 4px;
	border-radius: 4px;
	background: var(--ptg-purple);
	margin-top: 10px;
}
.ptg-page-deco{
	position: absolute;
	right: 20px;
	top: 8px;
	opacity: .9;
}
.ptg-page-deco svg{ width: 150px; height: 110px; }

/* card wrapping the table */
.ptg-wrapper .box{
	background: #fff;
	border: 1px solid var(--ptg-border);
	border-radius: 18px !important;
	box-shadow: 0 6px 22px rgba(108,99,245,0.1);
	overflow: hidden;
}
.ptg-wrapper .box-header{ display: none; } /* replaced by ptg-page-header above */
.ptg-wrapper .box-body{ padding: 0; }

.ptg-wrapper table{
	border: none !important;
	margin: 0 !important;
}
.ptg-wrapper table thead tr th{
	background: linear-gradient(135deg, var(--ptg-purple), var(--ptg-purple-dark)) !important;
	color: #fff !important;
	font-weight: 700;
	font-size: 14px;
	border: none !important;
	padding: 16px 22px !important;
}
.ptg-th-icon{
	display: inline-flex;
	align-items: center;
	gap: 8px;
}
.ptg-th-icon svg{ width: 16px; height: 16px; }

.ptg-wrapper table tbody tr td{
	border: none !important;
	border-top: 1px solid var(--ptg-border) !important;
	padding: 14px 22px !important;
	vertical-align: middle;
	font-size: 14.5px;
	color: var(--ptg-text);
}
.ptg-wrapper table tbody tr{
	position: relative;
}
.ptg-wrapper table tbody tr td:first-child{
	border-left: 4px solid var(--ptg-row-color, var(--ptg-purple));
}
.ptg-wrapper table tbody tr:hover{
	background: #fafaff;
}

.ptg-produit-cell{
	display: flex;
	align-items: center;
	gap: 12px;
	font-weight: 600;
}
.ptg-produit-icon{
	width: 34px;
	height: 34px;
	min-width: 34px;
	border-radius: 10px;
	display: flex;
	align-items: center;
	justify-content: center;
	background: var(--ptg-row-soft, var(--ptg-purple-soft));
	color: var(--ptg-row-color, var(--ptg-purple));
}
.ptg-produit-icon svg{ width: 17px; height: 17px; }

.ptg-quantite{
	font-weight: 700;
	font-size: 15px;
	color: var(--ptg-row-color, var(--ptg-purple));
}

/* Voir / Edit buttons */
.ptg-wrapper a.ptg-voir{
	background: var(--ptg-purple-soft) !important;
	color: var(--ptg-purple-dark) !important;
	border: none !important;
	border-radius: 10px !important;
	padding: 7px 16px !important;
	font-weight: 500;
	font-size: 13px;
	box-shadow: none !important;
}
.ptg-wrapper a.ptg-voir:hover{
	background: #E0DCFC !important;
}
.ptg-wrapper button.ptg-edit,
.ptg-wrapper a.ptg-edit{
	background: var(--ptg-purple) !important;
	color: #fff !important;
	border: none !important;
	border-radius: 10px !important;
	padding: 7px 16px !important;
	font-weight: 500;
	font-size: 13px;
	box-shadow: 0 3px 10px rgba(108,99,245,0.25) !important;
	margin-left: 6px !important;
}
.ptg-wrapper button.ptg-edit:hover,
.ptg-wrapper a.ptg-edit:hover{
	background: var(--ptg-purple-dark) !important;
}
.ptg-btn-icon{
	width: 13px;
	height: 13px;
	vertical-align: -2px;
	margin-right: 4px;
}

/* total row */
.ptg-wrapper table tbody tr.ptg-total-row td{
	background: var(--ptg-purple-soft);
	font-weight: 700;
	color: var(--ptg-purple-dark);
	border-top: 2px solid var(--ptg-purple) !important;
}

/* inline edit form */
.ptg-wrapper .ptg-inline-form input[type="number"]{
	border: 1px solid var(--ptg-border) !important;
	border-radius: 8px !important;
	box-shadow: none !important;
	height: 32px;
}
.ptg-wrapper .ptg-inline-form input[type="submit"]{
	border-radius: 8px !important;
	background: var(--ptg-purple) !important;
	border: none !important;
	color: #fff !important;
}

/* Valider button below the box */
.ptg-valider{
	display: inline-flex;
	align-items: center;
	gap: 8px;
	background: linear-gradient(135deg, var(--ptg-purple), var(--ptg-purple-dark)) !important;
	color: #fff !important;
	border: none !important;
	border-radius: 12px !important;
	padding: 11px 24px !important;
	font-weight: 600;
	font-size: 14.5px;
	box-shadow: 0 6px 18px rgba(108,99,245,0.3) !important;
	margin-top: 18px;
}
.ptg-valider svg{ width: 16px; height: 16px; }
</style>

<div class="ptg-wrapper">
<div class="ptg-page-header">
	<span class="ptg-page-icon">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 2h6a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"></path><line x1="9" y1="7" x2="15" y2="7"></line><line x1="9" y1="11" x2="15" y2="11"></line><line x1="9" y1="15" x2="12" y2="15"></line></svg>
	</span>
	<div>
		<h3 class="ptg-page-title"><?php echo __('Bon de Commande des échantillons'); ?></h3>
		<div class="ptg-page-sub">Liste des produits demandés et leurs quantités</div>
		<div class="ptg-page-underline"></div>
	</div>
	<div class="ptg-page-deco">
		<svg viewBox="0 0 150 110" fill="none" xmlns="http://www.w3.org/2000/svg">
			<circle cx="30" cy="30" r="22" fill="#FDE7CF" opacity="0.7"></circle>
			<circle cx="110" cy="20" r="16" fill="#DCE9FF" opacity="0.7"></circle>
			<circle cx="70" cy="60" r="26" fill="#EFEAFE" opacity="0.7"></circle>
			<rect x="95" y="35" width="8" height="40" rx="3" fill="#8B7CF6"></rect>
			<rect x="110" y="45" width="8" height="30" rx="3" fill="#F59E0B"></rect>
			<rect x="80" y="25" width="8" height="50" rx="3" fill="#EC4899"></rect>
			<path d="M60 90c10-6 20-6 30 0" stroke="#10B981" stroke-width="3" stroke-linecap="round" fill="none"></path>
		</svg>
	</div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Bon de Commande des échantillons'); ?>
        </h3>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>Produit</span></th>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>Quantité</span></th>
                    <th><span class="ptg-th-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Actions</span></th>
                </tr>
            </thead>
            <?php
            $t = 0;
            $i = 0;
            foreach ($echantillons as $key => $value):
                $ptg_idx = $i % $ptg_n;
                $ptg_color = $ptg_palette[$ptg_idx]['main'];
                $ptg_soft = $ptg_palette[$ptg_idx]['soft'];
                $ptg_icon_svg = $ptg_icons[$ptg_idx];
                ?>
                <tr style="--ptg-row-color: <?php echo $ptg_color; ?>; --ptg-row-soft: <?php echo $ptg_soft; ?>;">
                    <td>
						<div class="ptg-produit-cell">
							<span class="ptg-produit-icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $ptg_icon_svg; ?></svg>
							</span>
							<?php echo $value; ?>
						</div>
					</td>
                    <td>
                        <label class="label<?php echo $i; ?> ptg-quantite"><?php
                            $v = $this->requestAction("/gadjets/system_get_quantite_admin/$key");
                            echo $v;
                            $t = $t + $v;
                            ?>
                        </label>
                        <div class="input<?php echo $i; ?> ptg-inline-form" style="display:none;">
    <?php echo $this->Form->create('Gadjet'); ?>
                            <input type="number" value="<?php echo $v; ?>" name="data[Gadjet][quantite]" style="float:left;width:80px;margin-right:5px;padding:3px;">
                            <input type="hidden" value="<?php echo "$key"; ?>" name="data[Gadjet][info]" >
    <?php //echo $this->Form->end(array('label' => 'Modifier'), array('class'=>"btn bg-purple btn-flat",'style'=>"float:left;"));  ?>
                            <input type="submit" class="btn bg-light-blue btn-sm" value="Modifier">
                            </form>
                        </div>
                    </td>
                    <td>
    <?php echo $this->Html->link('<svg class="ptg-btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>Voir', array('action' => 'voir', $key), array('class' => "btn bg-purple btn-flat ptg-voir", 'escape' => false)); ?><button type="button" class="btn bg-purple btn-flat ptg-edit" style="margin-left:3px;" onclick="btn(<?php echo $i++; ?>)"><svg class="ptg-btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</button>
                    </td>
                </tr>
<?php endforeach; ?>
            <tr class="ptg-total-row">
                <td>Total</td>
                <td>
<?php echo $t; ?>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>
</div>
<?php echo $this->Html->link('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>Valider', array('action' => 'admin', 1), array('class' => "btn bg-purple btn-flat margin ptg-valider", 'escape' => false)); ?>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php
echo $this->Html->script('daterangepicker');
?>
<script>

                            $(function () {
                                $('#reservationtime').daterangepicker({format: 'MM/DD/YYYY',
                                    locale: {
                                        "format": "YYYY-MM-DD",
                                        "separator": "--",
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
                                    clickApply: function (e) {
                                        this.updateInputText();
                                    }
                                });
                                $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
                                    var startDate = picker.startDate;
                                    var endDate = picker.endDate;
                                    var action = $('#dateform').attr('action');
                                    var date = action + "?date=" + startDate + "--" + endDate;
                                    $('#dateform').attr('action', date);
                                    $('#dateform').submit();
                                });
                            });
                            function btn(id) {
                                $(".input" + id).show();
                                $(".label" + id).remove();
                            }
</script>