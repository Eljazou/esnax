<?php
echo $this->Html->css('btn-style');
?>	
<style type="text/css">
    :root{
        --accent:#9b90e0;
        --accent-dark:#7e71cf;
        --accent-light:#f4f2fc;
        --accent-pale:#ece7fb;
        --mint:#5ad1a8;
        --mint-dark:#2f9c78;
        --mint-light:#e6faf3;
        --mint-pale:#d6f5ea;
        --pink-dark:#e0457b;
        --pink-light:#fdeaf1;
        --border-color:#ece9f9;
        --text-dark:#2d2b42;
        --text-muted:#8b87a3;
        --radius-lg:16px;
        --radius-md:12px;
        --radius-sm:8px;
        --shadow-card:0 2px 14px rgba(108,92,231,0.07);
    }

    .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
    background-color: #00a7d0 !important;
    color: #ffffff !important;
    width: 100%;
}
.widget-user-2 .widget-user-header {
    padding: 14px 8px;
}
.widget-user-2 .widget-user-desc {
    float: right;

}
th {
    text-align: left !important;
}
td{
    text-align: right !important;
}
.box-widget {
    border-radius: 19px;
    box-shadow: 0px 0px 9px 1px rgb(156 156 156 / 38%);
    background: white;
}
.box-footer {
    background-color: transparent;
}
.grid{
    margin-top: 88px;
}
.quicksearch{
    box-shadow: 0px 0px 7px 0px #cacaca;
    padding: 7px;
    border-radius: 25px;
    width: 50%;
    border: 1px solid #c3c3c3;
}
.titre{
    margin-bottom: 34px;
    padding-right: 19px;
    border-left: 7px solid #00a7d0;
    padding-left: 10px;
    margin-left: 9px;
}

/* ---------- Page header ---------- */
.titre{
    display:flex !important; align-items:center; gap:16px;
    border-left:none !important; padding-left:0 !important; margin-left:0 !important;
    font-size:22px; font-weight:800; color:var(--text-dark);
}
.titre:before{
    content:"\f0f6"; font-family:"FontAwesome"; display:inline-flex; align-items:center; justify-content:center;
    width:52px; height:52px; border-radius:var(--radius-sm); background:var(--accent-light); color:var(--accent-dark);
    font-size:20px; flex:0 0 auto;
}
.titre .btn-sc{
    background:var(--accent) !important; border:none !important; color:#fff !important;
    border-radius:var(--radius-sm) !important; padding:11px 22px !important; font-weight:600; font-size:14px;
    box-shadow:0 4px 14px rgba(108,92,231,0.3) !important;
}
.titre .btn-sc:hover{ background:var(--accent-dark) !important; color:#fff !important; }

/* ---------- Search ---------- */
.quicksearch{
    box-shadow:none !important; border:1px solid var(--border-color) !important; border-radius:24px !important;
    padding:12px 20px 12px 40px !important; width:60% !important; font-size:14px;
    background:#fafafa url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' fill='%238b87a3' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg>") no-repeat 16px center;
    background-size:15px 15px;
}
.quicksearch:focus{ border-color:var(--accent) !important; background-color:#fff !important; outline:none; }

/* ---------- Cards ---------- */
.box-widget{
    border-radius:var(--radius-lg) !important; box-shadow:var(--shadow-card) !important;
    border:1px solid var(--border-color); overflow:hidden;
}
.widget-user-2 .widget-user-header{
    background:var(--accent-pale) !important; display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:10px; padding:16px 18px !important;
}
.element-item:nth-child(even) .widget-user-2 .widget-user-header{ background:var(--mint-pale) !important; }

.widget-user-username{ display:flex !important; align-items:center; gap:10px; color:var(--text-dark) !important; font-size:15px; }
.widget-user-username .avatar-badge{
    width:38px; height:38px; border-radius:50%; background:var(--accent); color:#fff;
    display:inline-flex; align-items:center; justify-content:center; font-size:12.5px; font-weight:700; flex:0 0 auto;
}
.element-item:nth-child(even) .widget-user-username .avatar-badge{ background:var(--mint-dark); }

.widget-user-2 h5{ color:var(--text-dark) !important; font-size:13px; margin:0; }
.widget-user-desc{ color:var(--text-dark) !important; }
.widget-user-desc b, .widget-user-username b{ color:var(--text-muted); font-weight:600; }
.widget-user-desc a, .widget-user-username a{ color:var(--accent-dark) !important; font-weight:700; }

.box-footer table.table{ margin-bottom:0; }
.box-footer table.table tr{ border-bottom:1px solid var(--border-color); }
.box-footer table.table tr:last-child{ border-bottom:none; }
.box-footer table.table th, .box-footer table.table td{
    border:none !important; padding:10px 8px !important; font-size:13px; vertical-align:middle;
}
.box-footer table.table th{
    color:var(--text-muted) !important; font-weight:600; display:flex; align-items:center; gap:8px;
}
.box-footer table.table th i{
    width:26px; height:26px; border-radius:7px; background:var(--accent-light); color:var(--accent-dark);
    display:inline-flex; align-items:center; justify-content:center; font-size:11px; flex:0 0 auto;
}
.box-footer table.table td{ color:var(--text-dark) !important; font-weight:600; }

.etat-pill{
    display:inline-block; padding:.35em 1em; border-radius:20px; font-size:12px; font-weight:700;
    background:var(--mint-light); color:var(--mint-dark);
}

.badge.bg-green{
    background:var(--mint-light) !important; color:var(--mint-dark) !important; border-radius:20px; font-weight:600;
}
.label.label-success{
    background:var(--mint-light) !important; color:var(--mint-dark) !important; border-radius:20px; font-weight:600;
    padding:.35em .8em; display:inline-block; margin:2px;
}

.action-row{ display:flex; justify-content:center; gap:12px; padding-bottom:18px; }
.btn-in.btn-outline-info{
    background:var(--accent-light) !important; color:var(--accent-dark) !important;
    border:1px solid var(--accent-pale) !important; border-radius:20px !important;
    padding:8px 20px !important; font-size:13px !important; font-weight:600; box-shadow:none !important;
}
.btn-in.btn-outline-info:hover{ background:var(--accent-pale) !important; }
.btn-dn.btn-outline-danger{
    background:var(--pink-light) !important; color:var(--pink-dark) !important;
    border:1px solid #f6cddc !important; border-radius:20px !important;
    padding:8px 20px !important; font-size:13px !important; font-weight:600; box-shadow:none !important;
}
.btn-dn.btn-outline-danger:hover{ background:#fbdce9 !important; }

</style>

<div class="row">
    
    <div class="col-md-12 ">
        <!-- titre  -->
            <h3 class="titre" >La liste des demandes d'opportunités digitales<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> ' . __('Créer une opportunité'), array('action' => 'add',), array('class' => 'btn-sc btn btn-outline-success','style'=>'float:right', 'escape' => false)); ?></h3>
    <!--end titre  -->

    <!-- input Recherche -->
    <div class="col-md-12" style="text-align: center;"><input type="text" class="quicksearch" placeholder="Recherche par Nom,Prenom,Tel,Ville..." /></div>
    <!-- end input Recherche -->
    <!-- les element -->
    <div class="grid">
<?php foreach ($digitals as $digital):
    $nomClient = $digital['Digital']['nom'];
    $nomParts = preg_split('/\s+/', trim($nomClient));
    $initiales = '';
    foreach (array_slice($nomParts, 0, 2) as $part)
        $initiales .= mb_strtoupper(mb_substr($part, 0, 1));
?>
    
<div class="col-md-6 element-item">
          <div class="box box-widget widget-user-2 ">
            <div class="widget-user-header bg-yellow">
              <h3 class="widget-user-username" style="    display: contents;"><span class="avatar-badge"><?php echo h($initiales); ?></span><b>Client : </b> <?php echo h($digital['Digital']['nom']); ?>
              </h3>
              <h5 style="max-width: 201px;">
                <b>Traiter par : </b>
                <?php
                        if ($digital['Digital']['super_id'] != null)
                            echo $this->requestAction("/users/system_get_name_user/" . $digital['Digital']['super_id']);
                        ?></h5>

              <h5 class="widget-user-desc"><b>Ajouter par : </b><?php echo $digital['User']['name']; ?></h5>
            </div>
            <div class="box-footer no-padding">
                <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th><i class="fa fa-map-marker"></i>ville</th>
                        <td class="pull-right"><?php echo $this->requestAction("/secteurs/system_get_name/" . $digital['Digital']['secteur_id']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-phone"></i>Téléphone</th>
                        <td><?php echo h($digital['Digital']['telephone']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-th-large"></i>autre</th>
                        <td><?php echo h($digital['Digital']['autre']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-gamepad"></i>games</th>
                        <td><?php
                        echo '<span class="pull-right badge bg-green">' . str_replace(",", '</span><span class="label label-success">',
                                $digital['Digital']['game_id']) . "</span>";
                        ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-paper-plane"></i>Origine</th>
                        <td><?php echo h($digital['Digital']['origine']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-user"></i>Demandeur</th>
                        <td><?php echo h($digital['Digital']['demandeur']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th><i class="fa fa-tag"></i>Type</th>
                        <td><?php echo h($digital['Digital']['type']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-comment-o"></i>Commentaire</th>
                        <td><?php echo h($digital['Digital']['commentaire']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-reply"></i>Repense</th>
                        <td><?php echo h($digital['Digital']['repense']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-flag-o"></i>Etat</th>
                        <td><span class="etat-pill"><?php echo h($digital['Digital']['etat']); ?></span></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-clock-o"></i>date repense</th>
                        <td><?php echo h($digital['Digital']['date_repense']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-calendar"></i>Date d'ajout</th>
                        <td><?php echo h($digital['Digital']['created']); ?></td>
                    </tr>
                    
                </table>
            </div>
            <div class="col-md-12" style="text-align: center;margin-bottom: 18px;">
                <div class="action-row">
                            <?php
                        if ($digital['Digital']['etat'] != "Traiter" && $this->requestAction('/droits/getrole/digitals/traiter') == 1)
                            echo $this->Html->link(__('Traiter'), array('action' => 'traiter', $digital['Digital']['id']), array('class' => 'fa fa-eye btn-in btn btn-outline-info'));
                        ?>
                        <?php
                        if ($this->requestAction('/droits/getrole/digitals/delete') == 1)
                            echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $digital['Digital']['id']), array('class' => 'fa fa-trash btn-dn btn btn-outline-danger'), __('Etes-vous sur de vouloir supprimer ?'));
                        ?>
                        </div>
            </div>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        
        <?php endforeach; ?>
    </div>
    </div>
    </div>
    <!-- end les element -->
<?php
echo $this->Html->script('jquery-2.2.3.min');
?>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js'></script>

<script type="text/javascript">
    var qsRegex;

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows',
  filter: function() {
    return qsRegex ? $(this).text().match( qsRegex ) : true;
  }
});

// use value of search field to filter
var $quicksearch = $('.quicksearch').keyup( debounce( function() {
  qsRegex = new RegExp( $quicksearch.val(), 'gi' );
  $grid.isotope();
}, 200 ) );

// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
  var timeout;
  threshold = threshold || 100;
  return function debounced() {
    clearTimeout( timeout );
    var args = arguments;
    var _this = this;
    function delayed() {
      fn.apply( _this, args );
    }
    timeout = setTimeout( delayed, threshold );
  };
}
</script>
