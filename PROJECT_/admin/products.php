<?php include('header.php'); ?>

  <?php
    if(!isset($_SESSION['admin_logged_in'])){
      header('location: login.php');
      exit();
    }  
  ?>

  <?php
  
  //get products

  $stmt = $conn->prepare("SELECT * FROM products");

  $stmt->execute();
  
  $products = $stmt->get_result();
  


  ?>


    <div class="container-fluid">
      <div class="row" style="min-height: 1000px" >
        
      <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>

          <h2>Products</h2>
          <?php if(isset($_GET['edit_success_message'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['edit_failed_message'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_failed_message'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['deleted_successfully'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['deleted_failure'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['product_created'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['product_created'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['product_failed'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['product_failed'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['images_updated'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['images_updated'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['images_failed'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['images_failed'] ?></p>
          <?php } ?>
          
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Product Id</th>
                  <th scope="col">Product Image</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Product Offer</th>
                  <th scope="col">Product Category</th>
                  <th scope="col">Product Color</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>

                </tr>
              </thead>
              <tbody>

              <?php foreach($products as $product) { ?>
                <tr>
                  <td><?php echo $product['product_id']; ?></td>
                  <td><img src="<?php echo "../assets/imgs/". $product['product_image']; ?>" style="width: 70px; height: 70px" ></td>
                  <td><?php echo $product['product_name']; ?></td>
                  <td><?php echo "€".$product['product_price']; ?></td>
                  <td><?php echo $product['product_special_offer'] . "%" ; ?></td>
                  <td><?php echo $product['product_category']; ?></td>
                  <td><?php echo $product['product_color']; ?></td>
                  <td><a class="btn btn-primary" href="edit_products.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                  <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>

          </div>
        </main>
      </div>
    </div>

    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="dashboard.js"></script>
  </body>
</html>
