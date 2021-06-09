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

$offset = (($per_page * $page) - $per_page);

if (isset($_GET['m'])) {
	if ($_GET['m'] == "s") {
		if (isset($_GET['ce']) && ($_GET['ce'] != "")) {
			if (isset($_GET['unde'])) {
				if (($_GET['unde'] == "toate") || ($_GET['unde'] == "")) {
					$cerereSQL = 'SELECT * FROM `anunt` WHERE `titlu` LIKE "%' . $_GET['ce'] . '%" OR `continut` LIKE "%' . $_GET['ce'] . '%" OR `alte` LIKE "%' . $_GET['ce'] . '%" ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
					$rezultat = mysqli_query($conexiune, $cerereSQL);
					$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `titlu` LIKE "%' . $_GET['ce'] . '%" OR `continut` LIKE "%' . $_GET['ce'] . '%" OR `alte` LIKE "%' . $_GET['ce'] . '%"';
					$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
				} else {
					$cerereSQL = 'SELECT * FROM `anunt` WHERE `oras`="' . $_GET['unde'] . '" AND (`titlu` LIKE "%' . $_GET['ce'] . '%" OR `continut` LIKE "%' . $_GET['ce'] . '%" OR `alte` LIKE "%' . $_GET['ce'] . '%") ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
					$rezultat = mysqli_query($conexiune, $cerereSQL);
					$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `oras`="' . $_GET['unde'] . '" AND (`titlu` LIKE "%' . $_GET['ce'] . '%" OR `continut` LIKE "%' . $_GET['ce'] . '%" OR `alte` LIKE "%' . $_GET['ce'] . '%")';
					$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
				}
				if (isset($_GET['h'])) {
					$link = 'search.php?ce=' . $_GET['ce'] . '&unde=' . $_GET['unde'] . '&m=s&h=' . $_GET['h'] . '&page=';
				} else {
					$link = 'search.php?ce=' . $_GET['ce'] . '&unde=' . $_GET['unde'] . '&m=s&page=';
				}
				$link2 = 'search.php?ce=' . $_GET['ce'] . '&unde=' . $_GET['unde'] . '&m=s&h=';
			} else {
				$cerereSQL = 'SELECT * FROM `anunt` WHERE `titlu` LIKE "%' . $_GET['ce'] . '%" OR `continut` LIKE "%' . $_GET['ce'] . '%" OR `alte` LIKE "%' . $_GET['ce'] . '%" ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `titlu` LIKE "%' . $_GET['ce'] . '%" OR `continut` LIKE "%' . $_GET['ce'] . '%" OR `alte` LIKE "%' . $_GET['ce'] . '%"';
				$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
				if (isset($_GET['h'])) {
					$link = 'search.php?ce=' . $_GET['ce'] . '&unde=toate&m=s&h=' . $_GET['h'] . '&page=';
				} else {
					$link = 'search.php?ce=' . $_GET['ce'] . '&unde=toate&m=s&page=';
				}
				$link2 = 'search.php?ce=' . $_GET['ce'] . '&unde=toate&m=s&h=';
			}
		} else {
			if (isset($_GET['unde'])) {
				if (($_GET['unde'] == "toate") || ($_GET['unde'] == "")) {
					$cerereSQL = 'SELECT * FROM `anunt` ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
					$rezultat = mysqli_query($conexiune, $cerereSQL);
					$cerereSQL2 = 'SELECT * FROM `anunt`';
					$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
				} else {
					$cerereSQL = 'SELECT * FROM `anunt` WHERE `oras`="' . $_GET['unde'] . '" ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
					$rezultat = mysqli_query($conexiune, $cerereSQL);
					$cerereSQL2 = 'SELECT * FROM `anunt` WHERE `oras`="' . $_GET['unde'] . '"';
					$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
				}
				if (isset($_GET['h'])) {
					$link = 'search.php?ce=&unde=' . $_GET['unde'] . '&m=s&h=' . $_GET['h'] . '&page=';
				} else {
					$link = 'search.php?ce=&unde=' . $_GET['unde'] . '&m=s&page=';
				}
				$link2 = 'search.php?ce=&unde=' . $_GET['unde'] . '&m=s&h=';
			} else {
				$cerereSQL = 'SELECT * FROM `anunt` ORDER BY `id` DESC LIMIT ' . $offset . ', ' . $per_page . '';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				$cerereSQL2 = 'SELECT * FROM `anunt`';
				$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
				if (isset($_GET['h'])) {
					$link = 'search.php?ce=&unde=toate&m=s&h=' . $_GET['h'] . '&page=';
				} else {
					$link = 'search.php?ce=&unde=toate&m=s&page=';
				}
				$link2 = 'search.php?ce=&unde=toate&m=s&h=';
			}
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
		$total_pages = ceil($intrari_totale / $per_page);
		$pagination = pagination($link, $page, $total_pages);

		echo '
				<table width="930" cellspacing="5" cellpadding="0" align="left">
					<tr>
						<td colspan="2" height="5" style="border-top: solid 3px #42455e;">
							&nbsp;
						</td>
					</tr>
					<tr>
						<td height="40" valign="top">';
		if (!isset($_GET['ce']) || ($_GET['ce'] == '')) {
			if (!isset($_GET['h']) || ($_GET['h'] == 0)) $h = '';
			else $h = ' :: Ultimele ' . $_GET['h'] . ' ore';
			if (!isset($_GET['unde']) || ($_GET['unde'] == '') || ($_GET['unde'] == 'toate')) {
				echo '<h2>Toate ' . $h . '</h2>';
			} else {
				echo '<h2>' . $_GET['unde'] . ' ' . $h . '</h2>';
			}
		} else {
			if (!isset($_GET['h']) || ($_GET['h'] == 0)) $h = '';
			else $h = ' :: Ultimele ' . $_GET['h'] . ' ore';
			if (!isset($_GET['unde'])) {
				echo '<h2>' . $_GET['ce'] . ' :: Toate zonele ' . $h . '</h2>';
			} else {
				echo '<h2>' . $_GET['ce'] . ' :: ' . $_GET['unde'] . ' ' . $h . '</h2>';
			}
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
		echo '
							<br />
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
		while ($rand = mysqli_fetch_assoc($rezultat)) {
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
										<td height="16" align="left" style="font-size:12px;">in <strong>' . $rand['oras'] . '</strong></td>
										<td width="250" height="16" align="right" style="font-size:12px;">
											adaugat in ' . $date[4] . '.' . $date[3] . '.' . $date[5] . '                                </td>
									</tr>
								</table>
							</td></tr>
		
							';
			}
		}
		echo '</table>';
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
	}
	/////////////////////////////////////////////////////////////////////////
	////////////////////// CAUTARE AVANSATA /////////////////////////////////
	/////////////////////////////////////////////////////////////////////////
	elseif ($_GET['m'] == "a") {
		echo '
			<form name="cauta" id="cauta" method="post" action="cautareav.php">
				<table align="center" width="692" height="450" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="9" height="9" background="images/anunt_11.gif"></td>
							<td colspan="5" background="images/anunt_12.gif"></td>
							<td width="9" height="9" background="images/anunt_14.gif"></td>
						</tr>
						<tr>
							<td width="9" background="images/anunt_19.gif">&nbsp;</td>
							<td width="30"></td>
						  <td colspan="3" height="70" align="center">
							<h1>Cautare avansata</h1>          </td>
							<td>&nbsp;</td>
							<td width="9" background="images/anunt_21.gif">&nbsp;</td>
						</tr>
						<tr>
						  <td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  <td width="30" height="40">&nbsp;</td>
						  <td width="205" align="left">
							<select id="category" name="category" onchange="getSubCategoryList(this);schimba(this)" style="width:198px;">
													<option value="" selected>Categoria</option>';
		$cerereSQL2 = 'SELECT * FROM `cat` ORDER BY `nume` ASC';
		$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
		while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
			if ($rand2['nume'] != "Altele")	echo '<option value="' . $rand2['nume'] . '">' . $rand2['nume'] . '</option>';
		}
		echo '<option value="Altele">Altele</option>';
		echo ' </select>          </td>
						  <td width="205" align="center">
							<select id="subcategory" name="subcategory" onchange="schimba(this)" style="width:198px;">
								<option selected value="" >Subcategoria</option>
							</select>          </td>
						  <td width="205" align="right">
							<select name="oras" style="width:198px;">
													<option selected value="toate" >Toate zonele</option>
													<option value="Alba"  >Alba</option> 
													<option value="Arad"  >Arad</option> 
													<option value="Arges"  >Arges</option> 
													<option value="Bacau"  >Bacau</option> 
													<option value="Bihor"  >Bihor</option> 
													<option value="Bistrita-Nasaud"  >Bistrita-Nasaud</option> 
													<option value="Botosani"  >Botosani</option> 
													<option value="Braila"  >Braila</option> 
													<option value="Brasov"  >Brasov</option> 
													<option value="Bucuresti"  >Bucuresti</option> 
													<option value="Buzau"  >Buzau</option> 
													<option value="Calarasi"  >Calarasi</option> 
													<option value="Caras-Severin"  >Caras-Severin</option> 
													<option value="Cluj"  >Cluj</option> 
													<option value="Constanta"  >Constanta</option> 
													<option value="Covasna"  >Covasna</option> 
													<option value="Dambovita"  >Dambovita</option> 
													<option value="Dolj"  >Dolj</option> 
													<option value="Galati"  >Galati</option> 
													<option value="Giurgiu"  >Giurgiu</option> 
													<option value="Gorj"  >Gorj</option> 
													<option value="Harghita"  >Harghita</option> 
													<option value="Hunedoara"  >Hunedoara</option> 
													<option value="Ialomita"  >Ialomita</option> 
													<option value="Iasi"  >Iasi</option> 
													<option value="Ilfov"  >Ilfov</option> 
													<option value="Maramures"  >Maramures</option> 
													<option value="Mehedinti"  >Mehedinti</option> 
													<option value="Mures"  >Mures</option> 
													<option value="Neamt"  >Neamt</option> 
													<option value="Olt"  >Olt</option> 
													<option value="Prahova"  >Prahova</option> 
													<option value="Salaj"  >Salaj</option> 
													<option value="Satu Mare"  >Satu Mare</option> 
													<option value="Sibiu"  >Sibiu</option> 
													<option value="Suceava"  >Suceava</option> 
													<option value="Teleorman"  >Teleorman</option> 
													<option value="Timis"  >Timis</option> 
													<option value="Tulcea"  >Tulcea</option> 
													<option value="Valcea"  >Valcea</option> 
													<option value="Vaslui"  >Vaslui</option> 
													<option value="Vrancea"  >Vrancea</option> 
							</select>          </td>
						  <td width="29">&nbsp;</td>
						  <td width="9" background="images/anunt_21.gif">&nbsp;</td>
					</tr>
						<tr id="auto">
						  <td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  <td height="40">&nbsp;</td>
						  <td align="left">
							<select id="marca" name="marca" onchange="getModeleList(this)" style="width:198px;" disabled="disabled">
													<option value="" selected>Marca</option>';
		$cerereSQL2 = 'SELECT * FROM `marca` ORDER BY `nume` ASC';
		$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
		while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
			if ($rand2['nume'] != "Alta") {
				echo '<option value="' . $rand2['nume'] . '">' . $rand2['nume'] . '</option>';
			}
		}
		echo '<option value="Alta">Alta</option>';
		echo ' </select>           </td>
						  <td align="center">
							<select id="model" name="model" style="width:198px;" disabled="disabled">
								<option selected value="" >Modelul</option>
							</select>          </td>
						  <td align="right">
							<select id="caroserie" name="caroserie" style="width:198px;" disabled="disabled">
									<option value="" selected="selected">Caroserie</option>
														<option value="berlina">berlina</option>
														<option value="pick-up">pick-up</option>
														<option value="SUV">SUV</option>
														<option value="Hatchback">hatchback</option>
														<option value="break">break</option>
														<option value="cabrio/roadster">cabrio/roadster</option>
														<option value="sport/coupe">sport/coupe</option>
														<option value="furgoneta/microbuz">furgoneta/microbuz</option>
														<option value="alta">alta</option>
							</select>          </td>
						  <td>&nbsp;</td>
						  <td width="9" background="images/anunt_21.gif">&nbsp;</td>
					</tr>
						<tr>
						  <td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  <td height="40">&nbsp;</td>
						  <td align="left">
							<select id="carburatie" name="carburatie" style="width:198px;" disabled="disabled">
														<option value="">Carburatie</option>
														<option value="benzina">benzina</option>
														<option value="diesel">diesel</option>
														<option value="electric">electric</option>
														<option value="gaz">gaz</option>
														<option value="hibrid">hibrid</option>
														<option value="alta">alta</option>
							</select>
						  </td>
						  <td align="center">
							<select name="an" id="an" disabled="disabled" style="width:198px;">
								<option value="0" selected="selected">Fabricatie de la</option>
								<option value="0">Toate</option>
								<option value="2010">2010</option>
								<option value="2009">2009</option>
								<option value="2008">2008</option>
								<option value="2007">2007</option>
								<option value="2006">2006</option>
								<option value="2005">2005</option>
								<option value="2004">2004</option>
								<option value="2003">2003</option>
								<option value="2002">2002</option>
								<option value="2001">2001</option>
								<option value="2000">2000</option>
								<option value="1999">1999</option>
								<option value="1998">1998</option>
								<option value="1997">1997</option>
								<option value="1996">1996</option>
								<option value="1995">1995</option>
								<option value="1994">1994</option>
								<option value="1993">1993</option>
								<option value="1992">1992</option>
								<option value="1991">1991</option>
								<option value="1990">1990</option>
								<option value="1989">1989</option>
								<option value="1988">1988</option>
								<option value="1987">1987</option>
								<option value="1986">1986</option>
								<option value="1985">1985</option>
								<option value="1984">1984</option>
								<option value="1983">1983</option>
								<option value="1982">1982</option>
								<option value="1981">1981</option>
								<option value="1980">1980</option>
								<option value="1979">1979</option>
								<option value="1978">1978</option>
								<option value="1977">1977</option>
								<option value="1976">1976</option>
								<option value="1975">1975</option>
								<option value="1974">1974</option>
								<option value="1973">1973</option>
								<option value="1972">1972</option>
								<option value="1971">1971</option>
								<option value="1970">1970</option>
								<option value="1969">1969</option>
								<option value="1968">1968</option>
								<option value="1967">1967</option>
								<option value="1966">1966</option>
								<option value="1965">1965</option>
								<option value="1964">1964</option>
								<option value="1963">1963</option>
								<option value="1962">1962</option>
								<option value="1961">1961</option>
								<option value="1900">inainte de 1960</option>
							</select>
						  </td>
						  <td align="right">
							<select name="km" id="km" disabled="disabled" style="width:198px;">
								<option value="9999999" selected="selected">Rulaj pana la</option>
								<option value="9999999">Toate</option>
								<option value="20000">20,000 km</option>
								<option value="35000">35,000 km</option>
								<option value="50000">50,000 km</option>
								<option value="75000">75,000 km</option>
								<option value="100000">100,000 km</option>
								<option value="125000">125,000 km</option>
								<option value="150000">150,000 km</option>
								<option value="200000">200,000 km</option>
							</select>
						  </td>
						  <td>&nbsp;</td>
						  <td width="9" background="images/anunt_21.gif">&nbsp;</td>
					</tr>
						<tr id="ap">
						  <td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  <td height="40">&nbsp;</td>
						  <td align="left">
							<select id="cam" name="cam" style="width:198px;" disabled="disabled">
														<option value="0">Nr. camere</option>
														<option value="1">1 camera</option>
														<option value="2">2 camere</option>
														<option value="3">3 camere</option>
														<option value="4">4 camere</option>
														<option value="5">5 camere</option>
														<option value="0">Mai multe camere</option>
							</select>          </td>
						  <td align="center">
							<select id="vilan" name="vilan" style="width:198px;" disabled="disabled">
														<option value="0">Tip teren</option>
														<option value="0">Toate</option>
														<option value="intravilan">Intravilan</option>
														<option value="extravilan">Extravilan</option>
														<option value="agricol">Agricol</option>
							</select>
						  </td>
						  <td align="right">
							<select name="crit" style="width:198px;">
								<option value="0" selected="selected">Toate anunturile</option>
								<option value="6">Ultimele 6 ore</option>
								<option value="12">Ultimele 12 ore</option>
								<option value="24">Ultimele 24 ore</option>
							</select>
						  </td>
						  <td>&nbsp;</td>
						  <td width="9" background="images/anunt_21.gif">&nbsp;</td>
					</tr>
						<tr>
						  <td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  <td height="40">&nbsp;</td>
						  <td align="left">
							
						  </td>
						  <td align="center">
							<input type="submit" value="Cauta!" name="cauta" class="cauta" style="width:198px;" />
						  </td>
						  <td align="right">
							
						  </td>
						  <td>&nbsp;</td>
						  <td width="9" background="images/anunt_21.gif">&nbsp;</td>
					</tr>
						<tr>
						  <td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  <td height="40" align="center">&nbsp;</td>
						  <td align="center">&nbsp;</td>
						  <td align="center"></td>
						  <td align="center">&nbsp;</td>
						  <td align="center">&nbsp;</td>
						  <td width="9" background="images/anunt_21.gif">&nbsp;</td>
					</tr>
						<tr>
						  <td background="images/anunt_19.gif">&nbsp;</td>
						  <td colspan="5" align="center">&nbsp;</td>
						  <td background="images/anunt_21.gif">&nbsp;</td>
				  </tr>
						
						<tr>
							<td width="9" height="9" background="images/anunt_27.gif"></td>
							<td colspan="5" background="images/anunt_28.gif"></td>
							<td width="9" height="9" background="images/anunt_29.gif"></td>
						</tr>
					</table>
				</form>';
	} else {
		echo 'Formular cautare';
	}
} else {
	echo 'Formular cautare';
}

include('footer.php');
