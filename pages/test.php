<?php
/* Chargement des événements JSON */
$calendarEvents=json_decode(file_get_contents(BASE_PATH.'/data/carpo-events.json'),true)??[];
/* Langue active */
$calendarLang='fr';
/* Liste fixe des mois disponibles pour le sélecteur */
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
/* Plage proposée dans les listes déroulantes */
$start=date('Y-m');
$end=date('Y-m',strtotime('+11 months'));
$months=months_range($start,$end);
/* Lecture des paramètres GET */
$selectedStart=$_GET['debut']??$start;
$selectedEnd=$_GET['fin']??$end;
/* Validation */
if(!in_array($selectedStart,$months,true)){
    $selectedStart='2026-03';
}
if(!in_array($selectedEnd,$months,true)){
    $selectedEnd='2026-12';
}
/* Corriger si l'utilisateur inverse début et fin */
if($selectedStart>$selectedEnd){
    $tmp=$selectedStart;
    $selectedStart=$selectedEnd;
    $selectedEnd=$tmp;
}
/* Transmettre la plage choisie au partial */
$calendarMonthStart=$selectedStart;
$calendarMonthEnd=$selectedEnd;
/* Conserver la page actuelle pour le routeur */
$currentPage=$_GET['page']??'carpodrome';
?>
<form method="get" style="margin-bottom:1rem;">
    <input type="hidden" name="page" value="<?= htmlspecialchars($currentPage) ?>">
    <label for="debut">De :</label>
    <select name="debut" id="debut">
        <?php foreach($months as $m): ?>
            <option value="<?= htmlspecialchars($m) ?>" <?= $m===$selectedStart?'selected':'' ?>><?= htmlspecialchars($m) ?></option>
        <?php endforeach; ?>
    </select>
    <label for="fin" style="margin-left:1rem;">À :</label>
    <select name="fin" id="fin">
        <?php foreach($months as $m): ?>
            <option value="<?= htmlspecialchars($m) ?>" <?= $m===$selectedEnd?'selected':'' ?>><?= htmlspecialchars($m) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn" style="margin-left:1rem;">Afficher</button>
</form>
<?php include BASE_PATH.'/partials/calendar.php'; ?>