<?

//plik definicji bazy
include_once("baza.inc");
setlocale(LC_ALL, 'pl_PL');

//funkcja pokauj¹ca formularz logowania
function formularz_logowania_html($komunikat)
{
echo "<br>
<br>
<form action=index.php method=post name=logowanko>";
echo "<table border=0 class=logowanie align=center>";
echo "<tr><th colspan=2 class=logowanie>$komunikat</th></tr>";
echo "<tr><td>U¿ytkownik</td><td><input type=text name=user size=20 class=logowanie></td></tr>";
echo "<tr><td>Has³o</td><td><input name=haslo size=20 type=password class=logowanie></td></tr><tr><td colspan=2 align=right>
<input type=hidden name=m value=zaloguj><input type=submit name=send value=Zaloguj class=logowanie></td></tr>";
echo "</table>";
echo "</form>";
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("logowanko");
 frmvalidator.addValidation("user","req","Wpisz u¿ytkownika");
 frmvalidator.addValidation("haslo","req","Wpisz swoje has³o");
</script>
<?
}


//autoryzacja

function logowanie($user, $haslo)
{
$loguj = "SELECT * FROM uzytkownicy WHERE imie LIKE '$user' AND haslo LIKE '$haslo'";
$wykonaj = mysql_query($loguj);

if (mysql_num_rows($wykonaj)>0) 
{
return 1;
}
else
{
return 0;
}
}

//funkcja pokazuj¹ca menu

function pokaz_menu() 
{
echo "<script type=\"text/javascript\">new COOLjsMenu(\"menu\",MENU_ITEMS_IB)</script><br><br>
<br>
";
}

//funkcja nag³owka strony

function head ($tytul)
{
echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">';
echo "<title>$tytul</title>";
echo '<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/coolmenu.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/gen_validatorv2.js"></script>
<script type="text/javascript" src="js/overlib.js"></script>
<script language="JavaScript">
  <!--
    function openWin( windowURL, windowName, windowFeatures ) {
        var Win = window.open( windowURL, windowName, windowFeatures );
        }
  // -->
</script>
</head>';
echo '<body leftmargin="0" rightmargin="0" topmargin="0">
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
}

//stopka
function foot ()
{
echo "<hr>";
echo "<font size=-2>".date("Y-m-d")."</font>";
echo "</body></html>";
}


//dodawanie noweg klienta

function dodaj_klienta($nazwisko,$ozn,$nr,$send,$abonament)
{
echo "<h3>Dodawanie nowego klienta</h3>";
if (!$send)
{

echo "<form action=index.php?m=dodaj_klienta method=post name=nowy_klient><table>
<tr><td>Nazwisko imiê</td><td><input type=text name=nazwisko class=formy size=30></td></tr>
<tr><td>Oznaczenie</td><td><input type=text name=ozn class=formy size=5></td></tr>";

$nr_kol = mysql_query("select max(nr) from klienci");
$wiersz1 = mysql_fetch_array($nr_kol);
$nr_kol2=$wiersz1['max(nr)']+1;
echo "<tr><td>Nr</td><td><input type=text name=nr class=formy size=5 value=$nr_kol2></td></tr>
<tr><td>Abonament</td><td>";
echo '<select name="abonament">';
$abonamenty = mysql_query("select * from abonamenty");
while($wiersz = mysql_fetch_array($abonamenty))
{
echo "<option value=".$wiersz['id_abonamenty'].">".$wiersz['oplata']."</option>";
}
echo '</select>';
echo "</td></tr>
<tr><td></td><td><input type=submit name=send value=Dodaj class=formy></td></tr>
</table>";
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("nowy_klient");
 frmvalidator.addValidation("nazwisko","req","Wpisz nazwisko imiê");
 frmvalidator.addValidation("ozn","req","Wpisz oznaczenie");
 frmvalidator.addValidation("nr","req","Wpisz nr");

</script>
<?
}
else
{
$sprawdz_nr = mysql_query("select * from klienci where nr like '$nr'");
if (mysql_num_rows($sprawdz_nr)!=0)
{
echo "<h4>Klient o numerze $nr ju¿ istnieje w bazie</h4>";
echo "<form action=index.php?m=dodaj_klienta method=post name=nowy_klient><table>
<tr><td>Nazwisko imiê</td><td><input type=text name=nazwisko class=formy size=30></td></tr>
<tr><td>Oznaczenie</td><td><input type=text name=ozn class=formy size=5></td></tr>";

$nr_kol = mysql_query("select max(nr) from klienci");
$wiersz1 = mysql_fetch_array($nr_kol);
$nr_kol2=$wiersz1['max(nr)']+1;
echo "<tr><td>Nr</td><td><input type=text name=nr class=formy size=5 value=$nr_kol2></td></tr>
<tr><td>Abonament</td><td>";
echo '<select name="abonament">';
$abonamenty = mysql_query("select * from abonamenty");
while($wiersz = mysql_fetch_array($abonamenty))
{
echo "<option value=".$wiersz['id_abonamenty'].">".$wiersz['oplata']."</option>";
}
echo '</select>';
echo "</td></tr>
<tr><td></td><td><input type=submit name=send value=Dodaj class=formy></td></tr>
</table>";
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("nowy_klient");
 frmvalidator.addValidation("nazwisko","req","Wpisz nazwisko imiê");
 frmvalidator.addValidation("ozn","req","Wpisz oznaczenie");
 frmvalidator.addValidation("nr","req","Wpisz nr");
</script>
<?
}
else
{
$dodaj_kl = mysql_query("insert into klienci (nr,ozn,nazwisko,id_abonamenty,aktywny) values ('$nr','$ozn','$nazwisko','$abonament','1')");
echo "<h4>Klient dodany</h4>";
echo "<form action=index.php?m=dodaj_klienta method=post name=nowy_klient><table>
<tr><td>Nazwisko imiê</td><td><input type=text name=nazwisko class=formy size=30></td></tr>
<tr><td>Oznaczenie</td><td><input type=text name=ozn class=formy size=5></td></tr>";

$nr_kol = mysql_query("select max(nr) from klienci");
$wiersz1 = mysql_fetch_array($nr_kol);
$nr_kol2=$wiersz1['max(nr)']+1;
echo "<tr><td>Nr</td><td><input type=text name=nr class=formy size=5 value=$nr_kol2></td></tr>
<tr><td>Abonament</td><td>";
echo '<select name="abonament">';
$abonamenty = mysql_query("select * from abonamenty");
while($wiersz = mysql_fetch_array($abonamenty))
{
echo "<option value=".$wiersz['id_abonamenty'].">".$wiersz['oplata']."</option>";
}
echo '</select>';
echo "</td></tr>
<tr><td></td><td><input type=submit name=send value=Dodaj class=formy></td></tr>
</table>";
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("nowy_klient");
 frmvalidator.addValidation("nazwisko","req","Wpisz nazwisko imiê");
 frmvalidator.addValidation("ozn","req","Wpisz oznaczenie");
 frmvalidator.addValidation("nr","req","Wpisz nr");

</script>
<?

}
}
}

//wyœwietlanie listy klientów

function lista_klientow($kolumna,$akcja,$id_klienci,$send,$nr, $ozn, $nazwisko, $id_abonamenty)
{
switch ($akcja)
{
case "odlacz";
$odlacz = mysql_query("update klienci set aktywny='0' where id_klienci like '$id_klienci'");
break;
case "podlacz";
$podlacz = mysql_query("update klienci set aktywny='1' where id_klienci like '$id_klienci'");
break;
case "edytuj";
if (!$send)
{
echo "<h3>Edycja klienta</h3>";
$klient = mysql_query("select * from klienci where id_klienci like '$id_klienci'");
$wiersz = mysql_fetch_array($klient);
echo "<form action=index.php?m=klienci&akcja=edytuj&id_klienci=$id_klienci method=post name=edytuj_klienta><table>
<tr><td>Nazwisko imiê</td><td><input type=text name=nazwisko class=formy size=30 value=\"".$wiersz['nazwisko']."\"></td></tr>
<tr><td>Oznaczenie</td><td><input type=text name=ozn class=formy size=5  value=\"".$wiersz['ozn']."\"></td></tr>";
echo "<tr><td>Nr</td><td><input type=text name=nr class=formy size=5  value=\"".$wiersz['nr']."\"></td></tr>
<tr><td>Abonament</td><td>";
echo '<select name="id_abonamenty">';
$abonamenty = mysql_query("select * from abonamenty");
while($wiersz1 = mysql_fetch_array($abonamenty))
{
echo "<option value=".$wiersz1['id_abonamenty']."";

if ($wiersz1['id_abonamenty']==$wiersz['id_abonamenty'])
{echo " SELECTED";}

echo ">".$wiersz1['oplata']."</option>";
}
echo '</select>';
echo "</td></tr>
<tr><td></td><td><input type=submit name=send value=Popraw class=formy></td></tr>
</table>";
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("edytuj_klienta");
 frmvalidator.addValidation("nazwisko","req","Uzupe³nij imiê i nazwisko");
 frmvalidator.addValidation("ozn","req","Wpisz oznaczenie");
 frmvalidator.addValidation("nr","req","Wpisz nr");

</script>
<?

}
else
{
echo "<h4>Dane klienta poprawione</h4>";
$plac = mysql_query("update klienci set nr='$nr', ozn='$ozn', nazwisko='$nazwisko', id_abonamenty='$id_abonamenty' where id_klienci like '$id_klienci'");
}

break;
case "skasuj";
$skasuj = mysql_query("delete from klienci where id_klienci like '$id_klienci'");
break;
}
if ($kolumna=="")
{
$kolumna="nazwisko";
}
if ($kolumna!="platnosci")
{
$klienci = mysql_query("select * from klienci order by $kolumna");
echo "<h3>Lista klientów</h3>";

}
else
{
$klienci = mysql_query("select * from klienci where id_klienci in (select id_klienci from faktury where kwota-zaplata_kwota!=0) order by nr");
echo "<h3>Lista d³u¿ników</h3>";

}

echo '<table cellpadding="3" cellspacing="0">
<tr align=center><td class=naglowek><a href="index.php?m=klienci&kolumna=ozn" class="nagl_tab">Ozn.</a></td><td class=naglowek><a href="index.php?m=klienci&kolumna=nr" class="nagl_tab">Nr</a></td><td class=naglowek><a href="index.php?m=klienci&kolumna=nazwisko" class="nagl_tab">Nazwisko imiê</a></td><td class=naglowek><a href="index.php?m=klienci&kolumna=id_abonamenty" class="nagl_tab">abonament</a></td><td class=naglowek><a href="index.php?m=klienci&kolumna=aktywny" class="nagl_tab">status</a></td><td class=naglowek><a href="index.php?m=klienci&kolumna=platnosci" class="nagl_tab">p³atnoœci</a></td><td class=naglowek1>edycja</td></tr>';


while($wiersz = mysql_fetch_array($klienci))
{
echo "<tr onmouseOver=\"this.bgColor='#b0d8f9'\"; onmouseOut=\"this.bgColor='#FFFFFF'\";><td class=reszta align=center>".$wiersz['ozn']."</td><td class=reszta align=right>".$wiersz['nr']."</td><!--<a onmouseover=\"return overlib('dane o kliencie: mo¿na ustawiæ co ma siê pokazywaæ');\" onmouseout=\"return nd();\">--><td class=reszta>
".$wiersz['nazwisko']."</td><!--</a>--><td class=reszta align=center>";
$jaki_abon = mysql_query("select oplata from abonamenty where id_abonamenty=".$wiersz['id_abonamenty']."");
$wiersz1 = mysql_fetch_array($jaki_abon);
echo "".$wiersz1['oplata']."";
echo "</td><td class=reszta align=center>";
if ($wiersz['aktywny']=="1")
{
echo "<a href=index.php?m=klienci&akcja=odlacz&id_klienci=".$wiersz['id_klienci']."><img src=grafika/gnome-stock-connect.png width=24 height=24 border=0 alt=aktywny></a>";
}
else
{
echo "<a href=index.php?m=klienci&akcja=podlacz&id_klienci=".$wiersz['id_klienci']."><img src=grafika/gnome-stock-disconnect.png width=24 height=24 border=0 alt=\"nie aktywny\"></a>";

}
echo "</td><td class=reszta align=center>";
$faktury = mysql_query("select * from faktury where id_klienci like '".$wiersz['id_klienci']."' and kwota-zaplata_kwota!=0");
$faktury_all = mysql_query("select * from faktury where id_klienci like '".$wiersz['id_klienci']."' and kwota-zaplata_kwota=0");

if (mysql_num_rows($faktury)==0)
{
echo "<a onmouseover=\"return overlib('wystawione faktury:<br>mc - kwota - data zap³aty - odnotowa³ zap³atê<br>";
while($wiersz4 = mysql_fetch_array($faktury_all))
{
echo "<strong>".$wiersz4['mc']."</strong> - ".$wiersz4['kwota']." -  ".$wiersz4['zaplata_data']." - ".$wiersz4['odnotowal_zaplate']."<br>";
}
echo "');\" onmouseout=\"return nd();\"><img src=grafika/gtk-yes.png width=24 height=24 alt=OK border=0></a>";

}
else
{
echo "<a onmouseover=\"return overlib('niezap³acone faktury:<br>";
while($wiersz3 = mysql_fetch_array($faktury))
{
$do_zaplaty=$wiersz3['kwota']-$wiersz3['zaplata_kwota'];
echo "<strong>".$wiersz3['mc']."</strong> - do zap³aty:";
if ($do_zaplaty<0)
{
echo " <font color=#FF0000>($do_zaplaty)</font> z³<br>";
}
else
{
echo " $do_zaplaty z³<br>";
}
}

echo "');\" onmouseout=\"return nd();\"><img src=grafika/gtk-cancel.png width=24 height=24  border=0></a>";
}


echo "</td><td class=reszta1 align=center><a href=index.php?m=klienci&akcja=edytuj&id_klienci=".$wiersz['id_klienci']."><img src=grafika/gnome-stock-edit.png width=24 height=24 alt=edytuj border=0></a>&nbsp;&nbsp;&nbsp;<a href=index.php?m=klienci&akcja=skasuj&id_klienci=".$wiersz['id_klienci']."><img src=grafika/gtk-delete.png width=24 height=24 alt=kasuj border=0></a></td></tr>";
}
$sumy = mysql_query("SELECT sum(abonamenty.oplata) as suma FROM klienci, abonamenty WHERE klienci.id_abonamenty=abonamenty.id_abonamenty group by aktywny");

for ($i=0;$i<=1;$i++)
{
$wiersz3 = mysql_fetch_array($sumy);
$cos[$i] = $wiersz3['suma'];
}
$razem=$cos[0]+$cos[1];
echo "<tr><td colspan=3 class=reszta align=right>suma</td><td class=reszta align=center>$razem</td><td class=reszta1 colspan=3>&nbsp;</td></tr><tr><td colspan=3 class=reszta align=right>pod³¹czonych</td><td class=reszta align=center>$cos[1]</td><td class=reszta1 colspan=3>&nbsp;</td></tr>
<tr><td colspan=3 class=reszta align=right>niepod³¹czonych</td><td class=reszta align=center>$cos[0]</td><td class=reszta1 colspan=3>&nbsp;</td></tr>";


echo '</table><br>
<br>
<img src=grafika/gnome-stock-connect.png width=24 height=24 border=0 alt=aktywny> klient pod³¹czony - klikniêcie powoduje od³¹czenie klienta<br>
<img src=grafika/gnome-stock-disconnect.png width=24 height=24 border=0 alt=\"nie aktywny\"> klient od³¹czony - klikniêcie powoduje pod³¹czenie klienta<br>
<img src=grafika/gtk-cancel.png width=24 height=24 alt=Zalega border=0> nie wszystkie faktury op³acone<br>
<img src=grafika/gtk-yes.png width=24 height=24 alt=OK border=0> wszystkie faktury op³acone<br>

<img src=grafika/gnome-stock-edit.png width=24 height=24 alt=edytuj border=0> edytuj klienta<br>
<img src=grafika/gtk-delete.png width=24 height=24 alt=kasuj border=0> skasuj klienta <strong>UWAGA</strong> kasuje od razu bez pytania<br>
';
}


//wystawianie faktur

function wystaw_faktury($mc,$rok,$kolumna,$send1,$abonament,$nazwisko,$kwota)
{
echo "<h3>Wystawianie faktur</h3>";

if (!$mc)
{
echo "<form action=index.php?m=wyst_faktur method=post name=wyst_faktur><table>
<tr><td>Miesi¹c</td><td><select name=mc>";
for ($i=1;$i<=12;$i++){
echo "<option value=".strftime("%m",mktime (0,0,0,$i,1,2006)).">".strftime("%m",mktime (0,0,0,$i,1,2006))."</option>";
}
echo "</select></td></tr>
<tr><td>Rok</td><td><input type=text name=rok class=formy size=5 value=2006></td></tr>
<tr><td></td><td><input type=submit name=send value=Wybierz class=formy></td></tr>
</table>";
}
else
{
if ($send1)
{
$mcr= $mc.'.'.$rok;
if ($kwota!="")
{$kasa=$kwota;}
else
{$kasa=$abonament;}

$dodaj_fakture = mysql_query("insert into faktury (id_klienci,mc,kwota,wystawil) values ('$nazwisko','$mcr','$kasa','".$_SESSION["imie_login"]."')");

}

$mcr= $mc.'.'.$rok;
if ($kolumna=="")
{
$kolumna="nazwisko";
}
$klienci = mysql_query("SELECT * FROM klienci WHERE id_klienci NOT IN (SELECT id_klienci FROM faktury WHERE mc LIKE '$mcr') and aktywny like '1' order by $kolumna");
if (mysql_num_rows($klienci)==0)
{
echo "<p>Zosta³y wystawione wszystkie faktury za okres $mc.$rok</p>";
}
else
{
echo "<h4>$mc.$rok</h4>";
echo "<table cellpadding=3 cellspacing=0>
<tr align=center><td class=naglowek><a href=index.php?m=wyst_faktur&kolumna=ozn&mc=$mc&rok=$rok class=nagl_tab>Ozn.</a></td><td class=naglowek><a href=index.php?m=wyst_faktur&kolumna=nr&mc=$mc&rok=$rok class=nagl_tab>Nr</a></td><td class=naglowek><a href=index.php?m=wyst_faktur&kolumna=nazwisko&mc=$mc&rok=$rok class=nagl_tab>Nazwisko imiê</a></td><td class=naglowek>abonament</td><td class=naglowek>inna<br>
kwota</td><td class=naglowek1>wystaw</td></tr>";
while($wiersz = mysql_fetch_array($klienci))
{
echo "<form action=index.php?m=wyst_faktur&mc=$mc&rok=$rok method=post name=wyst_f style=\"display:inline;\">
<tr><td class=reszta align=center>".$wiersz['ozn']."</td><td class=reszta align=right>".$wiersz['nr']."</td><td class=reszta>
".$wiersz['nazwisko']."<input type=hidden name=nazwisko value=".$wiersz['id_klienci']."></td><td class=reszta align=center>";
echo '<select name="abonament">';
$abonamenty = mysql_query("select * from abonamenty");
while($wiersz1 = mysql_fetch_array($abonamenty))
{
echo "<option value=".$wiersz1['oplata']."";
if ($wiersz1['id_abonamenty']==$wiersz['id_abonamenty'])
{echo " SELECTED";}
echo ">".$wiersz1['oplata']."</option>";
}
echo '</select>';
echo "</td><td class=reszta>";
echo '<input type="text" name="kwota" size="3" class="formy">';
echo "</td><td class=reszta1><input type=submit name=send1 value=wystaw class=formy></form></td></tr>";
}


echo '
</table><br>';
}
}
}


//podsumowanie widoczne na stronie g³ównej
function podsumowanie ()
{
echo "<h3>Podsumowanie</h3>";
$klientow = mysql_query("select count(*) as ilu from klienci");
$klientow_ak = mysql_query("select count(*) as ilu from klienci where aktywny like '1'");
$wiersz4 = mysql_fetch_array($klientow);
$wiersz5 = mysql_fetch_array($klientow_ak);
echo "<table cellpadding=20><tr valign=top><td><table cellpadding=3 cellspacing=0><caption><strong>Klienci</strong></caption>
<tr><td class=reszta2>Ogó³em:</td><td class=reszta3 align=right>".$wiersz4['ilu']."</td></tr>
<tr><td class=reszta>Pod³¹czonych:</td><td class=reszta1 align=right>".$wiersz5['ilu']."</td></tr>
<tr><td colspan=2 class=reszta1>Wg abonamentów (pod³¹czonych)</td></tr>";
$abo = mysql_query("select id_abonamenty,count(*) as ilu_ab from klienci where aktywny like '1' group by id_abonamenty");
while($wiersz6 = mysql_fetch_array($abo))
{
$abonam = mysql_query("select * from abonamenty where id_abonamenty like '".$wiersz6['id_abonamenty']."'");
$wiersz7 = mysql_fetch_array($abonam);
echo "<tr><td class=reszta>".$wiersz7['nazwa']."</td><td class=reszta1 align=right>".$wiersz6['ilu_ab']."</td></tr>";
}
echo "
</table></td>
<td><table cellpadding=3 cellspacing=0>
<caption><strong>Obroty</strong></caption>
<tr align=center><td class=naglowek align=center>Miesi¹c</td><td class=naglowek>wystawione<br>
faktury<br>
na kwotê</td><td class=naglowek>zap³acone</td><td class=naglowek1>niezap³acone</td></tr>";

$suma = mysql_query("select sum(kwota) as suma, sum(zaplata_kwota) as zaplacone from faktury");
$wiersz8 = mysql_fetch_array($suma);

$zalegaja=$wiersz8['suma']-$wiersz8['zaplacone'];

echo "<tr><td class=reszta>Ogó³em</td><td class=reszta align=right>".$wiersz8['suma']."</td><td class=reszta align=right>".$wiersz8['zaplacone']."</td><td class=reszta1 align=right><font color=#FF0000>$zalegaja</font></td></tr>
";

$ile_mcy = mysql_query("select distinct mc from faktury order by mc desc");
while($wiersz = mysql_fetch_array($ile_mcy))
{
$ogolem = mysql_query("select sum(kwota) as suma, sum(zaplata_kwota) as zaplacone from faktury where mc like '".$wiersz['mc']."'");
$wiersz1 = mysql_fetch_array($ogolem);

$niezaplacone=$wiersz1['suma']-$wiersz1['zaplacone'];
echo "<tr><td class=reszta>".$wiersz['mc']."</td><td class=reszta align=right>".$wiersz1['suma']."</td><td class=reszta align=right>".$wiersz1['zaplacone']."</td><td class=reszta1 align=right><font color=#FF0000>$niezaplacone</font></td></tr>
";
}
echo "</table></td></tr></table>";
}

//odnotowywanie zap³at
function zaplata($kolumna,$send,$send1,$id_faktury,$abonament,$kwota,$zaplata_cz,$id_klienci,$kwota_b_fak,$mc,$rok,$id_bez_faktury,$data_zaplaty)
{
echo "<h3>Odnotowywanie p³atnoœci klientów</h3>";
switch ($send)
{
case "zap³aæ";
echo "<h4>Odnotowano zap³atê ca³oœci faktury</h4>";
$plac = mysql_query("update faktury set zaplata_data='$data_zaplaty', odnotowal_zaplate='".$_SESSION["imie_login"]."', zaplata_kwota=kwota where id_faktury like '$id_faktury'");
break;

case "popraw";
if (!$send1)
{
$faktury = mysql_query("select * from faktury where id_faktury like '$id_faktury'");
$wiersz5 = mysql_fetch_array($faktury);
echo "<h4>Poprawianie faktury</h4>";
echo "<form action=index.php?m=zaplaty&send=popraw method=post name=wyst_f style=\"display:inline;\">";
echo "<table cellpadding=3 cellspacing=0>
<tr align=center><td class=naglowek>faktura mc</td><td class=naglowek>abonament</td><td class=naglowek>inna<br>kwota</td><td class=naglowek1>Popraw</td></tr>
<tr><td class=reszta align=center>".$wiersz5['mc']."</td><td class=reszta align=center>";
echo '<select name="abonament">';
$abonamenty = mysql_query("select * from abonamenty");
while($wiersz1 = mysql_fetch_array($abonamenty))
{
echo "<option value=".$wiersz1['oplata']."";
if ($wiersz1['oplata']==$wiersz5['kwota'])
{echo " SELECTED";}
echo ">".$wiersz1['oplata']."</option>";
}
echo '</select>';
echo "</td><td class=reszta><input type=hidden name=id_faktury value=".$wiersz5['id_faktury'].">";
echo '<input type="text" name="kwota" size="3" class="formy"></td><td class=reszta1><input type=submit name=send1 value=Popraw class=formy></form></td></tr></table><br>';
}
else
{
echo "<h4>Faktura poprawiona</h4>";
if (!$kwota)
{
$popraw_fak = mysql_query("update faktury set kwota='$abonament' where id_faktury like '$id_faktury'");
}
else
{
$popraw_fak = mysql_query("update faktury set kwota='$kwota' where id_faktury like '$id_faktury'");
}
}
break;
case "usuñ";
echo "<h4>Faktura skasowana</h4>";
$kasuj = mysql_query("delete from faktury where id_faktury like '$id_faktury'");
break;

case "zap³aæ czêœæ";
echo "<h4>Odnotowano zap³atê czêœciow¹</h4>";
$plac = mysql_query("update faktury set zaplata_data='$data_zaplaty', odnotowal_zaplate='".$_SESSION["imie_login"]."', zaplata_kwota=zaplata_kwota+'$zaplata_cz' where id_faktury like '$id_faktury'");
break;

case "OK";
echo "<h4>Odnotowano zap³atê bez faktury</h4>";
$mcr= $mc.'.'.$rok;
$zapl_b_fak = mysql_query("insert into bez_faktury (id_klienci, mc, kwota, wystawil) values ('$id_klienci','$mcr','$kwota_b_fak','".$_SESSION["imie_login"]."')");
break;

case "skojarz";
echo "<h4>Skojarzono zap³atê</h4>";
$plac = mysql_query("update faktury set zaplata_data=CURDATE(), odnotowal_zaplate='".$_SESSION["imie_login"]."', zaplata_kwota=kwota where id_faktury like '$id_faktury'");
$zapl_b_fak = mysql_query("delete from bez_faktury where id_bez_faktury like '$id_bez_faktury'");
break;

case "skasuj";
echo "<h4>P³atnoœæ skasowana</h4>";
$skasuj = mysql_query("delete from bez_faktury where id_bez_faktury like '$id_bez_faktury'");
break;
}
echo '<table cellpadding="3" cellspacing="0">
<tr align=center><td class=naglowek><a href="index.php?m=zaplaty&kolumna=ozn" class="nagl_tab">Ozn.</a></td><td class=naglowek><a href="index.php?m=zaplaty&kolumna=nr" class="nagl_tab">Nr</a></td><td class=naglowek><a href="index.php?m=zaplaty&kolumna=nazwisko" class="nagl_tab">Nazwisko imiê</a></td><td class=naglowek1>niezap³acone faktury <font color="#00cc33">(pozosta³o do zap³aty)</font> <font color="#FF0000">(-nadp³ata)</font></td></tr>';

if ($kolumna=="")
{
$kolumna="nazwisko";
}
$klienci = mysql_query("select * from klienci where id_klienci in (select id_klienci from faktury where kwota-zaplata_kwota!=0) order by $kolumna");


while($wiersz = mysql_fetch_array($klienci))
{
echo "<tr><td class=reszta align=center>".$wiersz['ozn']."</td><td class=reszta align=right>".$wiersz['nr']."</td><td class=reszta>
".$wiersz['nazwisko']."</td><td class=reszta1>";
$faktury = mysql_query("select * from faktury where id_klienci like ".$wiersz['id_klienci']." and kwota-zaplata_kwota!=0");

while($wiersz2 = mysql_fetch_array($faktury))
{
$do_zaplaty = $wiersz2['kwota']-$wiersz2['zaplata_kwota'];
echo "".$wiersz2['mc']." - ".$wiersz2['kwota']."";
if ($do_zaplaty<0)
{
echo "<font color=red>($do_zaplaty)</font> z³ ";
}
else
{
echo "<font color=#00cc33>($do_zaplaty)</font> z³ ";
}
echo "<form action=index.php?m=zaplaty method=post name=zaplata style=\"display:inline;\"><input type=hidden name=id_faktury value=".$wiersz2['id_faktury']."><input type=text name=data_zaplaty size=10 class=formy value=".date("Y-m-d")."><input type=submit name=send value=zap³aæ class=formy1></form> 
&nbsp;
<form action=index.php?m=zaplaty method=post name=popraw_fak style=\"display:inline;\"><input type=hidden name=id_faktury value=".$wiersz2['id_faktury']."><input type=text name=data_zaplaty size=10 class=formy value=".date("Y-m-d")."><input type=text name=zaplata_cz size=3 class=formy><input type=submit name=send value=\"zap³aæ czêœæ\" class=formy1></form>
&nbsp;

<form action=index.php?m=zaplaty method=post name=popraw_fak style=\"display:inline;\"><input type=hidden name=id_faktury value=".$wiersz2['id_faktury']."><input type=submit name=send value=\"popraw\" class=formy1></form>
&nbsp;
<form action=index.php?m=zaplaty method=post name=popraw_fak style=\"display:inline;\"><input type=hidden name=id_faktury value=".$wiersz2['id_faktury']."><input type=submit name=send value=\"usuñ\" class=formy1></form>
<br>";

}
echo "</td></tr>";
}
echo '</table><br>Uwaga: proszê u¿ywaæ "." zamiast "," w pisaniu kwot.<br><br>';
echo "<h3>P³atnoœci bez faktur</h3>";
echo "<h4>Dodaj</h4>";
$klientela = mysql_query("select * from klienci order by nazwisko");
echo '<form action=index.php?m=zaplaty method=post name=dodaj_pl style=\"display:inline;\"><select name="id_klienci" class=formy>';
while($wiersz8 = mysql_fetch_array($klientela))
{
echo "<option value=\"".$wiersz8['id_klienci']."\">".$wiersz8['nazwisko']."</option>";
}
echo '</select> Kwota <input type=text name=kwota_b_fak size=3 class=formy> Miesi¹c:';
echo "<select name=mc>";
for ($i=1;$i<=12;$i++){
echo "<option value=".strftime("%m",mktime (0,0,0,$i,1,2006)).">".strftime("%m",mktime (0,0,0,$i,1,2006))."</option>";
}
echo '</select> Rok: <input type=text name=rok class=formy size=5 value=2006> 
<input type=submit name=send value="OK" class=formy></form>';
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("dodaj_pl");
 frmvalidator.addValidation("kwota_b_fak","req","Wpisz kwotê");
</script>
<?



echo "<h4>Wykaz</h4>";
echo '<table cellpadding="3" cellspacing="0"><tr align=center><td class=naglowek>Ozn.</td><td class=naglowek>Nr</td><td class=naglowek>Nazwisko imiê</td><td class=naglowek>mc</td><td class=naglowek>kwota</td><td class=naglowek>skasuj</td><td class=naglowek1>niezap³acone faktury - skojarz</font></td></tr>';

$klienci_b_f = mysql_query("select * from bez_faktury,klienci where bez_faktury.id_klienci=klienci.id_klienci order by nazwisko,mc");

while($wiersz7 = mysql_fetch_array($klienci_b_f))
{
$faktury_nz = mysql_query("select * from faktury where id_klienci like ".$wiersz7['id_klienci']." and kwota-zaplata_kwota>0");
echo "<tr><td class=reszta align=center>".$wiersz7['ozn']."</td><td class=reszta align=right>".$wiersz7['nr']."</td><td class=reszta>
".$wiersz7['nazwisko']."</td><td class=reszta>
".$wiersz7['mc']."</td><td class=reszta align=right>
".$wiersz7['kwota']."</td><td class=reszta><form action=index.php?m=zaplaty method=post name=skasuj_p style=\"display:inline;\"><input type=hidden name=id_bez_faktury value=".$wiersz7['id_bez_faktury']."><input type=submit name=send value=\"skasuj\" class=formy1></form>
</td><td class=reszta1>";
if (mysql_num_rows($faktury_nz)==0)
{
echo "brak niezap³aconych faktury";
}
else
{
while($wiersz10 = mysql_fetch_array($faktury_nz))
{
$do_zaplaty = $wiersz10['kwota']-$wiersz10['zaplata_kwota'];
echo "".$wiersz10['mc']." - ".$wiersz10['kwota']."";
if ($do_zaplaty<0)
{
echo "<font color=red>($do_zaplaty)</font> z³ ";
}
else
{
echo "<font color=#00cc33>($do_zaplaty)</font> z³ ";
}

echo "<form action=index.php?m=zaplaty method=post name=zaplata style=\"display:inline;\"><input type=hidden name=id_faktury value=".$wiersz10['id_faktury']."><input type=hidden name=id_bez_faktury value=".$wiersz7['id_bez_faktury']."><input type=submit name=send value=skojarz class=formy1></form><br>";
}
}
echo "</td></tr>";
}
echo '</table>';
}

//kartoteka u¿ytkowników
function userzy($akcja,$id_uzytkownicy,$login,$haslo) 
{
echo "<h3>U¿ytkownicy</h3>";
switch ($akcja)
{
case "dodaj";
$users = mysql_query("insert into uzytkownicy (imie,haslo) values ('$login','$haslo')");
break;
case "kasuj";
$users = mysql_query("delete from uzytkownicy where id_uzytkownicy like '$id_uzytkownicy'");
break;
}
$users = mysql_query("select * from uzytkownicy");
echo '<table cellpadding="3" cellspacing="0"><tr align=center><td class=naglowek>Login</td><td class=naglowek>Has³o</td><td class=naglowek1>Akcja</td></tr>';

while($wiersz = mysql_fetch_array($users))
{
echo "<tr><td class=reszta>".$wiersz['imie']."</td><td class=reszta>".$wiersz['haslo']."</td><td class=reszta1 align=center><a href=index.php?m=user&akcja=kasuj&id_uzytkownicy=".$wiersz['id_uzytkownicy']."><img src=grafika/gtk-delete.png width=24 height=24 alt=kasuj border=0></a></td></tr>";
}
echo "<form action=index.php?m=user&akcja=dodaj method=post name=user style=\"display:inline;\"><tr><td class=reszta><input type=text name=login size=10 class=formy></td><td class=reszta><input type=text name=haslo size=10 class=formy></td><td class=reszta1 align=center><input type=submit name=send value=Dodaj class=formy1></td></tr></form>";
echo "</table>";
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("user");
 frmvalidator.addValidation("login","req","Wpisz u¿ytkownika");
 frmvalidator.addValidation("haslo","req","Wpisz has³o");
</script>
<?
}

//kartoteka abonamentów
function abonamenty($akcja,$nazwa,$predkosc,$oplata,$id_abonamenty) 
{
echo "<h3>Abonamenty</h3>";
switch ($akcja)
{
case "dodaj";
$abona_dodaj = mysql_query("insert into abonamenty (nazwa,predkosc,oplata) values ('$nazwa','$predkosc','$oplata')");
break;
case "popraw";
$abo_popraw = mysql_query("update abonamenty set nazwa='$nazwa', predkosc='$predkosc', oplata='$oplata' where id_abonamenty like '$id_abonamenty'");
break;
}
$abo = mysql_query("select * from abonamenty");
echo '<table cellpadding="3" cellspacing="0"><tr align=center><td class=naglowek>nazwa</td><td class=naglowek>prêdkoœæ</td><td class=naglowek>op³ata</td><td class=naglowek1>Akcja</td></tr>';

while($wiersz = mysql_fetch_array($abo))
{
echo "<form action=index.php?m=abo&akcja=popraw method=post name=abonam style=\"display:inline;\"><tr><td class=reszta><input type=text name=nazwa size=15 class=formy value=\"".$wiersz['nazwa']."\"></td><td class=reszta align=center><input type=text name=predkosc size=10 class=formy value=\"".$wiersz['predkosc']."\"></td><td class=reszta align=center><input type=text name=oplata size=5 class=formy value=\"".$wiersz['oplata']."\"></td><td class=reszta1 align=center><input type=hidden name=id_abonamenty value=".$wiersz['id_abonamenty']."><input type=submit name=send value=Popraw class=formy1></td></tr></form>";
}
echo "<form action=index.php?m=abo&akcja=dodaj method=post name=abo style=\"display:inline;\"><tr><td class=reszta><input type=text name=nazwa size=15 class=formy></td><td class=reszta><input type=text name=predkosc size=10 class=formy></td><td class=reszta><input type=text name=oplata size=5 class=formy></td><td class=reszta1 align=center><input type=submit name=send value=Dodaj class=formy1></td></tr></form>";
echo "</table>";
?>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("abo");
 frmvalidator.addValidation("nazwa","req","Wpisz nazwê");
 frmvalidator.addValidation("predkosc","req","Wpisz prêdkoœæ");
 frmvalidator.addValidation("oplata","req","Wpisz op³atê");

</script>
<?
}
?>




