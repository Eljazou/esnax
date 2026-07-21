<?php
 echo $this->Html->css('dataTables.bootstrap');
 echo $this->Html->css('jqcloud');
?>
<style>
	:root{
		--mtc-accent:#7C5CFA;
		--mtc-accent-dark:#5B3FD9;
		--mtc-accent-soft:#F1EDFF;
		--mtc-ink:#1E1B2E;
		--mtc-muted:#8B87A0;
		--mtc-border:#EAE7F5;
		--mtc-surface:#FFFFFF;
		--mtc-canvas:#F7F6FC;
		--mtc-radius:14px;
		--mtc-radius-sm:8px;
		--mtc-shadow:0 2px 10px rgba(76,55,168,.06);
		--mtc-success:#17A673; --mtc-success-soft:#E8FAF3;
		--mtc-info:#3E8BFF; --mtc-info-soft:#E8F1FF;
		--mtc-warning:#F5A524; --mtc-warning-soft:#FFF6E5;
		--mtc-danger:#E5484D; --mtc-danger-soft:#FDEBEC;
	}
	section.content, .col-md-12{ font-family:'Inter','Segoe UI',-apple-system,sans-serif; }

	.dt-button{width:auto;float:left;margin:5px;font-size:13px;line-height:20px;padding:6px 12px;background:var(--mtc-accent);color:#fff;border:none;border-radius:var(--mtc-radius-sm);font-weight:600;}
	.dt-button:hover{color:#fff;background:var(--mtc-accent-dark);}

	/* ============================================================
	   Metronic-style "statistic" widgets
	   (card-flush + symbol + fs-2hx pattern)
	   ============================================================ */
	.mtc-stats-row{ display:flex; flex-wrap:wrap; gap:16px; margin-bottom:18px; }
	.card.card-flush.mtc-stat{
		flex:1 1 200px;
		background:var(--mtc-surface);
		border:1px solid var(--mtc-border);
		border-radius:var(--mtc-radius);
		box-shadow:var(--mtc-shadow);
		padding:20px 22px;
		display:flex;
		align-items:center;
		gap:14px;
		transition:transform .15s, box-shadow .15s;
	}
	.card.card-flush.mtc-stat:hover{ transform:translateY(-2px); box-shadow:0 8px 22px rgba(76,55,168,.12); }
	.symbol{ display:inline-flex; align-items:center; justify-content:center; border-radius:12px; flex:0 0 auto; }
	.symbol.symbol-50px{ width:50px; height:50px; font-size:20px; }
	.symbol.symbol-light-primary{ background:var(--mtc-accent-soft); color:var(--mtc-accent-dark); }
	.symbol.symbol-light-success{ background:var(--mtc-success-soft); color:var(--mtc-success); }
	.symbol.symbol-light-info{ background:var(--mtc-info-soft); color:var(--mtc-info); }
	.symbol.symbol-light-warning{ background:var(--mtc-warning-soft); color:#B67200; }
	.fs-2hx{ font-size:26px; line-height:1.15; }
	.fw-bolder{ font-weight:800; }
	.fw-bold{ font-weight:700; }
	.fw-semibold{ font-weight:600; }
	.text-gray-800{ color:var(--mtc-ink); }
	.text-gray-500{ color:var(--mtc-muted); }
	.mtc-stat-label{ font-size:12.5px; color:var(--mtc-muted); font-weight:600; margin-top:2px; }

	/* ============================================================
	   Card shell (replaces AdminLTE .box)
	   ============================================================ */
	.mtc-card{ background:var(--mtc-surface); border:1px solid var(--mtc-border); border-radius:var(--mtc-radius); box-shadow:var(--mtc-shadow); margin-bottom:18px; overflow:hidden; }
	.mtc-card-header{ display:flex; align-items:center; gap:10px; padding:16px 20px; border-bottom:1px solid var(--mtc-border); }
	.mtc-card-header i.hdr-ic{ color:var(--mtc-accent); font-size:15px; }
	.mtc-card-header .mtc-card-title{ font-size:15px; font-weight:700; color:var(--mtc-ink); margin:0; flex:1; }
	.mtc-card-header .btn-box-tool{ color:var(--mtc-muted); background:transparent; border:none; padding:4px 8px; border-radius:var(--mtc-radius-sm); }
	.mtc-card-header .btn-box-tool:hover{ background:var(--mtc-accent-soft); color:var(--mtc-accent-dark); }
	.mtc-card-body{ padding:18px 20px; }
	.mtc-card.accent-top{ border-top:3px solid var(--mtc-accent); }

	/* Profile card */
	.mtc-profile-card{ background:var(--mtc-surface); border:1px solid var(--mtc-border); border-radius:var(--mtc-radius); box-shadow:var(--mtc-shadow); padding:22px; text-align:center; margin-bottom:18px; }
	.mtc-profile-card .mtc-profile-id{ font-size:22px; font-weight:800; color:var(--mtc-accent-dark); margin:0; }
	.mtc-profile-card .mtc-profile-name{ color:var(--mtc-muted); font-size:13.5px; margin:2px 0 16px; }
	.btn-mtc-block{ display:block; width:100%; background:var(--mtc-accent); border:none; color:#fff; font-weight:600; border-radius:var(--mtc-radius-sm); padding:10px; transition:background .15s; }
	.btn-mtc-block:hover{ background:var(--mtc-accent-dark); color:#fff; text-decoration:none; }

	/* ============================================================
	   Tabs (replaces broken nav-tabs-custom)
	   ============================================================ */
	.nav-tabs-custom{ background:var(--mtc-surface); border:1px solid var(--mtc-border); border-radius:var(--mtc-radius); box-shadow:var(--mtc-shadow); overflow:hidden; margin-bottom:18px; }
	.nav-tabs-custom > .nav.nav-tabs{ display:flex; border-bottom:1px solid var(--mtc-border); background:var(--mtc-canvas); margin:0; padding:0 8px; list-style:none; }
	.nav-tabs-custom > .nav.nav-tabs > li{ list-style:none; }
	.nav-tabs-custom > .nav.nav-tabs > li > a{ display:block; color:var(--mtc-muted); font-weight:600; font-size:14px; padding:14px 18px; text-decoration:none; border-bottom:2px solid transparent; }
	.nav-tabs-custom > .nav.nav-tabs > li.active > a{ color:var(--mtc-accent-dark); border-bottom-color:var(--mtc-accent); }
	.nav-tabs-custom .tab-content{ padding:20px; }
	.nav-tabs-custom .tab-pane h5{ font-size:14px; font-weight:700; color:var(--mtc-ink); margin:0 0 14px; }

	/* Tables */
	.mtc-card table.table-hover, .nav-tabs-custom table.table-hover{ width:100%; border-collapse:collapse; font-size:13.5px; }
	.mtc-card table.table-hover th, .nav-tabs-custom table.table-hover th{ text-align:left; background:var(--mtc-canvas); color:var(--mtc-muted); font-weight:700; text-transform:uppercase; font-size:11px; letter-spacing:.03em; padding:10px 12px; border-bottom:1px solid var(--mtc-border); }
	.mtc-card table.table-hover td, .nav-tabs-custom table.table-hover td{ padding:10px 12px; border-bottom:1px solid var(--mtc-border); vertical-align:middle; }
	.mtc-card table.table-hover tr:hover td, .nav-tabs-custom table.table-hover tr:hover td{ background:var(--mtc-accent-soft); }

	/* Word cloud section */
	.mtc-wordcloud-col{ border-right:1px solid var(--mtc-border); padding:0 16px; }
	.mtc-wordcloud-col:last-child{ border-right:none; }
	.mtc-wordcloud-col h4{ text-align:center; font-size:13.5px; font-weight:700; color:var(--mtc-ink); margin:0 0 12px; }
	#wordcloud1, #wordcloud2, #wordcloud3{
		position:relative;
		width:100%; height:280px;
		border:1px solid var(--mtc-border);
		border-radius:var(--mtc-radius-sm);
		background:var(--mtc-canvas);
	}
	.mtc-wc-empty{
		position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
		color:var(--mtc-muted); font-size:12.5px; font-weight:600; text-align:center; padding:0 16px;
	}
	#wordcloud1 span.w10, #wordcloud1 span.w9, #wordcloud1 span.w8, #wordcloud1 span.w7,
	#wordcloud2 span.w10, #wordcloud2 span.w9, #wordcloud2 span.w8, #wordcloud2 span.w7,
	#wordcloud3 span.w10, #wordcloud3 span.w9, #wordcloud3 span.w8, #wordcloud3 span.w7 {
		text-shadow: 0px 1px 1px #ccc;
	}
	#wordcloud1 span.w3, #wordcloud1 span.w2, #wordcloud1 span.w1,
	#wordcloud2 span.w3, #wordcloud2 span.w2, #wordcloud2 span.w1,
	#wordcloud3 span.w3, #wordcloud3 span.w2, #wordcloud3 span.w1 {
		text-shadow: 0px 1px 1px #fff;
	}
</style>
<section class="content">
<div class="mtc-profile-card">
    <h3 class="mtc-profile-id"><?php echo $category['Category']['id']; ?></h3>
    <p class="mtc-profile-name"><?php echo $category['Category']['name']; ?></p>
    <a href="<?php echo $this->Html->url(array('action' => 'edit', $category['Category']['id'])); ?>" class="btn-mtc-block"><b>Editer</b></a>
</div>

<div class="mtc-stats-row">
    <div class="card card-flush mtc-stat">
        <div class="symbol symbol-50px symbol-light-primary"><i class="fa fa-stethoscope"></i></div>
        <div>
            <div class="fs-2hx fw-bolder text-gray-800"><?php echo $category['Category']['name']; ?></div>
            <div class="mtc-stat-label">Spécialité</div>
        </div>
    </div>
    <div class="card card-flush mtc-stat">
        <div class="symbol symbol-50px symbol-light-info"><i class="fa fa-file-pdf-o"></i></div>
        <div>
            <div class="fs-2hx fw-bolder text-gray-800" id="tab-1"></div>
            <div class="mtc-stat-label">Brochures</div>
        </div>
    </div>
    <div class="card card-flush mtc-stat">
        <div class="symbol symbol-50px symbol-light-warning"><i class="fa fa-graduation-cap"></i></div>
        <div>
            <div class="fs-2hx fw-bolder text-gray-800" id="tab-2"></div>
            <div class="mtc-stat-label">Formations</div>
        </div>
    </div>
    <div class="card card-flush mtc-stat">
        <div class="symbol symbol-50px symbol-light-success"><i class="fa fa-users"></i></div>
        <div>
            <div class="fs-2hx fw-bolder text-gray-800" id="tab-3"></div>
            <div class="mtc-stat-label">Clients</div>
        </div>
    </div>
</div>

<div class="mtc-card accent-top">
    <div class="mtc-card-header">
        <i class="fa fa-bar-chart-o hdr-ic"></i>
        <h3 class="mtc-card-title">Potentialité des clients</h3>
    </div>
    <div class="mtc-card-body">
        <div id="bar-chart" style="height: 300px;"></div>
    </div>
</div>
</section>
<div class="mtc-card">
    <div class="mtc-card-header">
        <i class="fa fa-bar-chart-o hdr-ic"></i>
        <h3 class="mtc-card-title">Type des clients</h3>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
    <div class="mtc-card-body">
        <div id="donut-chart" style="height: 300px;"></div>
    </div>
</div>

<div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
                <?php //$active=' class="active" '; if (!empty($category['Brochure'])): ?>
                    <li class="active"<?php //echo $active;$active=''; ?>>
                        <a href="#tab_1" data-toggle="tab" aria-expanded="true">Brochures
                        </a>
                    </li>
                <?php //endif; ?>
                <?php //if (!empty($category['Formation'])): ?>
                    <li <?php //echo $active;$active=''; ?>>
                        <a href="#tab_2" data-toggle="tab" aria-expanded="true">Formations
                        </a>
                    </li>
                <?php //endif; ?>
                <?php //if (!empty($category['Client'])): ?>
                    <li <?php //echo $active;$active=''; ?>>
                        <a href="#tab_3" data-toggle="tab" aria-expanded="true">Clients
                        </a>
                    </li>
                <?php //endif; ?>
        </ul>
        <div class="tab-content">
            
				<div class="tab-pane active" id="tab_1">
                    <h5><?php echo __('Liste des brochures'); ?></h5>
					<?php if (!empty($category['Brochure'])): ?>
					 <div class="row">
                        <div class="col-xs-12">
                            <div class="mtc-card">
                                
                                <div class="mtc-card-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?php echo __('Nom'); ?></th>
                            <th><?php echo __('Brochure'); ?></th>
                            <th><?php echo __('Date d\'ajout'); ?></th>
                        </tr>
                        <?php
                        $i = 0;
                        foreach ($category['Brochure'] as $brochure):
                            ?>
                            <tr>
                                <td><?php echo $brochure['name']; ?></td>
                                <td><a href="/img/brochures/<?php echo $brochure['file']; ?>">Visualiser</a></td>
                                <td><?php echo $brochure['created']; ?></td>
                            </tr>
                    <?php endforeach; ?>
                    </table>
					</div>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>
				</div>
				<div class="tab-pane" id="tab_2">
                    <h5><?php echo __('Liste Formations'); ?></h5>
					<?php if (!empty($category['Formation'])): ?>
					<div class="row">
                        <div class="col-xs-12">
                            <div class="mtc-card">
                                
                                <div class="mtc-card-body table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?php echo __('Nom'); ?></th>
                                <th><?php echo __('Fichier'); ?></th>
                                <th><?php echo __('Date d\'ajout'); ?></th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($category['Formation'] as $formation):
                                ?>
                                <tr>
                                    <td><?php echo $formation['name']; ?></td>
                                    <td><a href="/img/formations/<?php echo $formation['file']; ?>">Visualiser</a></td>
                                    <td><?php echo $formation['created']; ?></td>
                                </tr>
                    <?php endforeach; ?>
                        </table>
						</div>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>
				</div>
				<div class="tab-pane" id="tab_3">
                    <h5><?php echo __('Liste des Clients'); ?></h5>
					<?php if (!empty($category['Client'])): ?>
					 <div class="row">
                        <div class="col-xs-12">
                            <div class="mtc-card">
                                
                                <div class="mtc-card-body table-responsive">
                    <table id="example1" class="table table-hover">
                        <thead>
							<tr>
                                <td> code CRM</td>
								<th><?php echo __('Nom'); ?></th>
								<th><?php echo __('Code wavesoft'); ?></th>
								<th><?php echo __('Activité'); ?></th>
								<th><?php echo __('Potentialité'); ?></th>
								<th><?php echo __('Secteur'); ?></th>
								<th><?php echo __('adresse'); ?></th>
								<th><?php echo __('Fixe'); ?></th>
								<th><?php echo __('GSM'); ?></th>
								<th>GEO</th>
								<th>Client centre appel</th>
								<th><?php echo __('Type pharmacie'); ?></th>
							</tr>
						</thead>
                        <?php
                        $i = 0;
                        $nbmedcin  =  0;
						$pot=array();
                        $type=array();
                        foreach ($category['Client'] as $client):
                            $nbmedcin++;
							if(!isset($pot[$client['potentialite']]))
								$pot[$client['potentialite']]=0;
							$pot[$client['potentialite']]=$pot[$client['potentialite']]+1;
								
                            if(!isset($type[$client['type_id']]))
                                $type[$client['type_id']]=0;
                            $type[$client['type_id']]=$type[$client['type_id']]+1;
                            ?>
                            <tr>
                                <td><?php echo $client['id']; ?></td>
                                <td><?php echo $this->Html->link($client['nom'].' '.$client['prenom'], array('controller' => 'clients', 'action' => 'view', $client['id'])); ?></td>
                                <td><?php echo $client['code_wavsoft']; ?></td>
                                <td><?php echo $client['activite']; ?></td>
                                <td><?php echo $client['potentialite']; ?></td>
                                <td><?php echo $secteurs[$client['secteur_id']]; ?></td>
								<td><?php echo $client['adress']; ?></td>
								<td><?php echo $client['fixe']; ?></td>
								<td><?php echo $client['tel']; ?></td>
								<td><?php if($client['longitude']!=null ) echo "Oui"; else echo "non"; ?></td>
								<td><?php 
								$clientcall=array("0"=>"Non","1"=>"Oui");
								echo $clientcall[$client['client_call']]; ?></td>
								
								<td><?php echo $client['type_pharmacie']; ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                            </table>
							</div>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>
				</div>
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
</div>

<?php 
$comantaire=$veille=$objection="";
/*foreach($visites as $v){
	$comantaire=$comantaire." ".strtolower($v['v']['commentaire']);
	$veille=$veille." ".strtolower($v['v']['veille']);
	$objection=$objection." ".strtolower($v['v']['objection']);
}*/
$words = str_word_count($comantaire, 1); // use this function if you care about i18n
$frequency = array_count_values($words);
arsort($frequency);
foreach($frequency as $key=>$value){
	if(strlen($key)<=3){
		unset($frequency[$key]);
	}
}
$comantaire=array_slice($frequency,0,10);

$words = str_word_count($veille, 1); // use this function if you care about i18n
$frequency = array_count_values($words);
arsort($frequency);
foreach($frequency as $key=>$value){
	if(strlen($key)<=3){
		unset($frequency[$key]);
	}
}
$veille=array_slice($frequency,0,10);

$words = str_word_count($objection, 1); // use this function if you care about i18n
$frequency = array_count_values($words);
arsort($frequency);
foreach($frequency as $key=>$value){
	if(strlen($key)<=3){
		unset($frequency[$key]);
	}
}
$objection=array_slice($frequency,0,10);
//debug($frequence);
?>
<div class="mtc-card">
	<div class="mtc-card-header">
		<i class="fa fa-cloud hdr-ic"></i>
		<h3 class="mtc-card-title">Les mots les plus répétés</h3>
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	</div>
	<div class="mtc-card-body" style="display:flex;flex-wrap:wrap;gap:16px;">
		<div class="mtc-wordcloud-col" style="flex:1 1 260px;">
			<h4>Commentaires</h4>
			<div id="wordcloud1" class="wordcloud1"></div>
		</div>
		<div class="mtc-wordcloud-col" style="flex:1 1 260px;">
			<h4>Veilles</h4>
			<div id="wordcloud2" class="wordcloud2"></div>
		</div>
		<div class="mtc-wordcloud-col" style="flex:1 1 260px;">
			<h4>Objections</h4>
			<div id="wordcloud3" class="wordcloud3"></div>
		</div>
	</div>
</div>

<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('jqcloud-1.0.0.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
echo $this->Html->script('jquery.flot.min');
echo $this->Html->script('jquery.flot.resize.min');
echo $this->Html->script('jquery.flot.pie.min');
echo $this->Html->script('jquery.flot.categories.min');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);


      
  
  function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Potentialité', 'Nombre de clients'],
		 <?php foreach($pot as $p=>$k)
				echo "['$p', $k],"; ?>
      ]);
       
    var options = {
	 'legend':'top',
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('bar-chart'));
    chart.draw(data, options);
  }
  
   var word_list1 = new Array(
  <?php 
  $i=6.5;
  foreach($comantaire as $key=>$value){?>
	   {text:"<?php echo $key;?>", weight: <?php echo $i;?>/*, link: "<?php echo $this->Html->url(array('controller' =>'visites','action' => 'system_get_commentaires_forspecialite_byword', $category['Category']['id'],$key)); ?>"*/},
 <?php $i=$i-0.5;} ?>
  {text: "", weight: 6}
      );
     /* $(document).ready(function() {
        $(".wordcloud").jQCloud(word_list);
      });*/
	  
	   var word_list2 = new Array(
  <?php 
  $i=6.5;
  foreach($veille as $key=>$value){?>
	   {text:"<?php echo $key;?>", weight: <?php echo $i;?>/*, link: "<?php echo $this->Html->url(array('controller' =>'visites','action' => 'system_get_veilles_forspecialite_byword', $category['Category']['id'],$key)); ?>"*/},
 <?php $i=$i-0.5;} ?>
  {text: "", weight: 6}
      );
      /*$(document).ready(function() {
        $(".wordcloud2").jQCloud(word_list2);
      });
		$("#tab5").click(function(){
			 $(".wordcloud2").jQCloud(word_list2);
		});*/
	  
	   var word_list3 = new Array(
  <?php 
  $i=6.5;
  foreach($objection as $key=>$value){?>
	   {text:"<?php echo $key;?>", weight: <?php echo $i;?>/*, link: "<?php echo $this->Html->url(array('controller' =>'visites','action' => 'system_get_objections_forspecialite_byword', $category['Category']['id'],$key)); ?>"*/},
 <?php $i=$i-0.5;} ?>
  {text: "", weight: 6}
      );
      $(document).ready(function() {
		$("#wordcloud1").jQCloud(word_list1);
        $("#wordcloud2").jQCloud(word_list2);
        $("#wordcloud3").jQCloud(word_list3);

        // Show a friendly empty-state when a cloud has no real words
        // (word_listN always contains one trailing blank placeholder entry)
        $.each(['#wordcloud1', '#wordcloud2', '#wordcloud3'], function(i, sel) {
            if ($(sel).find('span').filter(function() { return $.trim($(this).text()) !== ''; }).length === 0) {
                $(sel).append('<div class="mtc-wc-empty">Aucune donnée disponible</div>');
            }
        });
      });
		/*$("#tab6").click(function(){
			 $(".wordcloud3").jQCloud(word_list3);
		});*/
    </script>
<script>
   document.getElementById("tab-1").innerHTML = <?php echo count($category['Brochure']); ?>;
    document.getElementById("tab-2").innerHTML = <?php echo count($category['Formation']); ?>;
    document.getElementById("tab-3").innerHTML = <?php echo count($category['Client']); ?>;
    function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + "<br>"
        + Math.round(series.percent) + "%</div>";
  }
    var donutData = [
        <?php 
        $c[0]="#3c8dbc";
        $c[1]="#00c0ef";
        $c[2]="#0073b7";
        $c[3]="#3c5dbc";
        $c[4]="#1c8dbc";
        $i=0;
        foreach ($type as $key => $value) 
        {
            foreach ($types as $k => $v) {
                if($key==$k)
                    echo '{label: "'.$v.'", data: '.$value.', color: "'.$c[$i].'"},';
            }
            $i++;
        } ?>
    ];
    $.plot("#donut-chart", donutData, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    });
	$(function () {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering":  true,
            "info": false,
            "autoWidth": false,
			"order": [ 1, 1 ],
            "iDisplayLength": 50,
			dom: 'Bfrtip',
			buttons: [
				 'csv', 'excel', 'print'
			]
        });
    });
	$(window).load(function(){
		var height = $(".content-wrapper").height();
		var height1 = $(window).height();
		height = height+height1;
		$(".content-header").attr("style","height:"+height+"px");
	});
</script>
