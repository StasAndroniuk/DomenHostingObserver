<?php

echo'<form action="/DHO/index.php" method="POST">';

echo'<table border=1><tr><td colspan=2>Форма авторизации</td></tr>';
echo'<tr><td>Логин</td><td><input type=text name=login></td></tr>';
echo'<tr><td>Пароль</td><td><input type="password" name=pass></td></tr>';
echo'<tr><td colspan=2><input type=submit value=Войти></td></tr></table>';

echo'</form>';
?>