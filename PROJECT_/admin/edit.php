
<?php include('header.php'); ?>

<?php
  if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
  }  
?>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $id = $_POST["id"];
    $name = $_POST["name"];

    // Update the record in the database
    $sql = "UPDATE Autosalloni SET name='$name' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Retrieve the record to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record from the database
    $sql = "SELECT * FROM Autosalloni WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
    } else {
        echo "Record not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
</head>
<body>
    <h1>Edit Record</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Name:</label>
       
