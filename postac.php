<?PHP
  ERROR_REPORTING(0);

  session_start();
  
  require_once("./inc/config.inc.php");
  require_once("./inc/rights.inc.php");
  require_once("./inc/functions.inc.php");

  $sqlHp = mysql_connect(SQL_HP_HOST, SQL_HP_USER, SQL_HP_PASS);
  $sqlServ = mysql_connect(SQL_HOST, SQL_USER, SQL_PASS);
?>
<?php {
 if (isset($_GET['nr']) && $_GET['nr'] != '') {
  $nr1 = addslashes($_GET['nr']) - 100;
  $nr = addslashes($_GET['nr']);
  $nr2 = addslashes($_GET['nr']) + 100;
 } else {
  $nr1 = '-100';
  $nr = '0';
  $nr2 = '100';
 }
 $id = $_GET['page'];
 require_once ("config_player.php");
 @mysql_select_db("player");
 $abfrage = "SELECT * FROM player WHERE id='" . $id . "'";
 $ergebnis = @mysql_query($abfrage);
 $i = $nr + 1;
 while ($player = @mysql_fetch_array($ergebnis)) {
  $class = $player['job'];
  echo "<br><table><tr><td border=\"0\" width=\"240\">
    <img src=\"klasy/$class.png\"></td><td><table border=\"0\" width=\"180\" >
  <tr>
  <td border=\"0\" width=\"50%\"><b>Nazwa postaci:</b> " . $player["name"] . "</td>";
  echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><b>Czas gry:</b> " . $player["playtime"] . " minut</td>";
  echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><b>Ostatnio w grze:</b> " . $player["last_play"] . "</td>";
  echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><b>Królestwo: </b></td>";
  $query2 = mysql_query("SELECT * FROM player_index WHERE id LIKE '$player[account_id]'");
  while ($player2 = mysql_fetch_array($query2)) if ($player2['empire'] == 1) {
   echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><font color=red>Shinsoo </font><img src=\"kru/shinsoo.jpg\"></td>";
  } elseif ($player2['empire'] == 2) {
   echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><font color=yellow>Chunjo </font><img src=\"kru/chunjo.jpg\"></td>";
  } else {
   echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><font color=blue>Jinno </font><img src=\"kru/jinno.jpg\"></td>";
  }
  echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><h4>Statystyki:</h4></td>";
  echo " </tr> <tr>
  <td border=\"0\" width=\"50%\"><b>Poziom:</b> " . $player["level"] . " </td>";
  echo " </tr> <tr>
  </td></tr></table>";
  if ($player['job'] == 0) {
   echo "<B>Klasa:</b> Wojownik (Mężczyzna)<Br/>";
  } elseif ($player['job'] == 4) {
   echo "<b>Klasa:</b> Wojownik (Kobieta)<Br/>";
  }
  if ($player['job'] == 1) {
   echo "<b>Klasa:</b> Ninja (Mężczyzna)<Br/>";
  } elseif ($player['job'] == 5) {
   echo "<b>Klasa:</b> Ninja (Kobieta)<Br/>";
  }
  if ($player['job'] == 2) {
   echo "<b>Klasa:</b> Sura (Mężczyzna)<Br/>";
  } elseif ($player['job'] == 6) {
   echo "<b>Klasa:</b> Sura (Kobieta)<Br/>";
  }
  if ($player['job'] == 3) {
   echo "<b>Klasa:</b> Szaman (Mężczyzna)<Br/>";
  } elseif ($player['job'] == 7) {
   echo "<b>Klasa:</b> Szaman (Kobieta)<Br/>";
  }
  
  echo "<b>Poziom konia:</b> " . $player["horse_level"] . "<Br/>";
  echo "<b>Energia życiowa:</b> " . $player["ht"] . "<Br/>";
  echo "<b>Inteligencja:</b> " . $player["dx"] . "<Br/>";
  echo "<b>Siła:</b> " . $player["st"] . "<Br/>";
  echo "<b>Zręczność:</b> " . $player["dx"] . "<Br/>";
  echo "<b>Punkty życia:</b> " . $player["hp"] . "<Br/>";
  echo "<b>Punkty energii:</b> " . $player["mp"] . "<Br/>";
 }
 echo "</tr>";
 $i++;
}
echo "</table>";
echo "<br><br>";
?>