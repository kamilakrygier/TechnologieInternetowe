<?php
require 'baza.php';

// Tworzenie tabeli użytkowników
$pdo->exec('CREATE TABLE IF NOT EXISTS uzytkownicy (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT NOT NULL UNIQUE,
    haslo_hash TEXT NOT NULL
)');

// Tworzenie konta admina (używamy INSERT OR IGNORE, żeby nie dublować przy ponownym odpaleniu)
$z = $pdo->prepare('INSERT OR IGNORE INTO uzytkownicy (login, haslo_hash) VALUES (:login, :hash)');
$z->execute([
    'login' => 'admin',
    'hash' => password_hash('TwojeHaslo', PASSWORD_DEFAULT) // Tu wpisz własne hasło
]);

// Tworzenie tabeli usług
$pdo->exec('CREATE TABLE IF NOT EXISTS uslugi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nazwa TEXT NOT NULL,
    cena INTEGER NOT NULL,
    popularnosc INTEGER DEFAULT 0
)');

// Dodawanie domyślnych usług (tylko jeśli tabela jest pusta)
$ileUslug = $pdo->query('SELECT COUNT(*) FROM uslugi')->fetchColumn();
if ($ileUslug == 0) {
    $zUslugi = $pdo->prepare('INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)');
    $uslugi = [
        ['Przegląd podstawowy', 90],
        ['Duży serwis kompleksowy', 190],
        ['Centrowanie koła', 45],
        ['Wymiana dętki', 40]
    ];
    foreach ($uslugi as $usluga) {
        $zUslugi->execute(['nazwa' => $usluga[0], 'cena' => $usluga[1]]);
    }
}

echo "Baza gotowa.\n";