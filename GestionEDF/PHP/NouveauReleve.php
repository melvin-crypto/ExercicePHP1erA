<?php
session_start();
include 'cnx.php';
$erreur = 0;
if(!isset($_GET['btnInserer']))
{
    $sql = $cnx->prepare("select identifiant,nom,prenom, ancienreleve,dernierreleve from client where identifiant=".$_GET['numClient']);
    $sql->execute();
    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
    $idClient = $row[0]['identifiant'];
    $nomClient = $row[0]['nom'];
    $prenomClient = $row[0]['prenom'];
    $ancien = $row[0]['ancienreleve'];
    $dernier = $row[0]['dernierreleve'];
    $_SESSION['id'] = $row[0]['identifiant'];
    $_SESSION['nom'] = $row[0]['nom'];
    $_SESSION['prenom'] = $row[0]['prenom'];
    $_SESSION['ancien'] = $row[0]['ancienreleve'];
    $_SESSION['dernier'] = $row[0]['dernierreleve'];
}
 else
{
     if($_GET['txtNouveauReleve'] == "")
     {
        $erreur = 1;
        $message = "Le nouveau relevé ne peut-être vide";
     }
     else
     {
        if(intval($_GET['txtNouveauReleve']) < intval($_SESSION['dernier'])) 
        
        {
           $erreur = 1;
           $message = "Le nouveau relevé ne peut-être inférieur au dernier";
        }
        else
        {
            // Tout est ok
            $sql = $cnx->prepare("update client set ancienreleve = ".$_SESSION['dernier'].", dernierreleve = ".$_GET['txtNouveauReleve']." where identifiant = ".$_SESSION['id']);
            $sql->execute();
            header('Location:LesClients.php?numControleur='.$_SESSION['numControleur']);
        }
     }
}
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
        <?php
            if ($erreur==1)
            {
                echo("
                <div class=\"alert alert-warning\">".$message."</div>");
            }
        ?>
        <form action="NouveauReleve.php" method="get">
            <div class="col-md-3">
                <h1 class="col-md-12 text-center text-danger">Nouveau releve</h1><br>
                <label>Nom du client</label>
                <input class="form-control" disabled="disabled" type="text" id="txtNom" value="<?php echo $_SESSION['nom'] ;?>"><br>
                <label>Prenom du client</label>
                <input class="form-control" disabled="disabled" type="text" id="txtPrenom" value="<?php echo $_SESSION['prenom'] ;?>"><br>
                <label>Ancien releve</label>
                <input class="form-control" disabled="disabled" type="text" id="txtAncienReleve" value="<?php echo $_SESSION['ancien'] ;?>"><br>
                <label>Dernier releve</label>
                <input class="form-control" disabled="disabled" type="text" id="txtDernierReleve" value="<?php echo $_SESSION['dernier'] ;?>"><br>
                <label>Nouveau releve</label>
                <input class="form-control" type="text" name="txtNouveauReleve" id="txtNouveauReleve"><br>
                <button class="btn btn-success col-md-12 form-control" name="btnInserer" value="Inserer">Inserer</button><br><br>
            </div>
        </form>
    </body>
</html>

