<html>
    <head>
        <link rel="stylesheet" href="/styles/style.css">
    </head>
    <body>

        <?php

$servername="localhost";
$username="root";
$spassword="";
$bdname="products";
$connexion=mysqli_connect($servername,$username,$spassword,$bdname);
if(!$connexion){
    die("connection failed: ". mysqli_connect_error());}
else{
    echo "connexionn OK"; echo "<br>";
}
if (isset($_GET['Code_Prod'])) {
  $Code_Prod = $_GET['Code_Prod'];
  $resultat = mysqli_query($connexion, "SELECT * FROM stk WHERE Code_Prod=$Code_Prod");
  
  if (mysqli_num_rows($resultat) > 0) {
      $sql = "DELETE FROM stk WHERE Code_Prod = $Code_Prod";
      
      if (mysqli_query($connexion, $sql)) {
          echo "La donnée a été supprimée avec succès de la base de données.";
          
          $sql = "SET @decrement := 0";
          mysqli_query($connexion, $sql);
          
          $sql = "UPDATE stk SET id = (@decrement:=@decrement+1)";
          mysqli_query($connexion, $sql);
          
          $sql = "ALTER TABLE stk AUTO_INCREMENT = 1";
          mysqli_query($connexion, $sql);
          
          header("Location: list.php");
      } else {
          echo "Erreur: " . mysqli_error($connexion);
      }
  } else {
      echo "Le code produit saisi n'existe pas dans la table stk.";
  }

  mysqli_close($connexion);
}
?>
</body>
