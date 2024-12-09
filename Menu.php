<style>
  .menu-container {
    display: flex;
    justify-content: space-around; 
    align-items: center;
    width: 100%; 
    padding: 20px 0; 
  }

  a {
    position: relative; 
  }
  a:after {
    content: '';
    display: block; 
    width: 0;
    height: 2px;
    left: 0;
    background-color: red;
    position: absolute;
    transition: width 0.5s; 
  }
  a:hover:after {
    width: 100%; 
  }

  .image {
    width: 40px; 
    height: 40px; 
    border-radius: 20%; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    transition: transform 0.3s, box-shadow 0.3s; 
  }

  .image:hover {
    transform: scale(1.2); 
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);  
  }
</style>

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

<body>
  <div class="menu-container">
    <a href="list.php?lg=<?= $lg ?>" title="<?= TABLE_TITLE ?>" target="aff"><img src="img/list.png" alt="Image" class="image"></a>
    <a href="add.php?lg=<?= $lg ?>" title="<?= ajout ?>" target="aff"><img src="img/ajout.png" alt="Image" class="image"></a>
    <a href="search.php?lg=<?= $lg ?>" title="<?= RECHERCHE_TITRE ?>" target="aff"><img src="img/rechercher.png" alt="Image" class="image"></a>
    <a href="Quit.php?lg=<?= $lg ?>" title="<?= quitter ?>" target="aff"><img src="img/Quitter.png" alt="Image" class="image"></a>
  </div>
</body>