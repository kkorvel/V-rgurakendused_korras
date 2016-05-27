<?php
for ($i=0; $i < count($_POST['Sihtkoht']); $i++)  {
  if ($_POST['Sihtkoht'][$i]) {
    kontroller_add ($_POST['Sihtkoht'][$i], $_POST['Lähtekoht'][$i],  $_POST['Kuupäev'][$i],  $_POST['Lennualgus'][$i],  $_POST['Lennulõpp'][$i],  $_POST['Vabadkohad'][$i]);
  }
}

?>
