<?php
require 'auth.php';
require 'baza.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $akcja = $_POST['akcja'] ?? '';
    
    // Dodawanie
    if ($akcja === 'dodaj') {
        $nazwa = trim($_POST['nazwa'] ?? '');
        $cena = (int) ($_POST['cena'] ?? 0);
        
        if ($nazwa !== '' && $cena > 0) {
            $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)');
            $z->execute(['nazwa' => $nazwa, 'cena' => $cena]);
            header('Location: admin.php?ok=dodano');
            exit;
        }
    }
    
    // Usuwanie
    if ($akcja === 'usun') {
        $z = $pdo->prepare('DELETE FROM uslugi WHERE id = :id');
        $z->execute(['id' => (int) $_POST['id']]);
        header('Location: admin.php?ok=usunieto');
        exit;
    }
}

$uslugi = $pdo->query('SELECT id, nazwa, cena FROM uslugi ORDER BY nazwa')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Admina - Szprycha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Panel CMS</h1>
            <a href="wyloguj.php" class="btn btn-secondary">Wyloguj</a>
        </div>

        <?php if (isset($_GET['ok']) && $_GET['ok'] === 'dodano'): ?>
            <div class="alert alert-success">Usługa dodana.</div>
        <?php endif; ?>
        <?php if (isset($_GET['ok']) && $_GET['ok'] === 'usunieto'): ?>
            <div class="alert alert-info">Usługa usunięta.</div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Usługa</th>
                            <th>Cena</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($uslugi as $usluga): ?>
                            <tr>
                                <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                                <td><?= $usluga['cena'] ?> zł</td>
                                <td>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="akcja" value="usun">
                                        <input type="hidden" name="id" value="<?= (int) $usluga['id'] ?>">
                                        <button class="btn btn-sm btn-outline-danger">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card p-3">
                    <h4>Dodaj nową</h4>
                    <form method="post">
                        <input type="hidden" name="akcja" value="dodaj">
                        <div class="mb-3">
                            <label for="nazwa" class="form-label">Nazwa usługi</label>
                            <input id="nazwa" name="nazwa" class="form-control" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label for="cena" class="form-label">Cena (zł)</label>
                            <input id="cena" name="cena" type="number" min="1" class="form-control" required>
                        </div>
                        <button class="btn btn-primary w-100">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>