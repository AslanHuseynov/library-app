<?php
require("pro/database.php");

if ($_POST) {
  $id = (int) $_POST['id'];
  $b_name = trim($_POST['b_name']);
  $price = (float)$_POST['price'];
  $img = trim($_POST['img']);
  $auth_name = trim($_POST['auth_name']);
  $bio = trim($_POST['bio']);

  try {
    $sql = 'UPDATE books
              SET b_name= :b_name, price= :price, img= :img, auth_name= :auth_name, bio= :bio
            WHERE id = :id';

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":b_name", $b_name);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":img", $img);
    $stmt->bindParam(":auth_name", $auth_name);
    $stmt->bindParam(":bio", $bio);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
      header("Location: edit.php?id=".$id."&status=updated");
      exit();
    }
      header("Location: edit.php?id=".$id."&status=fail_update");
      exit();
  } catch (\Exception $e) {
      echo "Error" . $e->getMessage();
      exit();
  }

}  else {
  header("Location: edit.php?id=".$id."&status=fail_update");
  exit();
}


 ?>
