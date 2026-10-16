<?php
  if ( $_POST ) {

    $recepient = 'przemek@qamitech.pl'; // your e-mail
    $sitename  = 'Qamitech'; // your site name
    $subject   = "Wiadomość ze strony \"$sitename\""; // subject template

    $name      = trim( $_POST['visitor_name'] );
    $surname   = trim( $_POST['visitor_surname'] );
    $email     = trim( $_POST['visitor_email'] );
    $phone     = trim( $_POST['visitor_phone'] );
    $msg       = trim( $_POST['visitor_msg'] );

    $message = "
    -------------------<br><br>
    Imię:      $name <br>
    Nazwisko:  $surname <br>
    Email:     $email <br>
    Telefon:   $phone <br>
    Wiadomość: $msg <br><br>

    <br><br>-------------------
    ";

    mail( 
      $recepient, $subject, $message, 
      "From: $name <$email>" . "\r\n" . "Reply-To: $email" . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'Content-type: text/html; charset="utf-8"' );
  }
