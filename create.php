<?php include("pro/header.php") ?>
  <div class="container">
    <a href="index.php" class="btn btn-light mb-3"> << Back</a>

    <?php if (isset($_GET['status']) && $_GET['status'] == "created") : ?>
    <div class="alert alert-success" role="alert">
          <strong>The operation was completed successfully!</strong>
    </div>
    <?php endif ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == "fail_create") : ?>
    <div class="alert alert-danger" role="alert">
          <strong>Something is wrong! Please create again.!</strong>
    </div>
    <?php endif ?>

    <!-- Create Form -->
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <strong><i class="fa fa-plus"></i> Add New Book</strong>
        </div>
        <div class="card-body">
            <form action="add.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="b_name" class="col-form-label">Book's Name</label>
                        <input type="text" class="form-control" id="b_name" name="b_name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price" class="col-form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="img" class="col-form-label">Image</label>
                        <input type="file" class="form-control" id="img" name="img" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="auth_name" class="col-form-label">Author Name</label>
                        <input type="text" class="form-control" name="auth_name" id="auth_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bio" class="col-form-label">Biography</label>
                    <textarea name="bio" id="" rows="5" class="form-control" placeholder="Type something about the author..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Add Book</button>
            </form>
        </div>
    </div>
    <!-- End create form -->
    <br>
  </div><!-- /.container -->
<?php include("pro/footer.php") ?>
