<?php include('layouts/header.php'); ?>

<?php

include('server/connection.php');

//use the search section

if(isset($_POST['search'])){

  $category = $_POST['category'];
  $price = $_POST['price'];

  if($category=='all'){
    $stmt=$conn->prepare("SELECT * FROM products WHERE product_price<=?");
    $stmt->bind_param("i", $price);
  }else{
    $stmt=$conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");

    $stmt->bind_param("si",$category, $price);
  }
  $stmt->execute();

  $products = $stmt->get_result();


  //return all products
}else{

  $stmt = $conn->prepare("SELECT * FROM products");

  $stmt->execute();

  $products = $stmt->get_result();

}





?>




    
    <div class="shop1">
    <section id="search" class="my-5 ms-2">
      <div class="container mt-5 py-5">
        <p>Search Products</p>
        <hr>
      </div>

          <form action="shop.php" method="POST" >
            <div class="row mx-auto container">
              <div class="col-lg-12 col-md-12 col-sm-12">


                <p>Category</p>

                <div class="form-check">
                  <input class="form-check-input" value="all" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='all' ){echo 'checked'; } ?>>
                  <label class="form-check-label" for="flexRadioDefault1">
                    All
                  </label>
                </div>
                
                
                <div class="form-check">
                  <input class="form-check-input" value="shoes" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='shoes' ){echo 'checked'; } ?>>
                  <label class="form-check-label" for="flexRadioDefault1">
                    Shoes
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" value="hoodies" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=='hoodies' ){echo 'checked'; } ?>>
                  <label class="form-check-label" for="flexRadioDefault2">
                    Hoodies
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" value="watch" type="radio" name="category" id="category_three" <?php if(isset($category) && $category=='watch' ){echo 'checked'; } ?>>
                  <label class="form-check-label" for="flexRadioDefault3">
                    Watches
                  </label>
                </div>
                

              </div>
            </div>

            <div class="row mx-auto container mt-5">
              <div class="col-lg-12 col-md-12 col-sm-12">

                <p>Price</p>
                <input type="range" class="form-range w-50" name="price" value="<?php if(isset($price)){ echo $price; }else{ echo"1000"; } ?>" min="1" max="1000" id="customRange2">
                <div class="w-50">
                  <span style="float: left;">1</span>
                  <span style="float: right;">1000</span>
                </div>
              </div>
            </div>

            <div class="form-group my-3 mx-3">
              <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>
          </form>

    </section>
     

    <!--Shop-->
    <section id="shop" class="my-5 py-5">
        <div class="container  mt-5 py-5">
          <div class="product-p">
            <h3>Our Products</h3>
            <hr>
            <p>Here you can check out our products</p>
          </div>
        </div>
        <div class="row mx-auto container">

        <?php while($row = $products->fetch_assoc()){ ?>

          <div onclick="window.location.href='single_product.php?product_id=<?php echo $row['product_id'];?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3"  src="assets/imgs/<?php echo $row['product_image']; ?>"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">€<?php echo $row['product_price']; ?></h4>
            <a class="btn shop-buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Buy Now</a>
          </div>
          
          <?php } ?>


        </div>
      
    </section>     
    </div>

    
     
<?php include('layouts/footer.php'); ?>