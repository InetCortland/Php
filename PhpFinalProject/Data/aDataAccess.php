<?php


require_once '../Data/DataAccessMySQLi.php';




abstract class aDataAccess
{
    private static $m_DataAccess;

    public static function getInstance()
    {
        // singleton
        if(self::$m_DataAccess == null)
        {
            self::$m_DataAccess = new DataAccessMySQLi();
        }
        return self::$m_DataAccess;
    }

    public abstract function connectToDB();

    public abstract function closeDB();


}
?>
