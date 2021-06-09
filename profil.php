<?php
include('header.php');
if (!isset($_GET['a']) || ($_GET['a'] != "my")) {
	echo '
	<table width="692" height="450" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td width="9" height="9" background="images/anunt_11.gif"></td>
            <td background="images/anunt_12.gif"></td>
            <td width="9" height="9" background="images/anunt_14.gif"></td>
        </tr>
        <tr>
            <td width="9" background="images/anunt_19.gif">&nbsp;</td>
            <td style="padding-left:5px; padding-right:0px;" height="432" valign="top">';
}
if ($_SESSION['logat'] == "Da") {
	if ((isset($_GET['a'])) && (($_GET['a'] == "add") || ($_GET['a'] == "add2") || ($_GET['a'] == "my") || ($_GET['a'] == "edit") || ($_GET['a'] == "v") || ($_GET['a'] == "del"))) {
		//////////////////////////////////////////////////////////////////|
		///////////////// Adauga/Prelungeste Anunt Formular //////////////|
		//////////////////////////////////////////////////////////////////|
		if ($_GET['a'] == "add") {
			echo '
			<table width="600" height="400" border="0" cellspacing="0" cellpadding="0" align="center">
			';
			if (isset($_GET['id'])) {
				$cerereSQL = 'SELECT * FROM `anunt` WHERE `id`="' . $_GET['id'] . '"';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				while ($rand = mysqli_fetch_assoc($rezultat)) {
					echo '
						<form name="add" method="post" action="profil.php?a=v">
						<tr>
							<td align="left" colspan="2">';
					if (isset($_GET['ed'])) echo '<h1 style="margin-top:3px; padding-top:0px;">Formular editare anunt </h1>';
					else echo '<h1 style="margin-top:3px; padding-top:0px;">Formular Prelungire anunt </h1>';
					echo '</td>
						</tr>
						<tr>
							<td align="right">Titlu:</td>
							<td align="left"><input type="text" name="titlu" value="' . $rand['titlu'] . '" style="width:400px;" maxlength="50" /></td>
						</tr>
						<tr>
							<td align="right" valign="middle">Continut:</td>
							<td align="left">
								<textarea name="continut" style="width:400px; height:120px;" wrap="physical"
								onKeyDown="textCounter(document.add.continut,document.add.remLen1,700)"
								onKeyUp="textCounter(document.add.continut,document.add.remLen1,700)"
								onKeyPress="textCounter(document.add.continut,document.add.remLen1,700)">' . $rand['continut'] . '</textarea>
								<br>
								<input readonly type="text" name="remLen1" size="3" maxlength="3" value="700" style="border:none; height:15px; width:40px;"> caractere ramase
							</td>
						</tr>
						<tr>
							<td align="right">Nr. Telefon:</td>
							<td align="left"><input type="text" name="tel" value="' . $rand['tel'] . '" style="width:200px;" /></td>
						</tr>
						<input type="hidden" name="mail" value="' . $rand['mail'] . '" /></td>
						<tr>
							<td align="right">Produs din:</td>
							<td align="left">
								<select name="oras" style="width:202px;">
									<option selected="selected" value="' . $rand['oras'] . '" >' . $rand['oras'] . '</option>
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
								</select>
							</td>
						</tr>
						<tr>
							<td align="right">Pret:</td>
							<td align="left"><input type="text" name="pret" value="' . $rand['pret'] . '"  style="width:200px;" /></td>
						</tr>
						<tr>
							<td align="right"></td>
							<td align="left">
								<input type="radio" name="moneda" value="ron" id="lei"';
					if ($rand['moneda'] == "ron") echo 'checked';
					echo '/><label for="lei">RON</label> 
								<input type="radio" name="moneda" value="euro" id="euro"';
					if ($rand['moneda'] == "euro") echo 'checked';
					echo ' /><label for="euro">Euro</label>
                                <input type="radio" name="moneda" value="usd" id="usd"';
					if ($rand['moneda'] == "usd") echo 'checked';
					echo ' /><label for="usd">USD</label>
							</td>
						</tr>';
					if (isset($_GET['ed']))	echo '<input type="hidden" name="ce" value="ed" />';
					else echo '<input type="hidden" name="ce" value="prel" />';
					echo '<input type="hidden" name="ref" value="' . $_SERVER['HTTP_REFERER'] . '" />';
					echo '<input type="hidden" name="id" value="' . $_GET['id'] . '" />
						<input type="hidden" name="scat" value="' . $rand['subcat'] . '" />';
					$alte = explode(",", $rand['alte']);
					if ($rand['subcat'] == 'Automobile') {
						echo '
							<tr>
								<td align="right">Marca:</td>
								<td align="left">										
									<select id="marca" name="alte[]" onchange="getModeleList(this);getSerieList(this)" style="width:200px;">
												<option selected="selected" value="' . $alte[0] . '">' . $alte[0] . '</option>';
						$cerereSQL2 = 'SELECT * FROM `marca` ORDER BY `nume` ASC';
						$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
						while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
							if ($rand2['nume'] != "Alta") {
								echo '<option value="' . $rand2['nume'] . '">' . $rand2['nume'] . '</option>';
							}
						}
						echo '<option value="Alta">Alta</option>
                                	</select>
								</td>
							</tr>
							<tr>
								<td align="right">Seria:</td>
								<td align="left">
									<select id="seria" name="alte[]" style="width:200px;">
												<option value="' . $alte[1] . '" selected="selected">' . $alte[1] . '</option>
									</select>
								</td>
							</tr>
                            <tr>
								<td align="right">Modelul:</td>
								<td align="left">
									<select id="model" name="alte[]" style="width:200px;">
												<option value="' . $alte[2] . '" selected="selected">' . $alte[2] . '</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">Caroserie:</td>
								<td align="left">
									<select name="alte[]" style="width:200px;">
										<option selected="selected" value="' . $alte[3] . '">' . $alte[3] . '</option>
										<option value="berlina">berlina</option>
										<option value="pick-up">pick-up</option>
										<option value="SUV">SUV</option>
										<option value="Hatchback">hatchback</option>
										<option value="break">break</option>
										<option value="cabrio/roadster">cabrio/roadster</option>
										<option value="sport/coupe">sport/coupe</option>
										<option value="furgoneta/microbuz">furgoneta/microbuz</option>
										<option value="alta">alta</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">An fabricatie:</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[4] . '" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Carburatie:</td>
								<td align="left">
									<select name="alte[]" style="width:200px;">
										<option selected="selected" value="' . $alte[5] . '">' . $alte[5] . '</option>
										<option value="benzina">benzina</option>
										<option value="diesel">diesel</option>
										<option value="electric">electric</option>
										<option value="gaz">gaz</option>
										<option value="hibrid">hibrid</option>
										<option value="alta">alta</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">Km parcursi:</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[6] . '" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Capacitate cilindica(cc):</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[7] . '" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Cai putere:</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[8] . '" style="width:200px;" />
								</td>
							</tr>
							';
					} elseif (($rand['subcat'] == "Apartamente") || ($rand['subcat'] == "Case / Vile") || ($rand['subcat'] == "Case de lemn") || ($rand['subcat'] == "Inchirieri apartamente")) {
						echo '
							<tr>
								<td align="right">Camere:</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[0] . '" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Bai:</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[1] . '" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Suprafata(mp):</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[2] . '" style="width:200px;" />
								</td>
							</tr>
							';
					} elseif ($rand['subcat'] == "Terenuri") {
						echo '
							<tr>
								<td align="right">Suprafata:</td>
								<td align="left">
									<input type="text" name="alte[]" value="' . $alte[0] . '" style="width:200px;" />
								</td>
							</tr>
                            <tr>
								<td align="right">Tip teren:</td>
								<td align="left">
									 <select name="alte[]" style="width:200px;">
                                                    <option value="' . $alte[1] . '">' . $alte[1] . '</option>
													<option value="intravilan">Intravilan</option>
													<option value="extravilan">Extravilan</option>
                                                    <option value="agricol">Agricol</option>
									</select>
								</td>
							</tr>
							';
					} else {
						echo '';
					}
					echo '
						<tr>
							<td colspan="2" align ="center">
								<input type="checkbox" name="termeni" value="da" /> Am citit si sunt de acord cu <a href="termeni.php">Termenii si Conditiile</a>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">';
					if (isset($_GET['ed'])) echo '<input type="submit" name="add" value="Editeaza" class="cauta" />';
					else echo '<input type="submit" name="add" value="Prelungeste" class="cauta" />';
					echo '</td>
						</tr>
					';
				}
			} else {
				$cerereSQL3 = 'SELECT * FROM `users` WHERE `user`="' . $_SESSION['user'] . '"';
				$rezultat3 = mysqli_query($conexiune, $cerereSQL3);
				while ($rand3 = mysqli_fetch_assoc($rezultat3)) {
					echo '
						<form name="add" method="post" action="profil.php?a=add2">
						<tr>
							<td height="50" colspan="2" align="left">
							  <h1 style="margin:0px; padding:0px;">Formular adaugare anunt :: Pasul 1 </h1>
	  </td>
	</tr>
						<tr>
							<td height="30" align="right">Titlu:&nbsp;&nbsp;&nbsp;&nbsp;</td>
						  <td align="left"><input type="text" name="titlu" value="" style="width:400px;" maxlength="50" /></td>
						</tr>
						<tr>
							<td height="130" align="right" valign="middle">Continut:&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align="left">
								<textarea name="continut" style="width:400px; height:120px;" wrap="physical"
								onKeyDown="textCounter(document.add.continut,document.add.remLen1,700)"
								onKeyUp="textCounter(document.add.continut,document.add.remLen1,700)"
								onKeyPress="textCounter(document.add.continut,document.add.remLen1,700)"></textarea>
								<br>
								<input readonly type="text" name="remLen1" size="3" maxlength="3" value="700" style="border:none; height:15px; width:40px;"> caractere ramase
							</td>
						</tr>
						<tr>
							<td height="30" align="right">Categorie:&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align="left">
                                <select id="category" name="category" onchange="getSubCategoryList(this)" style="width:200px;">
									<option value="">Alege</option>';
					$cerereSQL2 = 'SELECT * FROM `cat` ORDER BY `nume` ASC';
					$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
					while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
						if ($rand2['nume'] != "Altele")	echo '<option value="' . $rand2['nume'] . '">' . $rand2['nume'] . '</option>';
					}
					echo '<option value="Altele">Altele</option>';
					echo ' </select>
							</td>
						</tr>
						<tr>
							<td height="30" align="right">Subcategorie:&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align="left">
                                <select id="subcategory" name="subcategory" style="width:200px;">
									<option value="">Alege</option>
								</select>
							</td>
						</tr>
						<tr>
							<td height="30" align="right">Nr. Telefon:&nbsp;&nbsp;&nbsp;&nbsp;</td>
						  <td align="left">
                          <input type="text" name="tel" value="' . $rand3['tel'] . '" style="width:200px;" /></td>
						</tr>
						<input type="hidden" name="mail" value="' . $rand3['mail'] . '" /></td>
						<tr>
							<td height="30" align="right">Produs din:&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align="left">
                                <select name="oras" style="width:200px;">
									<option selected="selected" value="' . $rand3['localitate'] . '" >' . $rand3['localitate'] . '</option>
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
								</select>
							</td>
						</tr>
						<tr>
							<td height="30" align="right">Pret:&nbsp;&nbsp;&nbsp;&nbsp;</td>
						  <td align="left">
                          <input type="text" name="pret" value="" style="width:200px;" /></td>
						</tr>	
						<tr>
							<td height="30" align="right"></td>
			  <td align="left">
                                <input type="radio" name="moneda" value="ron" id="lei" checked /><label for="lei">RON</label> 
								<input type="radio" name="moneda" value="euro" id="euro" /><label for="euro">Euro</label>
                				<input type="radio" name="moneda" value="usd" id="usd" /><label for="usd">USD</label>
							</td>
						</tr>					
						<tr>
							<td height="30" align="right"></td>
							<td height="30" align ="left">
							  <input type="submit" name="add" value="Pasul urmator" class="cauta" />
							</td>
	</tr>
					';
				}
			}
			echo '
				</form>
			</table>';
		}
		//////////////////////////////////////////////////////////////////|
		///////////////// Adauga Anunt Pas 2 /////////////////////////////|
		//////////////////////////////////////////////////////////////////|
		if ($_GET['a'] == "add2") {
			if (isset($_POST['add'])) {
				$_SESSION['titlu'] = $_POST['titlu'];
				$_SESSION['continut'] = $_POST['continut'];
				$_SESSION['cat'] = $_POST['category'];
				$_SESSION['scat'] = $_POST['subcategory'];
				$_SESSION['tel'] = $_POST['tel'];
				$_SESSION['mail'] = $_POST['mail'];
				$_SESSION['oras'] = $_POST['oras'];
				$_SESSION['pret'] = $_POST['pret'];
				$_SESSION['moneda'] = $_POST['moneda'];
				if (($_SESSION['titlu'] == '') || ($_SESSION['tel'] == '') || (!is_numeric($_SESSION['tel'])) || ($_SESSION['cat'] == '') || ($_SESSION['scat'] == '') || ($_SESSION['pret'] == '')) {
					echo '
					<table align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="9" height="9" background="images/anunt_11.gif"></td>
							<td background="images/anunt_12.gif"></td>
							<td width="9" height="9" background="images/anunt_14.gif"></td>
						</tr>
						<tr>
							<td width="9" background="images/anunt_19.gif">&nbsp;</td>
							<td style="padding-left:10px; padding-right:10px;" align="center">
							<strong>EROARE !</strong><br />';
					if ($_SESSION['titlu'] == '') echo 'Nu ati completat <strong>"Titlu"</strong> !<br />';
					if ($_SESSION['cat'] == '') echo 'Nu ati completat <strong>"Categoria"</strong> !<br />';
					if ($_SESSION['scat'] == '') echo 'Nu ati completat <strong>"Subcategoria"</strong> !<br />';
					if ($_SESSION['tel'] == '') echo 'Nu ati completat <strong>"Nr. Telefon"</strong> !<br />';
					if (!is_numeric($_SESSION['tel'])) echo 'Numarul de telefon este scris gresit !<br />';
					if ($_SESSION['pret'] == '') echo 'Nu ati completat <strong>"Pretul"</strong> !<br />';
					echo '
								<br /><input type="button" name="inapoi" value="Inapoi!" onclick="history.back();" class="cauta" />
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
					echo '
					<table width="600" border="0" cellspacing="2" cellpadding="2" align="center">
						<form name="add" method="post" action="profil.php?a=v" enctype="multipart/form-data">
						<tr>
							<td align="left" colspan="2">
								<h1>Formular adaugare anunt :: Pasul 2 </h1>
							</td>
						</tr>
						<input type="hidden" name="titlu" value="' . $_SESSION['titlu'] . '" />
						<input type="hidden" name="continut" value="' . $_SESSION['continut'] . '" />
						<input type="hidden" name="cat" value="' . $_SESSION['cat'] . '" />
						<input type="hidden" name="scat" value="' . $_SESSION['scat'] . '" />
						<input type="hidden" name="tel" value="' . $_SESSION['tel'] . '" />
						<input type="hidden" name="mail" value="' . $_SESSION['mail'] . '" />
						<input type="hidden" name="oras" value="' . $_SESSION['oras'] . '" />
						<input type="hidden" name="pret" value="' . $_SESSION['pret'] . '" />
						<input type="hidden" name="moneda" value="' . $_SESSION['moneda'] . '" />';
					if ($_POST['subcategory'] == 'Automobile') {
						echo '
							<tr>
								<td align="right">Marca:</td>
								<td align="left">
									<select id="marca" name="alte[]" onchange="getModeleList(this);getSerieList(this)" style="width:200px;">
												<option value="" selected="selected">Alege</option>';
						$cerereSQL2 = 'SELECT * FROM `marca` ORDER BY `nume` ASC';
						$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
						while ($rand2 = mysqli_fetch_assoc($rezultat2)) {
							if ($rand2['nume'] != "Alta") {
								echo '<option value="' . $rand2['nume'] . '">' . $rand2['nume'] . '</option>';
							}
						}
						echo '<option value="Alta">Alta</option>';
						echo ' </select>
								</td>
							</tr>
							<tr>
								<td align="right">Seria:</td>
								<td align="left">
									<select id="seria" name="alte[]" style="width:200px;">
												<option value="" selected="selected">Alege</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">Model:</td>
								<td align="left">
									<select id="model" name="alte[]" style="width:200px;">
												<option value="" selected="selected">Alege</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">Caroserie:</td>
								<td align="left">
									<select name="alte[]" style="width:200px;">
										<option value="berlina">berlina</option>
										<option value="pick-up">pick-up</option>
										<option value="SUV">SUV</option>
										<option value="Hatchback">hatchback</option>
										<option value="break">break</option>
										<option value="cabrio/roadster">cabrio/roadster</option>
										<option value="sport/coupe">sport/coupe</option>
										<option value="furgoneta/microbuz">furgoneta/microbuz</option>
										<option value="alta">alta</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">An fabricatie:</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Carburatie:</td>
								<td align="left">
									<select name="alte[]" style="width:200px;">
										<option value="benzina">benzina</option>
										<option value="diesel">diesel</option>
										<option value="electric">electric</option>
										<option value="gaz">gaz</option>
										<option value="hibrid">hibrid</option>
										<option value="alta">alta</option>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">Km parcursi:</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Capacitate cilindica(cc):</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Cai putere:</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							';
					} elseif (($_POST['subcategory'] == "Apartamente") || ($_POST['subcategory'] == "Case / Vile") || ($_POST['subcategory'] == "Case de lemn") || ($_POST['subcategory'] == "Inchirieri apartamente")) {
						echo '
							<tr>
								<td align="right">Camere:</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Bai:</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Suprafata(mp):</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							';
					} elseif ($_POST['subcategory'] == "Terenuri") {
						echo '
							<tr>
								<td align="right">Suprafata:</td>
								<td align="left">
									<input type="text" name="alte[]" value="" style="width:200px;" />
								</td>
							</tr>
							<tr>
								<td align="right">Tip teren:</td>
								<td align="left">
									 <select name="alte[]" style="width:202px;">
                                                    <option value="">Alege</option>
													<option value="intravilan">Intravilan</option>
													<option value="extravilan">Extravilan</option>
                                                    <option value="agricol">Agricol</option>
									</select>
								</td>
							</tr>
							';
					} else {
						echo '';
					}
					echo '
						<tr>
							<td align="right" valign="middle">Poze produs:<br />(prima poza reprezentativa)</td>
							<td align="left">
								<input type="file" name="poze[]" /><br />
								<input type="file" name="poze[]" /><br />
								<input type="file" name="poze[]" /><br />
								<input type="file" name="poze[]" /><br />
								<input type="file" name="poze[]" />
							</td>
						</tr>
						<input type="hidden" name="ce" value="add" />
						<tr>
							<td colspan="2" align ="center">
								<input type="checkbox" name="termeni" value="da" /> Am citit si sunt de acord cu <a href="termeni.php">Termenii si Conditiile</a>
							</td>
						</tr>
						<tr>
							<td colspan="2" align ="center">
								<input type="submit" name="add" value="Adauga" class="cauta" />
							</td>
						</tr>
						</form>
					</table>
				  ';
				}
			}
		}
		//////////////////////////////////////////////////////////////////|
		///////////////// Verifica Anunt /////////////////////////////////|
		//////////////////////////////////////////////////////////////////|
		elseif ($_GET['a'] == "v") {
			if (isset($_POST['add'])) {
				$cerereCFG = 'SELECT * FROM `config` WHERE `id`="1"';
				$rezultat = mysqli_query($conexiune, $cerereCFG);
				while ($config = mysqli_fetch_assoc($rezultat)) {
					$_SESSION['sms'] = $config['sms'];
					$_SESSION['durata'] = $config['durata'];
				}
				$_SESSION['titlu'] = $_POST['titlu'];
				$_SESSION['continut'] = $_POST['continut'];
				$_SESSION['tel'] = $_POST['tel'];
				$_SESSION['mail'] = $_POST['mail'];
				$_SESSION['oras'] = $_POST['oras'];
				$_SESSION['pret'] = $_POST['pret'];
				$_SESSION['scat'] = $_POST['scat'];
				$_SESSION['moneda'] = $_POST['moneda'];
				if ($_SESSION['scat'] == "Automobile") {
					$_SESSION['alte'] = $_POST['alte'][0] . ',' . $_POST['alte'][1] . ',' . $_POST['alte'][2] . ',' . $_POST['alte'][3] . ',' . $_POST['alte'][4] . ',' . $_POST['alte'][5] . ',' . $_POST['alte'][6] . ',' . $_POST['alte'][7] . ',' . $_POST['alte'][8];
				} elseif (($_SESSION['scat'] == "Apartamente") || ($_SESSION['scat'] == "Case / Vile") || ($_SESSION['scat'] == "Case de lemn") || ($_SESSION['scat'] == "Inchirieri apartamente")) {
					$_SESSION['alte'] = $_POST['alte'][0] . ',' . $_POST['alte'][1] . ',' . $_POST['alte'][2];
				} elseif ($_SESSION['scat'] == "Terenuri") {
					$_SESSION['alte'] = $_POST['alte'][0] . ',' . $_POST['alte'][1];
				} else {
					$_SESSION['alte'] = '';
				}
				if (($_POST['ce'] == "prel") || ($_POST['ce'] == "ed")) {
					$_SESSION['id'] = $_POST['id'];
					$_SESSION['ref'] = $_POST['ref'];
					if (($_SESSION['titlu'] == '') || ($_SESSION['tel'] == '') || (!is_numeric($_SESSION['tel'])) || ($_SESSION['id'] == '') || (!is_numeric($_SESSION['id'])) || ($_SESSION['pret'] == '') || (!isset($_POST['termeni']))) {
						echo '
						<table align="center" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="9" height="9" background="images/anunt_11.gif"></td>
								<td background="images/anunt_12.gif"></td>
								<td width="9" height="9" background="images/anunt_14.gif"></td>
							</tr>
							<tr>
								<td width="9" background="images/anunt_19.gif">&nbsp;</td>
								<td style="padding-left:10px; padding-right:10px;" align="center">
								<strong>EROARE !</strong><br />';
						if (($_SESSION['id'] == '') || (!is_numeric($_SESSION['id']))) echo '<strong>Eroare server!</strong>';
						if ($_SESSION['titlu'] == '') echo 'Nu ati completat <strong>"Titlu"</strong> !<br />';
						if ($_SESSION['tel'] == '') echo 'Nu ati completat <strong>"Nr. Telefon"</strong> !<br />';
						if (!is_numeric($_SESSION['tel'])) echo 'Numarul de telefon este scris gresit !<br />';
						if ($_SESSION['pret'] == '') echo 'Nu ati completat <strong>"Pretul"</strong> !<br />';
						if (!isset($_POST['termeni'])) echo 'Trebuie sa fiti de acord cu Termenii si conditiile pentru a posta anunturi !<br />';
						echo '
								<input type="button" name="inapoi" value="Inapoi!" onclick="history.back();" class="cauta" />
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
						if ($_POST['ce'] == "prel") {
							$cerereID = 'SELECT * FROM `anunt` ORDER BY `id` DESC LIMIT 1';
							$rezultatID = mysqli_query($conexiune, $cerereID);
							while ($rid = mysqli_fetch_assoc($rezultatID)) {
								$id = $rid['id'];
							}
							$id = $id + 1;
							$data2 = date("G\/i\/s\/m\/d\/Y");
							$cerereSQL = 'UPDATE  `anunt` SET
									`id` = "' . $id . '",
									`titlu` =  "' . htmlspecialchars($_SESSION['titlu'], ENT_QUOTES) . '",
									`continut` =  "' . htmlspecialchars($_SESSION['continut'], ENT_QUOTES) . '",
									`tel` =  "' . $_SESSION['tel'] . '",
									`oras` =  "' . $_SESSION['oras'] . '",
									`pret` =  "' . $_SESSION['pret'] . '",
									`moneda` =  "' . $_SESSION['moneda'] . '",
									`data` =  "' . $data2 . '" WHERE  `anunt`.`id` =' . $_SESSION['id'] . ' LIMIT 1';
							mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");

							echo '<script>alert("Felicitari!\nAnuntul a fost prelungit cu ' . $_SESSION['durata'] . ' zile!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' . $_SESSION['ref'] . '">';
						} else {
							$cerereSQL = 'UPDATE  `anunt` SET
									`titlu` =  "' . htmlspecialchars($_SESSION['titlu'], ENT_QUOTES) . '",
									`continut` =  "' . htmlspecialchars($_SESSION['continut'], ENT_QUOTES) . '",
									`tel` =  "' . $_SESSION['tel'] . '",
									`oras` =  "' . $_SESSION['oras'] . '",
									`pret` =  "' . $_SESSION['pret'] . '",
									`moneda` =  "' . $_SESSION['moneda'] . '" WHERE  `anunt`.`id` =' . $_SESSION['id'] . ' LIMIT 1';
							mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");

							echo '<script>alert("Felicitari!\nAnuntul a fost editat!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' . $_SESSION['ref'] . '">';
						}

						$_SESSION['titlu'] = '';
						$_SESSION['continut'] = '';
						$_SESSION['tel'] = '';
						$_SESSION['mail'] = '';
						$_SESSION['oras'] = '';
						$_SESSION['pret'] = '';
						$_SESSION['term'] = '';
						$_SESSION['scat'] = '';
						$_SESSION['moneda'] = '';
						$_SESSION['id'] = '';
						$_SESSION['alte'] = '';
						$_SESSION['ref'] = '';
					}
				} elseif ($_POST['ce'] == "add") {
					$_SESSION['cat'] = $_POST['cat'];
					$_SESSION['subcat'] = $_POST['scat'];

					$ok = 1;
					$ok2 = 1;
					while (list($key, $value) = altEach($_FILES["poze"]["name"])) {
						if (!empty($value)) {
							if (($_FILES["poze"]["type"][$key] != "image/jpeg") && ($_FILES["poze"]["type"][$key] != "image/pjpeg") && ($_FILES["poze"]["type"][$key] != "image/jpg")) {
								$ok = 0;
							}
							if ($_FILES["poze"]["size"][$key] > 5242880) {
								$ok2 = 0;
							}
						}
					}
					if (($_SESSION['titlu'] == '') || ($_SESSION['tel'] == '') || (!is_numeric($_SESSION['tel'])) || ($_SESSION['cat'] == '') || ($_SESSION['subcat'] == '') || ($_SESSION['pret'] == '') || (!isset($_POST['termeni'])) || ($ok == 0) || ($ok2 == 0)) {

						echo '
						<table align="center" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="9" height="9" background="images/anunt_11.gif"></td>
								<td background="images/anunt_12.gif"></td>
								<td width="9" height="9" background="images/anunt_14.gif"></td>
							</tr>
							<tr>
								<td width="9" background="images/anunt_19.gif">&nbsp;</td>
								<td style="padding-left:10px; padding-right:10px;" align="center">
								<strong>EROARE !</strong><br />';
						if ($_SESSION['titlu'] == '') echo 'Nu ati completat <strong>"Titlu"</strong> !<br />';
						if ($_SESSION['cat'] == '') echo 'Nu ati completat <strong>"Categoria"</strong> !<br />';
						if ($_SESSION['subcat'] == '') echo 'Nu ati completat <strong>"Subcategoria"</strong> !<br />';
						if ($_SESSION['tel'] == '') echo 'Nu ati completat <strong>"Nr. Telefon"</strong> !<br />';
						if (!is_numeric($_SESSION['tel'])) echo 'Numarul de telefon este scris gresit !<br />';
						if ($_SESSION['pret'] == '') echo 'Nu ati completat <strong>"Pretul"</strong> !<br />';
						if ($ok == 0) echo 'Imaginile trebuie sa fie <strong>JPEG</strong> sau <strong>JPG</strong> !<br />';
						if ($ok2 == 0) echo 'Imagine prea mare. Dimensiune maxima <strong>5 Mb</strong> !';
						if (!isset($_POST['termeni'])) echo 'Trebuie sa fiti de acord cu Termenii si conditiile pentru a posta anunturi !<br />';
						echo '
							<input type="button" name="inapoi" value="Inapoi!" onclick="history.back();" class="cauta" />
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
						$data = date("jny");
						$data2 = date("G\/i\/s\/m\/d\/Y");
						include("watermark.class.php");
						foreach ($_FILES["poze"]["tmp_name"] as $key => $tmp_name) {
							if (!empty($tmp_name)) {
								$uploadpath = "anunturi/";
								$filex = crc32($_SESSION['titlu']);
								$filex = $filex * $filex;
								$filex = sqrt($filex);
								$filex = mb_strimwidth($filex, 0, 10, "");
								$filex = $filex . '_' . rand() . '_' . $key . '.jpg';
								$uploadpath = $uploadpath . '' . basename($filex);
								if (move_uploaded_file($tmp_name, $uploadpath)) {
									$image_name = "anunturi/" . $filex;
									$nume_nou = $filex;
									list($width, $height) = getimagesize($image_name);

									if ($width > 800) {
										$image_r = new SimpleImage();
										$image_r->load($image_name);
										$image_r->resizeToWidth(800);
										$image_r->save($image_name);
										list($width, $height) = getimagesize($image_name);
									}
									if ($height > 600) {
										$image_r = new SimpleImage();
										$image_r->load($image_name);
										$image_r->resizeToHeight(600);
										$image_r->save($image_name);
										list($width, $height) = getimagesize($image_name);
									}

									$new_image_name = "anunturi/thumb_" . $filex;
									$ratio = ($width / 100);
									$ratio2 = ($height / 100);
									if (($height / $ratio) <= 100) {
										$new_width = 100;
										$new_height = ($height / $ratio);
									} else {
										$new_height = 100;
										$new_width = ($width / $ratio2);
									}
									$image_p = imagecreatetruecolor($new_width, $new_height);
									$image = imagecreatefromjpeg($image_name);
									imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
									imagejpeg($image_p, $new_image_name, 100);

									$img = new watermark($image_name);
									$img->ApplyWatermark("images/watermark.gif");
									$img->SaveAsFile($image_name);
									$img->Free();

									$poze[$key] = $nume_nou;
								} else die("Eroare la incarcarea imaginii!");
							} else {
								$poze[$key] = '';
							}
						}

						$poze2 = $poze[0] . ',' . $poze[1] . ',' . $poze[2] . ',' . $poze[3] . ',' . $poze[4];

						$cerereSQL = "INSERT INTO `anunt` ( `cat`, `subcat`, `titlu`, `continut`, `tel`, `mail`, `poze`, `data`, `user`, `oras`, `pret`, `moneda`, `alte`) 
												VALUES ( '" . $_SESSION['cat'] . "',
														 '" . $_SESSION['subcat'] . "',
														 '" . htmlspecialchars($_SESSION['titlu'], ENT_QUOTES) . "', 
														 '" . htmlspecialchars($_SESSION['continut'], ENT_QUOTES) . "',
														 '" . $_SESSION['tel'] . "',
														 '" . $_SESSION['mail'] . "',
														 '" . $poze2 . "',
														 '" . $data2 . "',
														 '" . $_SESSION['user'] . "',
														 '" . $_SESSION['oras'] . "',
														 '" . htmlentities($_SESSION['pret'], ENT_QUOTES) . "',
														 '" . $_SESSION['moneda'] . "',
														 '" . htmlspecialchars($_SESSION['alte'], ENT_QUOTES) . "')";
						mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");
						echo '<script>alert("Felicitari!\nAnuntul a fost adaugat cu succes!");</script>';
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=profil.php?a=my">';

						$_SESSION['titlu'] = '';
						$_SESSION['continut'] = '';
						$_SESSION['tel'] = '';
						$_SESSION['mail'] = '';
						$_SESSION['oras'] = '';
						$_SESSION['cat'] = '';
						$_SESSION['subcat'] = '';
						$_SESSION['scat'] = '';
						$_SESSION['pret'] = '';
						$_SESSION['moneda'] = '';
						$_SESSION['term'] = '';
						$_SESSION['alte'] = '';
					}
				}
			}
		}
		//////////////////////////////////////////////////////////////////|
		///////////////// Anunturile mele ////////////////////////////////|
		//////////////////////////////////////////////////////////////////|
		elseif ($_GET['a'] == "my") {
			$cerereSQL = 'SELECT * FROM `anunt` WHERE `user`="' . $_SESSION['user'] . '" ORDER BY `id` DESC';
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			echo '<table width="941" cellspacing="4">
			<tr><td><h1 align="center">Anunturile mele</h1><br /></td></tr>
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
						<table width="930" height="68" align="center" cellpadding="2" cellspacing="2" style="border-bottom: solid 1px #93A6CA; border-top: solid 1px #E2E2E2; border-left: solid 3px #42455e; background-color:' . $bgr . ';">
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
		}
		//////////////////////////////////////////////////////////////////|
		///////////////// Date profil ////////////////////////////////////|
		//////////////////////////////////////////////////////////////////|
		elseif ($_GET['a'] == "edit") {
			echo '
						<table width="600" align="center" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="9" height="12"></td>
								<td colspan="2"></td>
								<td width="9" height="12"></td>
							</tr>
							<tr>
								<td width="9">&nbsp;</td>
								<td style="padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom:5px; width:291px;" align="center" class="left">
									<a href="profil.php?a=edit&b=pers"><img src="images/anunt_login.gif" width="15" height="15" align="top" alt="IasiOcazii - Date personale" /> Editeaza date personale</a>
								</td>
								<td style="padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom:5px; width:291px;" align="center" class="left">
                                	<a href="profil.php?a=edit&b=pass"><img src="images/anunt_facont.gif" width="15" height="15" align="top" alt="IasiOcazii - Schimba parola" /> Schimba parola</a>
                                </td>
								<td width="9">&nbsp;</td>
							</tr>
							<tr>
								<td width="9" height="9"></td>
								<td colspan="2"></td>
								<td width="9" height="9"></td>
							</tr>
                            <tr>
                            	<td colspan="3" height="40">&nbsp;</td>
                            </tr>
						</table>
			';
			if (isset($_GET['b']) && ($_GET['b'] == "pers")) {
				if (isset($_POST['modd'])) {
					$_SESSION['nume'] = $_POST['nume'];
					$_SESSION['tel'] = $_POST['tel'];
					$_SESSION['mail'] = $_POST['mail'];
					if (($_SESSION['nume'] == '') || ($_SESSION['tel'] == '') || (!is_numeric($_SESSION['tel'])) || ($_SESSION['mail'] == '')) {
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
						if ($_SESSION['nume'] == '') echo 'Nu ati completat campul <strong>"Nume"</strong> !<br />';
						if ($_SESSION['tel'] == '') echo 'Nu ati completat campul <strong>"Telefon"</strong> !<br />';
						if (!is_numeric($_SESSION['tel'])) echo 'Numarul de telefon este scris gresit !<br />';
						if ($_SESSION['mail'] == '') echo 'Nu ati completat campul <strong>"Mail"</strong> !<br />';
						echo '</td>
								<td width="9" background="images/anunt_21.gif">&nbsp;</td>
							</tr>
							<tr>
								<td width="9" height="9" background="images/anunt_27.gif"></td>
								<td background="images/anunt_28.gif"></td>
								<td width="9" height="9" background="images/anunt_29.gif"></td>
							</tr>
							<tr>
								<td colspan="3" height="40">&nbsp;</td>
							</tr>
						</table>
						';
					} else {
						$cerereSQL = 'UPDATE `users` SET `nume`="' . $_SESSION['nume'] . '", `tel`="' . $_SESSION['tel'] . '", `mail`="' . $_SESSION['mail'] . '" WHERE `user`="' . $_SESSION['user'] . '"';
						mysqli_query($conexiune, $cerereSQL);

						echo '<br /><center><font color="darkgreen"><b>Datele personale au fost modificate !</b></font></center><br />';
						$_SESSION['nume'] = '';
						$_SESSION['tel'] = '';
						$_SESSION['mail'] = '';
					}
				}
				$cerereSQL = 'SELECT * FROM `users` WHERE `user`="' . $_SESSION['user'] . '"';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				while ($rand = mysqli_fetch_assoc($rezultat)) {
					echo '
						<h2 align="center">Formular modificare date personale</h2><br />
						<table width="600" align="center" border="0" cellspacing="0" cellpadding="0">
						<form action="" method="post">
						<tr>
							<td width="225" height="19" valign="top">&nbsp;</td>
							<td width="15" rowspan="5" valign="top"></td>
							<td colspan="2" valign="top">&nbsp;</td>
						  </tr>
						<tr>
							<td height="22" align="right" valign="top">Nume:</td>
							<td colspan="2" valign="top">
								<input type="text" name="nume" value="' . $rand['nume'] . '">							</td>
						</tr>
						<tr>
							<td height="7"></td>
							<td width="144"></td>
							<td></td>
						</tr>
						<tr>
							<td height="22" align="right" valign="top">Telefon:</td>
							<td colspan="2" valign="top"><input type="text" name="tel" value="' . $rand['tel'] . '"></td>
						</tr>
						<tr>
							<td height="7"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td height="22" align="right" valign="top">Mail:</td>
							<td valign="top"></td>
							<td colspan="2" valign="top"><input type="text" name="mail" value="' . $rand['mail'] . '" /></td>
						</tr>
						<tr>
							<td height="15"></td>
							<td valign="top"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td height="24">&nbsp;</td>
							<td valign="top"></td>
							<td colspan="2" valign="top"><input name="modd" type="submit" id="Trimite" value="Modifica" class="cauta" /></td>
						</tr>
						<tr>
							<td height="24">&nbsp;</td>
							<td valign="top"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						</form>
						</table>
					';
				}
			} elseif (isset($_GET['b']) && ($_GET['b'] == "pass")) {
				if (isset($_POST['modd'])) {
					$_SESSION['pass'] = $_POST['pass'];
					$_SESSION['pass2'] = $_POST['pass2'];
					if (($_SESSION['pass'] == '') || ($_SESSION['pass'] != $_SESSION['pass2'])) {
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
						if ($_SESSION['pass'] == '') echo 'Nu ati completat campul <strong>"Noua parola"</strong> !<br />';
						if ($_SESSION['pass'] != $_SESSION['pass2']) echo 'Parolele nu corespund !<br />';
						echo '</td>
								<td width="9" background="images/anunt_21.gif">&nbsp;</td>
							</tr>
							<tr>
								<td width="9" height="9" background="images/anunt_27.gif"></td>
								<td background="images/anunt_28.gif"></td>
								<td width="9" height="9" background="images/anunt_29.gif"></td>
							</tr>
							<tr>
								<td colspan="3" height="40">&nbsp;</td>
							</tr>
						</table>
						';
					} else {
						$cerereSQL = "UPDATE `users` SET `pass`='" . md5($_SESSION['pass']) . "' WHERE `user`='" . $_SESSION['user'] . "'";
						mysqli_query($conexiune, $cerereSQL);

						echo '<br /><center><font color="darkgreen"><b>Parola a fost schimbata !</b></font></center><br />';
						$_SESSION['pass'] = '';
						$_SESSION['pass2'] = '';
						echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=logout.php">';
					}
				}
				echo '
						<h2 align="center">Formular schimbare parola</h2><br />
						<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
						<form action="" method="post">
						<tr>
							<td width="225" height="19" valign="top">&nbsp;</td>
							<td width="15" rowspan="5" valign="top"></td>
							<td colspan="2" valign="top">&nbsp;</td>
						  </tr>
						<tr>
							<td height="22" align="right" valign="top">Noua parola:</td>
							<td colspan="2" valign="top">
								<input type="password" name="pass" value="">							</td>
						</tr>
						<tr>
							<td height="7"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td height="22" align="right" valign="top">Verificare parola:</td>
							<td colspan="2" valign="top">
								<input type="password" name="pass2" value="">							</td>
						</tr>
						<tr>
							<td height="15"></td>
							<td height="15"></td>
							<td></td>
						</tr>
						<tr>
							<td height="24">&nbsp;</td>
							<td valign="top"></td>
							<td colspan="2" valign="top"><input name="modd" type="submit" id="Trimite" value="Schimba" class="cauta" /></td>
						</tr>
						<tr>
							<td height="24">&nbsp;</td>
							<td valign="top"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						</form>
						</table>
					';
			} else {
				echo '';
			}
		} elseif ($_GET['a'] == "del") {
			if (isset($_GET['id'])) {
				$cerereSQL = 'SELECT * FROM `anunt` WHERE `id`="' . $_GET['id'] . '"';
				$rezultat = mysqli_query($conexiune, $cerereSQL);
				if (mysqli_num_rows($rezultat) == 0) {
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=profil.php?a=my">';
				} else {
					while ($rand = mysqli_fetch_assoc($rezultat)) {
						if (($_SESSION['user'] == $rand['user']) || ($_SESSION['acces'] = '3')) {
							$poze = explode(',', $rand['poze']);
							foreach ($poze as $poza) {
								if ($poza != '') {
									if (file_exists('anunturi/' . $poza)) {
										@unlink('anunturi/' . $poza);
									}
									if (file_exists('anunturi/thumb_' . $poza)) {
										@unlink('anunturi/thumb_' . $poza);
									}
								}
							}
							$cerereSQL2 = "DELETE FROM `anunt` WHERE `id`='" . htmlentities($_GET['id'], ENT_QUOTES) . "'";
							$rezultat2 = mysqli_query($conexiune, $cerereSQL2);
							echo '<script>alert("Anuntul a fost sters din baza noastra de date cu succes!");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=profil.php?a=my">';
						} else {
							echo '<script>alert("Ne pare rau!\nNu aveti dreptul de a sterge acest anunt !");</script>';
							echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=profil.php?a=my">';
						}
					}
				}
			} else {
				echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=profil.php?a=my">';
			}
		} else {
			echo '';
		}
	} else {
		echo '
		<table width="150" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td width="9" height="9" background="images/anunt_11.gif"></td>
				<td background="images/anunt_12.gif"></td>
				<td width="9" height="9" background="images/anunt_14.gif"></td>
			</tr>
			<tr>
				<td width="9" background="images/anunt_19.gif">&nbsp;</td>
				<td style="padding-left:10px; padding-right:10px;" align="center" class="left">
					<a href="?a=add">Adauga Anunt</a><br />
					<a href="?a=my">Anunturile mele</a><br />
					<a href="?a=edit">Editeaza profil</a><br />
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
	}
} else {
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=login.php">';
}
if (!isset($_GET['a']) || ($_GET['a'] != "my")) {
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
}
include('footer.php');
