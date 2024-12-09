<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Produit</title>
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
        include "constants/cstfr.php"; 
        $sens='LTR';
}
?>
<body>
<div class="container">
    <form method="POST" dir="<?php echo $sens; ?>" enctype="multipart/form-data">
        <h3><?php echo ajout ;?>:</h3>
        <label for="Code_Prod"><?php echo codeprod ;?>:</label>
        <input type="text" id="Code_Prod" name="Code_Prod" placeholder="<?php echo codeprod ;?>" autocomplete="off"><br><br>
        <label for="Prod_Designiation"><?php echo des ;?>:</label>
        <input type="text" id="Prod_Designiation" name="Prod_Designiation" placeholder="<?php echo des ;?>" autocomplete="off"><br><br>
        <label for="Prod_Prix_A"><?php echo prix ;?>:</label>
        <input type="text" id="Prod_Prix_A" name="Prod_Prix_A" placeholder="<?php echo prix ;?>" autocomplete="off"><br><br>
        <label for="Prod_Marge"><?php echo mar ;?>:</label>
        <input type="text" id="Prod_Marge" name="Prod_Marge" placeholder="<?php echo mar ;?>" autocomplete="off"><br><br>
        <label for="Prod_Quantité_St"><?php echo qua ;?>:</label>
        <input type="text" id="Prod_Quantité_St" name="Prod_Quantité_St" placeholder="<?php echo qua ;?>" autocomplete="off"><br><br>
        <label for="Prod_Sueuil"><?php echo seu ;?>:</label>
        <input type="text" id="Prod_Sueuil" name="Prod_Sueuil" placeholder="<?php echo seu ;?>" autocomplete="off"><br><br>
        <label for="ID_Fournisseur"><?php echo fou ;?>:</label>
        <input type="text" id="ID_Fournisseur" name="ID_Fournisseur" placeholder="<?php echo fou ;?>" autocomplete="off"><br><br>
        <label for="image"><?php echo img ;?>:</label>
        <input type="file" name="image" id="image"><br><br>
        <div class="button-container">
            <input type="submit" class="button" name="submit_btn" value="<?php echo val ;?>">
            <input type="reset" class="button" name="reset_btn" value="<?php echo ini ;?>">
        </div>
    </form>
</div>

<?php

$servername = "localhost";
$username = "root";
$spassword = "";
$bdname = "products";
$connexion = mysqli_connect($servername, $username, $spassword, $bdname);
if (!$connexion) {
    die("connection failed: " . mysqli_connect_error());
} else {
    echo "connexionn OK"; echo "<br>";
}
if (isset($_POST['Code_Prod']) and isset($_POST['Prod_Designiation']) and isset($_POST['Prod_Marge']) and isset($_POST['Prod_Quantité_St']) and isset($_POST['Prod_Sueuil']) and isset($_POST['ID_Fournisseur'])) {
    $Code_Prod = $_POST['Code_Prod'];
    $Prod_Designiation = $_POST['Prod_Designiation'];
    $Prod_Prix_A = $_POST["Prod_Prix_A"];
    $Prod_Marge = $_POST["Prod_Marge"];
    $Prod_Quantity_St = $_POST['Prod_Quantité_St'];
    $Prod_Seuil = $_POST['Prod_Sueuil'];
    $ID_Fournisseur = $_POST['ID_Fournisseur'];
    $imgName = $_FILES['image']['name']; 
    $imgTmp = $_FILES['image']['tmp_name']; 

    $extension = strtolower(pathinfo($imgName, PATHINFO_EXTENSION)); 
    $imgNewName = $Code_Prod . "." . $extension; 
    $directory = 'uploads/' . $imgNewName;
    move_uploaded_file($imgTmp, $directory);

    $sql = "INSERT INTO stk (Code_Prod, Prod_Designiation, Prod_Prix_A, Prod_Marge, Prod_Quantity_St, Prod_Sueuil, ID_Fournisseur, imagep)
            VALUES ('$Code_Prod', '$Prod_Designiation', '$Prod_Prix_A','$Prod_Marge','$Prod_Quantity_St','$Prod_Seuil','$ID_Fournisseur','$imgNewName')";

    if (mysqli_query($connexion, $sql)) {
        echo "Les données ont été ajoutées avec succès à la base de données.";
    } else {
        echo "Erreur: " . mysqli_error($connexion);
    }

    mysqli_close($connexion);
}
?>

</body>
</html>