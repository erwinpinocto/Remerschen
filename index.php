<?php
  // 🔹 Charge le bootstrap
  require __DIR__ . '/bootstrap.php'; 
  // Mini-routage des pages
  $page = $_GET['page'] ?? 'home';
  $allowedPages = ['home', 'test', 'carpodrome', 'contact', 
  'events', 'faq', 'jobs', 'loisirs', 'partners', 'tickets', 
  'teambuilding', 'ateliers', 'zones', 'about', 'news', 'visitmosel'];
  if (!in_array($page, $allowedPages)) {
      http_response_code(404);
      ?>
      <main>
        <section style="text-align:center; margin-top:50px;">
          <h1>404 - Page non trouvée</h1>
          <p>La page que vous cherchez n’existe pas.</p>
          <a href="<?= BASE_URL ?>/?page=home" class="btn">Retour à l'accueil</a>
        </section>
      </main>
      <?php
      exit;
  }
  // 🔹 Récupère config.json pour les messages
  $configFile = BASE_PATH . '/config/config.json';
  $config = [];
  if (file_exists($configFile)) {
      $config = json_decode(file_get_contents($configFile), true);
  }
  if (!is_array($config)) {
      $config = [
          'carpodrome' => ['statut'=>'ouvert', 'message'=>''],
          'loisirs'    => ['statut'=>'ouvert', 'message'=>'']
      ];
  }
  // 🔹 Noms des jours et des mois en français
  $jours = ['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'];
  $mois  = ['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'];
  // 🔹 Date actuelle
  $timestamp = time(); // ou strtotime('2026-03-01') pour tester une date fixe
  $jourSemaine = ucfirst($jours[(int)date('w', $timestamp)]);
  $jour = date('d', $timestamp);
  $moisNom = $mois[(int)date('n', $timestamp)-1];
  $annee = date('Y', $timestamp);
  // 🔹 Chaîne finale
  $today = "$jourSemaine $jour/$moisNom/$annee";
?>
<!DOCTYPE html>
  <html lang="fr">
  <?php require __DIR__ . '/partials/head.php'; ?>
  <body>
    <div class="page-container">
      <?php require __DIR__ . '/partials/header.php'; ?>
      <main>
        <?php include BASE_PATH . '/pages/' . $page . '.php'; ?>
      </main>
      <?php require __DIR__ . '/partials/footer.php'; ?>
      <!-- Script météo à placer une seule fois à la fin du body -->
      <script>
      !function(d, s, id){
          var js,fjs=d.getElementsByTagName(s)[0];
          if(!d.getElementById(id)){
              js=d.createElement(s);js.id=id;
              js.src='https://weatherwidget.io/js/widget.min.js';
              fjs.parentNode.insertBefore(js,fjs);
          }
      }(document,'script','weatherwidget-io-js');
      </script>
      <script>
        // Patiente que le widget soit chargé, puis ajuste la hauteur
        function fixWeatherWidget() {
          const widgets = document.getElementsByClassName('weatherwidget-io');
          for (let w of widgets) {
            w.style.height = '260px';            // hauteur désirée
            const iframe = w.querySelector('iframe');
            if (iframe) iframe.style.height = '260px';
          }
        }
        // Recalcule après 500ms et 1.5s (le widget peut s'initialiser lentement)
        setTimeout(fixWeatherWidget, 500);
        setTimeout(fixWeatherWidget, 1500);
        // Optionnel : recalcul si le message postMessage du widget arrive
        window.addEventListener("message", function(e) {
          if(e.origin === "https://weatherwidget.io") fixWeatherWidget();
        });
      </script>
    </div>
  </body>
</html>
