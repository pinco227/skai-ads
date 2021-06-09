<?php
include('header.php');
?>
<table width="941" cellpadding="10" cellspacing="0" border="0">
	<tr>
		<td width="470">
			<?php
			if (isset($_POST['contact'])) {
				$_SESSION['nume'] = $_POST['nume'];
				$_SESSION['mail'] = $_POST['mail'];
				$_SESSION['tel'] = $_POST['tel'];
				$_SESSION['sub'] = $_POST['sub'];
				$_SESSION['mesaj'] = $_POST['mesaj'];
				if (($_SESSION['nume'] == '') || ($_SESSION['mesaj'] == '')) {
					echo '
						<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
							<tr>
								<td width="9" height="9" background="images/anunt_11.gif"></td>
								<td background="images/anunt_12.gif"></td>
								<td width="9" height="9" background="images/anunt_14.gif"></td>
							</tr>
							<tr>
								<td width="9" background="images/anunt_19.gif">&nbsp;</td>
								<td style="padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px;" align="center">
									<strong><h3 style="color: red;">Eroare!</h3></strong>';
					if ($_SESSION['nume'] == '') echo '<br />Nu ai completat <strong>numele</strong>!';
					if ($_SESSION['mesaj'] == '') echo '<br />Nu ai completat <strong>mesajul</strong>!';
					echo '</td>
							<td width="9" background="images/anunt_21.gif">&nbsp;</td>
						</tr>
						<tr>
							<td width="9" height="9" background="images/anunt_27.gif"></td>
							<td background="images/anunt_28.gif"></td>
							<td width="9" height="9" background="images/anunt_29.gif"></td>
						</tr>
					</table><br />
					';
				} else {
					$catre = 'contact@skai.ro';
					$subiect = 'Contact SKAI - ' . $_SESSION['sub'];
					$mesaj = '
					<html>
					<head>
					<title>' . $subiect . '</title>
					</head>
					<body>
					<strong>Mail de pe pagina de <a href="http://www.skai.ro/contact.php">contact Skai.Ro</a> !</strong><br />
					Nume/Prenume : <b>' . $_SESSION['nume'] . '</b> <br />
					Adresa de e-mail: <b>' . $_SESSION['mail'] . '</b> <br />
					Nr. telefon: <b>' . $_SESSION['tel'] . '</b> <br />
					Mesaj : <br />
					' . $_SESSION['mesaj'] . '<br />
					</body></html>';
					$headere = "MIME-Version: 1.0\r\n";
					$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$headere .= "From: " . $_SESSION['mail'] . " <" . $_SESSION['mail'] . ">\r\n";

					// mail($catre, $subiect, $mesaj, $headere);
					echo '<script>alert("Felicitari!\nMesajul a fost trimis cu succes!");</script>';
					$_SESSION['name'] = '';
					$_SESSION['mail'] = '';
					$_SESSION['tel'] = '';
					$_SESSION['sub'] = '';
					$_SESSION['mesaj'] = '';
				}
			}
			if (isset($_GET['publicitate'])) {
			?>
				<h2 align="center">Publicitate pe SKAI.RO</h2>
				<p align="justify"><strong>SKAI.RO </strong>este un site care ofera tuturor posibilitatea  de a vinde sau cumpara produse noi sau second hand intr-un mod rapid si eficient. Pentru societati din domenii variate, <strong>SKAI.RO</strong> este un loc ideal pentru a-si face reclama.</p>
				<p align="justify">Prezentand oferta dvs. pe SKAI.RO puteti atinge in mod direct potentialul dvs. client! </p>
				<p align="justify">Va invitam sa colaboram!</p>
				<p align="justify">Daca doriti sa plasati o reclama pe site-ul nostru va rugam sa ne contactati la urmatoarea adresa de e-mail:</p>
				<p align="justify"><strong>contact@skai.ro</strong>.</p>
			<?php
			} else {
			?>
				<h2 align="center">Contact SKAI.RO </h2>
				<p align="justify"><strong>SKAI.RO</strong> este un site de anunturi, orientat catre afaceri, in care persoanele fizice sau companiile pot sa posteze anunturi. Toate anunturile sunt gratuite.</p>
				<p align="justify">In cazul in care aveti de adresat o intrebare echipei <strong>SKAI.RO</strong>, ne puteti contacta pe urmatoarea adresa de e-mail:</p>
				<p align="justify"><strong>contact@skai.ro</strong></p><?php
																	}

																		?>
		</td>
		<td width="470" align="right">
			<form name="contact" method="post" action="">
				<table width="470" style="background-color:#F5F8FA; border: solid 1px #CCCCCC; padding: 10px;" cellspacing="5">
					<tr>
						<td align="center" colspan="2" valign="middle">
							<h3 style="margin-top:0px;">Formular contact</h3>
						</td>
					</tr>
					<tr>
						<td align="right" width="150" valign="middle">Prenume/Nume: &nbsp;&nbsp;&nbsp;</td>
						<td align="left" width="300" valign="middle"><input type="text" value="" name="nume" style="width:300px;" /></td>
					</tr>
					<tr>
						<td align="right" width="150" valign="middle">Adresa e-mail: &nbsp;&nbsp;&nbsp;</td>
						<td align="left" width="300" valign="middle"><input type="text" value="" name="mail" style="width:300px;" /></td>
					</tr>
					<tr>
						<td align="right" width="150" valign="middle">Nr telefon: &nbsp;&nbsp;&nbsp;</td>
						<td align="left" width="300" valign="middle"><input type="text" value="" name="tel" style="width:300px;" /></td>
					</tr>
					<tr>
						<td align="right" width="150" valign="middle">Subiect: &nbsp;&nbsp;&nbsp;</td>
						<td align="left" width="300" valign="middle"><input type="text" value="" name="sub" style="width:300px;" /></td>
					</tr>
					<tr>
						<td align="right" width="150" valign="middle">Mesaj: &nbsp;&nbsp;&nbsp;</td>
						<td align="left" width="300" valign="middle"><textarea rows="7" name="mesaj" style="width:300px;"></textarea></td>
					</tr>
					<tr>
						<td align="right" colspan="2"><input type="submit" class="cauta" name="contact" value="Trimite !" /></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<?php
include('footer.php');
?>