<?php include('header.php'); ?>

<?php
// Kontrollo sesionin për admin
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

// Përfshijë lidhjen me bazën e të dhënave
include('../server/connection.php');

// Veprimi kur shtohet një autosallon
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_autosalloni'])) {
    $emertimi_autosalloni = $_POST['emertimi_autosalloni'];
    $datatime = $_POST['datatime'];

    // Përgatitni dhe ekzekutoni SQL query për shtimin e një rreshti në tabelën "Autosalloni"
    $stmt = $conn->prepare("INSERT INTO Autosalloni (emertimi_autosalloni, datatime) VALUES (?, ?)");
    $stmt->bind_param("ss", $emertimi_autosalloni, $datatime);
    $stmt->execute();

    // Kontrollo nëse ka ndonjë gabim në ekzekutim
    if ($stmt->affected_rows > 0) {
        $message = "Autosalloni u shtua me sukses.";
    } else {
        $error_message = "Gabim në shtimin e autosallonit.";
    }

    // Mbyll lidhjen me databazën
    $stmt->close();
}

// Veprimi kur fshihet një autosallon
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Përgatitni dhe ekzekutoni SQL query për fshirjen e një rreshti në tabelën "Autosalloni"
    $stmt = $conn->prepare("DELETE FROM Autosalloni WHERE ID_Autosalloni = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Kontrollo nëse ka ndonjë gabim në ekzekutim
    if ($stmt->affected_rows > 0) {
        $deleted_successfully = "Autosalloni u fshi me sukses.";
    } else {
        $deleted_failure = "Gabim në fshirjen e autosallonit.";
    }

    // Mbyll lidhjen me databazën
    $stmt->close();
}

// Përgatitni dhe ekzekutoni SQL query për të marrë të dhënat e autosaloneve
$stmt = $conn->prepare("SELECT * FROM Autosalloni");
$stmt->execute();
$autosalloni = $stmt->get_result();
$stmt->close();
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px">

        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Këtu mund të shtoni kodin për shfaqjen e mesazheve të suksesit ose gabimeve -->

            <h2>Autosalloni</h2>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="emertimi_autosalloni" class="form-label">Emeri i Autosallonit</label>
                    <input type="text" class="form-control" id="emertimi_autosalloni" name="emertimi_autosalloni" required>
                </div>
                <div class="mb-3">
                    <label for="datatime" class="form-label">Data dhe Ora</label>
                    <input type="datetime-local" class="form-control" id="datatime" name="datatime" required>
                </div>
                <button type="submit" class="btn btn-primary" name="add_autosalloni">Shto Autosallonin</button>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID Autosalloni</th>
                            <th scope="col">Emertimi Autosallonit</th>
                            <th scope="col">Datatime</th>
                            <th scope="col">Veprimet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($autosalloni as $autosallon) { ?>
                            <tr>
                                <td><?php echo $autosallon['ID_Autosalloni']; ?></td>
                                <td><?php echo $autosallon['emertimi_autosalloni']; ?></td>
                                <td><?php echo $autosallon['datatime']; ?></td>
                                <td>

                                <td>
                                    <a class="btn btn-danger" href="autosalloni.php?delete_id=<?php echo $autosallon['ID_Autosalloni']; ?>">Delete</a>
                                    <a class="btn btn-primary" href="edit_autosalloni.php?edit_id=<?php echo $autosallon['ID_Autosalloni']; ?>">Edit</a>
                                </td>

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
