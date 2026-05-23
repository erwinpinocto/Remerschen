<!-- =========DOKUMENTENKOPF===-->
<header class="doc-header">
	<div class="doc-header-logo">
		<img src="<?= BASE_URL ?>/assets/img/logo.jpg" alt="Logo Erliefnis Baggerweier">
	</div>
	<div class="doc-header-title">
		<h1>Hausordnung und Baderegeln</h1>
		<div class="version">Erliefnis Baggerweier – Remerschen</div>
	</div>
</header>
<!-- =================================================
		1. Zweck der Ordnung
================================================== -->
<section class="doc-section">
	<h2>1. Zweck der Ordnung</h2>
	<p class="article-text">
		Um die Sicherheit, Sauberkeit und den Komfort
		aller Besucher zu gewährleisten, verpflichtet sich
		jede Person, die das Gelände des Wasserfreizeitkomplexes
		Baggerweier betritt, diese Hausordnung einzuhalten.
	</p>
</section>
<!-- =================================================
		2. Öffnungszeiten
================================================== -->
<section class="doc-section">
	<h2>2. Öffnungszeiten</h2>
	<h3>Ticketverkauf</h3>
	<p class="article-text">
		Der Ticketverkauf ist von <strong>10:00 bis 17:30 Uhr</strong>
		vom <strong>1. Mai bis 15. September 2026</strong> geöffnet.
	</p>
	<h3>Schließzeiten des Geländes</h3>
	<ul>
		<li><strong>Mai :</strong> Schließung täglich um 18:00 Uhr.</li>
		<li><strong>Juni :</strong> Schließung um 18:00 Uhr, außer freitags und samstags: 20:00 Uhr, wenn die Wetterbedingungen es erlauben.</li>
		<li><strong>Juli :</strong> Schließung um 18:00 Uhr, außer donnerstags, freitags und samstags: 20:00 Uhr, wenn die Wetterbedingungen es erlauben.</li>
		<li><strong>August :</strong> Schließung um 18:00 Uhr, außer donnerstags, freitags und samstags: 20:00 Uhr, wenn die Wetterbedingungen es erlauben.</li>
		<li><strong>September :</strong> Schließung um 18:00 Uhr, außer freitags und samstags: 20:00 Uhr, wenn die Wetterbedingungen es erlauben.</li>
	</ul>
</section>
<!-- =================================================
		3. Eintrittspreise
================================================== -->
<section class="doc-section">
	<h2>3. Eintrittspreise</h2>
	<div class="doc-rates">
		<?php
			$ratesBloc=$RATES['loisirs']??null;
			$ratesDisplay='loisirs';
			require BASE_PATH.'/partials/rates_display.php';
		?>
	</div>
</section>
<!-- =================================================
		4. Baderegeln
================================================== -->
<section class="doc-section">
	<h2>4. Baderegeln</h2>
	<h3>Aufsicht</h3>
	<ul>
		<li>Das Baden ist während der Saison vom 1. Mai bis 15. September erlaubt.</li>
		<li>Beaufsichtigtes Baden von <strong>10:00 bis 18:00 Uhr</strong>, nur im Kinderbecken.</li>
		<li>In den anderen Bereichen des Sees ist das Baden frei.</li>
		<li>Das Baden erfolgt auf eigene Gefahr der Nutzer.</li>
	</ul>
	<h3>Haftung</h3>
	<p class="article-text">
		Der Betreiber übernimmt keine Haftung
		im Falle eines Zwischenfalls oder Unfalls.
	</p>
	<h3>Sicherheit der Kinder</h3>
	<ul>
		<li>Schwimmflügel sind für Kinder unter 8 Jahren obligatorisch.</li>
		<li>Schwimmflügel sind am Ticketverkauf zum Preis von 3 € erhältlich.</li>
		<li>Kinder unter 10 Jahren stehen unter der Verantwortung einer begleitenden erwachsenen Person.</li>
	</ul>
	<h3>Sicherheit auf dem See</h3>
	<ul>
		<li>Die Verwendung einer Sicherheitsboje ist auf dem See obligatorisch.</li>
		<li>Diese Boje ist am Ticketverkauf erhältlich.</li>
	</ul>
</section>
<!-- =================================================
		5. Tiere
================================================== -->
<section class="doc-section">
	<h2>5. Tiere</h2>
	<ul>
		<li>Assistenzhunde sind auf dem gesamten Gelände zugelassen.</li>
		<li>Hunde sind nur im ausgewiesenen Hundestrandbereich (Zone 6) sowie auf der Terrasse / Bar (Zone 2) zugelassen.</li>
		<li>Sie müssen an der Leine geführt und unter der Kontrolle ihres Halters gehalten werden.</li>
	</ul>
</section>
<!-- =================================================
		6. Verbote
================================================== -->
<section class="doc-section">
	<h2>6. Verbote</h2>
	<ul>
		<li>Offene Feuer außerhalb der ausgewiesenen Grillbereiche.</li>
		<li>Pflanzen oder Bäume entfernen, beschädigen oder zerstören.</li>
		<li>Abfälle in den See oder an dessen Ufer werfen; Abfalleimer stehen zur Verfügung.</li>
		<li>Der Zugang mit dem Fahrrad ist verboten.</li>
		<li>Vögel und andere Wildtiere auf dem gesamten Gelände stören oder füttern.</li>
		<li>Camping und Übernachtungen sind auf dem gesamten Gelände verboten.</li>
		<li>Die Nutzung von Motorbooten ist verboten, mit Ausnahme der Boote des Rettungs- und Wartungsdienstes.</li>
		<li>Der Zugang zum See ist während der Wintermonate streng verboten.</li>
		<li>Das Gehen und jede andere Aktivität auf dem See sind bei schlechtem Wetter verboten.</li>
		<li>Steine oder andere Gegenstände werfen, die auf dem gesamten Gelände Verletzungen verursachen könnten.</li>
	</ul>
</section>
<!-- =================================================
		7. Persönliche Gegenstände
================================================== -->
<section class="doc-section">
	<h2>7. Persönliche Gegenstände</h2>
	<p class="article-text">
		Bitte achten Sie darauf, Ihre persönlichen Gegenstände
		jederzeit unter Kontrolle zu halten. Der Betreiber übernimmt
		keine Haftung bei Verlust oder Diebstahl,
		die in den Räumlichkeiten eintreten,
		unabhängig von den Umständen.
	</p>
</section>
<!-- =================================================
		8. Sportliche, folkloristische oder andere Veranstaltungen
================================================== -->
<section class="doc-section">
	<h2>8. Sportliche, folkloristische oder andere Veranstaltungen</h2>
	<p class="article-text">
		Die Organisation sportlicher, folkloristischer oder anderer
		Veranstaltungen erfordert die vorherige schriftliche Zustimmung des Betreibers.
	</p>
	<ul>
		<li>Die Veranstalter sind allein verantwortlich für Unfälle oder Schäden an Personen oder Sachen, vorbehaltlich der Rechte Dritter.</li>
		<li>Der Betreiber und/oder die Gemeinde können in keinem Fall haftbar gemacht werden.</li>
		<li>Bei Schäden an den Einrichtungen oder Räumlichkeiten gehen die Reparaturkosten zulasten der Veranstalter.</li>
	</ul>
</section>