<?php
include('header.php');
if (!isset($_SESSION['logat'])) $_SESSION['logat'] = 'Nu';
if (($_SESSION['logat'] == 'Da') && ($_SESSION['acces'] == '3')) {
	echo '<a href="?action=addcat">Adauga categorie</a> | <a href="?action=addscat">Adauga subcategorie</a> | <a href="?action=lista">Lista categorii</a> | <a href="?action=lista2">Lista useri</a> | <a href="?action=lista3">Lista banari | <a href="?action=config">CONFIG</a><br /><br />';
	if (isset($_GET['action'])) {
		///////////////////////////////////////////////////////////////////////////////
		//  ADAUGA CATEGORIE   ////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		if ($_GET['action'] == 'addcat') {
			if (isset($_POST['addcat'])) {
				$_SESSION['nume'] = $_POST['nume'];
				$_SESSION['mtitlu'] = $_POST['mtitlu'];
				$_SESSION['mdesc'] = $_POST['mdesc'];
				$_SESSION['mkey'] = $_POST['mkey'];
				if ($_SESSION['nume'] == '') {
					echo '
					<table width="405" cellspacing="0" cellpading="5" align="center">
					<tr><td align="center"><b>ERROR !</b></td></tr>
					<tr><td align="center">Introdu numele categoriei !</td></tr>
					</table>
					';
				} else {
					$cerereSQL = "INSERT INTO `cat` ( `nume`, `mtitlu`, `mdesc`, `mkey` ) 
					VALUES ( '" . htmlentities($_SESSION['nume'], ENT_QUOTES) . "',
							'" . htmlentities($_SESSION['mtitlu'], ENT_QUOTES) . "',
							'" . htmlentities($_SESSION['mdesc'], ENT_QUOTES) . "',
							'" . htmlentities($_SESSION['mkey'], ENT_QUOTES) . "'
							)";
					mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");
					echo '<font color="green"><center><b>Categoria s-a adaugat cu succes !</b></center></font><br>';
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
				}
				$_SESSION['nume'] = '';
				$_SESSION['mtitlu'] = '';
				$_SESSION['mdesc'] = '';
				$_SESSION['mkey'] = '';
			} else {
				echo '';
			}
			echo '<form name="addcat" action="admin.php?action=addcat" method="post" enctype="multipart/form-data">
			<table border="0" align="center" width="500" cellspacing="5" cellpadding="5">
			<tr>
			<td align="right"><b>Nume Categorie:</b></td>
			<td align="left"><input type="text" size="50" name="nume"></td>   
			</tr>
			<tr>
			<td align="right"><b>Meta titlu:</b></td>
			<td align="left"><input type="text" size="50" name="mtitlu"></td>   
			</tr>
			<tr>
			<td align="right"><b>Meta descriere:</b></td>
			<td align="left"><input type="text" size="50" name="mdesc"></td>   
			</tr>
			<tr>
			<td align="right"><b>Meta keywords:</b></td>
			<td align="left"><input type="text" size="50" name="mkey"></td>   
			</tr>
			<tr>
			<td align="center" colspan="2"><input name="addcat" type="submit" value="Adauga" id="addcat"></td>
			</tr>
			</table>
			</form>
			';
		}
		///////////////////////////////////////////////////////////////////////////////
		//  ADAUGA SUBCATEGORIE   /////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'addscat') {
			if (isset($_POST['addscat'])) {
				$_SESSION['nume'] = $_POST['nume'];
				$_SESSION['cat'] = $_POST['cat'];
				$_SESSION['mtitlu'] = $_POST['mtitlu'];
				$_SESSION['mdesc'] = $_POST['mdesc'];
				$_SESSION['mkey'] = $_POST['mkey'];
				if (($_SESSION['nume'] == '') || ($_SESSION['cat'] == '')) {
					echo '<table width="405" cellspacing="0" cellpading="5" align="center"><tr><td align="center"><b>ERROR !</b></td></tr>';
					if ($_SESSION['nume'] == '') echo '<tr><td align="center">Introdu numele subcategoriei !</td></tr>';
					if ($_SESSION['cat'] == '') echo '<tr><td align="center">Alege categoria !</td></tr>';
					echo '</table>';
				} else {
					$cerereSQL = "INSERT INTO `subcat` ( `nume`, `cat`, `mtitlu`, `mdesc`, `mkey` )
					VALUES ( '" . htmlentities($_SESSION['nume'], ENT_QUOTES) . "',
						'" . htmlentities($_SESSION['cat'], ENT_QUOTES) . "',
						'" . htmlentities($_SESSION['mtitlu'], ENT_QUOTES) . "',
						'" . htmlentities($_SESSION['mdesc'], ENT_QUOTES) . "',
						'" . htmlentities($_SESSION['mkey'], ENT_QUOTES) . "'
						)";
					mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");
					echo '<font color="green"><center><b>Subcategoria s-a adaugat cu succes !</b></center></font><br>';
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
				}
				$_SESSION['nume'] = '';
				$_SESSION['cat'] = '';
				$_SESSION['mtitlu'] = '';
				$_SESSION['mdesc'] = '';
				$_SESSION['mkey'] = '';
			} else {
				echo '';
			}
			echo '<form name="addscat" action="admin.php?action=addscat" method="post" enctype="multipart/form-data">
			<table border="0" align="center" width="500" cellspacing="5" cellpadding="5">
			<tr>
			<td align="right"><b>Nume Subcategorie:</b></td>
			<td align="left"><input type="text" size="50" name="nume"></td>   
			</tr>
			<tr>
			<td align="right"><b>Categorie:</b></td>
			<td align="left">
			<select name="cat" size="1">
			<option value="">Alege !</option>';
			$cerereSQL = 'SELECT * FROM `cat` ORDER BY `nume` ASC';
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			while ($rand = mysqli_fetch_assoc($rezultat)) {
				echo '<option value="' . $rand['nume'] . '">' . $rand['nume'] . '</option>';
			}
			echo '</select>
			</td>   
			</tr>
			<tr>
			<td align="right"><b>Meta titlu:</b></td>
			<td align="left"><input type="text" size="50" name="mtitlu"></td>   
			</tr>
			<tr>
			<td align="right"><b>Meta descriere:</b></td>
			<td align="left"><input type="text" size="50" name="mdesc"></td>   
			</tr>
			<tr>
			<td align="right"><b>Meta keywords:</b></td>
			<td align="left"><input type="text" size="50" name="mkey"></td>   
			</tr>
			<tr>
			<td align="center" colspan="2"><input name="addscat" type="submit" value="Adauga" id="addscat"></td>
			</tr>
			</table>
			</form>
			';
		}
		///////////////////////////////////////////////////////////////////////////////
		//  Lista categorii		///////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'lista') {
			$cerereSQL = 'SELECT * FROM `cat` ORDER BY `nume` ASC';
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			while ($rand = mysqli_fetch_assoc($rezultat)) {
				echo '
				<table width="650" border="0" cellpadding="0" cellspacing="0" style="border-bottom:solid 1px #000000;" align="center">
				  <tr>
					<td valign="middle" width="200"><strong>' . $rand['nume'] . '</strong></td>
					<td width="250">
						<table width="250" border="0" cellpadding="0" cellspacing="0">';
				$cerereSQL2 = 'SELECT * FROM `subcat` WHERE `cat`="' . $rand['nume'] . '" ORDER BY `nume` ASC';
				$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
				while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
					echo '
								<tr>
									<td width="200" align="right" style="border-bottom:solid 1px #999999;">
										' . $rand2['nume'] . '
									</td>
									<td width="50" align="center" style="border-bottom:solid 1px #999999;">
										<a href="admin.php?action=del&ce=subcat&id=' . $rand2['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Sterge subcategorie" /></a>&nbsp;&nbsp;<a href="admin.php?action=edit&ce=subcat&id=' . $rand2['id'] . '"><img src="images/anunt_facont.gif" width="15" height="15" align="top" alt="Editeaza subcategorie" /></a>
									</td>
								</tr>
								';
				}
				echo '	
						</table>
					</td>
					<td width="150" align="right">
						<a href="admin.php?action=del&ce=cat&id=' . $rand['id'] . '">Sterge categorie <img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Sterge categorie" /></a><br />
						<a href="admin.php?action=edit&ce=cat&id=' . $rand['id'] . '">Editeaza categorie <img src="images/anunt_facont.gif" width="15" height="15" align="top" alt="Editeaza categorie" /></a>
					</td>
				  </tr>
				</table>
				<table><tr><td></td></tr></table>
				';
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		//  Lista useri		///////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'lista2') {
			echo '
				<table width="650" border="0" cellpadding="3" cellspacing="3">';
			$cerereSQL = 'SELECT * FROM `users` ORDER BY `user` ASC';
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			$nru = 0;
			while ($rand = mysqli_fetch_assoc($rezultat)) {
				$nru++;
				echo '
				  	<tr>
						<td valign="middle" style="border-bottom:solid 1px #999999; border-right:dashed 1px #999999; width:282px;">
							' . $nru . '. <a href="admin.php?action=profil&id=' . $rand['id'] . '"><strong>' . $rand['user'] . '</strong></a>
						</td>
						<td align="center" style="border-bottom:solid 1px #999999; border-right:dashed 1px #999999; width:92px;">
							<a href="admin.php?action=profil&id=' . $rand['id'] . '"><img src="images/anunt_facont.gif" width="15" height="15" align="top" alt="Vezi profil" /> Vezi profil</a>
						</td>
						<td align="center" style="border-bottom:solid 1px #999999; border-right:dashed 1px #999999; width:92px;">
							<a href="admin.php?action=anunturi&user=' . $rand['user'] . '"><img src="images/anunt_my.gif" width="15" height="15" align="top" alt="Vezi anunturi" /> Anunturi</a>
						</td>
						<td align="center" style="border-bottom:solid 1px #999999; border-right:dashed 1px #999999; width:92px;">
							<a href="admin.php?action=ban&id=' . $rand['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Baneaza ' . $rand['user'] . '" /> Baneaza</a>
						</td>
						<td align="center" style="border-bottom:solid 1px #999999; width:92px;">
							<a href="admin.php?action=del&ce=user&id=' . $rand['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Sterge ' . $rand['user'] . '" /> Sterge</a>
						</td>
				  	</tr>';
			}
			echo '
				</table>
			';
		}
		///////////////////////////////////////////////////////////////////////////////
		//	Stergeri	///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'del') {
			if (isset($_GET['ce'])) {
				if ($_GET['ce'] == "cat") {
					if (isset($_GET['id'])) {
						$cerereSQL = 'SELECT * FROM `cat` WHERE `id`="' . $_GET['id'] . '"';
						$rezultat = mysqli_query($conexiune, $cerereSQL);
						if (mysqli_num_rows($rezultat) == 0) {
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
						} else {
							while ($rand = mysqli_fetch_assoc($rezultat)) {
								$cerereSQL2 = "DELETE FROM `subcat` WHERE `cat`='" . $rand["nume"] . "'";
								$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
							}
							$cerereSQL3 = "DELETE FROM `cat` WHERE `id`='" . $_GET["id"] . "'";
							$rezultat3 = mysqli_query($conexiune, $cerereSQL3);
							echo '<script>alert("Categoria si toate subcategoriile incluse au fost sterse cu succes!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
						}
					} else {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
					}
				} elseif ($_GET['ce'] == "subcat") {
					if (isset($_GET['id'])) {
						$cerereSQL = 'SELECT * FROM `subcat` WHERE `id`="' . $_GET['id'] . '"';
						$rezultat = mysqli_query($conexiune, $cerereSQL);
						if (mysqli_num_rows($rezultat) == 0) {
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
						} else {
							$cerereSQL3 = "DELETE FROM `subcat` WHERE `id`='" . $_GET["id"] . "'";
							$rezultat3 = mysqli_query($conexiune, $cerereSQL3);
							echo '<script>alert("Subcategoria a fost stearsa cu succes!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
						}
					} else {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
					}
				} elseif ($_GET['ce'] == "user") {
					if (isset($_GET['id'])) {
						$cerereSQL = 'SELECT * FROM `users` WHERE `id`="' . $_GET['id'] . '"';
						$rezultat = mysqli_query($conexiune, $cerereSQL);
						if (mysqli_num_rows($rezultat) == 0) {
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
						} else {
							$cerereSQL3 = "DELETE FROM `users` WHERE `id`='" . $_GET["id"] . "'";
							$rezultat3 = mysqli_query($conexiune, $cerereSQL3);
							echo '<script>alert("Userul a fost sters cu succes!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
						}
					} else {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
					}
				} elseif ($_GET['ce'] == "ban") {
					if (isset($_GET['id'])) {
						$cerereSQL = 'SELECT * FROM `ban` WHERE `id`="' . $_GET['id'] . '"';
						$rezultat = mysqli_query($conexiune, $cerereSQL);
						if (mysqli_num_rows($rezultat) == 0) {
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista3">';
						} else {
							$cerereSQL3 = "DELETE FROM `ban` WHERE `id`='" . $_GET["id"] . "'";
							$rezultat3 = mysqli_query($conexiune, $cerereSQL3);
							echo '<script>alert("Userul si adresa de email nu mai sunt interzise!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista3">';
						}
					} else {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista3">';
					}
				} else {
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php">';
				}
			} else {
				echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php">';
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		//	Editari		///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'edit') {
			if (isset($_GET['ce'])) {
				if ($_GET['ce'] == "cat") {
					if (isset($_GET['id'])) {
						if (isset($_POST['edit'])) {
							$cerereSQL = 'UPDATE  `cat` SET
									`mtitlu` =  "' . $_POST['mtitlu'] . '",
									`mdesc` =  "' . $_POST['mdesc'] . '",
									`mkey` =  "' . $_POST['mkey'] . '" WHERE  `cat`.`id` ="' . $_GET['id'] . '" LIMIT 1';
							mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Editarea nu a putut fi realizata !</font></b></center>");

							echo '<script>alert("Categoria a fost editata cu succes!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
						} else {
							$cerereSQL = 'SELECT * FROM `cat` WHERE `id`="' . $_GET['id'] . '"';
							$rezultat = mysqli_query($conexiune, $cerereSQL);
							if (mysqli_num_rows($rezultat) == 0) {
								echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
							} else {
								while ($rand = mysqli_fetch_assoc($rezultat)) {
									echo '<form name="edit" action="" method="post">
									<table border="0" align="center" width="500" cellspacing="5" cellpadding="5">
									<tr>
									<td align="right"><b>Meta titlu:</b></td>
									<td align="left"><input type="text" size="50" name="mtitlu" value="' . $rand['mtitlu'] . '"></td>   
									</tr>
									<tr>
									<td align="right"><b>Meta descriere:</b></td>
									<td align="left"><input type="text" size="50" name="mdesc" value="' . $rand['mdesc'] . '"></td>   
									</tr>
									<tr>
									<td align="right"><b>Meta keywords:</b></td>
									<td align="left"><input type="text" size="50" name="mkey" value="' . $rand['mkey'] . '"></td>   
									</tr>
									<tr>
									<td align="center" colspan="2"><input name="edit" type="submit" value="Editeaza"></td>
									</tr>
									</table>
									</form>
									';
								}
							}
						}
					} else {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
					}
				} elseif ($_GET['ce'] == "subcat") {
					if (isset($_GET['id'])) {
						if (isset($_POST['edit'])) {
							$cerereSQL = 'UPDATE  `subcat` SET
									`cat` = "' . $_POST['cat'] . '",
									`mtitlu` =  "' . $_POST['mtitlu'] . '",
									`mdesc` =  "' . $_POST['mdesc'] . '",
									`mkey` =  "' . $_POST['mkey'] . '" WHERE  `subcat`.`id` ="' . $_GET['id'] . '" LIMIT 1';
							mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Editarea nu a putut fi realizata !</font></b></center>");

							echo '<script>alert("Subcategoria a fost editata cu succes!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
						} else {
							$cerereSQL = 'SELECT * FROM `subcat` WHERE `id`="' . $_GET['id'] . '"';
							$rezultat = mysqli_query($conexiune, $cerereSQL);
							if (mysqli_num_rows($rezultat) == 0) {
								echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
							} else {
								while ($rand = mysqli_fetch_assoc($rezultat)) {
									echo '<form name="edit" action="" method="post">
									<table border="0" align="center" width="500" cellspacing="5" cellpadding="5">
									<tr>
									<td align="right"><b>Categorie:</b></td>
									<td align="left">
										<select name="cat">';
									$cerereSQL2 = 'SELECT * FROM `cat` ORDER BY `nume` ASC';
									$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
									while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
										echo '<option ';
										if ($rand['cat'] == $rand2['nume']) echo 'selected="selected"';
										echo ' value="' . $rand2['nume'] . '">' . $rand2['nume'] . '</option>';
									}
									echo '
										</select>
									</td>   
									</tr>
									<tr>
									<td align="right"><b>Meta titlu:</b></td>
									<td align="left"><input type="text" size="50" name="mtitlu" value="' . $rand['mtitlu'] . '"></td>   
									</tr>
									<tr>
									<td align="right"><b>Meta descriere:</b></td>
									<td align="left"><input type="text" size="50" name="mdesc" value="' . $rand['mdesc'] . '"></td>   
									</tr>
									<tr>
									<td align="right"><b>Meta keywords:</b></td>
									<td align="left"><input type="text" size="50" name="mkey" value="' . $rand['mkey'] . '"></td>   
									</tr>
									<tr>
									<td align="center" colspan="2"><input name="edit" type="submit" value="Editeaza"></td>
									</tr>
									</table>
									</form>
									';
								}
							}
						}
					} else {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
					}
				} else {
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php">';
				}
			} else {
				echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php">';
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		//	Banare	///////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'ban') {
			if (isset($_GET['id'])) {
				$cerereSQL = 'SELECT * FROM `users` WHERE `id`="' . $_GET['id'] . '"';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				if (mysqli_num_rows($rezultat) == 0) {
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
				} else {
					while ($rand = mysqli_fetch_assoc($rezultat)) {
						$cerereSQL = "INSERT INTO `ban` ( `user`, `email`) 
												VALUES ( '" . $rand['user'] . "',
														 '" . $rand['mail'] . "')";
						mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Banarea nu a putut fi realizata !</font></b></center>");
						echo '<script>alert("Userul a fost banat cu succes!");</script>';
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=del&ce=user&id=' . $_GET['id'] . '">';
					}
				}
			} else {
				echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		//	Ban list	///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'lista3') {
			echo '
				<table width="650" border="0" cellpadding="3" cellspacing="3">';
			$cerereSQL = 'SELECT * FROM `ban` ORDER BY `user` ASC';
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			while ($rand = mysqli_fetch_assoc($rezultat)) {
				echo '
				  	<tr>
						<td valign="middle" style="border-bottom:solid 1px #999999; border-right:dashed 1px #999999; width:275px;">
							<strong>' . $rand['user'] . '</strong>
						</td>
						<td align="center" style="border-bottom:solid 1px #999999; border-right:dashed 1px #999999; width:275px;">
							' . $rand['email'] . '
						</td>
						<td align="center" style="border-bottom:solid 1px #999999; width:100px;">
							<a href="admin.php?action=del&ce=ban&id=' . $rand['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Scoate ban" /> UnBan</a>
						</td>
				  	</tr>';
			}
			echo '
				</table>
			';
		}
		///////////////////////////////////////////////////////////////////////////////
		//	Profil	///////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'profil') {
			if (isset($_GET['id'])) {
				if (isset($_POST['acc'])) {
					$cerereSQL = 'UPDATE  `users` SET
									`acces` =  "' . $_POST['acces'] . '" WHERE  `users`.`id` =' . $_GET['id'] . ' LIMIT 1';
					mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Editarea nu a putut fi realizata !</font></b></center>");

					echo '<script>alert("Modificarile au fost facute cu succes!");</script>';
					//echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=profil&id='.$_GET['id'].'">';
				}
				$cerereSQL = 'SELECT * FROM `users` WHERE `id`="' . $_GET['id'] . '"';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				if (mysqli_num_rows($rezultat) == 0) {
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
				} else {
					while ($rand = mysqli_fetch_assoc($rezultat)) {
						echo '
							<table width="650" border="0" cellspacing="4" cellpadding="4">
							  <tr>
								<td width="250" align="right">user:</td>
								<td width="400" align="center"><strong>' . $rand['user'] . '</strong></td>
							  </tr>
							  <tr>
								<td align="right">nume:</td>
								<td align="center">' . $rand['nume'] . '</td>
							  </tr>
							  <tr>
								<td align="right">nr. telefon:</td>
								<td align="center">' . $rand['tel'] . '</td>
							  </tr>
							  <tr>
								<td align="right">adresa de e-mail:</td>
								<td align="center">' . $rand['mail'] . '</td>
							  </tr>
							  <tr>
								<td align="right">localitate:</td>
								<td align="center">' . $rand['localitate'] . '</td>
							  </tr>
							  <tr>
								<td align="right">acces:</td>
								<td align="center">
									<form name="acc" action="" method="post">
										<select name="acces">
											<option ';
						if ($rand['acces'] == "1") echo ' selected="selected" ';
						echo ' value="1">User simplu</option>
											<option ';
						if ($rand['acces'] == "2") echo ' selected="selected" ';
						echo ' value="2">User free</option>
											<option ';
						if ($rand['acces'] == "3") echo ' selected="selected" ';
						echo ' value="3">Admin</option>
										</select>
										<input type="submit" name="acc" value="schimba" />
									</form>
								</td>
							  </tr>
							  <tr>
								<td colspan="2" align="center">
									<br /><a href="admin.php?action=del&ce=user&id=' . $rand['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Sterge ' . $rand['user'] . '" /> Sterge</a> &nbsp;&nbsp;&nbsp;&nbsp;
									<a href="admin.php?action=ban&id=' . $rand['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Baneaza ' . $rand['user'] . '" /> Baneaza</a> &nbsp;&nbsp;&nbsp;&nbsp;
									<a href="admin.php?action=anunturi&user=' . $rand['user'] . '"><img src="images/anunt_my.gif" width="15" height="15" align="top" alt="Vezi anunturi" /> Anunturi</a></td>
							  </tr>
							</table>
						';
					}
				}
			} else {
				echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		//	Config	///////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'config') {
			$cerereSQL = 'SELECT * FROM `config` WHERE `id`="1"';
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			while ($rand = mysqli_fetch_assoc($rezultat)) {
				if (isset($_POST['conf'])) {
					if ($_POST['durata'] == "") echo 'Eroare! durata nu poate fi 0!';
					else {
						$cerereSQL = 'UPDATE  `config` SET
									`durata` =  "' . $_POST['durata'] . '",
									`mtitlu` =  "' . $_POST['mtitlu'] . '",
									`mdesc` =  "' . $_POST['mdesc'] . '",
									`mkey` =  "' . $_POST['mkey'] . '" WHERE  `config`.`id` =1 LIMIT 1';
						mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Editarea nu a putut fi realizata !</font></b></center>");

						echo '<script>alert("Modificarile au fost facute cu succes!");</script>';
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=config">';
					}
				} else {
					echo '
							<form name="conf" action="" method="post">
							<table width="650" border="0" cellspacing="4" cellpadding="4">
							  <tr>
								<td width="250" align="right">durata anuntului (zile):</td>
								<td width="400" align="center">
									<input type="text" name="durata" value="' . $rand['durata'] . '" size="40" />
								</td>
							  </tr>
							  <tr>
								<td align="right">Meta titlu:</td>
								<td align="center">
									<input type="text" name="mtitlu" value="' . $rand['mtitlu'] . '" size="40" />
								</td>
							  </tr>
							  <tr>
								<td align="right">Meta descriere:</td>
								<td align="center">
									<input type="text" name="mdesc" value="' . $rand['mdesc'] . '" size="40" />
								</td>
							  </tr>
							  <tr>
								<td align="right">Meta keywords:</td>
								<td align="center">
									<input type="text" name="mkey" value="' . $rand['mkey'] . '" size="40" />
								</td>
							  </tr>
							  <tr>
								<td colspan="2" align="center">
									<input type="submit" name="conf" value="schimba" />
								</td>
							  </tr>
							</table>
							</form>
						';
				}
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		//	Anunturi	///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'anunturi') {
			if (isset($_GET['user'])) {
				$cerereSQL = 'SELECT * FROM `anunt` WHERE `user`="' . $_GET['user'] . '" ORDER BY `id` DESC';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				echo '<table width="690" cellspacing="4">
				<tr><td><h1 align="center">Anunturile lui ' . $_GET['user'] . '</h1><br /></td></tr>
				';
				while ($rand = mysqli_fetch_assoc($rezultat)) {
					$date = explode("/", $rand['data']);
					$seconds_dif = mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")) - mktime($date[0], $date[1], $date[2], $date[3], $date[4], $date[5]);
					$zile = floor($seconds_dif / 60 / 60 / 24);
					$ore = floor($seconds_dif / 60 / 60);
					if ($ore < ($durata * 24)) {
						$cat = $durata - $zile;
						if ($cat == 1) $mesaj = '<font color="#000000"><strong>expira in ' . ($durata * 24) - $ore . ' ore</strong></font>';
						else $mesaj = '<font color="#000000"><strong>expira in ' . $cat . ' zile</strong></font>';
					} else {
						$mesaj = '<font color="#FF0000"><strong>Expirat !</strong></font>';
					}
					$bgr = "#FFFFFF";
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
						<tr><td>
							<table width="100%" height="68" align="center" cellpadding="2" cellspacing="2" style="border-bottom: solid 1px #93A6CA; border-top: solid 1px #E2E2E2; border-left: solid 3px #42455e; background-color:' . $bgr . ';">
								<tr>
									<td rowspan="3" height="68" align="center" valign="middle" width="76"><a href="anunt.php?id=' . $rand['id'] . '"><img src="' . $src . '" width="' . $width2 . '" height="' . $height2 . '" alt="' . $rand['titlu'] . '" /></a></td>
									<td height="16"><strong><a href="anunt.php?id=' . $rand['id'] . '">' . $rand['titlu'] . '</a></strong></td>
									<td width="250" height="52" colspan="2" rowspan="2" align="right">
										' . $mesaj . '<br /><br />
									<font style="font-size:14px; font-weight:bold">' . $rand['pret'] . ' ' . strtoupper($rand['moneda']) . '</font>                                </td>
								</tr>
								<tr>
									<td height="36" style="font-size:12px;">' . $continut . '<br />
										in <strong>' . $rand['oras'] . '</strong>
									</td>
								</tr>
								<tr>
									<td height="16" colspan="3" align="right" style="font-size:12px;"><a href="profil.php?a=del&id=' . $rand['id'] . '"><img src="images/anunt_logout.gif" width="15" height="15" align="top" alt="Skai.Ro - Sterge anunt" /> Sterge</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="profil.php?a=add&id=' . $rand['id'] . '"><img src="images/anunt_adauga.gif" width="15" height="15" align="top" alt="Skai.Ro - Prelungeste anunt" /> Prelungeste</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="profil.php?a=add&id=' . $rand['id'] . '&ed"><img src="images/anunt_facont.gif" width="15" height="15" align="top" alt="Skai.Ro - Modifica anunt" /> Modifica</a></td>
								</tr>
							</table>
						</td></tr>
						';
				}
				echo '<tr><td>&nbsp;<br /><br /></td></tr></table>';
			} else {
				echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
			}
		} else {
			echo '';
		}
	} else {
		echo '';
	}
} else {
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=login.php">';
}
include('footer.php');
