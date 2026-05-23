<?php $currentPageDebug = $currentPage ?? ''; ?>
<script>
function checkCSS() {
  // Liste des CSS chargés
  const links = document.querySelectorAll('link[rel="stylesheet"]');
  let cssList = 'CSS chargés :\n';
  links.forEach(link => {
    cssList += link.href + '\n';
  });

  // Affiche currentPage PHP
  const currentPage = "<?= $currentPageDebug ?>";
  cssList += '\n$currentPage = ' + currentPage;

  alert(cssList);
  console.log(cssList);
}

// Exécution automatique au chargement de la page
document.addEventListener('DOMContentLoaded', checkCSS);
</script>