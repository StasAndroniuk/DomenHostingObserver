<?php
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/config.php');
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/classes/db_connection.php');


class HostingModel
{
    private $do_con;
    public function __construct()
    {
        $this->db_con=new db_connection();
    }
    
    public function GetHostingList()
    {
       $sql='SELECT h.hosting_id,h.name,h.login,h.pass,h.date_of_end, h.user_name,h.status,h.comment,CONCAT(o.firstname," ", o.lastname) as owner FROM '.DB_PREFIX.'hostings h LEFT JOIN '.DB_PREFIX.'owners o ON o.owner_id = h.owner_id';
       $this->db_con->OpenConnection();
       $res=mysql_query($sql);
       $now=new DateTime(date("Y-m-d"));
       for($i=0;$i<mysql_num_rows($res);$i++)
       {
         $hostings[]=mysql_fetch_assoc($res);
         if($now>(new DateTime($hostings[$i]['date_of_end']))) $hostings[$i]['overdue']=1;
         $sql1='SELECT name FROM '.DB_PREFIX.'domens WHERE hosting_id=\''.$hostings[$i]['hosting_id'].'\'';
         $res1=mysql_query($sql1);
         for($j=0;$j<mysql_num_rows($res1);$j++)
         {
           $hostings[$i]['domens'][]=mysql_fetch_assoc($res1);
         }
       }
       $this->db_con->CloseConnection();
       return $hostings;
    }
    public function GetOwnerList()
    {
        $sql='SELECT owner_id,CONCAT(firstname," ",lastname) as owner FROM '.DB_PREFIX.'owners ';
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
          $owners[]=mysql_fetch_assoc($res);
        }
        $this->db_con->CloseConnection();
        return $owners;
    }
    public function AddNewHosting($hosting)
    {
      $sql='INSERT INTO '.DB_PREFIX.'hostings (name,login,pass,date_of_end,status,user_name,comment,owner_id) VALUES(\''.$hosting['name'].'\', \''.$hosting['login'].'\',\''.$hosting['pass'].'\', \''.$hosting['date_of_end'].'\',\''.$hosting['status'].'\', \''.$hosting['user_name'].'\', \''.$hosting['comment'].'\',\''.$hosting['owner_id'].'\')';
      $this->db_con->OpenConnection();
      mysql_query($sql);
      $this->db_con->CloseConnection();
    }
    public function SaveHosting($hosting)
    {
       $sql='UPDATE '.DB_PREFIX.'hostings SET date_of_end=\''.$hosting['date_of_end'].'\', status=\''.$hosting['status'].'\',comment=\''.$hosting['comment'].'\',login=\''.$hosting['login'].'\',pass=\''.$hosting['pass'].'\',user_name=\''.$hosting['user_name'].'\' WHERE hosting_id=\''.$hosting['hosting_id'].'\'';
       $this->db_con->OpenConnection();
       mysql_query($sql);
       $this->db_con->CloseConnection();
    }
    public function GetHostingById($id)
    {
       $sql='SELECT h.hosting_id,h.name,h.login,h.pass,h.date_of_end,h.user_name,h.status,h.comment,CONCAT(o.firstname," ", o.lastname) as owner FROM '.DB_PREFIX.'hostings h LEFT JOIN '.DB_PREFIX.'owners o ON o.owner_id = h.owner_id WHERE hosting_id=\''.$id.'\'';
       $this->db_con->OpenConnection();
       $res=mysql_query($sql);
        $now=new DateTime(date("Y-m-d"));
         $hosting=mysql_fetch_assoc($res);
          if($now>(new DateTime($hosting['date_of_end']))) $hosting['overdue']=1;
         $sql1='SELECT name FROM '.DB_PREFIX.'domens WHERE hosting_id=\''.$hosting['hosting_id'].'\'';
         $res1=mysql_query($sql1);
         for($j=0;$j<mysql_num_rows($res1);$j++)
         {
           $hosting['domens'][]=mysql_fetch_assoc($res1);
         }
       
       $this->db_con->CloseConnection();
       return $hosting; 
    }
    public function DeleteHosting($id)
    {
      $sql[]='UPDATE '.DB_PREFIX.'domens SET hosting_id="" WHERE hosting_id=\''.$id.'\'';
      $sql[]='DELETE FROM '.DB_PREFIX.'hostings WHERE hosting_id=\''.$id.'\'';
      $this->db_con->OpenConnection();
      foreach ($sql as $req) {
   
            mysql_query($req);
      }
      $this->db_con->CloseConnection();
     
    }
}





?>