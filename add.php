<?php
require("pro/database.php");

if ($_POST) {
  $b_name = trim($_POST['b_name']);
  $price = (float)$_POST['price'];
  $img = trim($_FILES['img']['name']);
  $auth_name = trim($_POST['auth_name']);
  $bio = trim($_POST['bio']);

  $imageDir = __DIR__ . '/images/';
  $targetFile = $imageDir . basename($_FILES['img']['name']);

  if (getimagesize($_FILES['img']['tmp_name']) !== false) {
    if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {

    } else {
      echo "file could not be uploaded";
    }
  } else {
    echo "Something is wrong";
    die;
  }

  try {
    $sql = 'INSERT INTO books(b_name, price, img, auth_name, bio)
            VALUES(:b_name, :price, :img, :auth_name, :bio)';

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":b_name", $b_name);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":img", $img);
    $stmt->bindParam(":auth_name", $auth_name);
    $stmt->bindParam(":bio", $bio);
    $stmt->execute();
    if ($stmt->rowCount()) {
      header("Location: create.php?status=created");
      exit();
    }
      header("Location: create.php?status=fail_create");
      exit();
  } catch (\Exception $e) {
      echo "Error" . $e->getMessage();
      exit();
  }

}  else {
  header("Location: create.php?status=fail_create");
  exit();
}


 ?>
