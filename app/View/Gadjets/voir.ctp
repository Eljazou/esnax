<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style type="text/css">
    :root {
        --primary: #6C63F5;
        --primary-light: #ece9fe;
        --theme-border: #ece9f9;
        --radius-xl: 22px;
        --text-dark: #171730;
        --text-muted: #8d8da8;
    }

    body, .box, .table {
        font-family: 'Poppins', sans-serif;
    }

    /* Container Box Styling */
    .gadget-box-wrapper {
        width: 100%;
        margin-bottom: 30px;
    }

    .box {
        border-radius: var(--radius-xl) !important;
        border: 1px solid var(--theme-border) !important;
        box-shadow: 0 4px 20px rgba(108, 99, 245, 0.06) !important;
        background: #fff !important;
        overflow: hidden;
        border-top: none !important;
    }

    /* Header Section */
    .box-header {
        position: relative;
        padding: 24px 30px;
        background: linear-gradient(120deg, #ffffff 0%, #ffffff 55%, #ece7fd 100%);
        border-bottom: 1px solid var(--theme-border);
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .box-header::before {
        content: '';
        display: block;
        width: 12px;
        height: 24px;
        background: var(--primary);
        border-radius: 6px;
    }

    .box-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--text-dark) !important;
        margin: 0 !important;
        line-height: 1.2;
    }

    .box-body {
        padding: 24px 30px !important;
    }

    /* Data Table Styling */
    .table-responsive-wrapper {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid var(--theme-border) !important;
        border-radius: 14px;
        overflow: hidden;
    }

    .table > thead > tr > th {
        background-color: #fbfaff;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 13.5px;
        padding: 14px 16px;
        border-bottom: 1px solid var(--theme-border) !important;
        border-right: 1px solid var(--theme-border);
        text-align: center;
    }

    .table > thead > tr > th:first-child {
        text-align: left;
    }

    .table > tbody > tr > td {
        padding: 12px 16px;
        font-size: 14px;
        color: #4a4a68;
        border-bottom: 1px solid var(--theme-border);
        border-right: 1px solid var(--theme-border);
        text-align: center;
        vertical-align: middle;
        transition: background 0.15s ease;
    }

    .table > tbody > tr > td:first-child {
        text-align: left;
        font-weight: 500;
    }

    .table > tbody > tr:hover > td {
        background-color: #f8f7ff;
    }

    /* User link styling */
    .table td a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .table td a:hover {
        color: #4f46e5;
        text-decoration: underline;
    }

    /* Total Row Styling */
    .table-total-row {
        background-color: var(--primary-light) !important;
        font-weight: 700;
        color: var(--primary) !important;
    }

    .table-total-row td {
        border-bottom: none !important;
        color: var(--primary) !important;
        font-size: 14.5px !important;
    }

    /* Highlight Supervisor Rows */
    .supervisor-row td {
        background-color: #fcfbfe;
    }
</style>

<div class="gadget-box-wrapper">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo __('Détail de la demande des gadgets'); ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive-wrapper">
                <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <?php foreach ($echantillons as $key => $value) {
                                echo "<th>$value</th>";
                            } ?>                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalvertical=array();
                        foreach ($users as $user): 
                            $user['User1']=$user['User'];
                            $isSupervisor = ($user['User1']['role'] == "Super viseur");
                        ?>
                            <tr class="<?php echo $isSupervisor ? 'supervisor-row' : ''; ?>" <?php if($isSupervisor) echo 'style="font-weight: bold;"'; ?>>
                                <td><?php echo $this->Html->link($user['User1']['name'], array('controller' => 'users', 'action' => 'view', $user['User1']['id'])); ?></td>
                                <?php $total=0;
                                $i=0;
                                foreach ($echantillons as $key => $value)
                                {
                                    if(!isset($totalvertical[$i]))
                                       $totalvertical[$i]=0;
                                    $gadjets = $this->requestAction("/gadjets/system_get_quantite/".$user['User1']['id']."/$key");
                                    if(empty($gadjets))
                                        echo "<td>0</td>";
                                    else
                                    {
                                        $g=0;
                                        foreach ($gadjets as $gadjet) {
                                            $g=$g+$gadjet['Gadjet']['quantite'];
                                        }
                                        echo "<td>$g</td>";
                                        $total=$total+$g;
                                        $totalvertical[$i]=$totalvertical[$i]+$g;
                                    }
                                    $i++;
                                } ?>  
                            </tr>
                        <?php endforeach; ?>
                        
                        <tr class="table-total-row">
                            <td>Total</td>
                            <?php foreach ($totalvertical as $key => $value)
                                echo "<td>$value</td>"
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?php echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>
<script>
    $(function () {
        $('#reservationtime').daterangepicker({
            format: 'MM/DD/YYYY',
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
            }
        });
    });
</script>