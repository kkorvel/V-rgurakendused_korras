
<?php
session_start();
if (isset($_POST['action'])) {
  include 'kontroll.php';
  $loggedIn = kontroller_login ($_POST['kasutajanimi'], $_POST['parool']);
  foreach (message_list() as $value) {
    echo $value;
  }
  if ($loggedIn) {
    header('Location: view.php');
  }
}

 ?>

<!doctype html>
<html>
    <head>
        <meta charset="utf8" />
        <link rel="stylesheet" href="view.css">
        <title>Logi sisse</title>
    </head>
    <div class="loginsisu">

    <body>

        <h1>Logi sisse</h1>

        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

            <input type="hidden" name="action" value="login">

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
                <button type="submit" class="nupp">Logi sisse</button> või <a class="nupp" href="view_register.php">Registreeri konto</a>
            </p>

        </form>
    </body>
  </div>
</html>
