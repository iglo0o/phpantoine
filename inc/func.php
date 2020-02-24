<?php
function debug($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

function validText($errors,$value,$key,$min,$max,$empty = true)
{
  if(!empty($value)) {
    if(strlen($value) < $min) {
      $errors[$key] = 'Min '.$min.' caractères';
    } elseif(strlen($value) > $max) {
      $errors[$key] = 'Max '.$max.' caractères';
    }
  } else {
    if($empty) {
      $errors[$key] = 'Veuillez renseigner ce champ';
    }
  }
  return $errors;
}

function validEmail($errors,$value,$key,$empty = true)
{
  if(!empty($value)) {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $errors[$key] = 'E-mail invalide';
    }
  }else {
    if($empty) {
      $errors[$key] = 'Veuillez renseigner un E-mail';
    }
  }
  return $errors;
}
