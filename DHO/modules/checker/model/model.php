<?php
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/config.php');
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/classes/db_connection.php');


class CheckerModel
{
    private $do_con;
    public function __construct()
    {
        $this->db_con=new db_connection();
    }
    public function GetOwnerList()
    {
        $sql='SELECT owner_id, CONCAT(firstname," ",lastname) as name FROM '.DB_PREFIX.'owners ';
        $this->db_con->OpenConnection();
       
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
            $owners[]=mysql_fetch_assoc($res);
        }
        $this->db_con->CloseConnection();
        return $owners;
        
    }
    public function GetOwnerEmails($id)
    {
      $this->db_con->OpenConnection();
      
         $sql='SELECT email FROM '.DB_PREFIX.'emails WHERE owner_id=\''.$id.'\' AND LENGTH(email)>0';
         $res=mysql_query($sql);
         for($i=0;$i<mysql_num_rows($res);$i++)
         {
            $emails[]=mysql_fetch_assoc($res);
         }
         
    
       $this->db_con->CloseConnection();
       return $emails;
    }
    private function GetWaringTime()
    {
        $sql='SELECT value FROM '.DB_PREFIX.'settings WHERE name="first_warning"';
      
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        $firstWarning=mysql_fetch_assoc($res);
        $firstWarning=$firstWarning['value'];
        $sql='SELECT value FROM '.DB_PREFIX.'settings WHERE name="second_warning"';
         $res=mysql_query($sql);
        $secondWarning=mysql_fetch_assoc($res);
        $secondWarning=$secondWarning['value'];
      
        $this->db_con->CloseConnection();
        return array('first_warning'=>$firstWarning*7,'second_warning'=>$secondWarning);
    }
    public function GetHostingForWarnings($id)
    {
        $warning_limits=$this->GetWaringTime();
        $now=date('Y-m-d');
        $this->db_con->OpenConnection();
       
     
        
        $sql='SELECT hosting_id,date_of_end FROM '.DB_PREFIX.'hostings WHERE status=1 AND  owner_id=\''.$id.'\'';
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
            $row=mysql_fetch_assoc($res);
            
           $date= (strtotime($row['date_of_end']) - strtotime($now))/3600/24;
            
            if($date==$warning_limits['first_warning'] )  $hostings_first[]=$row;
            else if($date==$warning_limits['second_warning']) $hostings_second[]=$row;
            

        }
      
        $this->db_con->CloseConnection();
        
        return array('first_warning'=>$hostings_first,'second_warning'=>$hostings_second);  
        
    }
    public function GetDomenForWarnings($id)
    {
        $warning_limits=$this->GetWaringTime();
        $sql='SELECT domen_id,date_of_end FROM '.DB_PREFIX.'domens WHERE status=1 AND owner_id=\''.$id.'\'';
        $now=date('Y-m-d');
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
            
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
            $row=mysql_fetch_assoc($res);
            $date= (strtotime($row['date_of_end']) - strtotime($now))/3600/24;
      
            if($date==$warning_limits['first_warning'])  $domens_first[]=$row;
            if($date==$warning_limits['second_warning']) $domens_second[]=$row;
        }
   
        $this->db_con->CloseConnection();
        return array('first_warning'=>$domens_first,'second_warning'=>$domens_second); 
      
    }
    public function MakeMessage($recieverName,$messageType,$objects,$objectType)
    {
        $objName=substr($objectType,0,-1);
        $objNum=count($objects);
        if($objectType=='hostings') 
        {
          $obj='хостингов';
        }
        if($objectType=='domens')
        {
            $obj=' доменов ';
        }
        if($messageType=='first_warning')
        {
          $limit=' недель/недели ';
        }
        if($messageType=='second_warning')
        {
          $limit=' дня/дней ';
        }
        
         $message='<p>Здравствуйте, '.$recieverName.'.</p>';
         
         $message.='<p>Срок действия указанных ниже '.$obj.' заканчивается через ';
         $sql='SELECT value FROM '.DB_PREFIX.'settings WHERE name=\''.$messageType.'\'';
         $this->db_con->OpenConnection();
         $res=mysql_query($sql);
         $row=mysql_fetch_assoc($res);
         $limit=$row['value'].$limit;
         $message.=$limit;
      
        $sql='SELECT name FROM '.DB_PREFIX.$objectType.' WHERE '.$objName.'_id IN(';
        for($i=0;$i<$objNum;$i++)
        {
            $sql.='\''.$objects[$i][$objName.'_id'].'\'';
            if($i!=$objNum-1) $sql.=', ';
        }
           $sql.=')';
           
        $message.='<table border="1"><tr><td>№</td><td>Название</td><td>Дата окончания</td></tr>';
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
           $row=mysql_fetch_assoc($res);
           $message.='<tr><td>'.($i+1).'</td><td>'.$row['name'].'</td><td>'.$objects[$i]['date_of_end'].'</td></tr>';
        }
           
     
         $message.='</table>';
         $this->db_con->CloseConnection();
          
         return $message;
         
    }
    public function GetAdminEmail()
    {
       $sql='SELECT value FROM '.DB_PREFIX.'settings WHERE name="admin_email"';
       $this->db_con->OpenConnection();
       $res=mysql_query($sql);
       $row=mysql_fetch_assoc($res);
       $emails[]=array('email'=>$row['value']);
       $this->db_con->CloseConnection();
       return $emails;
    }

}





?>