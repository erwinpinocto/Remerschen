<header>
	<?php
		$currentPageLower = strtolower($currentPage ?? 'home');
		$cssToInclude = $pageCssMap[$currentPageLower] ?? null;
		$pageTitleKey = $headerPages[$currentPageLower]['title'] ?? null;
		$pageTitle = $pageTitleKey ? t($pageTitleKey) : 'Baggerweier ASBL';
	?>
<?php
	/* Page courante */
	$currentPage = $_GET['page'] ?? 'home';
	/* Titre affiché dans le bandeau */
	$pageTitleKey = $headerPages[$currentPage]['title'] ?? 'site.title';
?>
	<div class="header-top">
		<div class="logo">
			<a href="<?= BASE_URL ?>/admin/admin.php">
				<img src="<?= BASE_URL ?>/assets/img/logo_baggerweier.svg" alt="Erlebnis Baggerweier">
			</a>
		</div>
		<div class="page-title">
			<h1><?= htmlspecialchars(t($pageTitleKey)) ?></h1>
		</div>
      <!-- Drapeaux de langues -->
    <div class="lang-container">
      <?php
        $langs = [
          'fr' => 'Français',
          'en' => 'English',
          'de' => 'Deutsch'
        ];
        foreach ($langs as $code => $label) {
          echo '<a href="' . BASE_URL . '/?page=' . $currentPage . '&lang=' . $code . '">' .
            '<img src="' . BASE_URL . '/assets/img/' . $code . '.svg" alt="' . $label . '" ' . ($lang === $code ? 'class="active"' : '') . '>' .
            '</a>';
        }
      ?>
    </div>
	</div>
  <div class="nav-buttons">
    <div class="nav-links">
      <?php
        /* Construction du bandeau de navigation */
        foreach ($headerPages as $pageKey => $pageData) {
          if (!$pageData['show_in_nav']) continue;
          $activeClass = ($currentPage === $pageKey) ? 'active' : '';
          echo '<a href="' . BASE_URL . '/?page=' . $pageKey . '" class="btn ' . $activeClass . '">' . htmlspecialchars(t($pageData['nav'])) . '</a>';
        }
      ?>
    </div>
    <div id="google_translate_element" style="display:flex;justify-content:flex-end;"></div>
  </div>
</header>