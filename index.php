<?php
// Zmienne PHP
$firma = 'Szprycha';$rok = date('Y');

// Lab 3 - Cennik z bazy danych
require 'baza.php';
$cennik =$pdo->query('SELECT nazwa, cena FROM uslugi ORDER BY cena')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($firma) ?> – Pracownia Rowerowa</title>
  
  <link rel="stylesheet" href="style.css">
  <script src="app.js" defer></script>
</head>
<body>

  <header class="site-header">
    <a class="logo" href="#" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
      <svg viewBox="0 0 120 64" width="72" height="38" role="img" aria-labelledby="logo-tytul">
        <title id="logo-tytul">Szprycha</title>
        <circle cx="28" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        <circle cx="92" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        <polyline points="28,42 48,14 80,14 92,42" fill="none" stroke="#111" stroke-width="5" stroke-linejoin="round"/>
        <polyline points="48,14 60,42 80,14" fill="none" stroke="#111" stroke-width="5" stroke-linejoin="round"/>
      </svg>
      <span style="color: #111; font-weight: 700; font-size: 1.6rem;">Szprycha</span>
    </a>
    
    <button class="menu-toggle" aria-expanded="false" style="display: none;">Menu</button>
    <nav class="menu">
      <a href="#uslugi">Usługi</a>
      <a href="#cennik">Cennik</a>
      <a href="#kontakt">Kontakt</a>
    </nav>
  </header>

  <main>
    <section id="uslugi">
      <h2>Nasze Usługi</h2>
      <div class="hero-box">
        <img src="https://images.unsplash.com/photo-1532298229144-0ec0c57515c7?w=800&auto=format&fit=crop&q=80" alt="Rower w pracowni rowerowej Szprycha">
      </div>
      <div class="cards">
        <article class="card">
          <h3>Przegląd podstawowy</h3>
          <p>Regulacja hamulców, smarowanie napędu i kontrola ciśnienia w oponach.</p>
          <p class="card_price">od 90 zł</p>
        </article>
        <article class="card card--highlight">
          <span class="badge">Najczęściej wybierane</span>
          <h3>Duży serwis</h3>
          <p>Kompleksowe czyszczenie napędu