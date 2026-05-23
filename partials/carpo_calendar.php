<?php
/* Chargement des événements JSON */
$calendarEvents=json_decode(file_get_contents(BASE_PATH.'/data/carpo-events.json'),true)??[];
/* Langue active */
$lang=$lang??'fr';
/* Génère une liste de mois entre deux dates (YYYY-MM) */
function months_range($start,$end){
    $months=[];
    $d=DateTime::createFromFormat('Y-m-d',$start.'-01');
    $endDate=DateTime::createFromFormat('Y-m-d',$end.'-01');
    if(!$d||!$endDate||$d>$endDate){return $months;}
    while($d<=$endDate){
        $months[]=$d->format('Y-m');
        $d->modify('+1 month');
    }
    return $months;
}
/* Plage affichée (12 mois glissants) */
$start=date('Y-m');
$end=date('Y-m',strtotime('+11 months'));
$months=months_range($start,$end);
/* Lecture des paramètres GET */
$selectedStart=$_GET['debut']??$start;
$selectedEnd=$_GET['fin']??$end;
/* Validation des mois */
if(!in_array($selectedStart,$months,true)){
    $selectedStart=$start;
}
if(!in_array($selectedEnd,$months,true)){
    $selectedEnd=$end;
}
/* Correction si inversion */
if($selectedStart>$selectedEnd){
    [$selectedStart,$selectedEnd]=[$selectedEnd,$selectedStart];
}
/* Données transmises au partial */
$calendarMonthStart=$selectedStart;
$calendarMonthEnd=$selectedEnd;
/* Page courante */
$currentPage=$_GET['page']??'carpodrome';
/* Formulaire de sélection */
?>
<form method="get" action="<?= BASE_URL ?>/?page=<?= htmlspecialchars($currentPage) ?>&view=calendar#calendrier-peche" style="margin-bottom:1rem;">
    <input type="hidden" name="page" value="<?= htmlspecialchars($currentPage) ?>">
    <input type="hidden" name="view" value="calendar">
    <label for="debut">De :</label>
    <select name="debut" id="debut">
        <?php foreach($months as $m): ?>
            <option value="<?= htmlspecialchars($m) ?>" <?= $m===$selectedStart?'selected':'' ?>>
                <?= htmlspecialchars($m) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="fin" style="margin-left:1rem;">À :</label>
    <select name="fin" id="fin">
        <?php foreach($months as $m): ?>
            <option value="<?= htmlspecialchars($m) ?>" <?= $m===$selectedEnd?'selected':'' ?>>
                <?= htmlspecialchars($m) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn" style="margin-left:1rem;">Afficher</button>
</form>
<?php include BASE_PATH.'/partials/calendar.php'; ?>