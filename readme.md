# 🌐 Projet : Site web de Erliefnis Baggerweier ASBL
Erliefnis Baggerweier ASBL

------------------------------------------------
### Instructions pour l'écriture de code

1. Code dans un bloc unique.
2. Indentation correcte et cohérente.
3. Aucune ligne vide inutile.
4. Code compact (pas d’espacement décoratif).
5. Commentaires courts pour identifier les blocs logiques.
6. Code directement copiable dans le projet sans modification.

Indentation : tabulation
Langage principal : PHP / HTML / CSS
Format attendu : compact, commenté, sans lignes vides

------------------------------------------------

## 1. Objectif du projet
Développement d’un site vitrine en PHP pour présenter les activités de l’association Erliefnis Baggerweier, qui gère la base de loisirs de Remerschen.
Le site présente notamment :
- la base de loisirs
- le carpodrome
- les événements
- les tarifs
- les zones du site
- les partenaires
- les ateliers et activités
- les règlements
- les offres d’emploi
Le site est actuellement en version démonstration / prototype avancé.

------------------------------------------------

## 2. Environnement technique
### Serveur local
Environnement de développement :
- XAMPP (Windows)
- Apache + PHP
- Frontend : HTML / CSS
- Architecture PHP sans framework
- Pas de base de données pour le moment
- Document root local : `C:\xampp\htdocs`
- Projet : `C:\xampp\htdocs\baggerweier`
- URL locale : `http://localhost/baggerweier/`

### Hébergement web
- Serveur : Host4.globe.lu
- URL de test : `pp.baggerweier.lu`
- En production, le site est servi à la racine du domaine.

------------------------------------------------

## 3. Gestion des chemins (`BASE_PATH` / `BASE_URL`)
Le fichier `bootstrap.php` définit les chemins globaux.

### Chemin disque (PHP)
```php
define('BASE_PATH', __DIR__);
Exemple : C:\xampp\htdocs\baggerweier

------------------------------------------------

Chemin URL (HTML / CSS / images)
En local : define('BASE_URL', '/baggerweier');
En production : define('BASE_URL', '');
Ne jamais laisser les deux définitions actives simultanément.

------------------------------------------------

## 4. Architecture du projet - logique générale du site

Le site repose sur une architecture PHP simple :

1. index.php agit comme routeur principal.
2. La page demandée est récupérée via ?page=...
3. Le contenu correspondant est chargé depuis /pages.
4. Le header et le footer sont inclus via /partials.
5. Les données dynamiques simples (tarifs, statuts, FAQ) sont stockées en JSON.
6. Le CSS global est dans style.css et les pages peuvent charger leur CSS spécifique.

Structure principale :

/baggerweier
│
├── index.php
├── bootstrap.php
├── .htaccess
│
├── pages/
├── partials/
├── assets/
├── config/
├── data/
├── lang/

------------------------------------------------

5. Fichiers principaux

index.php
Point d’entrée public du site.
Contient un mini-routeur qui charge les pages depuis /pages.
Exemple : $page = $_GET['page'] ?? 'home';
Les pages autorisées sont définies dans un tableau : $allowedPages = [...]
Puis incluses dynamiquement.

------------------------------------------------

bootstrap.php
Initialise l’environnement global :
- charge les configurations
- définit les constantes
- initialise la session
- configure l’encodage et les erreurs
Tous les fichiers PHP passent par : require 'bootstrap.php';

------------------------------------------------

partials/

Contient les éléments réutilisables :

└───partials
        calendar.php
        carpo_calendar.php
        footer.php
        head.php
        header.php
        private_events.php
        public_events.php
        rates_display.php

head.php
- balise <head>
- CSS globaux
- métadonnées

header.php
- navigation principale
- menu du site

footer.php
- pied de page
- informations légales
- partenaires éventuels

rates_display.php
Composant permettant d’afficher les tarifs dynamiquement à partir du fichier rates.json.

------------------------------------------------

Section news

Les actualités sont gérées par la page pages/news.php, qui charge et affiche les données contenues dans data/news.json. Chaque entrée de news.json contient au minimum un id, une date, un statut published, un link optionnel, une image optionnelle et un bloc translations (FR/DE/EN). La page filtre les news publiées, les trie par date décroissante, puis affiche pour chacune la date, le titre, le texte, un bouton de lien éventuel et une image si elle existe. Le style spécifique de cette page est chargé directement dans news.php via assets/css/news.css, afin de garder style.css réservé aux composants globaux.

6. Organisation des pages

Les pages publiques se trouvent dans : /pages
Exemples :
home.php
loisirs.php
carpodrome.php
contact.php
events.php
faq.php
partners.php
zones.php
about.php
news.php

Certaines pages sont spécifiques :
carporules.php : règlement du carpodrome (imprimable)
loisirsrules.php : règlement de la base de loisirs
jobs.php : offres d’emploi

------------------------------------------------

7. Configuration
Les fichiers de configuration sont dans : /config
config.php
Contient certaines constantes globales.
Exemple : define('CARPODROME_OPEN', false); define('LOISIRS_OPEN', false);

------------------------------------------------

config.json
Contient les statuts dynamiques affichés sur le site.
{
  "carpodrome": {
    "statut": "ferme",
    "message": "Bonne soirée à tous les pêcheurs !"
  },
  "loisirs": {
    "statut": "ferme",
    "message": "Ouverture le 15 mars 2026"
  }
}

------------------------------------------------

config-admin.json
Identifiants administrateur pour la mini-interface admin.

------------------------------------------------

8. Gestion des tarifs

Les tarifs sont stockés dans `data/rates.json`, structuré en blocs thématiques (`carpodrome`, `loisirs`).
Chaque bloc contient un tableau `sections`, chaque section définissant un `title_key`, un tableau `visible_in` et un tableau `lignes`.
Chaque ligne porte un `label_key`, un `details_key` optionnel et un `prix` brut.

Les libellés (`title_key`, `label_key`, `details_key`) sont des clés de traduction résolues via la fonction `t()`,
qui les recherche dans `lang/{lang}/rates.php` avec fallback automatique sur le français.

L'affichage est délégué au partial `partials/rates_display.php`.
Avant de l'inclure, la page appelante doit fournir deux variables :
- `$ratesBloc` : le bloc de données issu de `rates.json` (ex. `$data['carpodrome']`)
- `$ratesDisplay` : le contexte d'affichage (`home`, `carpodrome`, `loisirs`, `flyer`)

Le partial filtre les sections dont `visible_in` contient le contexte actif,
puis génère pour chacune un tableau HTML `<table>` avec titre de section, libellé, détails et prix.
Les sections ou lignes vides sont ignorées silencieusement.

La mise en page est gérée par : assets/css/rates.css

------------------------------------------------

9. Organisation des styles

Les feuilles de styles sont dans : assets/css/
- style.css : CSS global du site.
- CSS spécifiques :
    - home.css
    - contact.css
    - loisirs.css
    - partners.css
    - events.css
    - docs.css
    - news.css
    - rates.css
Chaque page peut charger son CSS spécifique en complément.
Dans le cas où une mise en page purement locale est souhaitée, une surcharge inline est appliquée.
Une attention particulière est portée à la hiérarchie des styles pour éviter les effets indésirables de surcharges.

------------------------------------------------

10. Composants UI réutilisables
Certains blocs sont utilisés dans plusieurs pages :
- hero : bannière avec image de fond et titre (page d'accueil)
- header : bandeau pour les autres pages
- bloc-2cols : bloc générique deux colonnes
  - texte
  - image ou bouton
- btn : boutons standard du site
- doc-wrapper : mise en page document imprimable (PDF) pour règlements et formulaires
- bloc-card : bloc simple mis en évidence sur fond clair
- bloc-collapsible : permet de compacter de grosses sections
- dated-bloc_2cols : utilisé pour tous les items datés, comme news, events

### Contenus éditoriaux datés : News / Events / Carpodrome

Les actualités, les événements publics et les événements du carpodrome reposent sur une logique commune :

- données éditoriales stockées dans des fichiers JSON
- rendu PHP léger
- composants visuels réutilisables

Fichiers de données :

- `data/news.json`
- `data/public-events.json`
- `data/carpo-events.json`

Ces fichiers contiennent des tableaux d’objets décrivant chaque entrée.
Les événements du carpodrome peuvent également être affichés sous forme de calendrier via partials/calendar.php, avec un sélecteur de période (mois début / mois fin).

## Calendrier carpodrome

Le calendrier est composé de trois fichiers :

- `data/carpo-events.json` : données des événements carpodrome
- `partials/carpo_calendar.php` : formulaire de sélection de la plage de mois (12 mois glissants par défaut), transmise via GET (`?debut=YYYY-MM&fin=YYYY-MM`). Charge ensuite `partials/calendar.php`.
- `partials/calendar.php` : rendu du calendrier à partir de `data/carpo-events.json`.

### Fonctionnement
Les événements publiés sont indexés par mois et par jour. Les événements multi-jours sont expansés automatiquement. Chaque mois est affiché dans une carte avec un tableau date / jour / événement. Les week-ends sont colorés. Les libellés de mois et de jours sont multilingues (FR / DE / EN).

### Format des ids
Les ids des événements carpodrome suivent le format `carpo_YYYYMMDD_N` (ex. `carpo_20260606_1`). Ce format est requis pour que `generateItemId()` puisse incrémenter correctement lors de la création d'un nouvel événement via l'interface admin.

### Variables attendues par `calendar.php`
- `$calendarEvents` : tableau d'événements issu du JSON
- `$calendarMonthStart` / `$calendarMonthEnd` : bornes au format `YYYY-MM`
- `$lang` : langue active

### Structure générale d’une entrée

Champs communs :

- `id` : identifiant unique
- `created_at` : date de création
- `date_start` / `date_end` : période
- `date_display` : texte libre si la date ne peut pas être calculée
- `time_start` / `time_end` : horaires optionnels
- `location` : lieu optionnel
- `published` : booléen de publication
- `link` : lien externe ou page dédiée
- `image` : image optionnelle
- `translations` : contenus multilingues (`fr`, `de`, `en`)

### Structure JSON d’une entrée

```json
{
  "id": "",
  "created_at": "",
  "date_start": "",
  "date_end": "",
  "date_display": "",
  "time_start": "",
  "time_end": "",
  "location": "",
  "published": true,
  "link": "",
  "image": "",
  "translations": {
    "fr": {
      "title": "",
      "text": "",
      "bullets": [],
      "details": ""
    }
  }
}

## Interface d'édition news / events

L'interface `admin/edit-news-events.php` permet de gérer les entrées des trois fichiers JSON éditoriaux (`news.json`, `public-events.json`, `carpo-events.json`) sans toucher au code.

Elle est accessible via `?type=news`, `?type=events` ou `?type=carpo-events` et propose :
- création d'une nouvelle entrée avec génération automatique de l'id
- édition d'une entrée existante
- suppression avec confirmation
- gestion des traductions FR / DE / EN
- upload d'image vers `assets/img/news_events/` — le nom du fichier est celui du fichier uploadé, l'extension est déterminée automatiquement par le type MIME
- si le fichier existe déjà dans le dossier, il est lié sans re-upload
- si aucun fichier n'est uploadé, l'image existante est conservée

Les entrées sont triées par date décroissante à la sauvegarde.
------------------------------------------------

11. Pages document (impression)
Les règlements utilisent : docs.css
Structure :
- doc-wrapper
- doc-container
- doc-header
- doc-section
Ces pages doivent rester imprimables en PDF.

------------------------------------------------

12. État actuel du projet
Le projet est actuellement :
- fonctionnel en local et sur serveur
- architecture stabilisée
- contenu finalisé
- multilingue FR-EN-DE
Le site est considéré comme : version de pré-production
Projet : destiné à évoluer vers un site production dès que possible.
------------------------------------------------

13. Points sensibles à ne pas casser
Lors des modifications :
- maintenir la compatibilité local / production
- ne pas casser le mini-routage index.php?page=
- ne pas modifier la structure attendue par rates_display.php
- conserver l’inclusion des partials
- garder les pages document compatibles impression PDF
- Remarque importante : ne pas me balancer du code sans que je l'aie demandé. Lorsque tu m'en envoie, garde un format compact, indenté, commenté et sans lignes vides.

------------------------------------------------

14. Multilingue via /lang

### Gestion des traductions JSON (FAQ, données dynamiques)
Les contenus dynamiques (FAQ, events, news, etc.) utilisent une structure multilingue basée sur un champ `translations`.
#### Structure type
```json
{
  "id": 1,
  "translations": {
    "fr": {
      "question": "...",
      "answer": "...",
      "category": "...",
      "keywords": []
    },
    "en": {
      "question": "",
      "answer": "",
      "category": "",
      "keywords": []
    }
  }
}
```
#### Fonction `tr()`
La fonction `tr()` permet de récupérer les données dans la langue active avec fallback automatique vers le français.
**Comportement :**
- Si une traduction existe et est **non vide**, elle est utilisée
- Si une traduction est **vide ou absente**, la valeur française est conservée
- Évite les champs vides à l’affichage
#### Exemple d’utilisation
```php
$faqItem = tr($item, $lang);
echo $faqItem['question'];
echo $faqItem['answer'];
```
#### ⚠️ Important
Ne jamais remplacer les valeurs FR par des chaînes vides dans les traductions.
Une traduction vide est ignorée → fallback automatique sur le français.

15. Wantermoart 2026 – Gestion formulaire + règlement
### Structure retenue
- 1 page unique avec :
	- formulaire
	- règlement (partial multilingue)
- chargement dynamique du règlement selon `$lang`
- fallback automatique FR si fichier absent
```php
$rulesPartial=BASE_PATH.'/lang/'.$langCode.'/wantermoart_rules.php';
if(!is_readable($rulesPartial)) $rulesPartial=BASE_PATH.'/lang/'.$LANG_DEFAULT.'/wantermoart_rules.php';
```
### Organisation des fichiers
- `pages/wantermoart_2026.php` → structure + style local
- `lang/{lang}/wantermoart_rules.php` → contenu du règlement uniquement
👉 règle : **aucun style dans les partials**
### Impression
- formulaire + règlement imprimés
- séparation naturelle via containers
- suppression des sauts forcés (`page-break-before`) dans le règlement
### Compactage du règlement
Objectif : tenir sur 1 page A4
Solution :
- style local dans la page (pas dans `docs.css`)
- ciblage via `.doc-container.reglement`

### Choix techniques
- pas de refactor global (`docs.css` inchangé)
- pas de layout complexe (aside, flex, etc.)
- pas de duplication de style dans les langues
### Principe retenu
> simplicité + isolation + zéro effet de bord
- contenu = partials
- style spécifique = page
- global = `docs.css`

16. Arborescence complète :
C:.
│   .htaccess
│   bootstrap.php
│   index.php
│   readme.md
│   robots.txt
│
├───admin
│       admin-login.php
│       admin.php
│       edit-faq.php
│       edit-news-events.php
│       make-hash.php
│
├───assets
│   ├───css
│   │       booking.css
│   │       debug-css.php
│   │       debug.css
│   │       docs.css
│   │       faq.css
│   │       home.css
│   │       partners.css
│   │       rates.css
│   │       style.css
│   │
│   ├───docs
│   │       20260417_todo.txt
│   │
│   └───img
│       │   accessibilite1.jpg
│       │   accessibilite3.jpg
│       │   accessibilite4.png
│       │   accessibilite6.png
│       │   baggerweier-cygne.jpg
│       │   baggerweier1.jpg
│       │   baggerweier2.jpg
│       │   baggerweier2.webp
│       │   baggerweieren.jpg
│       │   baggerweier_banner.jpg
│       │   baggerweier_event_1.jpg
│       │   baggerweier_kayak1.avif
│       │   baggerweier_kayak2.avif
│       │   baggerweier_kayak_family.jpg
│       │   baignade.jpg
│       │   bbq_marshmallows.jpg
│       │   bbq_rent.jpg
│       │   beach_volley.jpg
│       │   billetterie.jpg
│       │   blue_mirror_banner.jpg
│       │   carpo1.jpg
│       │   carpo_stands.jpg
│       │   cc0_moselle.webp
│       │   cc0_moselle_1.jpg
│       │   chariot-ponton.jpg
│       │   cursus_de.png
│       │   cursus_en.png
│       │   cursus_fr.png
│       │   de.svg
│       │   en.svg
│       │   enfant_carpe.jpg
│       │   erliefnis1.jpg
│       │   events.jpg
│       │   events1.jpg
│       │   events4.png
│       │   events7.jpg
│       │   events8.jpg
│       │   events_mariage1.jpg
│       │   events_mariage2.jpg
│       │   events_mariage3.jpg
│       │   events_mariage4.jpg
│       │   flyer ateliers Recto.jpg
│       │   flyer_ateliers.jpg
│       │   flyer_ateliers_1.jpg
│       │   flyer_ateliers_impact.jpg
│       │   flyer_ateliers_verso.jpg
│       │   flyer_ateliers_vision.jpg
│       │   flyer_atelier_vert.jpg
│       │   flyer_carpodrome.jpg
│       │   flyer_contact.jpg
│       │   flyer_contact_carpo.jpg
│       │   flyer_formations.jpg
│       │   flyer_loisirs.jpg
│       │   flyer_private_events.jpg
│       │   flyer_regles_baignade.jpg
│       │   form_jardiniere1.jpg
│       │   form_jardi_pelouse1.jpg
│       │   form_jardi_pelouse2.jpg
│       │   form_lifeguard1.jpg
│       │   form_lifeguard2.jpg
│       │   form_menuiserie_path1.jpg
│       │   form_menuiserie_ponce.jpg
│       │   form_talus2.jpg
│       │   fr.svg
│       │   inclusion.webp
│       │   jardinage.webp
│       │   kayaks2.jpg
│       │   kids-ponton.jpg
│       │   kidspool2.jpg
│       │   kidspool5.jpg
│       │   kidspool6.jpg
│       │   kidspool7.jpg
│       │   lb.svg
│       │   logo.jpg
│       │   logo_baggerweier.svg
│       │   logo_regiondo.svg
│       │   loisirs1.jpg
│       │   management.webp
│       │   menuiserie_rambarde.jpg
│       │   multiservices.webp
│       │   paddle1.png
│       │   peche-famille.jpg
│       │   petanque.jpg
│       │   plage-relax.jpg
│       │   plage_paddle.jpg
│       │   regiondo-logo.jpg
│       │   resultats&impact.jpg
│       │   sculptures_sable.jpg
│       │   sm_entry_1.jpg
│       │   team.jpg
│       │   team1.jpg
│       │   teambuilding.webp
│       │   teambuilding_lac.webp
│       │   ullabeach2.jpg
│       │   unsplash_concours_peche.avif
│       │   unsplash_management_1.avif
│       │   unsplash_multi_services_3.avif
│       │   unsplash_secretariat_1.avif
│       │   vision.jpg
│       │   visitluxembourg.jpg
│       │   wikimedia-chateau-de-schengen.jpeg
│       │   wikimedia_biodiversum.avif
│       │   wikimedia_fondation_valentiny.webp
│       │   wikimedia_moselle.jpg
│       │   wikimedia_possenhaus_schengen.jpg
│       │   wikimedia_schengenmuseum.jpg
│       │
│       ├───news_events
│       │       baignade.jpg
│       │       erlefniss.jpg
│       │       etang1.webp
│       │       event_winter1.jpg
│       │       marina_freschmoart.jpg
│       │       sm_festival_2026.jpg
│       │
│       ├───partners
│       │       cmcm.svg
│       │       commune-schengen.png
│       │       design-for-all-international.jpg
│       │       design-for-all-luxembourg.jpg
│       │       Environement.jpg
│       │       Liste-logos.TXT
│       │       logo_schengen.svg
│       │       losch_fondation.jpg
│       │       ministry-mobility.jpg
│       │       ministry-social.jpg
│       │       ministry-tourism.jpg
│       │       ministry-work.jpg
│       │       ministry-work.webp
│       │       mobiliteit.jpg
│       │       Noms.TXT
│       │       oeuvre-charlotte.jpg
│       │       rotary-schengen.jpg
│       │       schengenmarina.png
│       │       Travail.jpg
│       │       visit-luxembourg.jpg
│       │       visit-mosel.jpg
│       │       visit-mosel.svg
│       │       visit-mosel2.jpg
│       │       wonschstaer.jpg
│       │
│       └───zones
│               baggerweier_hs.png
│               carpodrome.jpg
│               carpodrominfo.jpg
│               map.png
│               randonnee.jpg
│               schwammweier.png
│               zone10.png
│               zone11.png
│               zone2.png
│               zone3.png
│               zone4.png
│               zone5.png
│               zone6.png
│               zone7.png
│               zone8.png
│               zone9.png
│
├───config
│       config-admin.json
│       config.json
│       config.php
│
├───data
│       carpo-events.json
│       faq.json
│       news.json
│       public-events.json
│       rates.json
│
├───lang
│   ├───de
│   │       carpo-welcome.php
│   │       carporules.php
│   │       commons.php
│   │       documents.php
│   │       dogrules.php
│   │       loisirsrules.php
│   │       pages.php
│   │       rates.php
│   │       wantermoart_rules.php
│   │
│   ├───en
│   │       carpo-welcome.php
│   │       carporules.php
│   │       commons.php
│   │       documents.php
│   │       dogrules.php
│   │       loisirsrules.php
│   │       pages.php
│   │       rates.php
│   │       wantermoart_rules.php
│   │
│   └───fr
│           carpo-welcome.php
│           carporules.php
│           commons.php
│           documents.php
│           dogrules.php
│           loisirsrules.php
│           pages.php
│           rates.php
│           wantermoart_rules.php
│
├───pages
│       about.php
│       ateliers.php
│       carpodrome.php
│       carporules.php
│       carpo_booking.php
│       contact.php
│       dogrules.php
│       events.php
│       faq copy.php
│       faq.php
│       home.php
│       jobs.php
│       loisirs.php
│       loisirsrules.php
│       news.php
│       partners.php
│       private_booking.php
│       public_booking.php
│       rates_flyer.php
│       test.php
│       visitmosel.php
│       wantermoart_2026.php
│       zones.php
│
└───partials
        calendar.php
        carpo_calendar.php
        footer.php
        head.php
        header.php
        private_events.php
        public_events.php
        rates_display.php