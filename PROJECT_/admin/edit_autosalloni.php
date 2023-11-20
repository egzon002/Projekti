<?php include('header.php'); ?>

<?php
// Kontrollo sesionin për admin
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

// Përfshijë lidhjen me bazën e të dhënave
include('../server/connection.php');

// Veprimi kur redaktohet një autosallon
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_autosalloni_btn'])) {
    $id_autosalloni = $_POST['id_autosalloni'];
    $emertimi_autosalloni = $_POST['emertimi_autosalloni'];
    $datatime = $_POST['datatime'];

    // Përgatitni dhe ekzekutoni SQL query për ndryshimin e të dhënave të një autosalloni
    $stmt = $conn->prepare("UPDATE Autosalloni SET emertimi_autosalloni=?, datatime=? WHERE ID_Autosalloni=?");
    $stmt->bind_param("ssi", $emertimi_autosalloni, $datatime, $id_autosalloni);
    $stmt->execute();

    // Kontrollo nëse ka ndonjë gabim në ekzekutim
    if ($stmt->affected_rows > 0) {
        $edit_success_message = "Të dhënat e Autosallonit u ndryshuan me sukses.";
    } else {
        $edit_failed_message = "Gabim në ndryshimin e të dhënave të Autosallonit.";
    }

    // Mbyll lidhjen me databazën
    $stmt->close();
}

// Merrni ID e autosallonit nga URL
if (isset($_GET['edit_id'])) {
    $id_autosalloni = $_GET['edit_id'];

    // Përgatitni dhe ekzekutoni SQL query për të marrë të dhënat e autosallonit
    $stmt = $conn->prepare("SELECT * FROM Autosalloni WHERE ID_Autosalloni=?");
    $stmt->bind_param("i", $id_autosalloni);
    $stmt->execute();
    $autosalloni = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    // Nëse nuk ka ID të disponueshëm, kthehu në faqen e autosaloneve ose tjetrën sipas nevojës tuaj
    header('location: autosalloni.php');
    exit;
}
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px">

        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            

            <h2>Edit Autosalloni</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-autosalloni-form" method="POST" action="">
                        
                        <div class="form-group mt-2">
                            <input type="hidden" name="id_autosalloni" value="<?php echo $autosalloni['ID_Autosalloni']; ?>">
                            <label for="emertimi_autosalloni">Emertimi Autosallonit</label>
                            <input type="text" class="form-control" id="emertimi_autosalloni" name="emertimi_autosalloni" value="<?php echo $autosalloni['emertimi_autosalloni']; ?>" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="datatime">Datatime</label>
                            <input type="datetime-local" class="form-control" id="datatime" name="datatime" value="<?php echo date('Y-m-d\TH:i', strtotime($autosalloni['datatime'])); ?>" required>
                        </div>

                        <div class="form-group mt-3">
                            <a href="autosalloni.php" button type="submit" class="btn btn-primary" name="edit_autosalloni_btn">Edit</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include('footer.php'); ?>
