<?php
// Zadanie 2: Zmienne PHP
$firma = 'Szprycha';
$rok = date('Y');

// Zadanie 3: Tablica z usługami do cennika
$cennik = [
  ['nazwa' => 'Przegląd podstawowy', 'cena' => 90],
  ['nazwa' => 'Duży serwis kompleksowy', 'cena' => 190],
  ['nazwa' => 'Centrowanie koła (sztuka)', 'cena' => 45],
  ['nazwa' => 'Regulacja przerzutki', 'cena' => 35],
  ['nazwa' => 'Wymiana dętki', 'cena' => 40] // Dodatkowa usługa, żeby sprawdzić czy pętla działa
];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($firma) ?> – Pracownia Rowerowa</title>
  
  <!-- Podpięcie zewnętrznego CSS i JS (defer jest kluczowy dla zadania 1!) -->
  <link rel="stylesheet" href="style.css">
  <script src="app.js" defer></script>
</head>
<body>

  <!-- Zadanie 1 i 4: Przycisk mobilny oraz Logo w SVG -->
  <header class="site-header">
    <a class="logo" href="#" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
      <svg viewBox="0 0 120 64" width="72" height="38" role="img" aria-labelledby="logo-tytul">
        <title id="logo-tytul">Szprycha</title>
        <!-- Koła -->
        <circle cx="28" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        <circle cx="92" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        <!-- Rama dorysowana (polyline) -->
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
          <p>Kompleksowe czyszczenie napędu, centrowanie kół, regulacja przerzutek i hamulców.</p>
          <p class="card_price">od 190 zł</p>
        </article>
        <article class="card">
          <h3>Serwis amortyzatorów</h3>
          <p>Wymiana oleju, uszczelek oraz precyzyjne ustawienie tłumienia.</p>
          <p class="card_price">od 220 zł</p>
        </article>
      </div>
    </section>

    <section id="cennik">
      <h2>Cennik</h2>
      <table class="price-table">
        <thead>
          <tr>
            <th>Usługa</th>
            <th class="num">Cena</th>
          </tr>
        </thead>
        <tbody>
          <!-- Zadanie 3: Pętla foreach generująca wiersze z ochroną XSS -->
          <?php foreach ($cennik as $usluga): ?>
            <tr>
              <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
              <td class="num"><?= $usluga['cena'] ?> zł</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </main>

  <footer id="kontakt">
    <h2>Kontakt</h2>
    <p>Adres: ul. Gdańska 10, 85-006 Bydgoszcz</p>
    <p>Telefon: <a href="tel:+48500100200">+48 500 100 200</a></p>
    <p>E-mail: <a href="mailto:kontakt@szprycha-bydgoszcz.pl">kontakt@szprycha-bydgoszcz.pl</a></p>
    <!-- Zadanie 2: Stopka z dynamicznym rokiem i firmą -->
    <p style="margin-top: 20px; font-size: 0.9em; color: #666;">
      &copy; <?= $rok ?> <?= htmlspecialchars($firma) ?>
    </p>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script>
    gsap.from(".site-header", { duration: 0.8, y: -30, opacity: 0, ease: "power2.out" });
    gsap.from(".card", { duration: 0.7, delay: 0.1, y: 30, opacity: 0, stagger: 0.15, ease: "power2.out", clearProps: "all" });
  </script>
</body>
</html> 