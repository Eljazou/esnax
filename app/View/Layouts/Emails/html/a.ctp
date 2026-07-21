<h1 align="center">CRM VMP Rapport de la semaine </h1>
<table border="solid 2px" align="center" style="text-align:center;width:auto;height:auto;">
    <tbody><tr>
            <th>User</th>
            <th>Client</th>
            <th>Commentaire</th>
            <th>Objection</th>
            <th>Veille</th>
            <th>Date</th>
        </tr>
        <?php foreach ($visites as $value) : ?>
            <tr>
                <td><?php echo $value['User']['name'] ?></td>
                <td>
                    <?php
                        echo $value['Client']['nom'].' '.$value['Client']['prenom'];
                    ?>
                </td>
                <td><?php echo $value['Visite']['commentaire'] ?></td>
                <td><?php echo $value['Visite']['objection'] ?></td>
                <td><?php echo $value['Visite']['veille'] ?></td>
                <td><?php echo $value['Visite']['date'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody></table>
	<br><br><br> pour désinscription de notre listing merci de cliquer sur ce lien <a href="https://proveille.com/users/desanscription/"</a>