<?php echo $this->Html->css('dataTables.bootstrap');
?>	
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Rapports'); ?></h3>
        <?php if ($this->requestAction('/droits/getrole/rapports/add') == 1)
            echo $this->Html->link(__('Ajouter'), array('action' => 'add'), array('class' => "btn bg-purple btn-flat", 'style' => "float:right;"));
        ?>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>

                    <th>VMP</th>
                    <th>Nom du client</th>
                    <th>Détail visite</th>
                    
                </tr>
            </thead>
            <?php 
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');$i=0;
                foreach ($visites as $visite): ?>
                <tr>
               
                    <td><?php echo $visite['u']['name']; ?></td>
                    <td><?php echo $visite['c']['nom']." ".$visite['c']['prenom']; ?></td>
                    <td>
					 <b class="word<?php echo $i; $i++;?>" style="width:100%;float:left;font-size:14px;font-weight:normal;padding:5px 3px;border-bottom: 1px dashed #e0e0e0;"> <small style="float:left;width: 89px;font-weight:bold;font-size: 13px;line-height: 19px;">Commentaire : </small><?php echo $visite['v']['commentaire']; ?> </b>
					 <b class="word<?php echo $i; $i++;?>" style="width:100%;float:left;font-size:14px;font-weight:normal;padding:5px 3px;border-bottom: 1px dashed #e0e0e0;"><small style="float:left;width: 89px;font-weight:bold;font-size: 13px;line-height: 19px;">Objection : </small><?php echo $visite['v']['objection']; ?> </b>
					 <b class="word<?php echo $i; $i++;?>" style="width:100%;float:left;font-size:14px;font-weight:normal;padding:5px 3px;"><small style="float:left;width: 89px;font-weight:bold;font-size: 13px;line-height: 19px;">Veille : </small><?php echo $visite['v']['veille']; ?> </b>
					</td>
                </tr>
            <?php //$i++; 
			endforeach;?>
        </table>
    </div>
</div>
<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script>
    $(function () {
        $('#example1, #example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    });
	$(document).ready(function(){
		const words = ['<?php echo $mot; ?>']
		for(i=0; i<<?php echo $i; ?>; i++){
			const p = document.querySelector('.word'+i)
			var newHTML = p.innerHTML
			newHTML = newHTML.toLowerCase()
			words.forEach(word=>
				newHTML = newHTML.replace(word, '<span style="color:#f91515;font-weight:bold;font-size:16px;"><?php echo $mot; ?></span>')
			)
			p.innerHTML = newHTML
		}
	});
</script>