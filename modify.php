<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de Produit</title>
    <style>
      body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
      }

      .container {
        width: 60%;
        margin: 50px auto;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        padding: 20px;
      }

      h3 {
        text-align: center;
        color: #333;
      }

      label {
        display: inline-block;
        width: 150px;
        margin-bottom: 10px;
        color: #333;
      }

      input[type="text"], input[type="file"], textarea {
        width: calc(100% - 170px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-family: inherit;
        font-size: 16px;
      }

      .button-container {
        display: flex;
        justify-content: space-between;
      }

      input[type="submit"], input[type="reset"] {
        background-color: #0000FF;
        color: white;
        padding: 8px 16px; 
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px; 
        transition: background-color 0.3s;
        width: 48%; 
        height: 40px; 
      }

      input[type="submit"]:hover, input[type="reset"]:hover {
        background-color: #45a049;
      }
    </style>
</head>
<?php 
$lg = isset($_GET['lg']) ? $_GET['lg'] : 'Ang';
switch ($lg) {
    case 'Mr':
        include "constants/cstmr.php";
        $sens='RTL';
        break;
    case 'Fr':
        include "constants/cstfr.php";
        $sens='LTR';
        break;
    case 'Ang':
        include "constants/cstang.php";
        $sens='LTR';
        break;
    case 'Esp':
        include "constants/cstesp.php";
        $sens='LTR';
        break;
    default:
        include "constants/cstfr.php"; // Langue par défaut : Français
        $sens='LTR';
}
?>
<body>
<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";

// Créer une connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des nouvelles données
    $code_prod = $_POST["code_prod"];
    $nouvelle_designation = $_POST["nouvelle_designation"];
    $nouveau_prix = $_POST["nouveau_prix"];
    $nouvelle_marge = $_POST["nouvelle_marge"];
    $nouvelle_quantite = $_POST["nouvelle_quantite"];
    $nouveau_seuil = $_POST["nouveau_seuil"];
    $nouveau_fournisseur = $_POST["nouveau_fournisseur"];

    // Mettre à jour les données dans la base de données
    $sql = "UPDATE stk SET Prod_Designiation='$nouvelle_designation', Prod_Prix_A='$nouveau_prix', Prod_Marge='$nouvelle_marge', Prod_Quantity_St='$nouvelle_quantite', Prod_Sueuil='$nouveau_seuil', ID_Fournisseur='$nouveau_fournisseur' WHERE Code_Prod='$code_prod'";

    if (mysqli_query($conn, $sql)) {
        echo "Les données ont été mises à jour avec succès.";
        // Redirection vers la page de liste
        header("Location: list.php");
        
    } else {
            echo "Erreur: " . mysqli_error($connexion);
        
    }
}

// Vérifier si le paramètre Code_Prod existe dans l'URL
if (isset($_GET['Code_Prod'])) {
    $Code_Prod = $_GET['Code_Prod'];

    // Récupérer les données de la ligne correspondante
    $sql = "SELECT * FROM stk WHERE Code_Prod = '$Code_Prod'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nouvelle_designatio = $row["Prod_Designiation"];
        $nouveau_pri = $row["Prod_Prix_A"];
        $nouvelle_marg= $row["Prod_Marge"];
        $nouvelle_quantit = $row["Prod_Quantity_St"];
        $nouveau_seui = $row["Prod_Sueuil"];
        $nouveau_fournisseu = $row["ID_Fournisseur"];
    } else {
        echo "Aucune donnée trouvée pour le code produit : " . $Code_Prod;
    }
}
?>

<div class="container">
    <form method="post" dir="<?php echo $sens; ?>" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <h3><?php echo MODIFIER_DONNEES; ?></h3>
        <label for="code_prod"><?php echo CODE_PROD; ?>:</label>
        <input type="text" id="code_prod" value="<?php echo $Code_Prod; ?>" name="code_prod" readonly><br><br>
        <label for="nouvelle_designation"><?php echo NOUVELLE_DESIGNATION; ?>:</label>
        <input type="text" id="nouvelle_designation" name="nouvelle_designation" value="<?php echo isset($nouvelle_designatio) ? $nouvelle_designatio : ''; ?>"><br><br>
        <label for="nouveau_prix"><?php echo NOUVEAU_PRIX; ?>:</label>
        <input type="text" id="nouveau_prix" name="nouveau_prix" value="<?php echo isset($nouveau_pri) ? $nouveau_pri : ''; ?>"><br><br>
        <label for="nouvelle_marge"><?php echo NOUVELLE_MARGE; ?>:</label>
        <input type="text" id="nouvelle_marge" name="nouvelle_marge" value="<?php echo isset($nouvelle_marg) ? $nouvelle_marg : ''; ?>"><br><br>
        <label for="nouvelle_quantite"><?php echo NOUVELLE_QUANTITE; ?>:</label>
        <input type="text" id="nouvelle_quantite" name="nouvelle_quantite" value="<?php echo isset($nouvelle_quantit) ? $nouvelle_quantit : ''; ?>"><br><br>
        <label for="nouveau_seuil"><?php echo NOUVEAU_SEUIL; ?>:</label>
        <input type="text" id="nouveau_seuil" name="nouveau_seuil" value="<?php echo isset($nouveau_seui) ? $nouveau_seui : ''; ?>"><br><br>
        <label for="nouveau_fournisseur"><?php echo NOUVEAU_FOURNISSEUR; ?>:</label>
        <input type="text" id="nouveau_fournisseur" name="nouveau_fournisseur" value="<?php echo isset($nouveau_fournisseu) ? $nouveau_fournisseu : ''; ?>"><br><br>
        <div class="button-container">
            <input type="submit" class="button" name="submit_btn" value="<?php echo MODIFIER; ?>">
            <input type="reset" class="button" name="reset_btn" value="<?php echo ini ;?>">
        </div>
    </form>
</div>

</body>
</html>