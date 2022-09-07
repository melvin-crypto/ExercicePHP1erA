<!DOCTYPE html>
<?php
include 'cnx.php';
session_start();
$sql = $cnx->prepare("select nom,prenom from controleur where id=".$_GET['numControleur']);
$sql->execute();
$row = $sql->fetchAll(PDO::FETCH_ASSOC);
$nomControleur = $row[0]['nom'];
$prenomControleur = $row[0]['prenom'];
$_SESSION['numControleur'] = $_GET['numControleur'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion EDF</title>
         <script src="../JQuery/JQuery 3.5.1.js"></script>
        <script src="../Bootstrap/js/bootstrap.min.js"></script>
        <script src="../Bootstrap/js/bootstrap.js"></script>
        <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    </head>
    <body>
        <p class="h1 text-danger text-center">Liste des clients du contrôleur <?php echo $nomControleur . " - " . $prenomControleur ;?></p>
        <br>
        <a class="btn btn-primary" href="../index.php">Home</a>
        <br><br>
        <table class="table table-striped">
            <?php
                $sql = $cnx->prepare("select identifiant,nom,prenom, ancienreleve,dernierreleve from client where idControleur=".$_GET['numControleur']);
                $sql->execute();
                foreach ($sql->fetchAll(PDO::FETCH_NUM) as $row)
                {
            ?>
                <tr>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo "<a href='NouveauReleve.php?numClient=".$row[0]."'>Nouveau releve</a>" ?></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </body>
</html>
