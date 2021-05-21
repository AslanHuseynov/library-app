  <?php

     require("pro/database.php");

     try {

       $sql = "SELECT * FROM books";
       $author = $_GET['author'] ?? null;
       if ($author) {
         $sql .= " WHERE auth_name like '%$author%'";
       }
       $result = $conn->query($sql);

     } catch (\Exception $e) {
       echo "Error" . $e->getMessage();
       exit();
     }


    ?>

  <?php include("pro/header.php") ?>
    <div class="container">

      <?php if (isset($_GET['status']) && $_GET['status'] == "deleted") : ?>
      <div class="alert alert-success" role="alert">
            <strong>The book has been successfully deleted!</strong>
      </div>
      <?php endif ?>
      <?php if (isset($_GET['status']) && $_GET['status'] == "fail_delete") : ?>
      <div class="alert alert-danger" role="alert">
            <strong>Something is wrong! Please try again.!</strong>
      </div>
      <?php endif ?>

      <!-- Table Product -->
      <div class="card border-danger">
          <div class="card-header bg-danger text-white">
          <form class="form-inline my-2 my-lg-0" action="/library-app/index.php" method="get">
              <input name="author" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              <input type="submit" value="Search">
          </form>
      </div>
      <div class="card-body">
          <div class="row">
              <div class="col-md-12">
                  <h5 class="card-title float-left">Book list</h5>
                  <a href="create.php" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Add</a>
              </div>
          </div>
          <table class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th>Book's Name</th>
                      <th>Price</th>
                      <th>Author name</th>
                      <th style="width: 20%;">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php if ($result->rowCount() > 0) :  ?>
                <?php foreach ($result as $books) : ?>

                <tr>
                    <td><?= $books['b_name'] ?></td>
                    <td>₾<?= number_format($books['price'], 2)?></td>
                    <td><?= $books['auth_name'] ?></td>
                    <td>
                        <a href="show.php?id=<?=$books['id']?>" class="btn btn-sm btn-light"><i class="fa fa-th-list"></i></a>
                        <a href="edit.php?id=<?=$books['id']?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-<?= $books['id'] ?>"><i class="fa fa-trash"></i></a>
                          <?php include("pro/modal.php") ?>
                    </td>
                </tr>
              <?php endforeach ?>
              <?php endif ?>
              </tbody>
          </table>
      </div>
    </div>
    <!-- End Table Product -->
    <br>
    </div><!-- /.container -->
  <?php include("pro/footer.php") ?>
