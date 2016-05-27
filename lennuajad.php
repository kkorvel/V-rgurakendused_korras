<?php
$user = "test";
$pass = "t3st3r123";
$db = "test";
$host = "localhost";
$l = mysqli_connect($host, $user, $pass, $db) or die("ei saanudühendatud - " . mysqli_error());
mysqli_set_charset($l, 'utf8');
function model_load()
{
  global $l;
  $query = 'SELECT * FROM lennuajad_kkorvel ORDER BY Sihtkoht ASC';
  $stmt=mysqli_prepare($l, $query);
  if (mysqli_error($l)) {
    echo mysqli_error($l);
    exit;
  }
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $ID, $Sihtkoht, $Lähtekoht, $Kuupäev, $Lennualgus, $Lennulõpp, $Vabadkohad);
  $rows = array();
  while (mysqli_stmt_fetch($stmt)) {
    $rows[] = array(
        'ID' => $ID,
        'Sihtkoht' => $Sihtkoht,
        'Lähtekoht' => $Lähtekoht,
        'Kuupäev' => $Kuupäev,
        'Lennualgus' => $Lennualgus,
        'Lennulõpp' => $Lennulõpp,
        'Vabadkohad' => $Vabadkohad,
      );
    }
    mysqli_stmt_close($stmt);
    return $rows;
}
function model_add($Sihtkoht, $Lähtekoht, $Kuupäev, $Lennualgus, $Lennulõpp, $Vabadkohad)
{
  global $l;
  $query = 'INSERT INTO lennuajad_kkorvel (Sihtkoht, Lähtekoht, Kuupäev, `Lennu algus`, `Lennu lõpp`, `Vabu kohti`) VALUES (?,?,?,?,?,?)';
  $stmt = mysqli_prepare($l, $query);
      if (mysqli_error($l)) {
          echo mysqli_error($l);
          exit;

      }
      mysqli_stmt_bind_param($stmt, 'sssssi', $Sihtkoht, $Lähtekoht, $Kuupäev, $Lennualgus, $Lennulõpp, $Vabadkohad);
      mysqli_stmt_execute($stmt);
      $id = mysqli_stmt_insert_id($stmt);
      mysqli_stmt_close($stmt);
      return $id;
  }

  function model_delete($id)
  {
      global $l;
      $query = 'DELETE FROM lennuajad_kkorvel WHERE ID=? LIMIT 1';
      $stmt = mysqli_prepare($l, $query);
      if (mysqli_error($l)) {
          echo mysqli_error($l);
          exit;
      }
      mysqli_stmt_bind_param($stmt, 'i', $id);
      mysqli_stmt_execute($stmt);
      $deleted = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $deleted;

}
function broneeri($id)
{
  global $l;
  $query = 'UPDATE lennuajad_kkorvel SET `Vabu kohti`=`Vabu kohti`-1 WHERE ID=? AND `Vabu kohti` > 0';
  $stmt = mysqli_prepare($l, $query);
  if (mysqli_error($l)) {
      echo mysqli_error($l);
      exit;
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $id = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);






}
function model_user_add($kasutajanimi, $parool)
{
  global $l;
  $hash = password_hash($parool, PASSWORD_DEFAULT);
  $query = 'INSERT INTO lennuajad_kasutajad (Kasutajanimi, Parool) VALUES (?, ?)';
  $stmt = mysqli_prepare($l, $query);
  mysqli_stmt_bind_param($stmt, 'ss', $kasutajanimi, $hash);
  mysqli_stmt_execute($stmt);
  $id = mysqli_stmt_insert_id($stmt);
  mysqli_stmt_close($stmt);
  return $id;
}
function model_user_get($kasutajanimi, $parool)
{
    global $l;
    $query = 'SELECT Kasutajanimi, Parool FROM lennuajad_kasutajad WHERE Kasutajanimi=? LIMIT 1';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }
    mysqli_stmt_bind_param($stmt, 's', $kasutajanimi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hash);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return password_verify($parool, $hash) ? $id : false;
}
