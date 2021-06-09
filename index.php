<?php
include('header.php');

echo '
	<table width="692" height="131" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td width="9" height="9" background="images/anunt_11.gif"></td>
            <td background="images/anunt_12.gif"></td>
            <td width="9" height="9" background="images/anunt_14.gif"></td>
        </tr>
        <tr>
            <td width="9" background="images/anunt_19.gif">&nbsp;</td>
            <td align="center" valign="center" height="113" style="padding:0px; margin:0px;">
				<img src="images/reclama_index.gif" height="113" width="674" alt="" />
			</td>
            <td width="9" background="images/anunt_21.gif">&nbsp;</td>
        </tr>
        <tr>
            <td width="9" height="9" background="images/anunt_27.gif"></td>
            <td background="images/anunt_28.gif"></td>
            <td width="9" height="9" background="images/anunt_29.gif"></td>
        </tr>
	</table>
';

$cerereSQL = 'SELECT * FROM `cat` ORDER BY `nume` ASC';
$rezultat = mysqli_query($conexiune, $cerereSQL);
echo '<table width="693" border="0" cellspacing="7" cellpadding="0"><tr>';
$nr = 0;
while ($rand = mysqli_fetch_assoc($rezultat)) {
	$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `cat`="' . $rand['nume'] . '" ORDER BY `id` DESC';
	$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
	if (mysqli_num_rows($rezultat2) != 0) {
		$ok = 0;
		while (($rand2 = mysqli_fetch_assoc($rezultat2)) && ($rand2['cat'] != 'Imobiliare') && ($ok != 1)) {
			$poza = explode(',', $rand2['poze']);

			if (!file_exists('anunturi/thumb_' . $poza[0])) {
				$src = 'images/thumb_nophoto.gif';
			} else {
				$src = 'anunturi/thumb_' . $poza[0];
			}

			$date = explode("/", $rand2['data']);
			$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($date[0], $date[1], $date[2], $date[3], $date[4], $date[5]);
			$zile = floor($seconds_dif / 60 / 60 / 24);
			$ore = floor($seconds_dif / 60 / 60);
			$or = $durata * 24;
			if ($ore <= $or) {
				$titlu = wordwrap($rand2['titlu'], 16, "\n", true);
				$titlu = mb_strimwidth($titlu, 0, 48, '...');
				$nr++;
				echo '
									<td class="index" width="33%">
										<table border="0" cellpadding="5" cellspacing="0" width="100%" height="100">
											<tr>
												<td width="100" rowspan="2" align="center">
													<a href="anunt.php?id=' . $rand2['id'] . '"><img src="' . $src . '" alt="' . $rand2['titlu'] . '" /></a>
												</td>
												<td valign="top" align="left">
													<a href="anunt.php?id=' . $rand2['id'] . '">' . $titlu . '<br /></a>
												</td>
											</tr>
											<tr>
												<td valign="bottom" align="center">
													<a href="anunt.php?id=' . $rand2['id'] . '"><font style="font-size:14px; color:#FF0000; font-weight:bold;">' . $rand2['pret'] . ' ' . strtoupper($rand2['moneda']) . '</font></a>
												</td>
											</tr>
										</table>
									</td>';
				if ($nr % 3 == 0) echo '</tr><tr>
									';
				$ok = 1;
			}
		}
	}
}
echo '</tr></table>';
echo '<table width="693" border="0" cellspacing="7" cellpadding="0"><tr>';
$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `cat`="Auto-Moto" ORDER BY RAND()';
$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
if (mysqli_num_rows($rezultat2) != 0) {
	$ok = 0;
	while (($rand2 = mysqli_fetch_assoc($rezultat2)) && ($rand2['cat'] != 'Altele') && ($ok != 1)) {
		$poza = explode(',', $rand2['poze']);

		if (!file_exists('anunturi/' . $poza[0])) {
			$src = 'images/thumb_nophoto.gif';
		} else {
			$src = 'anunturi/' . $poza[0];
		}
		$date = explode("/", $rand2['data']);
		$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($date[0], $date[1], $date[2], $date[3], $date[4], $date[5]);
		$zile = floor($seconds_dif / 60 / 60 / 24);
		$ore = floor($seconds_dif / 60 / 60);
		$or = $durata * 24;
		if ($ore <= $or) {
			$titlu = mb_strimwidth($rand2['titlu'], 0, 46, '...');
			$nr++;
			echo '
									<td class="index" width="50%">
										<table border="0" cellpadding="5" cellspacing="0" width="100%" height="200">
											<tr>
												<td align="center">
													<a href="anunt.php?id=' . $rand2['id'] . '">' . $titlu . '</a>                                        </td>
											</tr>
											<tr>
											  <td align="center"><a href="anunt.php?id=' . $rand2['id'] . '"><img src="' . $src . '" height="150" alt="' . $rand2['titlu'] . '" /></a></td>
										  </tr>
											<tr>
											  <td align="center"><a href="anunt.php?id=' . $rand2['id'] . '"><font style="font-size:14px; color:#FF0000; font-weight:bold;">' . $rand2['pret'] . ' ' . strtoupper($rand2['moneda']) . '</font></a></td>
											</tr>
										</table>
									</td>
									';
			$ok = 1;
		}
	}
}
$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `cat`="Imobiliare" ORDER BY RAND()';
$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
if (mysqli_num_rows($rezultat2) != 0) {
	$ok = 0;
	while (($rand2 = mysqli_fetch_assoc($rezultat2)) && ($rand2['cat'] != 'Altele') && ($ok != 1)) {
		$poza = explode(',', $rand2['poze']);

		if (!file_exists('anunturi/' . $poza[0])) {
			$src = 'images/thumb_nophoto.gif';
		} else {
			$src = 'anunturi/' . $poza[0];
		}
		$date = explode("/", $rand2['data']);
		$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($date[0], $date[1], $date[2], $date[3], $date[4], $date[5]);
		$zile = floor($seconds_dif / 60 / 60 / 24);
		$ore = floor($seconds_dif / 60 / 60);
		$or = $durata * 24;
		if ($ore <= $or) {
			$titlu = mb_strimwidth($rand2['titlu'], 0, 46, '...');
			$nr++;
			echo '
									<td class="index" width="50%">
										<table border="0" cellpadding="5" cellspacing="0" width="100%" height="200">
											<tr>
												<td align="center">
													<a href="anunt.php?id=' . $rand2['id'] . '">' . $titlu . '</a>                                        </td>
											</tr>
											<tr>
											  <td align="center"><a href="anunt.php?id=' . $rand2['id'] . '"><img src="' . $src . '" height="150" alt="' . $rand2['titlu'] . '" /></a></td>
										  </tr>
											<tr>
											  <td align="center"><a href="anunt.php?id=' . $rand2['id'] . '"><font style="font-size:14px; color:#FF0000; font-weight:bold;">' . $rand2['pret'] . ' ' . strtoupper($rand2['moneda']) . '</font></a></td>
											</tr>
										</table>
									</td>
									';
			$ok = 1;
		}
	}
}
echo '</tr></table>';

include('footer.php');
