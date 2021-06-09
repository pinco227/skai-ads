<?php
include('header.php');
$cerereSQL = 'SELECT * FROM `anunt` WHERE `id`="' . $_GET['id'] . '"';
$rezultat = mysqli_query($conexiune, $cerereSQL);
while ($rand = mysqli_fetch_assoc($rezultat)) {
	$poze = explode(",", $rand['poze']);
	if (isset($_POST['mmail'])) {
		$_SESSION['mname'] = $_POST['mname'];
		$_SESSION['memail'] = $_POST['memail'];
		$_SESSION['mtel'] = $_POST['mtel'];
		$_SESSION['mmesaj'] = $_POST['mmesaj'];
		if (($_SESSION['mname'] == '') || ($_SESSION['mmesaj'] == '')) {
			echo '
						<table border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width="9" height="9" background="images/anunt_11.gif"></td>
								<td background="images/anunt_12.gif"></td>
								<td width="9" height="9" background="images/anunt_14.gif"></td>
							</tr>
							<tr>
								<td width="9" background="images/anunt_19.gif">&nbsp;</td>
								<td style="padding-left:3px; padding-right:3px;" align="center">
									<strong>Eroare!</strong>';
			if ($_SESSION['mname'] == '') echo '<br />Nu ai completat numele!';
			if ($_SESSION['mmesaj'] == '') echo '<br />Nu ai completat mesajul!';
			echo '</td>
							<td width="9" background="images/anunt_21.gif">&nbsp;</td>
						</tr>
						<tr>
							<td width="9" height="9" background="images/anunt_27.gif"></td>
							<td background="images/anunt_28.gif"></td>
							<td width="9" height="9" background="images/anunt_29.gif"></td>
						</tr>
					</table>
					';
		} else {
			$catre = $rand['mail'];
			$subiect = 'Skai.Ro - mesaj de la ' . $_SESSION['mname'];
			$mesaj = '
					<html>
					<head>
					<title>' . $subiect . '</title>
					</head>
					<body>
					Ati primit un mesaj de pe pagina produsului <b><a href="http://www.skai.ro/anunt.php?id=' . $rand['id'] . '">' . $rand['titlu'] . '</a></b> !<br />
					Nume : <b>' . $_SESSION['mname'] . '</b> <br />
					Email: <b>' . $_SESSION['memail'] . '</b> <br />
					Mesaj : <br />
					' . $_SESSION['mmesaj'] . '<br />
					</body></html>';
			$headere = "MIME-Version: 1.0\r\n";
			$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headere .= "From: " . $_SESSION['memail'] . " <SKAI.RO>\r\n";

			// mail($catre, $subiect, $mesaj, $headere);
			echo '<script>alert("Felicitari!\nMesajul a fost trimis cu succes!");</script>';
			$_SESSION['mname'] = '';
			$_SESSION['memail'] = '';
			$_SESSION['mtel'] = '';
			$_SESSION['mmesaj'] = '';
		}
	}
	echo
	'
			<table width="941" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3" align="left" style="padding-bottom:5px;">
						<h2>' . $rand['titlu'] . '</h2>
						<div align="right"><font style="font-size:10px;"><a href="index.php">Home</a> >> <a href="anunturi.php?cat=' . $rand['cat'] . '">' . $rand['cat'] . '</a> >> <a href="anunturi.php?cat=' . $rand['cat'] . '&subcat=' . $rand['subcat'] . '">' . $rand['subcat'] . '</a></font></div>					</td>
				</tr>
				<tr>
					<td colspan="3" style="background-image:url(images/anunt_12.gif); background-repeat:repeat-x;" height="9"></td>
				</tr>
				<tr>
					<td width="432" rowspan="2" valign="top" style="padding-left:5px;">';
	$date = explode("/", $rand['data']);
	$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($date[0], $date[1], $date[2], $date[3], $date[4], $date[5]);
	$zile = floor($seconds_dif / 60 / 60 / 24);
	$ore = floor($seconds_dif / 60 / 60);
	if ($ore < ($durata * 24)) {
		$cat = $durata - $zile;
		if ($cat == 1) $mesaj = 'expira in <strong>' . ($durata * 24) - $ore . '</strong> ore';
		else $mesaj = 'expira in <strong>' . $cat . '</strong> zile';
	} else {
		$mesaj = 'expirat';
	}
	echo '
						<h3>Pret: ' . $rand['pret'] . ' ' . strtoupper($rand['moneda']) . '</h3>
						<hr color="#CCCCCC" size="1" />
						<strong>' . $mesaj . '</strong>';
	if ($rand['subcat'] == "Automobile") {
		$alte = explode(",", $rand['alte']);
		echo '
							<hr color="#CCCCCC" size="1" />
							<strong>Marca: </strong> ' . $alte[0] . '
							<hr color="#CCCCCC" size="1" />';
		if ($alte[1] == '') echo '';
		else {
			echo '<strong>Seria: </strong> ' . $alte[1] . '
								<hr color="#CCCCCC" size="1" />';
		}
		echo '
							<strong>Model: </strong> ' . $alte[2] . '
							<hr color="#CCCCCC" size="1" />
							<strong>Caroserie: </strong> ' . $alte[3] . '
							<hr color="#CCCCCC" size="1" />
							<strong>An fabricatie: </strong> ' . $alte[4] . '
							<hr color="#CCCCCC" size="1" />
							<strong>Carburatie: </strong> ' . $alte[5] . '
							<hr color="#CCCCCC" size="1" />
							<strong>Km parcursi: </strong> ' . $alte[6] . '
							<hr color="#CCCCCC" size="1" />
							<strong>Capacitate cilindrica: </strong> ' . $alte[7] . ' cc
							<hr color="#CCCCCC" size="1" />
							<strong>Putere: </strong> ' . $alte[8] . ' CP
							';
	} elseif (($rand['subcat'] == "Apartamente") || ($rand['subcat'] == "Case / Vile") || ($rand['subcat'] == "Case de lemn") || ($rand['subcat'] == "Inchirieri apartamente")) {
		$alte = explode(",", $rand['alte']);
		echo '
							<hr color="#CCCCCC" size="1" />
							<strong>Camere: </strong> ' . $alte[0] . '
							<hr color="#CCCCCC" size="1" />
							<strong>Bai: </strong> ' . $alte[1] . '
							<hr color="#CCCCCC" size="1" />
							<strong>Suprafata: </strong> ' . $alte[2] . ' mp
							';
	} elseif ($rand['subcat'] == "Terenuri") {
		$alte = explode(",", $rand['alte']);
		echo '
							<hr color="#CCCCCC" size="1" />
							<strong>Suprafata: </strong> ' . $alte[0] . ' mp
							<hr color="#CCCCCC" size="1" />
							<strong>Teren: </strong> ' . $alte[1] . '
							';
	}
	echo '
						<hr color="#CCCCCC" size="1" />
						<strong>Descriere</strong><br />
							' . $rand['continut'] . '
						<hr color="#CCCCCC" size="1" />
							Produs disponibil in <strong>' . $rand['oras'] . '</strong>
						<hr color="#CCCCCC" size="1" />
							<img src="images/phone.png" alt="Telefon" align="absmiddle" /> <font style="font-size:14px;"><strong>Telefon:</strong> ' . $rand['tel'] . '</font>
                  <br />
				  <hr color="#CCCCCC" size="1" />
                  <img src="images/mail.png" alt="Trimite Mail" align="absmiddle" /> <font style="font-size:14px;"><strong>Trimite e-mail</strong></font>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" style="background-color:#F3F3F3;">
							<tr>
								<td>
									<form name="mmail" action="" method="post">
									Nume si Prenume:<br />
									<input type="text" name="mname" size="30" /><br />
									Adresa de e-mail:<br />
									<input type="text" name="memail" size="30" /><br />
									Numarul de telefon:<br />
									<input type="text" name="mtel" size="30" /><br />
									Mesaj:<br />
									<textarea name="mmesaj" style="width:430px;" rows="6"></textarea><br />
									<input type="submit" name="mmail" value="Trimite" />
									</form>								</td>
							</tr>
				  </table></td>
					<td width="9" background="images/anunt_19.gif"></td>
					<td width="500" rowspan="2" align="center" valign="top">';
	if ($poze[0] == "") {
		echo '<img src="images/nophoto.gif" width="482" height="482" />';
	} else {
		if (file_exists('anunturi/' . $poze[0])) {
			$image_name = 'anunturi/' . $poze[0];
			list($width, $height) = getimagesize($image_name);
			if (($width < 482) && ($height < 482)) {
				$nwidth = $width;
				$nheight = $height;
			} else {
				if ($width > $height) {
					$nwidth = 482;
					$ratio = $width / $nwidth;
					$nheight = $height / $ratio;
				} elseif ($height > $width) {
					$nheight = 482;
					$ratio = $height / $nheight;
					$nwidth = $width / $ratio;
				} else {
					$nwidth = 482;
					$nheight = 482;
				}
			}
			echo '
									<img src="anunturi/' . $poze[0] . '" width="' . $nwidth . '" height="' . $nheight . '" name="myImage" />
									<table><tr><td></td></tr></table>
                        		';
			foreach ($poze as $poza) {
				if (!empty($poza)) {
					if (file_exists('anunturi/thumb_' . $poza)) {
						$image_name = 'anunturi/' . $poza;
						list($width, $height) = getimagesize($image_name);
						if (($width < 482) && ($height < 482)) {
							$nwidth = $width;
							$nheight = $height;
						} else {
							if ($width > $height) {
								$nwidth = 482;
								$ratio = $width / $nwidth;
								$nheight = $height / $ratio;
							} elseif ($height > $width) {
								$nheight = 482;
								$ratio = $height / $nheight;
								$nwidth = $width / $ratio;
							} else {
								$nwidth = 482;
								$nheight = 482;
							}
						}
						echo '<a onmousedown="changeImage(\'anunturi/' . $poza . '\',\'' . $nwidth . '\',\'' . $nheight . '\');"><img src="anunturi/thumb_' . $poza . '" alt="' . $rand['titlu'] . '" height="50" class="mini" /></a>';
					} else {
						echo '';
					}
				}
			}
		} else {
			echo '<img src="images/nophoto.gif" width="482" height="482" />';
		}
	}
	echo '<br /><br />';
	$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `cat`="' . $rand['cat'] . '" AND (`titlu` LIKE "%' . $rand['titlu'] . '%" OR `alte` LIKE "%' . $rand['alte'] . '%") ORDER BY RAND() LIMIT 3';
	$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
	if (mysqli_num_rows($rezultat2) != 0) {
		echo '<hr color="#CCCCCC" size="1" />
                            <h3>Alte anunturi asemanatoare:</h3>';
		echo '<table border="0" cellspacing="5" cellpadding="0"><tr>';
		while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
			if ($rand['id'] != $rand2['id']) {
				$poza = explode(',', $rand2['poze']);
				echo '
										<td class="index" width="100">
											<table border="0" cellpadding="5" cellspacing="0" width="100%" height="100">
												<tr>
													<td width="100" align="center">
														<a href="anunt.php?id=' . $rand2['id'] . '">';
				if (file_exists('anunturi/thumb_' . $poza[0])) {
					echo '<img src="anunturi/thumb_' . $poza[0] . '" alt="' . $rand2['titlu'] . '" />';
				} else {
					echo '<img src="images/thumb_nophoto.gif" alt="' . $rand2['titlu'] . '" />';
				}
				echo '
														</a>
													</td>
												</tr>
												<tr>
													<td align="center">
														<a href="anunt.php?id=' . $rand2['id'] . '">' . $rand2['titlu'] . '</a><br />
														<strong>' . $rand2['pret'] . ' ' . $rand2['moneda'] . '</strong>
													</td>
												</tr>
											</table>
										</td>';
			}
		}
		echo '</tr></table>';
	}
	echo '<br /><br />
                         <br /><br />
					</td>
                </tr>
				<tr>
				  <td width="9" background="images/anunt_19.gif"></td>
  </tr>
                            <tr>
								<td align="center">								</td>
							</tr>
						</table>
			';
}

include('footer.php');
