<?php

extract($_GET);
require('project_connection.php');
try {
  $currentDateTime = new DateTime();
  $formattedDate = $currentDateTime->format('Y-m-d H:i:s');
  $sql = "INSERT INTO customer_support_messages (dateTime, name, email, phone, message, status ) VALUES (:datetime, :name, :email, :phone , :message , 'unread')";

  $stmt = $db->prepare($sql);
  $stmt->bindParam(':datetime', $formattedDate);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':message', $message);
  $stmt->execute();
  //make success and error modal displayed on support form
  header('Location:contact.php?msg=Message has been sent successfully');
} catch (PDOException $e) {
  echo $e->getMessage();
}
