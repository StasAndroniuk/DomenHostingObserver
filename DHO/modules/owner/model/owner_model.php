<?php
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/config.php');
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/classes/db_connection.php');

class owner_model
{
    private $db_con;
    public function __construct()
    {
        $this->db_con=new db_connection();
    }
    
    public function getOwnerList()
    {
       
        $sql='select * from '.DB_PREFIX.'owners';
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
            $row=mysql_fetch_array($res,MYSQL_ASSOC);
            $owners[$i]=$row;
            $owners[$i]['emails']=$this->getOwnerEmails($row['owner_id']);
            $owners[$i]['phones']=$this->getOwnerPhones($row['owner_id']);
        }
        $this->db_con->CloseConnection();
        return $owners;
    }
    public function getOwnerById($id)
   {
       $sql='SELECT * FROM '.DB_PREFIX.'owners WHERE owner_id=\''.$id.'\'';
       $this->db_con->OpenConnection();
       $res=mysql_query($sql);
       $row=mysql_fetch_assoc($res);
       $owner=$row;
       $owner['emails']=$this->getOwnerEmails($id);
       $owner['phones']=$this->getOwnerPhones($id);
       return $owner;
       
   }
    public function removeOwner($n)
    {
       
         $sql='DELETE FROM '.DB_PREFIX.'owners WHERE owner_id=\''.$n.'\'';
         $this->db_con->OpenConnection();
         $res=mysql_query($sql);
         $this->db_con->Close_Connection();
    }
    private function getOwnerEmails($owner_id)
    {
        $sql='SELECT id,email FROM '.DB_PREFIX.'emails WHERE owner_id=\''.$owner_id.'\'';
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
            $row=mysql_fetch_array($res,MYSQL_ASSOC);
            $emails[]=$row;
        }
        return $emails;
    }
     private function getOwnerPhones($owner_id)
    {
        $sql='SELECT id,phone FROM '.DB_PREFIX.'phones WHERE owner_id=\''.$owner_id.'\'';
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
            $row=mysql_fetch_array($res,MYSQL_ASSOC);
            $phones[]=$row;
        }
        return $phones;
    }
    public function editOwner($owner)
    {
        $sql='UPDATE '.DB_PREFIX.'owners SET firstname=\''.$owner['firstname'].'\', lastname=\''.$owner['lastname'].'\' where owner_id=\''.$owner['id'].'\'';
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        $this->db_con->CloseConnection();
        echo'Готово';
    }
    public function EditOwnerData($owner)
    {
      
        $sql[]='UPDATE '.DB_PREFIX.'owners SET firstname=\''.$owner['firstname'].'\', lastname=\''.$owner['lastname'].'\' WHERE owner_id=\''.$owner['owner_id'].'\';';
        foreach ($owner['phones'] as $phone) {
           $sql[]='UPDATE '.DB_PREFIX.'phones SET phone=\''.$phone['phone'].'\' WHERE id=\''.$phone['phoneId'].'\' and owner_id=\''.$owner['owner_id'].'\';';
        }
        foreach ($owner['emails'] as $email) {
           $sql[]='UPDATE '.DB_PREFIX.'emails SET email=\''.$email['email'].'\' WHERE id=\''.$email['emailId'].'\' and owner_id=\''.$owner['owner_id'].'\';';
        }
        $this->db_con->OpenConnection();
        mysql_query("START TRANSACTION");
          $flag=true;
          
          foreach ($sql as $request) {
              $res=mysql_query($request);
              if(!$res)
              {
                  $flag=false;
                  break;
              }
          }
          if ($flag) 
          {
                    mysql_query("COMMIT");
          }
           else 
         
                    mysql_query("ROLLBACK");
        
              $this->db_con->CloseConnection();    
        
        
    }
    public function AddNewOwner($owner)
    {
        $flag=true;
         $this->db_con->OpenConnection();
        mysql_query("START TRANSACTION");
        
        $sql1="INSERT INTO ".DB_PREFIX.'owners (firstname,lastname) VALUES(\''.$owner['firstname'].'\',\''.$owner['lastname'].'\')';
        $res=mysql_query($sql1);
        if(!$res)
                $flag=false;
        $sql1='SELECT MAX(owner_id) as owner_id FROM '.DB_PREFIX.'owners';
        $res=mysql_query($sql1);
        $row=mysql_fetch_assoc($res);
        $id=$row['owner_id'];
        
        foreach ($owner['emails'] as $email) {
            $sql[]='INSERT INTO '.DB_PREFIX.'emails (owner_id,email) VALUES(\''.$id.'\',\''.$email['email'].'\')';
        }
        foreach ($owner['phones'] as $phone) {
            $sql[]='INSERT INTO '.DB_PREFIX.'phones (owner_id,phone) VALUES(\''.$id.'\',\''.$phone['phone'].'\')';
        }
        foreach ($sql as $request) {
            $res=mysql_query($request);
            if(!$res)
                {
                    $flag=false;
                    break;
                }
        }
        
        if ($flag) mysql_query("COMMIT");
         else      mysql_query("ROLLBACK");
        
        $this->db_con->CloseConnection();  
       
    }
    public function DeleteOwner($ownerid)
    {
        
        $flag=true;
        $sql[]='DELETE FROM '.DB_PREFIX.'emails WHERE owner_id=\''.$ownerid.'\'';
        $sql[]='DELETE FROM '.DB_PREFIX.'phones WHERE owner_id=\''.$ownerid.'\'';
        $sql[]='UPDATE '.DB_PREFIX.'domens SET owner_id="" WHERE owner_id=\''.$ownerid.'\'';
        $sql[]='UPDATE '.DB_PREFIX.'hostings SET owner_id="" WHERE owner_id=\''.$ownerid.'\'';
        $sql[]='DELETE FROM '.DB_PREFIX.'owners  WHERE owner_id=\''.$ownerid.'\''; 
        $this->db_con->OpenConnection();
         mysql_query("START TRANSACTION");
         
         foreach ($sql as $request) {
             $res=mysql_query($request);
             if(!$res)
             {
                 $flag=false;
                 break;
             }
         }
         if ($flag) mysql_query("COMMIT");

           else   mysql_query("ROLLBACK");
           
         $this->db_con->CloseConnection();    
    }
   
    
}








?>