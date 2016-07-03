<?php
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/config.php');
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/classes/db_connection.php');


class SettingsModel
{
    private $db_con;
    
    public function __construct()
    {
        $this->db_con=new db_connection();
    }
    public function GetSettings()
    {
       $sql='SELECT * FROM '.DB_PREFIX.'settings';
       $this->db_con->OpenConnection();
       $res=mysql_query($sql);
       for($i=0;$i<mysql_num_rows($res);$i++)
       {
           $row=mysql_fetch_assoc($res);
           $settings[$row['name']]=$row;
       }
       $sql="SELECT user_id,login FROM ".DB_PREFIX."users";
       $res=mysql_query($sql);
       $row=mysql_fetch_assoc($res);
       $settings['user_id']=$row['user_id'];
       $settings['login']=$row['login'];
       $this->db_con->CloseConnection();
       
       return $settings;
    }
    public function SaveSettings($settings)
    {
      
      $keys=array_keys($settings);
     
      foreach ($keys as $key)
      {
          if($key=="login" || $key=="old_pass" || $key=="new_pass"|| $key=="user_id" )
          {
              continue;
          }
        $sql[]='UPDATE '.DB_PREFIX.'settings SET value=\''.$settings[$key].'\'  WHERE name=\''.$key.'\'';
      }
      
      $this->db_con->OpenConnection();
      if($settings['old_pass']!="" && $settings['new_pass']!="")
      {
          $check_pass='SELECT * FROM '.DB_PREFIX.'users WHERE pass=\''.md5($settings['old_pass']).'\'';
          $res=mysql_query($check_pass);
          if(mysql_num_rows($res)>0)
          {
              $sql[]='UPDATE '.DB_PREFIX.'users SET pass=\''.md5($settings['new_pass']).'\' WHERE user_id=\''.$settings['user_id'].'\'';
          }
      }
      foreach ($sql as $req) {
          mysql_query($req);
      }
      $this->db_con->CloseConnection();
      
    }
}





?>