<?php
 include('connection.php');


$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='shoes1' LIMIT 3 ");


$stmt ->execute();



$shoes1 = $stmt->get_result();



?>