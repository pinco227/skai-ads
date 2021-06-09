<?php
include('config.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php
	$cerereSQL0 = 'SELECT * FROM `config`';
	$rezultat0 = mysqli_query($conexiune, $cerereSQL0);
	while ($rand = mysqli_fetch_assoc($rezultat0)) {
		$sms = $rand['sms'];
		$confirm = $rand['confirm'];
		$durata = $rand['durata'];
		$mtitlu = $rand['mtitlu'];
		$mdesc = $rand['mdesc'];
		$mkey = $rand['mkey'];
	}
	if ((isset($_GET['cat'])) && (!isset($_GET['subcat']))) {
		$cerereSQLk = 'SELECT * FROM `cat` WHERE `nume`="' . $_GET['cat'] . '"';
		$rezultatk = mysqli_query($conexiune, $cerereSQLk);
		while ($rand = mysqli_fetch_assoc($rezultatk)) {
			$titlu = $rand['mtitlu'];
			$desc = $rand['mdesc'];
			$key = $rand['mkey'];
		}
	} elseif (isset($_GET['subcat'])) {
		$cerereSQLk = 'SELECT * FROM `subcat` WHERE `nume`="' . $_GET['subcat'] . '"';
		$rezultatk = mysqli_query($conexiune, $cerereSQLk);
		while ($rand = mysqli_fetch_assoc($rezultatk)) {
			$titlu = $rand['mtitlu'];
			$desc = $rand['mdesc'];
			$key = $rand['mkey'];
		}
	} else {
		if ($_SERVER['PHP_SELF'] == $path . '/anunt.php') {
			if (isset($_GET['id'])) {
				$cerereSQL = 'SELECT * FROM `anunt` WHERE `id`="' . $_GET['id'] . '"';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				while ($rand = mysqli_fetch_assoc($rezultat)) {
					$titlu = 'Skai.Ro - ' . $rand['titlu'];
				}
				$desc = $mdesc;
				$key = $mkey;
			} else {
				$titlu = $mtitlu;
				$desc = $mdesc;
				$key = $mkey;
			}
		} else {
			if (isset($_GET['ce'])) $titlu = $mtitlu . ' - ' . $_GET['ce'];
			else $titlu = $mtitlu;
			$desc = $mdesc;
			$key = $mkey;
		}
	}

	?>
	<title>
		<?php
		echo $titlu;
		?>
	</title>

	<meta name="Keywords" content="<?php echo $key; ?>">
	<meta name="author" content="Pi-Design.Ro">
	<meta name="rating" content="GENERAL">
	<meta name="description" content="<?php echo $desc; ?>">
	<meta name="subject" content="<?php echo $desc; ?>">
	<meta name="classification" content="<?php echo $desc; ?>">
	<meta name="copyright" content="Pi-Design.Ro @ 2010. Toate drepturile sunt rezervate. - http://www.pi-design.ro">
	<meta name="robots" content="index,follow">
	<meta name="geography" content="Romania, Iasi">
	<meta name="language" content="Romanian">
	<meta HTTP-EQUIV="expires" content="never">
	<meta name="designer" content="Pi-Design.Ro">
	<meta name="publisher" content="Pi-Design.Ro">
	<meta name="distribution" content="Global">
	<meta name="city" content="Iasi">
	<meta name="country" content="Romania">

	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="js/ajax.js"></script>
	<SCRIPT LANGUAGE="JavaScript">
		function textCounter(field, cntfield, maxlimit) {
			if (field.value.length > maxlimit)
				field.value = field.value.substring(0, maxlimit);
			else
				cntfield.value = maxlimit - field.value.length;
		}
	</script>
	<script type="text/javascript">
		var ajax = new Array();

		function getSubCategoryList(sel) {
			var category = sel.options[sel.selectedIndex].value;
			document.getElementById('subcategory').options.length = 0; // Empty city select box
			if (category.length > 0) {
				var index = ajax.length;
				ajax[index] = new sack();

				ajax[index].requestFile = 'subcategorii.php?cat=' + category; // Specifying which file to get
				ajax[index].onCompletion = function() {
					createSubCategories(index)
				}; // Specify function that will be executed after file has been found
				ajax[index].runAJAX(); // Execute AJAX function
			}
		}

		function createSubCategories(index) {
			var obj = document.getElementById('subcategory');
			eval(ajax[index].response); // Executing the response from Ajax as Javascript code	
		}

		function getModeleList(sel) {
			var marca = sel.options[sel.selectedIndex].value;
			document.getElementById('model').options.length = 0; // Empty city select box
			if (marca.length > 0) {
				var index = ajax.length;
				ajax[index] = new sack();

				ajax[index].requestFile = 'modele.php?mar=' + marca; // Specifying which file to get
				ajax[index].onCompletion = function() {
					createModele(index)
				}; // Specify function that will be executed after file has been found
				ajax[index].runAJAX(); // Execute AJAX function
			}
		}

		function createModele(index) {
			var obj = document.getElementById('model');
			eval(ajax[index].response); // Executing the response from Ajax as Javascript code	
		}

		function getSerieList(sel) {
			var marca = sel.options[sel.selectedIndex].value;
			document.getElementById('seria').options.length = 0; // Empty city select box
			if (marca.length > 0) {
				var index = ajax.length;
				ajax[index] = new sack();

				ajax[index].requestFile = 'modele.php?ser&mar=' + marca; // Specifying which file to get
				ajax[index].onCompletion = function() {
					createSerie(index)
				}; // Specify function that will be executed after file has been found
				ajax[index].runAJAX(); // Execute AJAX function
			}
		}

		function createSerie(index) {
			var obj = document.getElementById('seria');
			eval(ajax[index].response); // Executing the response from Ajax as Javascript code	
		}
	</script>
	<script type="text/javascript">
		var menuids = ["linktree"] //Enter id(s) of SuckerTree UL menus, separated by commas

		function buildsubmenus() {
			for (var i = 0; i < menuids.length; i++) {
				var ultags = document.getElementById(menuids[i]).getElementsByTagName("ul")
				for (var t = 0; t < ultags.length; t++) {
					ultags[t].parentNode.getElementsByTagName("a")[0].className = "subfolderstyle"
					if (ultags[t].parentNode.parentNode.id == menuids[i]) //if this is a first level submenu
						ultags[t].style.left = ultags[t].parentNode.offsetWidth + "px" //dynamically position first level submenus to be width of main menu item
					else //else if this is a sub level submenu (ul)
						ultags[t].style.left = ultags[t - 1].getElementsByTagName("a")[0].offsetWidth + "px" //position menu to the right of menu item that activated it
					ultags[t].parentNode.onmouseover = function() {
						this.getElementsByTagName("ul")[0].style.display = "block"
					}
					ultags[t].parentNode.onmouseout = function() {
						this.getElementsByTagName("ul")[0].style.display = "none"
					}
				}
				for (var t = ultags.length - 1; t > -1; t--) { //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
					ultags[t].style.visibility = "visible"
					ultags[t].style.display = "none"
				}
			}
		}

		if (window.addEventListener)
			window.addEventListener("load", buildsubmenus, false)
		else if (window.attachEvent)
			window.attachEvent("onload", buildsubmenus)
	</script>
	<script type="text/javascript">
		function changeImage(imageURL, wdh, hgh) {
			document.myImage.src = imageURL;
			document.myImage.width = wdh;
			document.myImage.height = hgh;
		}
	</script>
	<script type="text/javascript">
		function schimba(frm) {
			if (frm.value == 'Automobile') {
				document.getElementById('marca').disabled = false;
				document.getElementById('model').disabled = false;
				document.getElementById('caroserie').disabled = false;
				document.getElementById('carburatie').disabled = false;
				document.getElementById('an').disabled = false;
				document.getElementById('km').disabled = false;
				document.getElementById('cam').disabled = true;
				document.getElementById('vilan').disabled = true;
			} else if ((frm.value == 'Apartamente') || (frm.value == 'Case / Vile') || (frm.value == 'Case de lemn') || (frm.value == 'Inchirieri apartamente')) {
				document.getElementById('cam').disabled = false;
				document.getElementById('vilan').disabled = true;
				document.getElementById('marca').disabled = true;
				document.getElementById('model').disabled = true;
				document.getElementById('caroserie').disabled = true;
				document.getElementById('carburatie').disabled = true;
				document.getElementById('an').disabled = true;
				document.getElementById('km').disabled = true;
			} else if (frm.value == 'Terenuri') {
				document.getElementById('cam').disabled = true;
				document.getElementById('vilan').disabled = false;
				document.getElementById('marca').disabled = true;
				document.getElementById('model').disabled = true;
				document.getElementById('caroserie').disabled = true;
				document.getElementById('carburatie').disabled = true;
				document.getElementById('an').disabled = true;
				document.getElementById('km').disabled = true;
			} else {
				document.getElementById('marca').disabled = true;
				document.getElementById('model').disabled = true;
				document.getElementById('caroserie').disabled = true;
				document.getElementById('carburatie').disabled = true;
				document.getElementById('an').disabled = true;
				document.getElementById('km').disabled = true;
				document.getElementById('cam').disabled = true;
				document.getElementById('vilan').disabled = true;
			}
			if (frm.name == 'category') {
				document.getElementById('marca').disabled = true;
				document.getElementById('model').disabled = true;
				document.getElementById('caroserie').disabled = true;
				document.getElementById('carburatie').disabled = true;
				document.getElementById('an').disabled = true;
				document.getElementById('km').disabled = true;
				document.getElementById('cam').disabled = true;
				document.getElementById('vilan').disabled = true;
			}
		}
	</script>
</head>
<?php
if ($_SERVER['PHP_SELF'] != $path . '/cautareav.php') {
	if (isset($_SESSION['cata'])) $_SESSION['cata'] = 0;
	$_SESSION['category'] = '';
	$_SESSION['subcategory'] = '';
	$_SESSION['oras'] = '';
	$_SESSION['marca'] = '';
	$_SESSION['model'] = '';
	$_SESSION['caroserie'] = '';
	$_SESSION['carburatie'] = '';
	$_SESSION['an'] = '';
	$_SESSION['km'] = '';
	$_SESSION['cam'] = '';
	$_SESSION['vilan'] = '';
	$_SESSION['crit'] = '';
}
?>

<body>
	<table width="941" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td width="941" height="90" valign="middle" colspan="2">
				<table width="941" height="90" border="0" cellpadding="0" cellspacing="0" align="center">
					<tr>
						<td width="264" height="90" align="left" valign="middle">
							<a href="index.php"><img src="images/anunt_02.gif" width="264" height="61" alt="Iasi Ocazii"></a>
						</td>
						<td width="667" height="90" align="right" valign="middle">
							<?php
							if ($_SESSION['logat'] == "Da") {
							?>
								<a href="index.php"><img src="images/anunt_home.gif" width="15" height="15" align="top" alt="IasiOcazii"> Home</a> ::
								<a href="profil.php?a=add"><img src="images/anunt_adauga.gif" width="15" height="15" align="top" alt="IasiOcazii - Adauga anunt"> Adauga Anunt</a> ::
								<a href="profil.php?a=my"><img src="images/anunt_my.gif" width="15" height="15" align="top" alt="IasiOcazii - Anunturile mele"> Anunturile Mele</a> ::
								<a href="profil.php?a=edit&b=pers"><img src="images/anunt_profil.gif" width="15" height="15" align="top" alt="IasiOcazii - Contul meu"> Contul Meu</a> ::
								<?php if ($_SESSION['acces'] == '3') { ?> <a href="admin.php">Admin</a> :: <?php } ?>
								<a href="ajutor.php"><img src="images/anunt_ajutor.gif" width="15" height="15" align="top" alt="IasiOcazii - Ajutor"> Ajutor</a> ::
								<a href="logout.php"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="IasiOcazii - Logout"> Logout</a>
							<?php
							} else {
							?>
								<a href="index.php"><img src="images/anunt_home.gif" width="15" height="15" align="top" alt="IasiOcazii"> Home</a> ::
								<a href="profil.php?a=add"><img src="images/anunt_adauga.gif" width="15" height="15" align="top" alt="IasiOcazii - Adauga anunt"> Adauga Anunt</a> ::
								<a href="login.php"><img src="images/anunt_login.gif" width="15" height="15" align="top" alt="IasiOcazii - Login"> Login</a> ::
								<a href="register.php"><img src="images/anunt_facont.gif" width="15" height="15" align="top" alt="IasiOcazii - Fa-ti Cont"> Inregistrare</a> ::
								<a href="ajutor.php"><img src="images/anunt_ajutor.gif" width="15" height="15" align="top" alt="IasiOcazii - Ajutor"> Ajutor</a>
							<?php
							}
							?>
						</td>
					</tr>
				</table>


			</td>
		</tr>
		<tr>
			<?php if (($_SERVER['PHP_SELF'] == $path . '/anunt.php') || ($_SERVER['PHP_SELF'] == $path . '/termeni.php') || ($_SERVER['PHP_SELF'] == $path . '/ajutor.php') || ($_SERVER['PHP_SELF'] == $path . '/contact.php')) { ?>
				<td height="10" colspan="2">
					<hr color="#3D4272" size="5" style="border-bottom:solid 2px #CCCCCC;">
				<?php } else { ?>
				<td height="15" colspan="2">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">

						<tr>
							<td width="10" height="58" background="images/anunt_04.gif">&nbsp;</td>
							<td height="58" background="images/anunt_05.gif" align="center" valign="middle">
								<form action="search.php" method="get" name="search">
									<input type="text" name="ce" size="60" value="">&nbsp;&nbsp;
									<select name="unde" style="width:200px;">
										<option selected="selected" value="toate">Toate zonele</option>
										<option value="Alba">Alba</option>
										<option value="Arad">Arad</option>
										<option value="Arges">Arges</option>
										<option value="Bacau">Bacau</option>
										<option value="Bihor">Bihor</option>
										<option value="Bistrita-Nasaud">Bistrita-Nasaud</option>
										<option value="Botosani">Botosani</option>
										<option value="Braila">Braila</option>
										<option value="Brasov">Brasov</option>
										<option value="Bucuresti">Bucuresti</option>
										<option value="Buzau">Buzau</option>
										<option value="Calarasi">Calarasi</option>
										<option value="Caras-Severin">Caras-Severin</option>
										<option value="Cluj">Cluj</option>
										<option value="Constanta">Constanta</option>
										<option value="Covasna">Covasna</option>
										<option value="Dambovita">Dambovita</option>
										<option value="Dolj">Dolj</option>
										<option value="Galati">Galati</option>
										<option value="Giurgiu">Giurgiu</option>
										<option value="Gorj">Gorj</option>
										<option value="Harghita">Harghita</option>
										<option value="Hunedoara">Hunedoara</option>
										<option value="Ialomita">Ialomita</option>
										<option value="Iasi">Iasi</option>
										<option value="Ilfov">Ilfov</option>
										<option value="Maramures">Maramures</option>
										<option value="Mehedinti">Mehedinti</option>
										<option value="Mures">Mures</option>
										<option value="Neamt">Neamt</option>
										<option value="Olt">Olt</option>
										<option value="Prahova">Prahova</option>
										<option value="Salaj">Salaj</option>
										<option value="Satu Mare">Satu Mare</option>
										<option value="Sibiu">Sibiu</option>
										<option value="Suceava">Suceava</option>
										<option value="Teleorman">Teleorman</option>
										<option value="Timis">Timis</option>
										<option value="Tulcea">Tulcea</option>
										<option value="Valcea">Valcea</option>
										<option value="Vaslui">Vaslui</option>
										<option value="Vrancea">Vrancea</option>
									</select>&nbsp;&nbsp;
									<input type="hidden" name="m" value="s">
									<input type="submit" value="Cauta!" name="search">
									&nbsp;&nbsp;<a href="search.php?m=a" style="text-decoration:underline;">Cautare avansata</a>
								</form>
							</td>
							<td width="10" height="58" background="images/anunt_07.gif">&nbsp;</td>
						</tr>
					</table>
				<?php }
				?>
				</td>
		</tr>
		<tr>
			<td height="10" colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="941" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<?php
						if (isset($_GET['m'])) $m = $_GET['m'];
						else $m = '';
						if (isset($_GET['a'])) $ac = $_GET['a'];
						else $ac = '';
						if (($_SERVER['PHP_SELF'] != $path . '/anunt.php') && ($_SERVER['PHP_SELF'] != $path . '/anunturi.php') && ($m != 's') && ($_SERVER['PHP_SELF'] != $path . '/termeni.php') && ($_SERVER['PHP_SELF'] != $path . '/ajutor.php') && ($_SERVER['PHP_SELF'] != $path . '/contact.php') && ($ac != "my") && ($_SERVER['PHP_SELF'] != $path . '/cautareav.php')) {

						?> <td width="239" valign="top"> <?php
															if (($_SERVER['PHP_SELF'] != $path . '/login.php') && ($_SERVER['PHP_SELF'] != $path . '/register.php') && ($m != "a") && ($ac != "add") && ($ac != "add2") && ($ac != "v") && ($ac != "edit")) {
																if ($_SESSION['logat'] == "Da") {
															?>
										<table width="239" height="131" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td height="32" colspan="3" background="images/anunt_15.gif" class="header_left">Panoul tau</td>
											</tr>
											<tr>
												<td width="9" background="images/anunt_19.gif">&nbsp;</td>
												<td width="221" align="left" style="padding-left:8px; padding-top:3px;" valign="top" height="88">
													<p style="line-height:18px; padding:0px; margin:0px; text-indent:20px;">Bun venit, <strong><?php echo $_SESSION['user']; ?></strong><br>
														<a href="profil.php?a=add"><img src="images/anunt_adauga.gif" width="15" height="15" align="top" alt="IasiOcazii - Adauga anunt"> Adauga Anunt</a><br>
														<a href="profil.php?a=my"><img src="images/anunt_my.gif" width="15" height="15" align="top" alt="IasiOcazii - Anunturile mele"> Anunturile Mele</a><br>
														<a href="profil.php?a=edit"><img src="images/anunt_profil.gif" width="15" height="15" align="top" alt="IasiOcazii - Contul meu"> Contul Meu</a><br>
														<a href="logout.php"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="IasiOcazii - Logout"> Logout</a>
													</p>
												</td>
												<td width="9" background="images/anunt_21.gif">&nbsp;</td>
											</tr>
											<tr>
												<td width="9" height="9" background="images/anunt_27.gif"></td>
												<td height="9" background="images/anunt_28.gif"></td>
												<td width="9" height="9" background="images/anunt_29.gif"></td>
											</tr>
										</table>
										<table>
											<tr>
												<td></td>
											</tr>
										</table>
										<?php
																} else {
																	if ($_SERVER['PHP_SELF'] != $path . '/login.php') {
										?>
											<form action="login.php" method="post" name="login">
												<table width="239" height="131" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td height="32" colspan="4" background="images/anunt_15.gif" class="header_left">Login</td>
													</tr>
													<tr>
														<td width="9" rowspan="3" background="images/anunt_19.gif">&nbsp;</td>
														<td height="26" align="right" width="170">
															User :
															<input type="text" name="user" style="width:100px;">
														</td>
														<td width="51" height="52" rowspan="2">
															<input type="submit" name="login" value="" class="login2">
														</td>
														<td width="9" rowspan="3" background="images/anunt_21.gif">&nbsp;</td>
													</tr>
													<tr>
														<td height="26" align="right" width="170">
															Parola :
															<input type="password" name="pass" style="width:100px;">
														</td>
													</tr>
													<tr>
														<td height="40" colspan="2">
															<a href="login.php?lost">Mi-am uitat datele!</a><br>
															Nu ai cont? <a href="register.php">Inregistreaza-te!</a>
														</td>
													</tr>
													<tr>
														<td width="9" height="9" background="images/anunt_27.gif"></td>
														<td height="9" colspan="2" background="images/anunt_28.gif"></td>
														<td width="9" height="9" background="images/anunt_29.gif"></td>
													</tr>
												</table>
												<table>
													<tr>
														<td></td>
													</tr>
												</table>
											</form>
									<?php
																	}
																}
									?>
									<table width="239" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="32" colspan="3" background="images/anunt_15.gif" class="header_left">Categorii Anunturi</td>
										</tr>
										<tr>
											<td colspan="3">
												<div class="linkdiv">
													<ul id="linktree">
														<?php

																$cerereSQL = 'SELECT * FROM `cat` ORDER BY `nume` ASC';
																$rezultat = mysqli_query($conexiune, $cerereSQL);
																while ($rand = mysqli_fetch_assoc($rezultat)) {
																	if ($rand['nume'] != "Altele") {
																		$cerereSQLx = 'SELECT * FROM `anunt` WHERE `cat`="' . $rand['nume'] . '"';
																		$rezultatx = mysqli_query($conexiune, $cerereSQLx);
																		$nr = 0;
																		while ($randx = mysqli_fetch_assoc($rezultatx)) {
																			$start = explode("/", $randx['data']);
																			$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($start[0], $start[1], $start[2], $start[3], $start[4], $start[5]);
																			$zile = floor($seconds_dif / 60 / 60 / 24);
																			$ore = floor($seconds_dif / 60 / 60);
																			if ($ore < ($durata * 24)) {
																				$nr++;
																			}
																		}
																		echo '<li><a href="anunturi.php?cat=' . $rand['nume'] . '">' . $rand['nume'] . '</a> (' . $nr . ') <br>';

																		$cerereSQL3 = 'SELECT * FROM `subcat` WHERE `cat`="' . $rand['nume'] . '" ORDER BY `nume` ASC';
																		$rezultat3 = mysqli_query($conexiune, $cerereSQL3);
																		if (mysqli_num_rows($rezultat3) != 0) {
																			echo '<ul>';
																			while ($rand2 = mysqli_fetch_assoc($rezultat3)) {
																				if ($rand2['nume'] != "Altele") {
																					$cerereSQLz = 'SELECT * FROM `anunt` WHERE `cat`="' . $rand['nume'] . '" AND `subcat`="' . $rand2['nume'] . '"';
																					$rezultatz = mysqli_query($conexiune, $cerereSQLz);
																					$nr2 = 0;
																					while ($randz = mysqli_fetch_assoc($rezultatz)) {
																						$start = explode("/", $randz['data']);
																						$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($start[0], $start[1], $start[2], $start[3], $start[4], $start[5]);
																						$zile = floor($seconds_dif / 60 / 60 / 24);
																						$ore = floor($seconds_dif / 60 / 60);
																						if ($ore < ($durata * 24)) {
																							$nr2++;
																						}
																					}
																					echo '<li><a href="anunturi.php?cat=' . $rand['nume'] . '&subcat=' . $rand2['nume'] . '">' . $rand2['nume'] . ' <font style="font-weight:normal;">(' . $nr2 . ')</font></a></li>';
																				}
																			}
																			$cerereSQLq = 'SELECT * FROM `anunt` WHERE `cat`="' . $rand['nume'] . '" AND `subcat`="Altele"';
																			$rezultatq = mysqli_query($conexiune, $cerereSQLq);
																			$nr6 = 0;
																			while ($randq = mysqli_fetch_assoc($rezultatq)) {
																				$start = explode("/", $randq['data']);
																				$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($start[0], $start[1], $start[2], $start[3], $start[4], $start[5]);
																				$zile = floor($seconds_dif / 60 / 60 / 24);
																				$ore = floor($seconds_dif / 60 / 60);
																				if ($ore < ($durata * 24)) {
																					$nr6++;
																				}
																			}
																			echo '<li><a href="anunturi.php?cat=' . $rand['nume'] . '&subcat=Altele">Altele <font style="font-weight:normal;">(' . $nr6 . ')</font></a></li>';
																			echo '</ul>';
																		}
																	}
																}
																$cerereSQLx = 'SELECT * FROM `anunt` WHERE `cat`="Altele"';
																$rezultatx = mysqli_query($conexiune, $cerereSQLx);
																$nr = 0;
																while ($randx = mysqli_fetch_assoc($rezultatx)) {
																	$start = explode("/", $randx['data']);
																	$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($start[0], $start[1], $start[2], $start[3], $start[4], $start[5]);
																	$zile = floor($seconds_dif / 60 / 60 / 24);
																	$ore = floor($seconds_dif / 60 / 60);
																	if ($ore < ($durata * 24)) {
																		$nr++;
																	}
																}
																echo '<li><a href="anunturi.php?cat=Altele">Altele</a> (' . $nr . ')<br>';
																$cerereSQLy = 'SELECT * FROM `subcat` WHERE `cat`="Altele" ORDER BY `nume` ASC';
																$rezultaty = mysqli_query($conexiune, $cerereSQLy);
																if (mysqli_num_rows($rezultaty) != 0) {
																	echo '<ul>';
																	while ($randy = mysqli_fetch_assoc($rezultaty)) {
																		if ($randy['nume'] != "Altele") {
																			$cerereSQLx = 'SELECT * FROM `anunt` WHERE `cat`="Altele" AND `subcat`="' . $randy['nume'] . '"';
																			$rezultatx = mysqli_query($conexiune, $cerereSQLx);
																			$nr = 0;
																			while ($randx = mysqli_fetch_assoc($rezultatx)) {
																				$start = explode("/", $randx['data']);
																				$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($start[0], $start[1], $start[2], $start[3], $start[4], $start[5]);
																				$zile = floor($seconds_dif / 60 / 60 / 24);
																				$ore = floor($seconds_dif / 60 / 60);
																				if ($ore < ($durata * 24)) {
																					$nr++;
																				}
																			}
																			echo '<li><a href="anunturi.php?cat=Altele&subcat=' . $randy['nume'] . '">' . $randy['nume'] . ' <font style="font-weight:normal;">(' . $nr . ')</font></a></li>';
																		}
																	}
																	$cerereSQLh = 'SELECT * FROM `anunt` WHERE `cat`="Altele" AND `subcat`="Altele"';
																	$rezultath = mysqli_query($conexiune, $cerereSQLh);
																	$nr = 0;
																	while ($randh = mysqli_fetch_assoc($rezultath)) {
																		$start = explode("/", $randh['data']);
																		$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($start[0], $start[1], $start[2], $start[3], $start[4], $start[5]);
																		$zile = floor($seconds_dif / 60 / 60 / 24);
																		$ore = floor($seconds_dif / 60 / 60);
																		if ($ore < ($durata * 24)) {
																			$nr++;
																		}
																	}
																	echo '<li><a href="anunturi.php?cat=Altele&subcat=Altele">Altele <font style="font-weight:normal;">(' . $nr . ')</font></a></li>';
																	echo '</ul>';
																}
														?>
											</td>
										</tr>
										<tr>
											<td width="9" height="9" background="images/anunt_27.gif"></td>
											<td width="221" height="9" background="images/anunt_28.gif"></td>
											<td width="9" height="9" background="images/anunt_29.gif"></td>
										</tr>
									</table>
									<table>
										<tr>
											<td></td>
										</tr>
									</table>
									<table border="0" cellspacing="0" cellpadding="0" align="center" width="239">
										<tr>
											<td width="9" height="9" background="images/anunt_11.gif"></td>
											<td background="images/anunt_12.gif"></td>
											<td width="9" height="9" background="images/anunt_14.gif"></td>
										</tr>
										<tr>
											<td width="9" background="images/anunt_19.gif">&nbsp;</td>
											<td style="padding-left:0px; padding-right:0px;" align="center">
												<img src="images/reclama_square.gif" alt="Reclama ta aici!" width="220" height="220">
											</td>
											<td width="9" background="images/anunt_21.gif">&nbsp;</td>
										</tr>
										<tr>
											<td width="9" height="9" background="images/anunt_27.gif"></td>
											<td background="images/anunt_28.gif"></td>
											<td width="9" height="9" background="images/anunt_29.gif"></td>
										</tr>
									</table>
									<table>
										<tr>
											<td></td>
										</tr>
									</table>
									<table border="0" cellspacing="0" cellpadding="0" align="center" width="239" height="390">
										<tr>
											<td width="9" height="9" background="images/anunt_11.gif"></td>
											<td background="images/anunt_12.gif"></td>
											<td width="9" height="9" background="images/anunt_14.gif"></td>
										</tr>
										<tr>
											<td width="9" background="images/anunt_19.gif">&nbsp;</td>
											<td style="padding-left:10px; padding-right:10px;" align="center" valign="middle">
												<font style="font-size:20px; font-weight:bold; line-height:30px;"><strong>SKAI.RO</strong></font><br>
												<font style="font-size:18px; line-height:30px;">este un site care ofera tuturor posibilitatea de a vinde sau cumpara produse noi sau second hand intr-un mod rapid si eficient.<br>
													<strong>Toate anunturile sunt GRATUITE !</strong>
												</font>
											</td>
											<td width="9" background="images/anunt_21.gif">&nbsp;</td>
										</tr>
										<tr>
											<td width="9" height="9" background="images/anunt_27.gif"></td>
											<td background="images/anunt_28.gif"></td>
											<td width="9" height="9" background="images/anunt_29.gif"></td>
										</tr>
									</table>
								<?php
															} else {
								?>
									<table border="0" cellspacing="0" cellpadding="0" align="center" width="239">
										<tr>
											<td width="9" height="9" background="images/anunt_11.gif"></td>
											<td background="images/anunt_12.gif"></td>
											<td width="9" height="9" background="images/anunt_14.gif"></td>
										</tr>
										<tr>
											<td width="9" background="images/anunt_19.gif">&nbsp;</td>
											<td style="padding-left:10px; padding-right:10px; height:432px;" align="center" valign="middle">
												<font style="font-size:20px; font-weight:bold; line-height:30px;"><strong>SKAI.RO</strong></font><br>
												<font style="font-size:18px; line-height:30px;">este un site care ofera tuturor posibilitatea de a vinde sau cumpara produse noi sau second hand intr-un mod rapid si eficient.<br>
													<strong>Toate anunturile sunt GRATUITE !</strong>
												</font>
											</td>
											<td width="9" background="images/anunt_21.gif">&nbsp;</td>
										</tr>
										<tr>
											<td width="9" height="9" background="images/anunt_27.gif"></td>
											<td background="images/anunt_28.gif"></td>
											<td width="9" height="9" background="images/anunt_29.gif"></td>
										</tr>
									</table>
								<?php
															}
														} else {
								?>
							<td width="0"> <?php
														}
											?>
							</td>
							<?php if (($_SERVER['PHP_SELF'] == $path . '/anunt.php') && ($_SERVER['PHP_SELF'] == $path . '/anunturi.php') && ($m == 's') && ($_SERVER['PHP_SELF'] == $path . '/termeni.php') && ($_SERVER['PHP_SELF'] == $path . '/ajutor.php') && ($_SERVER['PHP_SELF'] == $path . '/contact.php') && ($ac != "my") && ($_SERVER['PHP_SELF'] == $path . '/cautareav.php')) { ?>
								<td valign="top" align="left" style="padding: 0px;">
								<?php } else { ?>
								<td width="10">&nbsp;</td>
								<td width="692" valign="top">
								<?php } ?>