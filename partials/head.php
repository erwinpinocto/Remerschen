<?php
$currentPageLower = strtolower($currentPage ?? 'home');
$cssToInclude = $pageCssMap[$currentPageLower] ?? null;

$pageTitleKey = $headerPages[$currentPageLower]['title'] ?? null;
$pageTitle = $pageTitleKey ? t($pageTitleKey) : 'Baggerweier ASBL';
?>
<?php
// Détermination du CSS spécifique à la page
$currentPageLower = strtolower($currentPage ?? '');
$cssToInclude = $pageCssMap[$currentPageLower] ?? null;
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="robots" content="noindex, nofollow">

  <!-- CSS global -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">

  <?php if ($cssToInclude): ?>
  <!-- CSS spécifique à la page -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/<?= $cssToInclude ?>">
  <?php endif; ?>

  <?php if (!empty($DEBUG_LAYOUT)): ?>
  <!-- Debug layout -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/debug.css">
  <?php endif; ?>

  <!-- Traduction Google temporaire -->
  <script>
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'fr',
        
        layout: google.translate.TranslateElement.InlineLayout.VERTICAL
      }, 'google_translate_element');
    }
  </script>
  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>