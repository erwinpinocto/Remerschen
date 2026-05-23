<?php
/* PARTIAL : rates.php */
/* Affiche un bloc de tarifs à partir de $ratesBloc */
/* Contexte attendu dans $ratesDisplay : home, carpodrome, loisirs, flyer */
if(empty($ratesBloc)||!is_array($ratesBloc)) return;
$sections=$ratesBloc['sections']??[];
if(!is_array($sections)||empty($sections)) return;
$ratesDisplay=$ratesDisplay??'home';
?>
<div class="doc-rates">
	<?php foreach($sections as $section): ?>
		<?php
		$visibleIn=$section['visible_in']??[];
		if(!is_array($visibleIn)) $visibleIn=[];
		if(!in_array($ratesDisplay,$visibleIn,true)) continue;
		$sectionTitle=t($section['title_key']??'');
		$lignes=$section['lignes']??[];
		if(!is_array($lignes)||empty($lignes)) continue;
		?>
		<section class="info-tarifs">
			<?php if($sectionTitle!==''): ?>
				<h3><?= htmlspecialchars($sectionTitle) ?></h3>
			<?php endif; ?>
			<table>
				<tbody>
					<?php foreach($lignes as $ligne): ?>
						<?php
						$label=t($ligne['label_key']??'');
						$details=isset($ligne['details_key'])?t($ligne['details_key']):'';
						$prix=$ligne['prix']??'';
						?>
						<tr>
							<td>
								<?= htmlspecialchars($label) ?>
								<?php if($details!==''): ?>
									<div class="rate-details"><?= htmlspecialchars($details) ?></div>
								<?php endif; ?>
							</td>
							<td><?= htmlspecialchars($prix) ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
	<?php endforeach; ?>
</div>