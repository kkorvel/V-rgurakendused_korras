<?php include 'lennuajad.php'; include 'kontroll.php';
session_start();
if (isset($_POST['logout'])) {
  kontroller_logout();
}
if(!kontroller_user()) {
  header('Location: view_login.php');
}
if (isset($_POST['Sihtkoht'])) {
  include 'salvestalennuajad.php';
} if(isset($_POST['Kustuta'])){
  model_delete($_POST['Kustuta']);
}if(isset($_POST['Broneeri'])){
  broneeri($_POST['Broneeri']);
}



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lennupiletid</title>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="projekt.js" charset="utf-8"></script>
    <link rel="stylesheet" href="view.css">



  </head>
  <body>

    <form method="post">

      <button type="submit" name="logout">Logi välja</button>

    </form>

    <h2>Lennupiletite ülevaade</h2>
<div id="p">

  <p>
    Tere! Tore, et olete tulnud siia veebilehele, et broneerida endale lennukipilet.
    Loodan, et just meie lennufirmal on kõige mõistlikumad piletid. Soovime teile turvalist lendu!
  </p>
</div>
<div class="teade">

  <?php foreach (message_list() as $value) {
    echo $value;
  } ?>
</div>
  <form id="lisavorm" method="post">
  <?php if ($_SESSION['isAdmin']) { ?>
  <p>
    <button type="submit">Salvesta andmed</button>
  </p>
  <p>
    <button onclick="Realisamine(this); return false;">Lisa rida</button>
  </p>
 <?php } ?>

<table id ="lennupiletid">
  <tr>
    <th> ID </th>
    <th> Sihtkoht </th>
    <th> Lähtekoht</th>
    <th>Kuupäev</th>
    <th> Lennu algus </th>
    <th> Lennu lõpp </th>
    <th> Vabu kohti </th>
    <?php if (!$_SESSION['isAdmin']) { ?>
    <th> Broneeri </th>
    <?php } else { ?>
    <th> Kustuta rida</th>
    <?php } ?>
  </tr>
<?php foreach (model_load() as $value) { ?>
  <tr>
    <td>
      <?=$value['ID'] ?>
    </td>
    <td>
      <?=$value['Sihtkoht'] ?>
    </td>
    <td>
      <?=$value['Lähtekoht'] ?>
    </td>
    <td>
      <?=$value['Kuupäev'] ?>
    </td>
    <td>
      <?=$value['Lennualgus'] ?>
    </td>
    <td>
      <?=$value['Lennulõpp'] ?>
    </td>
    <td>
      <?=$value['Vabadkohad'] ?>
    </td>
    <?php if (!$_SESSION['isAdmin']) { ?>
    <td>
      <button type="submit" name="Broneeri" value="<?=$value['ID'] ?>" <?=$value['Vabadkohad'] <= 0 ? 'disabled' : '' ?>>Broneeri</button></td>
    </td>
    <?php } else { ?>
    <td>
      <button type="submit" name="Kustuta" value="<?=$value['ID'] ?>">Kustuta rida</button></td>
    </td>
    <?php } ?>
  </tr>
<?php } ?>
<?php if ($_SESSION['isAdmin']) { ?>
  <tr>
    <td></td>
    <td>
      <input type="text" name="Sihtkoht[]">
    </td>
    <td>
      <input type="text" name="Lähtekoht[]">
    </td>
    <td>
      <input type="date" name="Kuupäev[]">
    </td>
    <td>
      <input type="time" name="Lennualgus[]">
    </td>
    <td>
      <input type="time" name="Lennulõpp[]">
    </td>
    <td>
      <input type="number" name="Vabadkohad[]">
    </td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>
      <input type="text" name="Sihtkoht[]">
    </td>
    <td>
      <input type="text" name="Lähtekoht[]">
    </td>
    <td>
      <input type="date" name="Kuupäev[]">
    </td>
    <td>
      <input type="time" name="Lennualgus[]">
    </td>
    <td>
      <input type="time" name="Lennulõpp[]">
    </td>
    <td>
      <input type="number" name="Vabadkohad[]">
    </td>
    <td></td>
  </tr>
  <?php } ?>
</table>
</form>

</body>

</html>
