<?php
require 'auth.php';
require 'baza.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $akcja = $_POST['akcja'] ?? '';
    
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
}

$uslugi = $pdo->query('SELECT id, nazwa, cena FROM uslugi ORDER BY nazwa')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Panel Admina</title></head>
<body>
    <h1>Panel zarządzania cennikiem</h1>
    <a href="wyloguj.php">Wyloguj</a>
    
    <?php if (isset($_GET['ok']) && $_GET['ok'] === 'dodano'): ?>
        <p style="color:green;">Usługa została dodana!</p>
    <?php endif; ?>

    <h2>Lista usług</h2>
    <table border="1">
        <tr><th>Nazwa</th><th>Cena</th></tr>
        <?php foreach ($uslugi as $usluga): ?>
            <tr>
                <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                <td><?= $usluga['cena'] ?> zł</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Dodaj nową usługę</h2>
    <form method="post">
        <input type="hidden" name="akcja" value="dodaj">
        <label for="nazwa">Nazwa</label>
        <input id="nazwa" name="nazwa" required maxlength="100"><br><br>
        <label for="cena">Cena (zł)</label>
        <input id="cena" name="cena" type="number" min="1" required><br><br>
        <button>Dodaj</button>
    </form>
</body>
</html>