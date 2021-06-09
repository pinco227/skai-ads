<?php
include('header.php');

if (!isset($_SESSION['logat'])) $_SESSION['logat'] = 'Nu';
if ($_SESSION['logat'] == "Da") {
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=index.php">';
} else {
	if (isset($_POST['register'])) {
		$_SESSION['user'] = $_POST['user'];
		$_SESSION['parola1'] = $_POST['parola1'];
		$_SESSION['parola2'] = $_POST['parola2'];
		$_SESSION['nume'] = $_POST['nume'];
		$_SESSION['tel'] = $_POST['tel'];
		$_SESSION['mail'] = $_POST['mail'];
		$_SESSION['localitate'] = $_POST['oras'];

		$cerereBan = "SELECT * FROM `ban` WHERE `user`='" . htmlentities($_SESSION['user']) . "'";
		$rezultatBan = mysqli_query($conexiune, $cerereBan);
		$cerereBan2 = "SELECT * FROM `ban` WHERE `email`='" . htmlentities($_SESSION['mail']) . "'";
		$rezultatBan2 = mysqli_query($conexiune, $cerereBan2);
		$cerereSQL = "SELECT * FROM `users` WHERE `user`='" . htmlentities($_SESSION['user']) . "'";
		$rezultat = mysqli_query($conexiune, $cerereSQL);
		$cerereSQL2 = "SELECT * FROM `users` WHERE `mail`='" . htmlentities($_SESSION['mail']) . "'";
		$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
		if (($_SESSION['user'] == '') || (mysqli_num_rows($rezultat) == 1) || (mysqli_num_rows($rezultatBan) == 1) || (mysqli_num_rows($rezultatBan2) == 1) || ($_SESSION['parola1'] == '') || ($_SESSION['parola2'] != $_SESSION['parola1']) || ($_SESSION['nume'] == '') || ($_SESSION['tel'] == '') || (!is_numeric($_SESSION['tel'])) || ($_SESSION['mail'] == '') || (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $_SESSION['mail'])) || (mysqli_num_rows($rezultat2) == 1) || ($_SESSION['localitate'] == '0') || ($_SESSION['cod'] != $_POST['cod'])) {
			echo '
			<table align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="9" height="9" background="images/anunt_11.gif"></td>
					<td background="images/anunt_12.gif"></td>
					<td width="9" height="9" background="images/anunt_14.gif"></td>
				</tr>
				<tr>
					<td width="9" background="images/anunt_19.gif">&nbsp;</td>
					<td style="padding-left:5px; padding-right:5px;" align="center">
					<strong>EROARE !</strong><br />';
			if ($_SESSION['user'] == '') echo 'Nu ati completat campul <strong>"User"</strong> !<br />';
			if (mysqli_num_rows($rezultat) == 1) echo 'Userul <strong>' . $_SESSION['user'] . '</strong> exista deja in baza de date !<br />';
			if ($_SESSION['nume'] == '') echo 'Nu ati completat campul <strong>"Nume"</strong> !<br />';
			if ($_SESSION['parola1'] == '') echo 'Nu ati completat campul <strong>"Parola"</strong> !<br />';
			if ($_SESSION['parola2'] != $_SESSION['parola1']) echo 'Parolele nu corespund !<br />';
			if ($_SESSION['tel'] == '') echo 'Nu ati completat campul <strong>"Telefon"</strong> !<br />';
			if (!is_numeric($_SESSION['tel'])) echo 'Numarul de telefon este scris gresit !<br />';
			if ($_SESSION['mail'] == '') echo 'Nu ati completat campul <strong>"Mail"</strong> !<br />';
			if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $_SESSION['mail'])) echo 'Adresa de e-mail nu este valida !<br />';
			if (mysqli_num_rows($rezultat2) == 1) echo 'Adresa de mail este deja folosita !<br />';
			if (mysqli_num_rows($rezultatBan) == 1) echo 'User banat !<br />';
			if (mysqli_num_rows($rezultatBan2) == 1) echo 'Adresa de mail banata !<br />';
			if ($_SESSION['localitate'] == '0') echo 'Nu ati completat campul <strong>"Localitate"</strong> !<br />';
			if ($_SESSION['cod'] != $_POST['cod']) echo '<strong>Cod de siguranta incorect !</strong><br />';

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
			$cerereSQL3 = "INSERT INTO `users` ( `user`, `nume`, `pass`, `tel`, `mail`, `localitate` )
						VALUES ( '" . htmlentities($_SESSION['user'], ENT_QUOTES) . "', 
						'" . htmlentities($_SESSION['nume'], ENT_QUOTES) . "', 
						'" . md5($_SESSION['parola1']) . "', 
						'" . htmlentities($_SESSION['tel'], ENT_QUOTES) . "', 
						'" . htmlentities($_SESSION['mail'], ENT_QUOTES) . "', 
						'" . htmlentities($_SESSION['localitate'], ENT_QUOTES) . "' )";
			mysqli_query($conexiune, $cerereSQL3) or die('
			<table align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="9" height="9" background="images/anunt_11.gif"></td>
					<td background="images/anunt_12.gif"></td>
					<td width="9" height="9" background="images/anunt_14.gif"></td>
				</tr>
				<tr>
					<td width="9" background="images/anunt_19.gif">&nbsp;</td>
					<td style="padding-left:10px; padding-right:10px;" align="center">
					<strong>EROARE !</strong><br />
					Adaugarea nu a putut fi realizata !<br /></td>
					<td width="9" background="images/anunt_21.gif">&nbsp;</td>
				</tr>
				<tr>
					<td width="9" height="9" background="images/anunt_27.gif"></td>
					<td background="images/anunt_28.gif"></td>
					<td width="9" height="9" background="images/anunt_29.gif"></td>
				</tr>
			</table>
			');

			echo '
			<table align="center" width="692" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="9" height="9" background="images/anunt_11.gif"></td>
					<td background="images/anunt_12.gif"></td>
					<td width="9" height="9" background="images/anunt_14.gif"></td>
				</tr>
				<tr>
					<td width="9" background="images/anunt_19.gif">&nbsp;</td>
					<td style="padding-left:10px; padding-right:10px;" align="center">
					<strong>SUCCES !</strong><br />';
			echo '
					Felicitari <strong>' . $_SESSION['user'] . '</strong>! Ai fost inregistrat cu succes !<br />
					De acum poti adauga anunturi, iti poti gestiona anunturile si poti primi mesaje de la cumparatori!<br />
					Click <a href="login.php">aici</a> pentru logare!<br />
					';
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

			$_SESSION['user'] = '';
			$_SESSION['parola1'] = '';
			$_SESSION['parola2'] = '';
			$_SESSION['nume'] = '';
			$_SESSION['tel'] = '';
			$_SESSION['mail'] = '';
			$_SESSION['localitate'] = '';
			$_SESSION['cod'] = '';
		}
	}
	if (!isset($_SESSION['user'])) $_SESSION['user'] = '';
	if (!isset($_SESSION['parola1'])) $_SESSION['parola1'] = '';
	if (!isset($_SESSION['parola2'])) $_SESSION['parola2'] = '';
	if (!isset($_SESSION['nume'])) $_SESSION['nume'] = '';
	if (!isset($_SESSION['tel'])) $_SESSION['tel'] = '';
	if (!isset($_SESSION['mail'])) $_SESSION['mail'] = '';
	if (!isset($_SESSION['localitate'])) $_SESSION['localitate'] = '';

	echo '
	<table align="center" width="692" height="450" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="9" height="9" background="images/anunt_11.gif"></td>
			<td background="images/anunt_12.gif"></td>
			<td width="9" height="9" background="images/anunt_14.gif"></td>
		</tr>
		<tr>
			<td width="9" background="images/anunt_19.gif">&nbsp;</td>
			<td align="center">				
				<table width="600" height="371" border="0" cellpadding="0" cellspacing="0" align="center">
					<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
					<tr>
						<td height="36" colspan="4" align="center" valign="top"><h1>Formular inregistrare</h1></td>
					</tr>
					<tr>
						<td width="250" height="19" valign="top">&nbsp;</td>
						<td width="40" rowspan="19" valign="top"></td>
						<td width="200" valign="top">&nbsp;</td>
					    <td width="110" valign="top">&nbsp;</td>
					</tr>
				  	<tr>
						<td height="22" align="right" valign="middle">User:</td>
						<td align="center" valign="top">
							<input type="text" name="user" value="' . $_SESSION['user'] . '" style="width:198px;" />					  </td>
					    <td align="center" valign="top">&nbsp;</td>
				  	</tr>
				  	<tr>
						<td height="10"></td>
						<td width="200"></td>
						<td></td>
				  	</tr>
				  	<tr>
						<td height="22" align="right" valign="middle">Parola:</td>
					  <td align="center" valign="top"><input type="password" name="parola1" value="' . $_SESSION['parola1'] . '" style="width:198px;" /></td>
					  <td align="center" valign="top">&nbsp;</td>
				  	</tr>
				  	<tr>
						<td height="10"></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td height="22" align="right" valign="middle">Verificare Parola:</td>
						<td align="center" valign="middle"><input type="password" name="parola2" value="' . $_SESSION['parola2'] . '" style="width:198px;" /></td>
					    <td align="center" valign="middle">&nbsp;</td>
					</tr>
				  	<tr>
						<td height="10"></td>
						<td></td>
						<td></td>
				  	</tr>
				  	<tr>
						<td height="19" align="right" valign="middle">Nume si Prenume:</td>
						<td align="center" valign="top"><input type="text" name="nume" value="' . $_SESSION['nume'] . '" style="width:198px;" /></td>
					    <td align="center" valign="top">&nbsp;</td>
				  	</tr>
				  	<tr>
						<td height="10"></td>
						<td></td>
						<td></td>
				  	</tr>
					<tr>
						<td height="22" align="right" valign="middle">Numar de telefon:</td>
						<td align="center" valign="top"><input type="text" name="tel" value="' . $_SESSION['tel'] . '" style="width:198px;" /></td>
					    <td align="center" valign="top">&nbsp;</td>
					</tr>
				  	<tr>
						<td height="10"></td>
						<td></td>
						<td></td>
				  	</tr>
					<tr>
						<td height="22" align="right" valign="middle">Adresa de e-mail:</td>
						<td align="center" valign="top"><input type="text" name="mail" value="' . $_SESSION['mail'] . '" style="width:198px;" /></td>
					    <td align="center" valign="top">&nbsp;</td>
					</tr>
				  	<tr>
						<td height="10"></td>
						<td></td>
						<td></td>
				  	</tr>
				  	<tr>
						<td height="22" align="right" valign="middle">Localitate:</td>
						<td align="center" valign="top">
							<select name="oras" style="width:200px;">
									<option value="0" >Alege</option>
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
							</select>						</td>
					    <td align="center" valign="top">&nbsp;</td>
				  	</tr>
				  	<tr>
						<td height="10"></td>
						<td height="10"></td>
						<td></td>
				  	</tr>
				  	<tr>
				  	  <td height="40" align="right" valign="middle">
                      		Cod siguranta: <img src="captcha.php?width=100&height=40&characters=4" width="100" height="40" align="middle" />                      </td>
				  	  <td align="center" valign="top"><input type="text" name="cod" value="" style="width:198px;" /></td>
				  	  <td align="center" valign="top">&nbsp;</td>
				  	</tr>
				  	<tr>
				  	  <td height="19">&nbsp;</td>
				  	  <td>&nbsp;</td>
				  	  <td>&nbsp;</td>
				  	  </tr>
				  	<tr>
						<td height="24">&nbsp;</td>
						<td align="center" valign="top">
							<input name="register" type="submit" id="Trimite" value="Trimite" class="cauta">						</td>
					    <td align="center" valign="top">&nbsp;</td>
				  	</tr>
				  	<tr>
						<td height="24">&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
				  	</tr>
				  	</form>
				</table>
			</td>
			<td width="9" background="images/anunt_21.gif">&nbsp;</td>
		</tr>
		<tr>
			<td width="9" height="9" background="images/anunt_27.gif"></td>
			<td background="images/anunt_28.gif"></td>
			<td width="9" height="9" background="images/anunt_29.gif"></td>
		</tr>
	</table>';
}

include('footer.php');
