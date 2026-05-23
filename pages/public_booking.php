<?php
require __DIR__.'/../bootstrap.php'; // initialise l'environnement
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- encodage -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- responsive -->
    <title>Inscription à un évènement</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/docs.css"> <!-- layout document -->
</head>
<body>
    <div class="doc-wrapper">
        <div class="doc-container"> <!-- structure document -->
            <header class="doc-header">
                <div class="doc-header-logo">
                    <img src="<?= BASE_URL ?>/assets/img/logo.jpg" alt="Logo Erliefnis Baggerweier">
                </div>
                <div class="doc-header-title">
                    <h1>Inscription à un évènement</h1>
                </div>
            </header>
            <form class="doc-form"> <!-- formulaire inscription -->
                <!-- Participant -->
                <section id="participant">
                    <h2>Participant</h2>
                    <label>Nom</label>
                    <input type="text" name="last_name"> <!-- nom -->
                    <label>Prénom</label>
                    <input type="text" name="first_name"> <!-- prénom -->
                    <label>Email</label>
                    <input type="email" name="email"> <!-- email -->
                    <label>Téléphone</label>
                    <input type="text" name="phone"> <!-- téléphone -->
                </section>
                <!-- Évènement -->
                <section id="event">
                    <h2>Évènement</h2>
                    <label>Libellé de l’évènement</label>
                    <input type="text" name="event_name"> <!-- nom event -->
                    <label>Date</label>
                    <input type="date" name="event_date"> <!-- date event -->
                </section>
                <!-- Participants -->
                <section id="participants">
                    <h2>Participants</h2>
                    <div class="grid-2">
                        <label>
                            Nombre d’adultes
                            <input type="number" name="participants_adults" min="0" value="1"> <!-- adultes -->
                        </label>
                        <label>
                            Nombre d’enfants (-12 ans)
                            <input type="number" name="participants_children" min="0" value="0"> <!-- enfants -->
                        </label>
                    </div>
                </section>
                <!-- Informations -->
                <section id="needs">
                    <h2>Besoins particuliers</h2>
                    <textarea name="special_needs" placeholder="Allergies, accessibilité, remarques..."></textarea> <!-- remarques -->
                </section>
                <!-- Confirmation -->
                <section id="confirmation">
                    <h2>Confirmation</h2>
                    <label>
                        <input type="checkbox" name="terms">
                        Je confirme que les informations fournies sont exactes
                    </label> <!-- validation -->
                </section>
                <!-- Actions écran -->
                <div class="print-actions no-print">
                    <button type="button" onclick="window.location.href='<?= BASE_URL ?>/?page=events'">⬅️ Retour</button> <!-- retour -->
                    <button type="button" onclick="window.print()">🖨️ Imprimer / PDF</button> <!-- impression -->
                </div>
            </form>
        </div>
    </div>
</body>
</html>