<?php
include('header.php');
include('pagination.php');

$per_page = 20;

//  check to make sure that "page" is set and a number
//  if its not set or not a number, then default the page to 1
if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = 1;
}

if (!isset($_GET['cat'])) {
	$cerereSQL = 'SELECT * FROM `anunt` ORDER BY `id` DESC';
	$rezultat2 = mysqli_query($conexiune, $cerereSQL);
	if (isset($_GET['h'])) {
		$link = 'anunturi.php?h=' . $_GET['h'] . 'page=';
	} else {
		$link = 'anunturi.php?page=';
	}
	$link2 = 'anunturi.php?h=';
	$link3 = '';
} elseif ((isset($_GET['cat'])) && (!isset($_GET['subcat']))) {
	$cat = $_GET['cat'];

	$cerereSQL = 'SELECT * FROM `anunt` WHERE `cat`="' . $cat . '" ORDER BY `id` DESC';
	$rezultat2 = mysqli_query($conexiune, $cerereSQL);
	if (isset($_GET['h'])) {
		$link = 'anunturi.php?cat=' . $cat . '&h=' . $_GET['h'] . '&page=';
	} else {
		$link = 'anunturi.php?cat=' . $cat . '&page=';
	}
	$link2 = 'anunturi.php?cat=' . $cat . '&h=';
	$link3 = 'cat=' . $cat;
} else {
	$cat = $_GET['cat'];
	$subcat = $_GET['subcat'];

	$cerereSQL = 'SELECT * FROM `anunt` WHERE `cat`="' . $cat . '" AND `subcat`="' . $subcat . '" ORDER BY `id` DESC';
	$rezultat2 = mysqli_query($conexiune, $cerereSQL);
	if (isset($_GET['h'])) {
		$link = 'anunturi.php?cat=' . $cat . '&subcat=' . $subcat . '&h=' . $_GET['h'] . '&page=';
	} else {
		$link = 'anunturi.php?cat=' . $cat . '&subcat=' . $subcat . '&page=';
	}
	$link2 = 'anunturi.php?cat=' . $cat . '&subcat=' . $subcat . '&h=';
	$link3 = 'cat=' . $cat . '&subcat=' . $subcat;
}

if (isset($_GET['h'])) {
	if (($_GET['h'] <= 360) && ($_GET['h'] > 0)) {
		$or = $_GET['h'];
	} else {
		$or = $durata * 24;
	}
} else {
	$or = $durata * 24;
}
$intrari_totale = 0;
while ($rand = mysqli_fetch_assoc($rezultat2)) {
	$start = explode("/", $rand['data']);
	$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($start[0], $start[1], $start[2], $start[3], $start[4], $start[5]);
	$zile = floor($seconds_dif / 60 / 60 / 24);
	$ore = floor($seconds_dif / 60 / 60);
	if ($ore <= $or) {
		$intrari_totale++;
	}
}

//  results to display per page
$offset = (($per_page * $page) - $per_page);    //  offset from 0
$total_pages = ceil($intrari_totale / $per_page);  //  total number of pages

//  generate our pagination
$pagination = pagination($link, $page, $total_pages);

//  get our results from the database for the page that we want
if (!isset($_GET['cat'])) {
	$cerereSQL2 = 'SELECT * FROM `anunt` ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
	$rezultat3 = mysqli_query($conexiune, $cerereSQL2);
} elseif ((isset($_GET['cat'])) && (!isset($_GET['subcat']))) {
	$cat = $_GET['cat'];

	$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `cat`="' . $cat . '" ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
	$rezultat3 = mysqli_query($conexiune, $cerereSQL2);
} else {
	$cat = $_GET['cat'];
	$subcat = $_GET['subcat'];

	$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `cat`="' . $cat . '" AND `subcat`="' . $subcat . '" ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
	$rezultat3 = mysqli_query($conexiune, $cerereSQL2);
}

//  loop through our results and display them in a table


echo '
			<table width="930" cellspacing="5" cellpadding="0" align="left">
			<tr>
				<td colspan="2" height="5" style="border-top: solid 3px #42455e;">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td height="40" valign="top">';
if (!isset($_GET['cat'])) {
	if (!isset($_GET['h']) || ($_GET['h'] == 0)) $h = '';
	else $h = ' :: Ultimele ' . $_GET['h'] . ' ore';
	echo '<h2>Toate ' . $h . '</h2>';
} elseif ((isset($_GET['cat'])) && (!isset($_GET['subcat']))) {
	if (!isset($_GET['h']) || ($_GET['h'] == 0)) $h = '';
	else $h = ' :: Ultimele ' . $_GET['h'] . ' ore';
	echo '<h2>' . $_GET['cat'] . ' ' . $h . '</h2>';
} else {
	if (!isset($_GET['h']) || ($_GET['h'] == 0)) $h = '';
	else $h = ' :: Ultimele ' . $_GET['h'] . ' ore';
	echo '<h2>' . $_GET['cat'] . ' :: ' . $_GET['subcat'] . ' ' . $h . '</h2>';
}
echo '</td>
				<td align="right" height="20">
					<a href="' . $link2 . '6">Ultimele 6 ore</a> | <a href="' . $link2 . '12">Ultimele 12 ore</a> | <a href="' . $link2 . '24">Ultimele 24 ore</a> | <a href="' . $link2 . '0">Toate</a>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left" height="20" style="border-bottom: solid 3px #42455e;">';
if ($intrari_totale == 1) {
	echo
	$intrari_totale . ' anunt';
} else {
	echo
	$intrari_totale . ' anunturi';
}
echo '<br />
				</td>
			</tr>';
$nr = 0;
if (isset($_GET['h'])) {
	if (($_GET['h'] <= 360) && ($_GET['h'] > 0)) {
		$or = $_GET['h'];
	} else {
		$or = $durata * 24;
	}
} else {
	$or = $durata * 24;
}
while ($rand = mysqli_fetch_assoc($rezultat3)) {
	if (isset($_GET['h'])) {
		if (($_GET['h'] <= 360) && ($_GET['h'] > 0)) {
			$or = $_GET['h'];
		} else {
			$or = $durata * 24;
		}
	} else {
		$or = $durata * 24;
	}
	$nr++;
	$date = explode("/", $rand['data']);
	$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($date[0], $date[1], $date[2], $date[3], $date[4], $date[5]);
	$zile = floor($seconds_dif / 60 / 60 / 24);
	$ore = floor($seconds_dif / 60 / 60);
	if ($ore <= $or) {
		$bgr = "#FFFFFF";
		if ($nr % 2 == 0) $bgr = "#FFFFFF";
		$poza = explode(',', $rand['poze']);
		if ($poza[0] != "") {
			if (file_exists('anunturi/thumb_' . $poza[0])) {
				$image_name = 'anunturi/thumb_' . $poza[0];
				list($width, $height) = getimagesize($image_name);
				if ($width >= $height) {
					$width2 = 68;
					$ratio = $width / $width2;
					$height2 = $height / $ratio;
				} else {
					$height2 = 68;
					$ratio = $height / $height2;
					$width2 = $width / $ratio;
				}
				$src = 'anunturi/thumb_' . $poza[0];
			} else {
				$width2 = "68";
				$height2 = "68";
				$src = 'images/thumb_nophoto.gif';
			}
		} else {
			$width2 = "68";
			$height2 = "68";
			$src = 'images/thumb_nophoto.gif';
		}
		$continut = mb_strimwidth($rand['continut'], 0, 200, '... <a href="anunt.php?id=' . $rand['id'] . '">[vezi tot]</a>');
		echo '
					<tr><td colspan="2">
						<table width="930" height="68" align="center" cellpadding="2" cellspacing="2" style="border-bottom: solid 1px #93A6CA; border-top: solid 1px #E2E2E2; border-left: solid 3px #42455e; background-color:' . $bgr . ';">
							<tr>
								<td rowspan="3" height="68" align="center" valign="middle" width="76"><a href="anunt.php?id=' . $rand['id'] . '"><img src="' . $src . '" width="' . $width2 . '" height="' . $height2 . '" alt="' . $rand['titlu'] . '" /></a></td>
								<td height="16"><strong><a href="anunt.php?id=' . $rand['id'] . '">' . $rand['titlu'] . '</a></strong></td>
								<td width="300" height="52" rowspan="2" align="right">';
		if (($_SESSION['logat'] == "Da") && ($_SESSION['acces'] == '3')) {
			echo '<a href="profil.php?a=del&id=' . $rand['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Skai.Ro - Sterge anunt" /> Sterge</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="profil.php?a=add&id=' . $rand['id'] . '&ed"><img src="images/anunt_facont.gif" width="15" height="15" align="top" alt="Skai.Ro - Modifica anunt" /> Modifica</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="profil.php?a=add&id=' . $rand['id'] . '"><img src="images/anunt_adauga.gif" width="15" height="15" align="top" alt="Skai.Ro - Prelungeste anunt" /> Prelungeste</a><br />';
		}
		echo '
                                	<h3>' . $rand['pret'] . ' ' . strtoupper($rand['moneda']) . '</h3>
                                </td>
							</tr>
							<tr>
								<td height="36" style="font-size:12px;">' . $continut . '<br />								</td>
						    </tr>
							<tr>
								<td height="16" align="left" style="font-size:12px;">in <strong>' . $rand['oras'] . '</a></td>
							    <td width="250" height="16" align="right" style="font-size:12px;">
                                	adaugat in ' . $date[4] . '.' . $date[3] . '.' . $date[5] . '                                </td>
							</tr>
						</table>
					</td></tr>

					';
	}
}
echo '</table><br />';

echo '
						<table width="930" cellspacing="5" cellpadding="0" border="0"><tr><td style="padding-top:10px;">
							<table width="930" height="35" cellpadding="0" cellspacing="3" align="left" style="border-bottom: solid 1px #93A6CA; border-top: solid 1px #E2E2E2; border-left: solid 3px #42455e; background-color:#F5F8FA;"><tr>';
echo '
								<td valign="middle" align="left" width="20%">
									<strong>Pagina ' . $page . ' din ' . $total_pages . '</strong>
								</td>
							';
echo $pagination;
echo '
								<td valign="middle" align="right" width="20%">
								</td>
							</tr></table>
						</td></tr><tr><td style="padding-top:30px;"></td></tr></table>
					';

include('footer.php');
