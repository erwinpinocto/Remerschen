<?php
/* Entrées attendues : events + bornes de mois + langue */
$calendarEvents=$calendarEvents??[];
$calendarMonthStart=$calendarMonthStart??'';
$calendarMonthEnd=$calendarMonthEnd??'';
$lang=$lang??'fr';
/* Génère les mois entre 2 bornes YYYY-MM */
function calendar_months_range(string $startYm,string $endYm): array{
    $months=[];
    $start=DateTime::createFromFormat('Y-m-d',$startYm.'-01');
    $end=DateTime::createFromFormat('Y-m-d',$endYm.'-01');
    if(!$start||!$end||$start>$end){return $months;}
    while($start<=$end){
        $months[]=$start->format('Y-m');
        $start->modify('+1 month');
    }
    return $months;
}
/* Libellé mois selon langue */
function calendar_month_label(string $ym,string $lang='fr'): string{
    $labels=[
        'fr'=>[1=>'janvier',2=>'février',3=>'mars',4=>'avril',5=>'mai',6=>'juin',7=>'juillet',8=>'août',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre'],
        'de'=>[1=>'Januar',2=>'Februar',3=>'März',4=>'April',5=>'Mai',6=>'Juni',7=>'Juli',8=>'August',9=>'September',10=>'Oktober',11=>'November',12=>'Dezember'],
        'en'=>[1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December']
    ];
    [$y,$m]=explode('-',$ym);
    $map=$labels[$lang]??$labels['fr'];
    return ucfirst(($map[(int)$m]??$m).' '.$y);
}
/* Libellé jour selon langue */
function calendar_day_label(string $date,string $lang='fr'): string{
    $map=[
        'fr'=>['Mon'=>'Lun','Tue'=>'Mar','Wed'=>'Mer','Thu'=>'Jeu','Fri'=>'Ven','Sat'=>'Sam','Sun'=>'Dim'],
        'de'=>['Mon'=>'Mo','Tue'=>'Di','Wed'=>'Mi','Thu'=>'Do','Fri'=>'Fr','Sat'=>'Sa','Sun'=>'So'],
        'en'=>['Mon'=>'Mon','Tue'=>'Tue','Wed'=>'Wed','Thu'=>'Thu','Fri'=>'Fri','Sat'=>'Sat','Sun'=>'Sun']
    ];
    $en=date('D',strtotime($date));
    $m=$map[$lang]??$map['fr'];
    return $m[$en]??$en;
}
/* Classe week-end */
function calendar_day_class(string $d): string{
    if(in_array($d,['Sam','Sat','Sa'],true)){return 'calendar-day-sat';}
    if(in_array($d,['Dim','Sun','So'],true)){return 'calendar-day-sun';}
    return '';
}
/* Expansion des events multi-jours */
function calendar_expand_dates(array $item): array{
    $dates=[];
    $start=$item['date_start']??'';
    $end=$item['date_end']??'';
    if($start===''){return $dates;}
    if($end===''){$end=$start;}
    $s=DateTime::createFromFormat('Y-m-d',$start);
    $e=DateTime::createFromFormat('Y-m-d',$end);
    if(!$s||!$e||$s>$e){return $dates;}
    while($s<=$e){
        $dates[]=$s->format('Y-m-d');
        $s->modify('+1 day');
    }
    return $dates;
}
/* Génération liste mois */
$calendarMonths=calendar_months_range($calendarMonthStart,$calendarMonthEnd);
if(empty($calendarMonths)||empty($calendarEvents)){return;}
/* Indexation calendrier */
$calendarData=[];
foreach($calendarMonths as $ym){
    $calendarData[$ym]=[];
}
foreach($calendarEvents as $item){
    if(empty($item['published'])){continue;}
    $tr=$item['translations'][$lang]??$item['translations']['fr']??[];
    $title=trim((string)($tr['title']??''));
    $text=trim((string)($tr['text']??''));
    if($title===''){continue;}
    foreach(calendar_expand_dates($item) as $date){
        $ym=substr($date,0,7);
        $day=(int)substr($date,8,2);
        if(!isset($calendarData[$ym])){continue;}
        $calendarData[$ym][$day][]=[
            'title'=>$title,
            'text'=>$text,
            'location'=>trim((string)($item['location']??'')),
            'time_start'=>trim((string)($item['time_start']??'')),
            'time_end'=>trim((string)($item['time_end']??'')),
            'link'=>trim((string)($item['link']??'')),
            'image'=>trim((string)($item['image']??'')),
        ];
    }
}
?>
<style>
.calendar-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1rem;margin:1rem 0;}
.calendar-card{background:#fff;border:1px solid #ddd;border-radius:12px;padding:1rem;}
.calendar-title{margin:0 0 .75rem;font-size:1.1rem;font-weight:700;}
.calendar-table{width:100%;border-collapse:collapse;}
.calendar-table th,.calendar-table td{padding:.55rem .6rem;border-bottom:1px solid #eee;text-align:left;}
.calendar-table th{background:#f7f7f7;font-weight:700;}
.calendar-date{display:inline-block;min-width:2rem;text-align:center;padding:.15rem .45rem;border-radius:999px;background:#f2f2f2;font-weight:700;}
.calendar-day-sat{color:#a66a00;}
.calendar-day-sun{color:#b00020;}
.calendar-event-title{font-weight:700;}
.calendar-event-text{display:block;color:#444;font-size:.95em;}
</style>
<div class="calendar-grid">
<?php foreach($calendarMonths as $ym): ?>
    <div class="calendar-card">
        <div class="calendar-title"><?=htmlspecialchars(calendar_month_label($ym,$lang))?></div>
        <table class="calendar-table">
            <thead>
                <tr>
                    <th><?=htmlspecialchars(t('calendar.date'))?></th>
                    <th><?=htmlspecialchars(t('calendar.day'))?></th>
                    <th><?=htmlspecialchars(t('calendar.event'))?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($calendarData[$ym])): ?>
                    <tr>
                        <td colspan="3">—</td>
                    </tr>
                <?php else: ?>
                    <?php ksort($calendarData[$ym]);foreach($calendarData[$ym] as $day=>$events):
                        $date=$ym.'-'.str_pad($day,2,'0',STR_PAD_LEFT);
                        $dow=calendar_day_label($date,$lang);
                    ?>
                        <tr>
                            <td><span class="calendar-date"><?=$day?></span></td>
                            <td class="<?=calendar_day_class($dow)?>"><?=htmlspecialchars($dow)?></td>
                            <td>
                                <?php foreach($events as $ev): ?>
                                    <div>
                                        <span class="calendar-event-title"><?=htmlspecialchars($ev['title'])?></span>
                                        <?php if($ev['text']!==''): ?>
                                            <span class="calendar-event-text"><?=htmlspecialchars($ev['text'])?></span>
                                        <?php endif; ?>
                                        <?php $details=$ev['link']!==''?$ev['link']:($ev['image']!==''?BASE_URL.'/assets/img/'.$ev['image']:''); ?>
                                        <?php if($details!==''): ?>
                                            <a class="btn" href="<?=htmlspecialchars($details)?>" target="_blank">
                                                <?=htmlspecialchars(t('buttons.more'))?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>
</div>