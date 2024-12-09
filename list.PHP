<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produits</title>
    <style>
      body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
      }

      a {
        margin-right: 10px;
        position: relative;
        text-decoration: none;
        color: #333;
      }

      a:after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background-color: red;
        position: absolute;
        left: 0;
        transition: width 0.3s;
      }

      a:hover:after {
        width: 100%;
      }

      .image {
        width: 30px;
        height: 30px;
        transition: transform 0.3s;
      }

      .image:hover {
        transform: scale(1.1);
      }

      table {
        border-collapse: collapse;
        width: 80%;
        margin: 50px auto;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
      }

      th, td {
        text-align: left;
        padding: 12px;
      }

      th {
        background-color: #0000FF;
        color: white;
        font-weight: bold;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      tr:hover {
        background-color: #f1f1f1;
      }

      form {
        margin-top: 50px;
      }

      .action-icons img {
        width: 25px;
        height: 25px;
        margin-right: 5px;
        transition: transform 0.3s;
      }

      .action-icons img:hover {
        transform: scale(1.2);
      }
    </style>
  </head>
  <body>
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
            include "cstfr.php"; // Langue par défaut : Français
            $sens='LTR';
    }
  ?>
  <?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "products";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Vérification de la connexion
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Requête SQL pour récupérer toutes les données de la table "products"
    $sql = "SELECT * FROM stk ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    // Affichage des données récupérées

    if (mysqli_num_rows($result) > 0) {
      echo "<form>";
      echo '<table>';
      echo '<tr><th>'.ID.'</th><th>' . CODE_PROD . '</th><th>' . DESIGNATION . '</th><th>' . PRIX_A . '</th><th>' . MARGE . '</th><th>' . QUANTITE_STOCK . '</th><th>' . SEUIL . '</th><th>' . ID_FOURNISSEUR .'</th><th>' . IMAGE . '</th><th>' . ACTION . '</th></tr>';
      
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["Code_Prod"] . "</td>";
        echo "<td>" . $row["Prod_Designiation"] . "</td>";
        echo "<td>" . $row["Prod_Prix_A"] . "</td>";
        echo "<td>" . $row["Prod_Marge"] . "</td>";
        echo "<td>" . $row["Prod_Quantity_St"] . "</td>";
        echo "<td>" . $row["Prod_Sueuil"] . "</td>";
        echo "<td>" . $row["ID_Fournisseur"] . "</td>";
        echo '<td><img src="uploads/' . $row["imagep"] . '" width="30" height="30" alt="Product Image" class="image"></td>';
        echo '<td class="action-icons">
                <a href="delete.php?Code_Prod=' . $row["Code_Prod"] . '" title="' . SUPPRIMER . '" target="aff"><img src="img/dell.png" alt="Supprimer"></a>
                <a href="modify.php?Code_Prod=' . $row["Code_Prod"].'&lg='.$lg.'" title="' . MODIFIER . '" target="aff"><img src="img/modification.png" alt="Modifier"></a>
                <a href="details.php?Code_Prod=' . $row["Code_Prod"].'&lg='.$lg.'" title="' . DETAILS . '" target="aff"><img src="img/details.png" alt="Détails"></a>
              </td>';
        echo "</tr>";
      }
      echo "</table>";
      echo "</form>";
    }
    else {
        echo NO_RESULT;
    }
    ?>
  </body>
</html>