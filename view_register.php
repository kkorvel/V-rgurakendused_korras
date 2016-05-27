
<!doctype html>
<html>
    <head>
        <meta charset="utf8" />
        <link rel="stylesheet" href="register.css">
        <title>Registreeri konto</title>
    </head>
    <div class="rega">

    <body>

        <h1>Registreeri konto</h1>

        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

          <input type="hidden" name="action" value="register">

            <table>
                <tr>
                    <td>Kasutajanimi</td>
                    <td>
                        <input type="text" name="kasutajanimi" required>
                    </td>
                </tr>
                <tr>
                    <td>Parool</td>
                    <td>
                        <input type="password" name="parool" required>
                    </td>
                </tr>
            </table>

            <p>
                <button type="submit">Registreeri konto</button>
            </p>

        </form>
<?php

  if (isset($_POST['action'])) {
    include 'kontroll.php';
kontroller_register ($_POST['kasutajanimi'], $_POST['parool']);
foreach (message_list() as $value) {
  echo $value;
}

}


?>

    </body>
  </div>
</html>
