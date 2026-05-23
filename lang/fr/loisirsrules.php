<!-- =========EN-TÊTE DU DOCUMENT===--> 
<header class="doc-header">
    <div class="doc-header-logo">
        <img
            src="<?= BASE_URL ?>/assets/img/logo.jpg"
            alt="Logo Erliefnis Baggerweier"
        >
    </div>
    <div class="doc-header-title">
        <h1>Règlement intérieur et règles de baignade</h1>
        <div class="version">Erliefnis Baggerweier – Remerschen</div>
    </div>
</header>
<!-- =================================================
        1. Objet du règlement
================================================== -->
<section class="doc-section">
    <h2>1. Objet du règlement</h2>

    <p class="article-text">
        Afin de garantir la sécurité, la propreté et le confort
        de tous les visiteurs, toute personne entrant sur le site
        du complexe aquatique Baggerweier s’engage à respecter
        le présent règlement intérieur.
    </p>
</section>
<!-- =================================================
        2. Horaires d’ouverture
================================================== -->
<section class="doc-section">
    <h2>2. Horaires d’ouverture</h2>
    <h3>Billetterie</h3>
    <p class="article-text">
        La billetterie est ouverte de <strong>10h00 à 17h30</strong>,
        du <strong>1er mai au 15 septembre 2026</strong>.
    </p>
    <h3>Horaires de fermeture du site</h3>
    <ul>
        <li><strong>Mai :</strong> fermeture à 18h00 tous les jours.</li>
        <li><strong>Juin :</strong> fermeture à 18h00, sauf vendredi et samedi : 20h00 si les conditions météorologiques le permettent.</li>
        <li><strong>Juillet :</strong> fermeture à 18h00, sauf jeudi, vendredi et samedi : 20h00 si les conditions météorologiques le permettent.</li>
        <li><strong>Août :</strong> fermeture à 18h00, sauf jeudi, vendredi et samedi : 20h00 si les conditions météorologiques le permettent.</li>
        <li><strong>Septembre :</strong> fermeture à 18h00, sauf vendredi et samedi : 20h00 si les conditions météorologiques le permettent.</li>
    </ul>
</section>
<!-- =================================================
        3. Tarifs d’entrée
================================================== -->
<section class="doc-section">
    <h2>3. Tarifs d’entrée</h2>
    <div class="doc-rates">
        <?php
            $ratesBloc    = $RATES['loisirs'] ?? null;
            $ratesDisplay = 'loisirs';
            require BASE_PATH . '/partials/rates_display.php';
        ?>
    </div>
</section>
<!-- =================================================
        4. Règlement de baignade
================================================== -->
<section class="doc-section">
    <h2>4. Règlement de baignade</h2>
    <h3>Surveillance</h3>
    <ul>
        <li>La baignade est autorisée durant la saison, du 1er mai au 15 septembre.</li>
        <li>Baignade surveillée de <strong>10h00 à 18h00</strong> au bassin pour enfants uniquement.</li>
        <li>Dans les autres zones du lac, la baignade est libre.</li>
        <li>La baignade s’effectue aux risques et périls des usagers.</li>
    </ul>
    <h3>Responsabilité</h3>
    <p class="article-text">
        L’exploitant décline toute responsabilité
        en cas d’incident ou d’accident.
    </p>
    <h3>Sécurité des enfants</h3>
    <ul>
        <li>Les brassards sont obligatoires pour les enfants de moins de 8 ans.</li>
        <li>Les brassards sont disponibles à la billetterie au prix de 3 €.</li>
        <li>Les enfants de moins de 10 ans sont sous la responsabilité d’un adulte accompagnateur.</li>
    </ul>
    <h3>Sécurité sur le lac</h3>
    <ul>
        <li>L’utilisation d’une bouée de sécurité est obligatoire sur le lac.</li>
        <li>Cette bouée est disponible à la billetterie.</li>
    </ul>
</section>
<!-- =================================================
        5. Animaux
================================================== -->
<section class="doc-section">
    <h2>5. Animaux</h2>
    <ul>
        <li>Les chiens d’assistance sont admis sur l’ensemble du site.</li>
        <li>Les chiens sont admis uniquement dans la zone de plage canine désignée (Zone 6) et sur la terrasse / bar (Zone 2).</li>
        <li>Ils doivent être tenus en laisse et sous le contrôle de leur maître.</li>
    </ul>
</section>
<!-- =================================================
        6. Interdictions
================================================== -->
<section class="doc-section">
    <h2>6. Interdictions</h2>
    <ul>
        <li>Feux à ciel ouvert en dehors des zones de barbecue désignées.</li>
        <li>Enlever, endommager ou détruire des plantes ou des arbres.</li>
        <li>Jeter des déchets dans le lac et ses abords ; des poubelles sont à disposition.</li>
        <li>L’accès à vélo est interdit.</li>
        <li>Déranger ou nourrir les oiseaux et autres animaux sauvages sur l’ensemble du site.</li>
        <li>Le camping et les séjours de nuit sont interdits sur l’ensemble du site.</li>
        <li>L’utilisation de bateaux à moteur, à l’exception de ceux appartenant au service de sauvetage et d’entretien, est interdite.</li>
        <li>L’accès au lac est strictement interdit pendant les mois d’hiver.</li>
        <li>La marche et toute autre activité sur le lac sont interdites par mauvais temps.</li>
        <li>Jeter des pierres ou tout autre objet susceptible de blesser sur l’ensemble du site.</li>
    </ul>
</section>
<!-- =================================================
        7. Effets personnels
================================================== -->
<section class="doc-section">
    <h2>7. Effets personnels</h2>
    <p class="article-text">
        Veuillez veiller à garder vos effets personnels
        sous contrôle en permanence. L’exploitant décline
        toute responsabilité en cas de perte ou de vol
        survenu dans les locaux, quelles que soient
        les circonstances.
    </p>
</section>
<!-- =================================================
        8. Événements sportifs, folkloriques ou autres
================================================== -->
<section class="doc-section">
    <h2>8. Événements sportifs, folkloriques ou autres</h2>
    <p class="article-text">
        L’organisation d’événements sportifs, folkloriques ou autres
        requiert l’accord écrit préalable de l’exploitant.
    </p>
    <ul>
        <li>Les organisateurs sont seuls responsables des accidents ou dommages causés aux personnes ou aux biens, sous réserve des droits des tiers.</li>
        <li>L’exploitant et/ou la municipalité ne peuvent en aucun cas être tenus responsables.</li>
        <li>En cas de dommages aux installations des locaux, les frais de réparation seront à la charge des organisateurs.</li>
    </ul>
</section>

