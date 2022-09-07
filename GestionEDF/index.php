<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion EDF</title>
         <script src="./JQuery/JQuery 3.5.1.js"></script>
        <script src="./Bootstrap/js/bootstrap.min.js"></script>
        <script src="./Bootstrap/js/bootstrap.js"></script>
        <link href="./Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./Bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    </head>
    <body>
        <p class="h1 text-danger text-center">Liste des contrôleurs</p>
        <table class="table table-striped">
            <?php
                include './PHP/cnx.php';
                $sql=$cnx->prepare("SELECT id, nom,prenom from controleur");
                $sql->execute();
		foreach($sql->fetchAll(PDO::FETCH_NUM)as $row)
                {
            ?>
            <tr>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo "<a href='PHP/LesClients.php?numControleur=".$row[0]."'>Tous les clients</a>" ?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </body>
</html>
