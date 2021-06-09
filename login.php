<?php
include('header.php');

if (!isset($_SESSION['logat'])) $_SESSION['logat'] = 'Nu';
if ($_SESSION['logat'] == "Da") {
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=index.php">';
} else {
	if (isset($_GET['lost'])) {
		if ((isset($_POST['user'])) || (isset($_POST['parola']))) {
			if (isset($_POST['user'])) {
				$cerereSQL = "SELECT * FROM `users` WHERE `mail`='" . htmlentities($_POST['mail']) . "'";
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				if (mysqli_num_rows($rezultat) == 1) {
					while ($rand = mysqli_fetch_assoc($rezultat)) {
						$catre = $rand['mail'];
						$data_trimitere = date('d-m-Y H:i:s');
						$subiect = 'Recuperare Username SKAI.RO';
						$mesaj = '
						<html>
						<head>
						<title>Recuperare Username SKAI.RO</title>
						</head>
						<body>
						Data trimiterii : ' . $data_trimitere . ' <br /><br />
						Username : <b>' . $rand['user'] . '</b> <br /><br />
						<a href="http://www.skai.ro/login.php">Click aici pentru logare!</a><br /><br />
						Sau introduceti in adresa: http://www.skai.ro/login.php
						</body></html>';
						$headere = "MIME-Version: 1.0\r\n";
						$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headere .= "From: recuperare@skai.ro <SKAI.RO>\r\n";

						// mail($catre, $subiect, $mesaj, $headere);
						echo '<script>alert("Username-ul a fost trimis la adresa de e-mail: ' . $_POST['mail'] . '\n\nVerificati si folderul Spam!");</script>';
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=login.php">';
					}
				} else {
					echo '<script>alert("Ne pare rau! \nAdresa de email nu exista in baza de date!");</script>';
				}
			} else {
				$cerereSQL = "SELECT * FROM `users` WHERE `mail`='" . htmlentities($_POST['mail']) . "'";
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				if (mysqli_num_rows($rezultat) == 1) {
					while ($rand = mysqli_fetch_assoc($rezultat)) {
						$chars = "abcdefghijkmnopqrstuvwxyz023456789";
						srand((float)microtime() * 1000000);
						$i = 0;
						$pass = '';

						while ($i <= 7) {
							$num = rand() % 33;
							$tmp = substr($chars, $num, 1);
							$pass = $pass . $tmp;
							$i++;
						}
						$cerereSQL = "UPDATE `users` SET `pass`='" . md5($pass) . "' WHERE `id`='" . $rand['id'] . "'";
						mysqli_query($conexiune, $cerereSQL) or die("<script>alert('Ne pare rau! \nParola nu a putut fi recuperata!');</script>");
						$catre = $rand['mail'];
						$data_trimitere = date('d-m-Y H:i:s');
						$subiect = 'Recuperare Parola SKAI.RO';
						$mesaj = '
						<html>
						<head>
						<title>Recuperare Parola SKAI.RO</title>
						</head>
						<body>
						Data trimiterii : ' . $data_trimitere . ' <br /><br />
						Username : <b>' . $rand['user'] . '</b> <br /><br />
						Noua Parola : <b>' . $pass . '</b> <br /><br />
						<a href="http://www.skai.ro/login.php">Click aici pentru logare!</a><br /><br />
						Sau introduceti in adresa: http://www.skai.ro/login.php<br /><br />
						Nu uita sa-ti schimbi parola din sectiunea <b>Contul meu</b>
						</body></html>';
						$headere = "MIME-Version: 1.0\r\n";
						$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headere .= "From: recuperare@skai.ro <SKAI.RO>\r\n";

						// mail($catre, $subiect, $mesaj, $headere);
						echo '<script>alert("Parola a fost trimisa la adresa de e-mail: ' . $_POST['mail'] . '\n\nVerificati si folderul Spam!");</script>';
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=login.php">';
					}
				} else {
					echo '<script>alert("Ne pare rau! \nAdresa de email nu exista in baza de date!");</script>';
				}
			}
		}
		echo '
					<table width="692" height="450" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="9" height="9" background="images/anunt_11.gif"></td>
							<td height="9" background="images/anunt_12.gif"></td>
							<td width="9" height="9" background="images/anunt_14.gif"></td>
						</tr>
						<tr>
							<td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  	<td align="center">
							  <table width="654" align="center" border="0" cellspacing="4" cellpadding="4">
								<tr>
								  <td height="36" colspan="3" align="center"><h1>Recuperarea datelor de login</h1>
							      <br /><br /><br /></td>
								</tr>
								<tr>
								  	<td width="317" align="left" valign="top">
                                    	<form name="user" method="post" action="login.php?lost" style="width:300px; margin:0px;">
										<table align="left" cellspacing="5">
                                        	<tr>
                                            	<td width="300" align="left" valign="top">
                                                	<h3 style="margin-top:3px; padding-top:3px;">Mi-am uitat username-ul !</h3>
                                                    <p style="line-height: 30px;">Adresa de e-mail:<br />
                                                    <input type="text" name="mail" style="width:270px;" />
													</p>
                                              	</td>
                                            </tr>
                                            <tr>
                                            	<td align="left" valign="bottom" height="30">
                                                	<input type="submit" name="user" value="Recupereaza username" class="cauta" />
                                                    </td>
                                                </td>
                                            </tr>
                                    	</table>
                                        </form>
                                    </td>
									<td width="20" style="background:url(images/anunt_21.gif); background-position:center; background-repeat:repeat-y;"></td>
								  	<td width="317" align="right" valign="top">
                                    	<form name="parola" method="post" action="login.php?lost" style="width:300px; margin:0px;">
										<table align="right" cellspacing="5">
                                        	<tr>
                                            	<td width="300" align="right" valign="top">
                                                	<h3 style="margin-top:3px; padding-top:3px;">Mi-am uitat parola !</h3>
                                                    <p style="line-height: 30px;">Adresa de e-mail:<br />
                                                    <input type="text" name="mail" style="width:270px;" />
													</p>
                                              </td>
                                            </tr>
                                            <tr>
                                            	<td align="right" valign="bottom" height="30">
                                                	<input type="submit" name="parola" value="Recupereaza parola" class="cauta" />
                                                </td>
                                            </tr>
                                    	</table>
                                        </form>
                                    </td>
								</tr>
							  </table>
							  <br />
							  <br />
							  <br />
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
	} else {
		if (isset($_POST['login'])) {
			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$pass = md5($pass);
			$_SESSION['username'] = $user;

			$cerereSQL = "SELECT * FROM `users` WHERE `user`='" . htmlentities($user) . "' AND `pass`='" . $pass . "'";
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			if (mysqli_num_rows($rezultat) == 1) {
				while ($rand = mysqli_fetch_assoc($rezultat)) {
					$_SESSION['logat'] = 'Da';
					$_SESSION['user'] = $user;
					$_SESSION['acces'] = $rand['acces'];
					if (isset($_SERVER['HTTP_REFERER'])) {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' . $_SERVER['HTTP_REFERER'] . '">';
					} else {
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=index.php">';
					}
				}
			} else {
				echo '<br><center><font color="red"><b>Userul si parola nu corespund ! Incercati din nou !</b></font></center>';
			}
		} else {
			echo '
				<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
					<table width="692" height="450" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="9" height="9" background="images/anunt_11.gif"></td>
							<td height="9" background="images/anunt_12.gif"></td>
							<td width="9" height="9" background="images/anunt_14.gif"></td>
						</tr>
						<tr>
							<td width="9" background="images/anunt_19.gif">&nbsp;</td>
						  <td align="center">
							  <table width="654" align="center" border="0" cellspacing="4" cellpadding="4">
								<tr>
								  <td height="36" colspan="3" align="center"><h1>Formular Autentificare</h1><br /><br /></td>
								</tr>
								<tr>
									<td width="367" valign="bottom" align="left">
										Nume Utilizator:<br />
										<input type="text" name="user" style="width:200px;" /><br /><br />
										Parola:<br />
										<input type="password" name="pass" style="width:200px;" /><br /><br />									</td>
									<td width="20" rowspan="2" style="background:url(images/anunt_21.gif); background-position:left; background-repeat:repeat-y;"></td>
									<td width="267" align="left">
										<h3 style="margin-top:3px; padding-top:3px;">Nu ai cont?</h3>
									  Creaza-ti acum unul!<br />
									  <ul type="circle" style="list-style-type:disc; text-indent: 0px;">
										<li>Poti adauga anunturi</li>
										<li>Iti poti gestiona anunturile</li>
										<li>Iti poti administra datele personale</li>
									  </ul>									</td>
								</tr>
								<tr>
								  <td align="left"><input type="submit" name="login" value="" class="login" /></td>
								  <td align="left"><a href="register.php"><img src="images/anunt_42.gif" width="163" height="27" alt="Inregistreaza-te!" /></a></td>
								</tr>
								<tr>
								  <td colspan="3" height="9" style="background:url(images/anunt_12.gif); background-position:top; background-repeat:repeat-x;"></td>
							    </tr>
                                <tr>
								  <td colspan="3" align="center">
                                  	<h3 align="center" style="margin-top:0px;">Ti-ai uitat username-ul sau parola ?</h3>
                                  	<a href="login.php?lost"><font color="#3366CC">Click AICI pentru a le recupera !</font></a>
                                  </td>
							    </tr>
							  </table>
							  <br />
							  <br />
							  <br />
                            </td>
							<td width="9" background="images/anunt_21.gif">&nbsp;</td>
						</tr>
						<tr>
							<td width="9" height="9" background="images/anunt_27.gif"></td>
							<td background="images/anunt_28.gif"></td>
							<td width="9" height="9" background="images/anunt_29.gif"></td>
						</tr>
					</table>
				</form>
			';
		}
	}
}
include('footer.php');
