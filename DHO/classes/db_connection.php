<?php

class db_connection
{
    private $connection;
    
   
    public function OpenConnection()
    {
        $this->connection=mysql_connect(DB_HOST,DB_USER,DB_PASS) or die ("message");
        mysql_select_db(DB_NAME);
    }   
    public function CloseConnection()
    {
        mysql_close($this->connection);
    }
}

?>
