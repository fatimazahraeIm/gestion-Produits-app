<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-details img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .product-details table {
            width: 100%; 
            table-layout: auto; 
            border-collapse: collapse;
        }

        .product-details th, .product-details td {
            text-align: left;
            padding: 12px;
            word-wrap: break-word;
            border-bottom: 1px solid #ddd; 
        }

        .product-details th {
            background-color: #0000FF;
            color: white;
            font-weight: bold;
            width: 30%; 
        }

        .product-details td {
            width: 70%; 
        }

        .product-details tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .product-details tr:hover {
            background-color: #f1f1f1;
        }

        .text-green {
            color: black;
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
    <div class="container">
        <h1>Détails du Produit</h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "products";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $code_prod = isset($_GET['Code_Prod']) ? $_GET['Code_Prod'] : '';
        $sql = "SELECT * FROM stk WHERE Code_Prod = '$code_prod'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo '<div class="product-details">';
            echo '<img src="uploads/' . $row["imagep"] . '" alt="Product Image">';
            echo '<table>';
            echo '<tr><th>ID</th><td class="text-green">' . $row["id"] . '</td></tr>';
            echo '<tr><th>Code Produit</th><td class="text-green">' . $row["Code_Prod"] . '</td></tr>';
            echo '<tr><th>Désignation</th><td class="text-green">' . $row["Prod_Designiation"] . '</td></tr>';
            echo '<tr><th>Prix A</th><td class="text-green">' . $row["Prod_Prix_A"] . '</td></tr>';
            echo '<tr><th>Marge</th><td class="text-green">' . $row["Prod_Marge"] . '</td></tr>';
            echo '<tr><th>Quantité en Stock</th><td class="text-green">' . $row["Prod_Quantity_St"] . '</td></tr>';
            echo '<tr><th>Seuil</th><td class="text-green">' . $row["Prod_Sueuil"] . '</td></tr>';
            echo '<tr><th>Fournisseur</th><td class="text-green">' . $row["ID_Fournisseur"] . '</td></tr>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p style="text-align: center;">Aucun détail trouvé pour ce produit.</p>';
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>