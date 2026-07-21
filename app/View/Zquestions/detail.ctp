<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<style>
    .mb-2 {
        margin-bottom: 20px;
    }
</style>



<section class="content">

    <div class="box">
        <div class="box-body">
            <div class="row">
            <?php 
			$chifre=$label="";
			foreach ($stats as  $key=>$value)
			{
				$chifre="$chifre,$value";
				$label="$label,'$key'";
			}
			$chifre = trim($chifre, ",");
			$label = trim($label, ",");
				
			?>
                <div class="col-md-12">
                    <div id="chart" class=""></div>
                    <label for="chart"><?php echo $question["Zquestion"]["question"]; ?></label>
                    <script>
                        var options = {
                            series: [<?php echo $chifre; ?>],
                            chart: {
                                width: 600,
                                type: 'pie',
                            },
                            labels: [<?php echo $label; ?>],
                            responsive: [{
                                breakpoint: 380,
                                options: {
                                    chart: {
                                        width: 200
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();
                    </script>
                </div>
            </div>
        </div>
    </div>
	
	
	

</section>



<div class="row">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Liste des repenses </h3>

            </div>
                <div class="box-body">
                    <h3 class="box-title"><?php echo $question["Zquestion"]["question"]; ?></h3>
                    <table class="table table-bordered table-striped mytable">
                        <thead>
                            <tr>
                                
                                <th>Titre</th>
                                <th>sous titre</th>
                                <th>Question</th>
                                <th>Réponse</th>
								<th>Nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($questions as $question): $question=$question["Zquestion"]; ?>
                                <tr>
                                    
                                    <td><?php echo h($question['titre']); ?></td>
                                    <td><?php echo h($question['soustitre']); ?></td>
                                    <td><?php echo $question['question']; ?></td>
                                    <td><?php echo h($question['repense']); ?></td>
									<td><?php echo h($question['nom']); ?></td>
                                   
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </section>

</div>
