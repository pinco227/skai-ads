<?php
include('header.php');
?>

<table width="941" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="941" style="padding-left:50px; padding-right:50px;">
      <h2 align="center">AJUTOR  SKAI.RO</h2>
      <h4>Siguranta online</h4>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">Atentie !<br />
        <br />
        - Nu trimiteti sume de bani anticipat persoanelor necunoscute, bazate doar pe o simpla intelegere de genul costuri de transport, avans etc !<br />
        - Nu trimiteti copii de pe acte de proprietate&nbsp;sau personale ! acestea pot fi folosite pentru fraudarea identitatii sau proprietatii !<br />
        - Nu luati in considerare eventualele mesaje in care sunteti desemnat castigator al vreunui concurs organizat de SKAI.RO !<br />
        - Nu luati in considerare eventualele mesaje in care SKAI.RO este numit ca intermediant in vanzarea unor produse/servicii ! Noi nu ne-am implicat ca intermediari si n-o vom face niciodata !
      </p>
      <h4>Cum ma inregistrez ?</h4>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">Pentru a va inregistra accesati sectiunea <a href="register.php">Inregistrare </a>in cadrul careia completati formularul. <br />
        Va rugam sa completati datele dvs. cu adresa de mail valida pentru a putea recupera parola in cazul in care ati uitat-o. </p>
      <h4>Cum utilizez serviciul SKAI.RO ?</h4>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">Dupa ce v-ati inregistrat, accesati sectiunea <a href="login.php">Login</a>.<br />
        Introduceti username-ul si parola aleasa la inregistrare.</p>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">Odata logat veti putea sa : <br />
        - modificati datele dvs. de inregistrare si sa schimbati parola la sectiunea <a href="profil.php?a=edit">Contul meu</a> <br />
        - adaugati anunturi la sectiunea <a href="profil.php?a=add">Adauga anunt</a> in cadrul careia completati formularul atasat <span style="color:#CC0000;"><strong>si nu uitati : O POZA FACE CAT O MIE DE CUVINTE</strong>.</span><br />
        - gestionati (vedeti, stergeti, editati sau prelungiti) anunturile la sectiunea <a href="profil.php?a=my">Anunturile mele</a>. Anunturile expirate <strong>nu</strong> vor fi sterse imediat!</p>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">Anuntul va fi valabil <?php echo $durata; ?> zile din momentul adaugarii sau prelungirii (editarii) lui.</p>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">Daca ati uitat username-ul sau parola, acestea se pot recupera accesand <a href="login.php?lost">Mi-am uitat datele</a> din sectiunea <a href="login.php">Login</a> doar cu adresa de e-mail de la inregistrare.</p>
      <h4>Publicitate</h4>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">- daca doriti sa plasati o reclama pe site-ul nostru va rugam sa accesati sectiunea <a href="contact.php?publicitate">Publicitate</a> !</p>
      <h4>Contact</h4>
      <p style="padding-left:20px; font-size:13px; line-height:17px;" align="justify">- pentru sugestii, reclamatii, eventuale nelamuriri va rugam sa accesati sectiunea <a href="contact.php">Contact</a> !</p>
      <br /><br />
    </td>
  </tr>
</table>
<?php
include('footer.php');
?>