<?php


class login_controller
{
    private $login;
    private $pass;
    
    public function __construct()
    {
        
    }
    
    public function init($login,$pass)
    {
        $this->login=strip_tags($login);
        $this->pass=md5(strip_tags($pass));        
    }
    public function login()
    {
         
        $db_con=new db_connection();
        $db_con->OpenConnection();
       
        $sql='SELECT user_id FROM '.DB_PREFIX.'users WHERE login=\''.$this->login.'\' and pass=\''.$this->pass.'\'';
      
        $res=mysql_query($sql);
        $db_con->CloseConnection();
        $row=mysql_fetch_array($res,MYSQL_ASSOC);
        if($row['user_id']!='')
            $_SESSION['auth']=1;
            $_POST='';
         header('Location:/DHO/');
    }
    public function logout()
    {
        
        $_SESSION['auth']=0;  
        header('Location:/DHO/');
    }
}
session_start();
$lc=new login_controller();
if($_POST['login']!='' && $_POST['pass']!='' && $_SESSION['auth']==0)
{
   
    $lc->init($_POST['login'],$_POST['pass']);
    $lc->login();
}
else if($_SESSION['auth']==1)
{
    $lc->logout();
    
}




?>