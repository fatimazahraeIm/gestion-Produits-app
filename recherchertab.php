<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <style>
      body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
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

      .image {
        width: 30px;
        height: 30px;
        transition: transform 0.3s;
      }

      .image:hover {
        transform: scale(1.1);
      }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Résultats de la recherche</h2>
    <?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "products";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les paramètres de recherche
    $lg = isset($_GET['lg']) ? $_GET['lg'] : 'Ang';
    $code_prod = $_GET['Code_Prod'];
    $Prod_Designiation = $_GET['Prod_Designiation'];
    $Prod_Prix_A = $_GET['Prod_Prix_A'];
    $Prod_Marge = $_GET['Prod_Marge'];
    $Prod_Quantity_St = $_GET['Prod_Quantity_St'];
    $Prod_Seuil = $_GET['Prod_Seuil'];
    $ID_Fournisseur = $_GET['ID_Fournisseur'];

    // Construire la requête SQL
    $sql = "SELECT * FROM stk WHERE 1=1";
    if (!empty($code_prod)) $sql .= " AND Code_Prod LIKE '%$code_prod%'";
    if (!empty($Prod_Designiation)) $sql .= " AND Prod_Designiation LIKE '%$Prod_Designiation%'";
    if (!empty($Prod_Prix_A)) $sql .= " AND Prod_Prix_A LIKE '%$Prod_Prix_A%'";
    if (!empty($Prod_Marge)) $sql .= " AND Prod_Marge LIKE '%$Prod_Marge%'";
    if (!empty($Prod_Quantity_St)) $sql .= " AND Prod_Quantity_St LIKE '%$Prod_Quantity_St%'";
    if (!empty($Prod_Seuil)) $sql .= " AND Prod_Sueuil LIKE '%$Prod_Seuil%'";
    if (!empty($ID_Fournisseur)) $sql .= " AND ID_Fournisseur LIKE '%$ID_Fournisseur%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Code Produit</th><th>Désignation</th><th>Prix Achat</th><th>Marge</th><th>Quantité Stock</th><th>Seuil</th><th>ID Fournisseur</th><th>Image</th></tr>";
        while($row = $result->fetch_assoc()) {
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
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>Aucun résultat trouvé</p>";
    }

    $conn->close();
    ?>
</body>
</html>