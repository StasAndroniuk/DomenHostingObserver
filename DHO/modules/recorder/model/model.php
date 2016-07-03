<?php
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/config.php');
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/classes/db_connection.php');

class RecorderModel
{
    private $db_con;
    public function __construct()
    {
        $this->db_con=new db_connection();
    }
    
    public function GetRecorderList()
    {
        $sql='SELECT * FROM '.DB_PREFIX.'recorders';
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        for($i=0;$i<mysql_num_rows($res);$i++)
        {
            $recorders[]=mysql_fetch_assoc($res);
        }
        $this->db_con->CloseConnection();
        return $recorders;
        
    }
    public function SaveChanges($recorder)
    {
        $sql='UPDATE '.DB_PREFIX.'recorders SET name=\''.$recorder['name'].'\',login=\''.$recorder['login'].'\',pass=\''.$recorder['pass'].'\' WHERE recorder_id=\''.$recorder['recorder_id'].'\'';
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        $this->db_con->CloseConnection();
    }
    public function GetRecorderById($id)
    {
        $sql='SELECT * FROM '.DB_PREFIX.'recorders WHERE recorder_id=\''.$id.'\'';
        $this->db_con->OpenConnection();
        $res=mysql_query($sql);
        $recorder=mysql_fetch_assoc($res);
        $this->db_con->CloseConnection();
        return $recorder;
    }
    public function DeleteRecorder($id)
    {   
        $sql[]='DELETE FROM '.DB_PREFIX.'recorders WHERE recorder_id=\''.$id.'\'';
        $sql[]='UPDATE '.DB_PREFIX.'domens SET recorder_id="" WHERE recorder_id=\''.$id.'\'';
        $this->db_con->OpenConnection();
        ;
        foreach ($sql as $request) {
           $res=mysql_query($request);
        }
        $this->db_con->CloseConnection();
    }   
    public function AddRecorder($recorder)
    {
        $sql='INSERT INTO '.DB_PREFIX.'recorders (name,login,pass) VALUES(\''.$recorder['name'].'\',\''.$recorder['login'].'\',\''.$recorder['pass'].'\')';
        $this->db_con->OpenConnection();
        mysql_query($sql);
        $this->db_con->CloseConnection();

    }
    
}






?>