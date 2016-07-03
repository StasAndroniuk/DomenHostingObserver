<?php
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/config.php');
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/classes/db_connection.php');


class DomenModel
{
    private $db_con;
    public function __construct()
    {
        $this->db_con=new db_connection();
        
    }
    public function GetDomenList()
    {
       $sql='SELECT d.domen_id,d.name as domen_name,d.date_of_end,d.status,d.comment,CONCAT(o.firstname," ",o.lastname) as owner,o.owner_id,r.name as reg_name,r.recorder_id,h.name as host_name,d.hosting_id FROM '.DB_PREFIX.'domens d LEFT JOIN '.DB_PREFIX.'owners o ON o.owner_id=d.owner_id LEFT JOIN '.DB_PREFIX.'recorders r ON r.recorder_id = d.recorder_id LEFT JOIN '.DB_PREFIX.'hostings h ON h.hosting_id = d.hosting_id';
       $now=new DateTime(date('Y-m-d'));
       $this->db_con->OpenConnection();
       $res=mysql_query($sql);
       for($i=0;$i<mysql_num_rows($res);$i++)
       {
           $row=mysql_fetch_assoc($res);
           if($now>(new DateTime($row['date_of_end'])))
           {
               $row['overdue']=1;
           }
           $domens[]=$row;
            
       }
       $this->db_con->CloseConnection();
       return $domens;
    }
    public function GetDomenById($id)
    {
        $sql='SELECT d.domen_id,d.name as domen_name,d.date_of_end,d.status,d.comment,CONCAT(o.firstname," ",o.lastname) as owner,o.owner_id,r.name as reg_name,r.recorder_id,h.name as host_name,d.hosting_id FROM '.DB_PREFIX.'domens d LEFT JOIN '.DB_PREFIX.'owners o ON o.owner_id=d.owner_id LEFT JOIN '.DB_PREFIX.'recorders r ON r.recorder_id = d.recorder_id LEFT JOIN '.DB_PREFIX.'hostings h ON h.hosting_id = d.hosting_id WHERE d.domen_id=\''.$id.'\'';
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        $domen=mysql_fetch_assoc($res);
        $this->db_con->CloseConnection();
         $now= new DateTime(date('Y-m-d'));
       if($now>(new DateTime($row['date_of_end'])))
           {
               $domen['overdue']=1;
           }
        return $domen;
    
    }
    public function SaveDomen($domen)
    {
       
       $sql='UPDATE '.DB_PREFIX.'domens SET  date_of_end=\''.$domen['date_of_end'].'\',status=\''.$domen['status'].'\',comment=\''.$domen['comment'].'\' WHERE domen_id=\''.$domen['domen_id'].'\'';
       $this->db_con->OpenConnection();
       $res=mysql_query($sql);
       $this->db_con->CloseConnection();
    }
    public function GetDomenComponents()
    {
        $sql[]='SELECT hosting_id,name FROM '.DB_PREFIX.'hostings';
        $sql[]='SELECT recorder_id,name FROM '.DB_PREFIX.'recorders';
        $sql[]='SELECT owner_id,CONCAT(firstname," ",lastname) as name FROM '.DB_PREFIX.'owners'; 
       
        $this->db_con->OpenConnection();
        $res=mysql_query($sql[0]);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
                 $info['hostings'][]=mysql_fetch_assoc($res);    
        }
         $res=mysql_query($sql[1]);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
                 $info['recorders'][]=mysql_fetch_assoc($res);    
        }
         $res=mysql_query($sql[2]);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
                 $info['owners'][]=mysql_fetch_assoc($res);    
        }
        $this->db_con->CLoseConnection();
        return $info;
       
    }
    public function AddDomen($data)
    {
        
        $domen['name']=strip_tags($data['domen_name']);
        $domen['date_of_end']=strip_tags($data['date_of_end']);
        $domen['owner_id']=strip_tags($data['owner_id']);
        $domen['recorder_id']=strip_tags($data['recorder_id']);
        $domen['hosting_id']=strip_tags($data['hosting_id']);
        if($data['status']==1)
            $domen['status']=1;
        else 
            $domen['status']=0;
         $domen['comment']=strip_tags($data['comment']);
         
         $sql='INSERT INTO '.DB_PREFIX.'domens (name,date_of_end,status,comment,owner_id,recorder_id,hosting_id) VALUES'.
         '(\''.$domen['name'].'\', \''.$domen['date_of_end'].'\',\''.$domen['status'].'\',\''.$domen['comment'].'\', \''.$domen['owner_id'].'\',\''.$domen['recorder_id'].'\', \''.$domen['hosting_id'].'\')';
        $this->db_con->OpenConnection();
        mysql_query($sql);
        $this->db_con->CloseConnection();
        
        
    }
    public function DeleteDomen($id)
    {
        if($id=='') return;
        $sql='DELETE FROM '.DB_PREFIX.'domens WHERE domen_id=\''.$id.'\'';
        $this->db_con->OpenConnection();
        mysql_query($sql);
        $this->db_con->CloseConnection();
    }
}





?>