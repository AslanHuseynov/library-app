<?php

      require("pro/database.php");
      $id = $_GET['id'] ? intval($_GET['id']) : 0;

      try {
          $sql = "SELECT * FROM books WHERE id = :id LIMIT 1";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":id", $id, PDO::PARAM_INT);
          $stmt->execute();

      } catch (\Exception $e) {
        echo "Error" . $e->getMessage();
        exit();
      }

      if (!$stmt->rowCount()) {
        header("Location: index.php");
        exit();
      }
      $books = $stmt->fetch();



 ?>


<?php include("pro/header.php") ?>
  <div class="container">
    <a href="index.php" class="btn btn-light mb-3"><< Back</a>
    <!-- Show  a Book -->
      <div class="card border-danger">
          <div class="card-header bg-danger text-white">
              <strong><i class="fa fa-book"></i> More Information</strong>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-9">
                      <table class="table table-bordered table-striped">
                          <tr>
                              <th>Book's Name</th>
                              <td><?= $books['b_name'] ?></td>
                              <th>Price</th>
                              <td>₾<?= number_format($books['price'], 2) ?></td>
                          </tr>
                          <tr>
                              <th>Author Name</th>
                              <td><?= $books['auth_name'] ?></td>
                          </tr>
                          <tr>
                              <th>Biography</th>
                              <td colspan="3"><?= $books['bio'] ?></td>
                          </tr>
                      </table>
                  </div>
                  <div class="col-3">
                      <img src="images/<?= $books['img'] ?>" alt="<?= $books['b_name'] ?>" class="img-fluid img-thumbnail">
                  </div>
              </div>
          </div>
      </div>
      <!-- End Show a product -->
      <br>
  </div><!-- /.container -->
<?php include("pro/footer.php") ?>
