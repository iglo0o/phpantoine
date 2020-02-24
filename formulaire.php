<?php
require('inc/func.php');
$title = 'Formulaire POST';
// Traitement du formulaire
$errors = array();
$success = false;
// if formulaire soumis ?
if(!empty($_POST['submitted'])) {
  // Faille XSS
  $nom     = trim(strip_tags($_POST['nom']));
  $prenom  = trim(strip_tags($_POST['prenom']));
  $email   = trim(strip_tags($_POST['email']));
  $message = trim(strip_tags($_POST['message']));
  $age     = trim(strip_tags($_POST['age']));
  $color   = trim(strip_tags($_POST['color']));
  // Validation
  // Validation nom
  $errors = validText($errors,$nom,'nom',3,100);
  $errors = validText($errors,$prenom,'prenom',2,70);
  $errors = validText($errors,$message,'message',10,500);
  // validation email
  $errors = validEmail($errors,$email,'email');

  // validation age
  if(!empty($age)) {
    if (filter_var($age, FILTER_VALIDATE_INT)) {
      if($age < 0) {
        $errors['age'] = 'Veuillez renseigner un age positif';
      } elseif($age > 130){
        $errors['age'] = 'Vous vous moquez de nous ?';
      }
    } else {
      $errors['age'] = 'Etrange !!!';
    }
  } else {
    $errors['age'] = 'Veuillez renseigner votre age';
  }
  // Validation color
  if(empty($color)) {
    $errors['color'] = 'Veuillez sélectionnez une couleur';
  }

  if(count($errors) == 0) {
    $success = true;
    // insertion en bdd
    // envoie email
    // redirection
  }

}
// debug($_POST);
// debug($errors);

include('inc/header.php'); ?>
<div class="wrapform">
  <?php if($success) {
    echo '<p>Bravo, Nous revenons vers vous dans les plus brefs délais.</p>';
  } else { ?>

  <form action="" method="post">
    <!-- nom -->
    <label for="nom">Nom *</label>
    <input type="text" name="nom" id="nom" value="<?php if(!empty($_POST['nom'])) {echo $_POST['nom']; } ?>">
    <p class="error"><?php if(!empty($errors['nom'])) {echo $errors['nom'];} ?></p>

    <!-- prenom -->
    <label for="prenom">Prénom *</label>
    <input type="text" name="prenom" id="prenom" value="<?php if(!empty($_POST['prenom'])) {echo $_POST['prenom']; } ?>">
    <p class="error"><?php if(!empty($errors['prenom'])) {echo $errors['prenom'];} ?></p>

    <!-- email => !!! changer le type to email !!!  -->
    <label for="email">E-mail *</label>
    <input type="email" name="email" id="email" value="<?php if(!empty($_POST['email'])) {echo $_POST['email']; } ?>">
    <p class="error"><?php if(!empty($errors['email'])) {echo $errors['email'];} ?></p>

    <!-- message  -->
    <label for="message">Message *</label>
    <textarea name="message" rows="8" cols="80"><?php if(!empty($_POST['message'])) {echo $_POST['message']; } ?></textarea>
    <p class="error"><?php if(!empty($errors['message'])) {echo $errors['message'];} ?></p>

    <!-- age -->
    <label for="age">Age *</label>
    <input type="number"  min="0" max="130" name="age" id="age" value="<?php if(!empty($_POST['age'])) {echo $_POST['age']; } ?>">
    <p class="error"><?php if(!empty($errors['age'])) {echo $errors['age'];} ?></p>

    <?php
    $couleurs = array('red' => 'Rouge','green'  => 'Vert','orange' => 'Orange', 'violet' => 'Violet','blue' => 'Bleu' );
    ?>
    <select name="color">
      <option value="">__ sélectionnez une couleur __</option>
      <?php foreach ($couleurs as $key => $value) { ?>
        <option value="<?= $key; ?>"<?php if(!empty($_POST['color'])) { if($_POST['color'] == $key) { echo ' selected="selected"'; }} ?>><?php echo $value; ?></option>
      <?php } ?>
    </select>
    <p class="error"><?php if(!empty($errors['color'])) {echo $errors['color'];} ?></p>

    <input type="submit" name="submitted" value="Envoyer">
  </form>

<?php } // end of $success ?>
</div>
<?php include('inc/footer.php');
