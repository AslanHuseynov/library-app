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

    <a href="index.php" class="btn btn-light mb-3"> << Back</a>

    <?php if (isset($_GET['status']) && $_GET['status'] == "updated") : ?>
    <div class="alert alert-success" role="alert">
          <strong>The operation was completed successfully!</strong>
    </div>
    <?php endif ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == "fail_update") : ?>
    <div class="alert alert-danger" role="alert">
          <strong>Something is wrong! Please edit again.!</strong>
    </div>
    <?php endif ?>

    <!-- Create Form -->
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <strong><i class="fa fa-edit"></i> Edit Info About Book</strong>
        </div>
        <div class="card-body">
            <form action="update.php" method="post">
              <input type="hidden" name="id" value="<?= $books['id'] ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="b_name" class="col-form-label">Book's Name</label>
                        <input type="text" class="form-control" id="b_name" name="b_name" value="<?= $books['b_name'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price" class="col-form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required value="<?= $books['price'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="img" class="col-form-label">Image</label>
                        <input type="file" class="form-control" id="img" name="img" required value="<?= $books['img'] ?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="auth_name" class="col-form-label">Author Name</label>
                        <input type="text" class="form-control" name="auth_name" id="auth_name" required value="<?= $books['auth_name'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="bio" class="col-form-label">Biography</label>
                    <textarea name="bio" id="" rows="5" class="form-control" placeholder="Type something about the author..." required><?= $books['bio'] ?></textarea>
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Edit</button>
            </form>
        </div>
    </div>
    <!-- End create form -->
    <br>

  </div><!-- /.container -->
<?php include("pro/footer.php") ?>
