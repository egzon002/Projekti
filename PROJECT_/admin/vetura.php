<?php include('header.php'); ?>

<?php
// Kontrollo sesionin për admin
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

// Përfshijë lidhjen me bazën e të dhënave
include('../server/connection.php');

// Veprimi kur shtohet një veturë
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_vetura'])) {
    $emertim_vetura = $_POST['emertim_vetura'];
    $id_autosalloni = $_POST['id_autosalloni'];

    // Përgatitni dhe ekzekutoni SQL query për shtimin e një rreshti në tabelën "Vetura"
    $stmt = $conn->prepare("INSERT INTO Vetura (emertim_vetura, ID_Autosalloni) VALUES (?, ?)");
    $stmt->bind_param("si", $emertim_vetura, $id_autosalloni);
    $stmt->execute();

    // Kontrollo nëse ka ndonjë gabim në ekzekutim
    if ($stmt->affected_rows > 0) {
        $message = "Vetura u shtua me sukses.";
    } else {
        $error_message = "Gabim në shtimin e veturës.";
    }

    // Mbyll lidhjen me databazën
    $stmt->close();
}

// Veprimi kur fshihet një veturë
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Përgatitni dhe ekzekutoni SQL query për fshirjen e një rreshti në tabelën "Vetura"
    $stmt = $conn->prepare("DELETE FROM Vetura WHERE ID_Vetura = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Kontrollo nëse ka ndonjë gabim në ekzekutim
    if ($stmt->affected_rows > 0) {
        $deleted_successfully = "Vetura u fshi me sukses.";
    } else {
        $deleted_failure = "Gabim në fshirjen e veturës.";
    }

    // Mbyll lidhjen me databazën
    $stmt->close();
}

// Përgatitni dhe ekzekutoni SQL query për të marrë të dhënat e veturave
$stmt = $conn->prepare("SELECT * FROM Vetura");
$stmt->execute();
$vetura = $stmt->get_result();
$stmt->close();

// Përgatitni dhe ekzekutoni SQL query për të marrë të dhënat e autosaloneve (për dropdown)
$stmt_autosalloni = $conn->prepare("SELECT * FROM Autosalloni");
$stmt_autosalloni->execute();
$autosalloni = $stmt_autosalloni->get_result();
$stmt_autosalloni->close();
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px">

        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Këtu mund të shtoni kodin për shfaqjen e mesazheve të suksesit ose gabimeve -->

            <h2>Vetura</h2>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="emertim_vetura" class="form-label">Emertimi Vetures</label>
                    <input type="text" class="form-control" id="emertim_vetura" name="emertim_vetura" required>
                </div>
                <div class="mb-3">
                    <label for="id_autosalloni" class="form-label">Autosalloni</label>
                    <select class="form-select" id="id_autosalloni" name="id_autosalloni" required>
                        <?php foreach ($autosalloni as $autosallon) { ?>
                            <option value="<?php echo $autosallon['ID_Autosalloni']; ?>"><?php echo $autosallon['emertimi_autosalloni']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="add_vetura">Shto Veturen</button>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID Vetura</th>
                            <th scope="col">Emertimi Vetures</th>
                            <th scope="col">Autosalloni</th>
                            <th scope="col">Veprimet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vetura as $vet) { ?>
                            <tr>
                                <td><?php echo $vet['ID_Vetura']; ?></td>
                                <td><?php echo $vet['emertim_Vetura']; ?></td>
                                <td><?php echo $vet['ID_Autosalloni']; ?></td>
                                <td>
                                    <a class="btn btn-danger" href="vetura.php?delete_id=<?php echo $vet['ID_Vetura']; ?>">Fshi</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include('footer.php'); ?>
