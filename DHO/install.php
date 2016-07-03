<?php


if($_POST['user']!="" && $_POST['pass']!="" && $_POST['server']!="" && $_POST['db']!="" && $_POST['prefix']!="")
{
  
    
   // mysql tables
    $file=file_get_contents('dhobs.sql');
    $sql=explode(";",$file);
    mysql_connect($_POST['server'],$_POST['user'],$_POST['pass']);
    mysql_select_db($_POST['db']);
    foreach ($sql as $req) 
    {
      mysql_query($req);
    }
    //config file
    $file=file_get_contents('config.php');     
    $file=str_replace("define(DB_PREFIX,'')","define(DB_PREFIX,'".$_POST['prefix']."')",$file);
    $file=str_replace("define(DB_NAME,'')","define(DB_NAME,'".$_POST['db']."')",$file);
    $file=str_replace("define(DB_USER,'')","define(DB_USER,'".$_POST['user']."')",$file);
    $file=str_replace("define(DB_HOST,'')","define(DB_HOST,'".$_POST['server']."')",$file);
    $file=str_replace("define(DB_PASS,'')","define(DB_PASS,'".$_POST['pass']."')",$file);
    file_put_contents('config.php',$file);
    //delete install files
    unlink('dhobs.sql');
    unlink('install.php');

}
else
{
    echo'<form method="POST" action="/DHO/install.php">';
    echo"<table><tr><td colspan='2'>Database info</td></tr>
                <tr><td>host</td><td><input type='text' name='server'></td></tr>
                <tr><td>Username</td><td><input type='text' name='user'></td></tr>
                <tr><td>Password</td><td><input type='password' name='pass'></td></tr>
                <tr><td>Database name</td><td><input type='text' name='db'></td></tr>
                <tr><td>Database prefix</td><td><input type='text' name='prefix'></td></tr>
                <tr><td colspan='2'><input type='submit' value='install'></td></tr></table>
        ";


    echo'</form>';
}







?>