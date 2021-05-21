<?php
require("pro/database.php");

if (isset($_GET['id'])) {
  // Delete record
  try {
    // SQL Statement
    $sql = 'DELETE FROM books WHERE id = :id LIMIT 1';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount()) {
      header("Location: index.php?status=deleted");
      exit();
    }
    header("Location: index.php?status=fail_delete");
    exit();
    
  } catch (\Exception $e) {
    echo "Error" . $e->getMessage();
    exit();
  }

} else {
  // Redirect to index.php
  header("Location: index.php?status=fail_delete");
  exit();
}


 ?>
