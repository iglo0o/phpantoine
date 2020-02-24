<?php
//bonjour michel
require('inc/func.php');
$title = 'Formulaire';
// Traitement du formulaire
debug($_GET);

include('inc/header.php'); ?>
<div class="wrap">
  <?php if(!empty($_GET['nom']) && !empty($_GET['prenom'])) {
    echo '<p>Bonjour ' . $_GET['nom'] . ' '.$_GET['prenom'].'</p>';
  } ?>

  <form action="" method="get">
    <label for="nom">Nom *</label>
    <input type="text" name="nom" id="nom" value="">

    <label for="prenom">Prenom *</label>
    <input type="text" name="prenom" id="prenom" value="">

    <input type="submit" name="submitted" value="envoyer">
  </form>


</div>
<?php include('inc/footer.php');
