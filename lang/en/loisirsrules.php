<!-- =========EN-TÊTE DU DOCUMENT===--> 
<header class="doc-header">
	<div class="doc-header-logo">
		<img src="<?= BASE_URL ?>/assets/img/logo.jpg" alt="Erliefnis Baggerweier logo">
	</div>
	<div class="doc-header-title">
		<h1>Internal regulations and swimming rules</h1>
		<div class="version">Erliefnis Baggerweier – Remerschen</div>
	</div>
</header>
<!-- =================================================
		1. Purpose of the regulations
================================================== -->
<section class="doc-section">
	<h2>1. Purpose of the regulations</h2>
	<p class="article-text">
		In order to ensure the safety, cleanliness and comfort
		of all visitors, any person entering the Baggerweier
		aquatic complex agrees to comply with these internal regulations.
	</p>
</section>
<!-- =================================================
		2. Opening hours
================================================== -->
<section class="doc-section">
	<h2>2. Opening hours</h2>
	<h3>Ticket office</h3>
	<p class="article-text">
		The ticket office is open from <strong>10:00 to 17:30</strong>,
		from <strong>May 1 to September 15, 2026</strong>.
	</p>
	<h3>Site closing hours</h3>
	<ul>
		<li><strong>May:</strong> closing at 18:00 every day.</li>
		<li><strong>June:</strong> closing at 18:00, except Friday and Saturday: 20:00 if weather conditions permit.</li>
		<li><strong>July:</strong> closing at 18:00, except Thursday, Friday and Saturday: 20:00 if weather conditions permit.</li>
		<li><strong>August:</strong> closing at 18:00, except Thursday, Friday and Saturday: 20:00 if weather conditions permit.</li>
		<li><strong>September:</strong> closing at 18:00, except Friday and Saturday: 20:00 if weather conditions permit.</li>
	</ul>
</section>
<!-- =================================================
		3. Entry fees
================================================== -->
<section class="doc-section">
	<h2>3. Entry fees</h2>
	<div class="doc-rates">
		<?php
			$ratesBloc=$RATES['loisirs']??null;//rates
			$ratesDisplay='loisirs';
			require BASE_PATH.'/partials/rates_display.php';
		?>
	</div>
</section>
<!-- =================================================
		4. Swimming rules
================================================== -->
<section class="doc-section">
	<h2>4. Swimming rules</h2>
	<h3>Supervision</h3>
	<ul>
		<li>Swimming is permitted during the season, from May 1 to September 15.</li>
		<li>Supervised swimming from <strong>10:00 to 18:00</strong>, only at the kids area.</li>
		<li>In other areas of the lake, swimming is unsupervised.</li>
		<li>Swimming is at the users’ own risk.</li>
	</ul>
	<h3>Liability</h3>
	<p class="article-text">
		The operator declines all responsibility
		in the event of any incident or accident.
	</p>
	<h3>Children’s safety</h3>
	<ul>
		<li>Armbands are mandatory for children under 8 years old.</li>
		<li>Armbands are available at the ticket office for €3.</li>
		<li>Children under 10 years old are under the responsibility of an accompanying adult.</li>
	</ul>
	<h3>Lake safety</h3>
	<ul>
		<li>The use of a safety buoy is mandatory on the lake.</li>
		<li>This buoy is available at the ticket office.</li>
	</ul>
</section>
<!-- =================================================
		5. Animals
================================================== -->
<section class="doc-section">
	<h2>5. Animals</h2>
	<ul>
		<li>Assistance dogs are allowed throughout the entire site.</li>
		<li>Dogs are only allowed in the designated dog beach area (Zone 6) and on the terrace/bar (Zone 2).</li>
		<li>They must be kept on a leash and under their owner's control.</li>
	</ul>
</section>
<!-- =================================================
		6. Prohibitions
================================================== -->
<section class="doc-section">
	<h2>6. Prohibitions</h2>
	<ul>
		<li>Open fires outside designated barbecue areas.</li>
		<li>Removing, damaging or destroying plants or trees.</li>
		<li>Throwing waste into the lake or surrounding areas; bins are provided.</li>
		<li>Bicycle access is prohibited.</li>
		<li>Disturbing or feeding birds and other wildlife throughout the site.</li>
		<li>Camping and overnight stays are prohibited throughout the site.</li>
		<li>The use of motorboats, except those belonging to rescue and maintenance services, is prohibited.</li>
		<li>Access to the lake is strictly prohibited during the winter months.</li>
		<li>Walking and any other activity on the lake are prohibited in bad weather.</li>
		<li>Throwing stones or any object likely to cause injury anywhere on the site.</li>
	</ul>
</section>
<!-- =================================================
		7. Personal belongings
================================================== -->
<section class="doc-section">
	<h2>7. Personal belongings</h2>
	<p class="article-text">
		Please ensure that your personal belongings
		are kept under control at all times. The operator declines
		all responsibility in case of loss or theft
		occurring on the premises, regardless of the circumstances.
	</p>
</section>
<!-- =================================================
		8. Sports, cultural or other events
================================================== -->
<section class="doc-section">
	<h2>8. Sports, cultural or other events</h2>
	<p class="article-text">
		The organization of sports, cultural or other events
		requires prior written approval from the operator.
	</p>
	<ul>
		<li>Organizers are solely responsible for accidents or damage caused to persons or property, without prejudice to third-party rights.</li>
		<li>The operator and/or the municipality cannot be held liable under any circumstances.</li>
		<li>In case of damage to facilities or premises, repair costs will be charged to the organizers.</li>
	</ul>
</section>
