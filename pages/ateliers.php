<!-- Style ateliers -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/ateliers.css">
<main class="wrapper">
<!-- Section formations -->
<h1><?= htmlspecialchars(t('ateliers.title')) ?></h1>
<div class="slogan-wrapper">
	<div class="slogan"><?= htmlspecialchars(t('ateliers.slogan')) ?></div>
</div>
<div class="bloc-2cols">
	<div class="bloc-left">
		<h2><?= htmlspecialchars(t('ateliers.vision.title')) ?></h2>
		<p><?= htmlspecialchars(t('ateliers.vision.text')) ?></p>
	</div>
	<div class="bloc-right">
		<a href="<?= BASE_URL ?>/assets/img/flyer_ateliers_vision.jpg" target="_blank" rel="noopener">
			<img src="<?= BASE_URL ?>/assets/img/flyer_ateliers_vision.jpg" alt="<?= htmlspecialchars(t('ateliers.vision_img_alt')) ?>" class="img-thumb">
		</a>
	</div>
</div>
<section class="bloc-bordure-gauche">
	<div class="slogan-wrapper">
		<!-- div class="slogan"><?= htmlspecialchars(t('ateliers.formations.text')) ?></ div-->
	</div>
	<section class="bloc-2cols">
		<div class="bloc-left">
			<h2><?= htmlspecialchars(t('ateliers.formations.title')) ?></h2>
			<p><?= htmlspecialchars(t('ateliers.formations.text')) ?></p>
		</div>
		<div class="bloc-right">
			<a href="<?= BASE_URL ?>/assets/img/flyer_formations.jpg" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/flyer_formations.jpg" alt="Flyer Formations" class="img-thumb">
			</a>
		</div>
	</section>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.formations.items.landscape.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.formations.items.landscape.text')) ?></p>
				</div>
				<div class="bloc-right">
					<a href="<?= BASE_URL ?>/assets/img/form_jardi_pelouse1.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/form_jardi_pelouse1.jpg" alt="Aménagement paysager" class="img-thumb"></a>
					<a href="<?= BASE_URL ?>/assets/img/form_jardiniere1.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/form_jardiniere1.jpg" alt="Aménagement paysager" class="img-thumb"></a>
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.formations.items.event.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.formations.items.event.text')) ?></p>
				</div>
				<div class="bloc-right">
					<a href="<?= BASE_URL ?>/assets/img/events4.png" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/events4.png" alt="Événementiel" class="img-thumb"></a>
					<a href="<?= BASE_URL ?>/assets/img/events14.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/events14.jpg" alt="Événementiel" class="img-thumb"></a>
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.formations.items.safety.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.formations.items.safety.text')) ?></p>
				</div>
				<div class="bloc-right">
					<a href="<?= BASE_URL ?>/assets/img/form_lifeguard1.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/form_lifeguard1.jpg" alt="Surveillance aquatique" class="img-thumb"></a>
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.formations.items.management.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.formations.items.management.text')) ?></p>
				</div>
				<div class="bloc-right">
					<img src="<?= BASE_URL ?>/assets/img/unsplash_management_1.avif" alt="Management" class="img-stamp">
				</div>
			</section>
		</div>
	</details>
	<div class="bloc-card" style="background:var(--bg-soft-1);">
		<h2 class="slogan"><?= htmlspecialchars(t('ateliers.pedagogy.title')) ?></h2>
		<p style="text-align:center;"><?= t('ateliers.pedagogy.text') ?></p>
	</div>
</section>
<!-- Section ateliers -->
<section class="bloc-bordure-gauche">
	<section class="bloc-2cols">
		<div class="bloc-left">
			<h2><?= htmlspecialchars(t('ateliers.ateliers_list.title')) ?></h2>
			<p><?= nl2br(htmlspecialchars(t('about.workshops_text'))) ?></p>
		</div>
		<div class="bloc-right">
			<a href="<?= BASE_URL ?>/assets/img/flyer_ateliers.jpg" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/flyer_ateliers.jpg" alt="Flyer Ateliers" class="img-thumb">
			</a>
		</div>
	</section>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.ateliers_list.items.garden.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.ateliers_list.items.garden.text')) ?></p>
				</div>
				<div class="bloc-right">
					<a href="<?= BASE_URL ?>/assets/img/flyer_atelier_vert.jpg" target="_blank" rel="noopener">
						<img src="<?= BASE_URL ?>/assets/img/flyer_atelier_vert.jpg" alt="Jardinage" class="img-thumb">
					</a>
					<a href="<?= BASE_URL ?>/assets/img/form_talus2.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/form_talus2.jpg" alt="Aménagement paysager" class="img-thumb"></a>				
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.ateliers_list.items.carpentry.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.ateliers_list.items.carpentry.text')) ?></p>
				</div>
				<div class="bloc-right">
					<a href="<?= BASE_URL ?>/assets/img/menuiserie_rambarde.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/menuiserie_rambarde.jpg" alt="Menuiserie" class="img-thumb"></a>
					<a href="<?= BASE_URL ?>/assets/img/form_menuiserie_path1.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/form_menuiserie_path1.jpg" alt="Menuiserie" class="img-thumb"></a>
					<a href="<?= BASE_URL ?>/assets/img/menuiserie_bacs.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/menuiserie_bacs.jpg" alt="Menuiserie" class="img-thumb"></a>
					<a href="<?= BASE_URL ?>/assets/img/menuiserie_talus.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/menuiserie_talus.jpg" alt="Menuiserie" class="img-thumb"></a>				
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.ateliers_list.items.multi.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.ateliers_list.items.multi.text')) ?></p>
				</div>
				<div class="bloc-right">
					<img src="<?= BASE_URL ?>/assets/img/unsplash_multi_services_3.avif" alt="Multiservice" class="img-stamp">
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.ateliers_list.items.safety.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.ateliers_list.items.safety.text')) ?></p>
				</div>
				<div class="bloc-right">
					<a href="<?= BASE_URL ?>/assets/img/form_lifeguard2.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/form_lifeguard2.jpg" alt="Sauvetage" class="img-thumb"></a>
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.ateliers_list.items.event.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.ateliers_list.items.event.text')) ?></p>
				</div>
				<div class="bloc-right">
					<a href="<?= BASE_URL ?>/assets/img/baggerweier_event_1.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/baggerweier_event_1.jpg" alt="Événementiel" class="img-thumb"></a>
					<a href="<?= BASE_URL ?>/assets/img/events13.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/events13.jpg" alt="Événementiel" class="img-thumb"></a>
				</div>
			</section>
		</div>
	</details>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title"><?= htmlspecialchars(t('ateliers.ateliers_list.items.admin.title')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<section class="bloc-2cols">
				<div class="bloc-left">
					<p><?= htmlspecialchars(t('ateliers.ateliers_list.items.admin.text')) ?></p>
				</div>
				<div class="bloc-right">
					<img src="<?= BASE_URL ?>/assets/img/unsplash_secretariat_1.avif" alt="Secrétariat" class="img-stamp">
				</div>
			</section>
		</div>
	</details>
	<section class="bloc-card" style="background:var(--bg-soft-1);">
		<p><?= htmlspecialchars(t('ateliers.values')) ?></p>
	</section>
</section>
<section class="ateliers-bloc-resultats">
	<div class="bloc-2cols">
		<div class="bloc-left">
			<h2><?= htmlspecialchars(t('ateliers.results.title')) ?></h2>
			<p><?= htmlspecialchars(t('ateliers.results.text')) ?></p>
		</div>
		<div class="bloc-right">
			<a href="<?= BASE_URL ?>/assets/img/flyer_ateliers_impact.jpg" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/flyer_ateliers_impact.jpg" alt="Impact des ateliers" class="img-thumb">
			</a>
		</div>
	</div>
	<section class="bloc-2cols" style="background:var(--bg-soft-1);">
		<div class="col-text">
			<h2 class="slogan"><?= htmlspecialchars(t('ateliers.goals.title')) ?></h2>
			<p><?= htmlspecialchars(t('ateliers.goals.text')) ?></p>
		</div>
<div class="cursus-image">
	<?php $lang_img=in_array($lang,['fr','de','en'])?$lang:'fr'; ?>
	<a href="<?= BASE_URL ?>/assets/img/cursus_<?= $lang_img ?>.png" target="_blank" rel="noopener noreferrer">
		<img src="<?= BASE_URL ?>/assets/img/cursus_<?= $lang_img ?>.png" alt="" class="img-thumb">
	</a>
</div>
	</section>
</section>
</main>