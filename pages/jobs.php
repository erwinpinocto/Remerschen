<?php
$pageTitle=t('jobs.title');
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
<div class="page-wrapper">
	<div class="container">
			<div class="slogan-wrapper">
				<div class="slogan"><?= htmlspecialchars(t('jobs.slogan')) ?></div>
			</div>
		<article class="dated-bloc-2cols">
			<div class="dated-bloc-main">
				<div class="bloc-left">
                    <h2 class="item-title"><?= htmlspecialchars(t('jobs.offer_title')) ?></h2>
                    <p class="item-text"><?= nl2br(htmlspecialchars(t('jobs.intro'))) ?></p>
				</div>
				<div class="bloc-right item-media">
					<img src="<?= BASE_URL ?>/assets/img/team.jpg" alt="">
				</div>
			</div>
			<details class="dated-bloc-details-toggle">
				<summary><?= htmlspecialchars(t('jobs.details_toggle')) ?></summary>
				<div class="dated-bloc-details">
				<div><?= t('jobs.content') ?></div>
				</div>
			</details>
		</article>
	</div>
</div>