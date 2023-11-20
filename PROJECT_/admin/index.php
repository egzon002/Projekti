<?php include('header.php'); ?>

  <?php
    if(!isset($_SESSION['admin_logged_in'])){
      header('location: login.php');
      exit();
    }  
  ?>

  <?php
  //get orders

  $stmt = $conn->prepare("SELECT * FROM orders");

  $stmt->execute();
  
  $orders = $stmt->get_result();
  


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

          <h2>Orders</h2>

          <?php if(isset($_GET['order_updated'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['order_updated'] ?></p>
          <?php } ?>

          <?php if(isset($_GET['order_failed'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['order_failed'] ?></p>
          <?php } ?>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Order Id</th>
                  <th scope="col">Order Status</th>
                  <th scope="col">User Id</th>
                  <th scope="col">Order Date</th>
                  <th scope="col">User Phone</th>
                  <th scope="col">User Address</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>

                </tr>
              </thead>
              <tbody>

              <?php foreach($orders as $order) { ?>
                <tr>
                  <td><?php echo $order['order_id']; ?></td>
                  <td><?php echo $order['order_status']; ?></td>
                  <td><?php echo $order['user_id']; ?></td>
                  <td><?php echo $order['order_date']; ?></td>
                  <td><?php echo $order['user_phone']; ?></td>
                  <td><?php echo $order['user_address']; ?></td>
                  <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td>
                  <td><a class="btn btn-danger" href="">Delete</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <canvas class="my-4 w-100" id="myChart" width="100" height="100"></canvas>
        </main>
      </div>
    </div>

    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="dashboard.js"></script>
  </body>
</html>
