<?php echo $this->Html->css('dataTables.bootstrap');
?>
<style>
    body { background: #f4f5fa; }

    .box {
        background: #fff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(99, 60, 200, 0.08);
        overflow: hidden;
    }

    .box-header {
        background: #fff;
        padding: 24px 28px 8px;
        border: none;
    }

    .box-header .title-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .box-header .icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #eee9fd;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .box-header .icon-circle svg {
        width: 24px;
        height: 24px;
        stroke: #6b46e5;
    }

    .box-header h3.box-title {
        color: #1e1e2e;
        font-size: 21px;
        font-weight: 700;
        margin: 0;
        width: auto !important;
    }

    .box-header .subtitle {
        color: #8b87a5;
        font-size: 14px;
        margin-top: 3px;
        font-weight: 400;
    }

    .action-bar {
        padding: 4px 28px 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-cycle {
        background: linear-gradient(135deg, #4a7bf0 0%, #6b9bf5 100%);
        border: none;
        color: #fff !important;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
        box-shadow: 0 4px 14px rgba(74, 123, 240, 0.3);
    }

    .btn-cycle:hover {
        opacity: 0.92;
        color: #fff !important;
    }

    .btn-cycle svg {
        width: 16px;
        height: 16px;
        stroke: #fff;
    }

    .btn-danger-modern {
        background: linear-gradient(135deg, #e75c5c 0%, #f08383 100%);
        border: none;
        color: #fff !important;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
        box-shadow: 0 4px 14px rgba(231, 92, 92, 0.3);
    }

    .btn-danger-modern:hover {
        opacity: 0.92;
        color: #fff !important;
    }

    .btn-danger-modern svg {
        width: 16px;
        height: 16px;
        stroke: #fff;
    }

    .box-body {
        padding: 8px 28px 28px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table.table {
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1200px;
    }

    table.table thead th {
        background: #f2eefd;
        color: #6b5ecb;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: none !important;
        padding: 12px 14px;
        white-space: nowrap;
    }

    table.table tbody td {
        border: none !important;
        border-bottom: 1px solid #f0eefa !important;
        padding: 10px 14px;
        font-size: 13px;
        color: #3a3a4a;
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    table.table tbody td:first-child {
        text-align: left;
        font-weight: 600;
        color: #2c2c3a;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fbfaff;
    }

    table.table-bordered {
        border: none;
    }

    .remplir-link {
        color: #a29fc0;
        font-weight: 500;
        text-decoration: none !important;
        font-size: 13px;
    }

    .remplir-link:hover {
        color: #6b46e5;
        text-decoration: underline !important;
    }

    .qty-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 26px;
        padding: 0 8px;
        border-radius: 8px;
        background: #efeafc;
        color: #5a3fd6;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none !important;
    }

    .qty-badge:hover {
        background: #6b46e5;
        color: #fff;
    }

    .dataTables_wrapper .dataTables_filter {
        text-align: right;
        margin-bottom: 16px;
    }

    .dataTables_wrapper .dataTables_filter label {
        color: #4a4a5a;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px;
        border: 1px solid #e0dbf7;
        padding: 8px 14px;
        font-size: 14px;
        margin-left: 0 !important;
        min-width: 200px;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #7b5ce8;
    }

    .dataTables_wrapper .dataTables_info {
        color: #8b87a5;
        font-size: 13px;
        padding-top: 14px;
    }
</style>
<div class="box">
    <div class="box-header">
        <div class="title-wrap">
            <div class="icon-circle">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
            </div>
            <div>
                <h3 class="box-title"><?php echo __('Autoechantiants'); ?></h3>
                <div class="subtitle"><?php echo __('Gérez la répartition des échantillons par spécialité'); ?></div>
            </div>
        </div>
	</div>
    <div class="action-bar">
		<?php 
			$date=date("Y-m-d",strtotime('next monday'));
			$d="$date , ";
			$date = date("Y-m-d",strtotime("+7 day", strtotime($date)));
			$d=$d."$date , ";
			$date = date("Y-m-d",strtotime("+7 day", strtotime($date)));
			$d=$d."$date , ";
			$date = date("Y-m-d",strtotime("+7 day", strtotime($date)));
			$d=$d.$date;
			echo $this->Html->link (
                '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>' . "Proposition des 4 prochain cycle ($d)",
                array("action"=>"proposition",4),
                array('class'=>'btn-cycle', 'escape' => false)
            );
		?>
		<?php echo $this->Html->link (
            '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>' . "Supprimer les proposition non valide",
            array("action"=>"suppnonvalide"),
            array('class'=>'btn-danger-modern', 'escape' => false)
        ); ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SPECIALITES / POTENTIALITES</th>
                    <?php
                    $pot = array("A1", "A2", "A3", "A4", "B1", "B2", "B3", "B4", "C1", "C2", "C3", "C4", "NR");
                    for ($i = 0; $i < count($pot); $i++)
                        echo "<th>$pot[$i]</th>";
                    ?>
                </tr>
            </thead>
            <?php foreach ($categories as $key => $value): ?>
                <tr>
                    <td><?php echo $value ?>&nbsp;</td>
                    <?php
                    for ($i = 0; $i < count($pot); $i++) {
                        $kain=0;
                        foreach ($autoechantiants as $auto) {
                            if($auto["Autoechantiant"]["category_id"]==$key && $auto["Autoechantiant"]["classification"]==$pot[$i])
                            {
                                if($auto["Autoechantiant"]["gadjets"]=="")
                                    $kain=0;
                                else
                                {
                                    $d= explode("||", $auto["Autoechantiant"]["gadjets"]);
                                    for($j=0;$j<count($d);$j++)
                                    {
                                        $nombre=explode("&&",$d[$j]);
                                        $kain=$kain+$nombre[1];
                                    }
                                }
                                break;
                            }
                        }
                        if($kain==0)
                            echo "<td>".$this->Html->link ("Remplir",array("action"=>"add",$key,$pot[$i]),array('class'=>'remplir-link'))."</rd>";
                        else
                            echo "<td>".$this->Html->link ($kain,array("action"=>"edit",$key,$pot[$i]),array('class'=>'qty-badge'))."</rd>";
                    }
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>