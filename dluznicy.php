<?
session_start();
require_once ("includes/funkcje.php");
if (!session_is_registered('imie_login')) 
{
echo "<a href=index.php>Zaloguj siê</a>";
}
else 
{
echo '<table cellpadding="3" cellspacing="0" border="1"><tr align="center"><td><strong>Nazwisko imiê</strong></td><td><strong>nr</strong></td><td><strong>ozn.</strong></td><td><strong>do zap³aty</strong></td><td><strong>miesi¹c</strong></td></tr>';

$dluznicy = mysql_query("select * from klienci,faktury where klienci.id_klienci=faktury.id_klienci and faktury.kwota-faktury.zaplata_kwota>0");

while($wiersz = mysql_fetch_array($dluznicy))
{
$do_zaplaty=$wiersz['kwota']-$wiersz['zaplata_kwota'];
echo "<tr>

<td align=left>".$wiersz['nazwisko']."</td>
<td align=center>".$wiersz['nr']."</td>
<td align=center>".$wiersz['ozn']."</td>
<td align=right>$do_zaplaty</td>
<td align=center>".$wiersz['mc']."</td>
</tr>";

}
echo "</table>";

echo '<br>
<br>
<br>
<input type="submit" name="Drukuj" onclick=window.print() value="Drukuj">';

}
echo "kasujemy to ciekawe czy zapamieta co bylo pdo spodem";
echo "zmienna";
?>

