<?php


class Validation
{
    public static function isEmail($email)
    {
    	return empty($email) OR preg_match('/^[a-z0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z0-9]+[._a-z0-9-]*\.[a-z0-9]+$/', $email);
    }
    public static function IsId($id)
    {
      return empty($id) OR preg_match('/^[0-9]+$/',$id);
    }
    public static function IsName($name)
    {
         return empty($name) OR preg_match('/^[a-zA-Zа-яА-Я]+$/ui',$name);
    }
    public static function IsPhone($phone)
    {
      return empty($phone) OR preg_match('/^[0-9]+$/',$phone);
    }
}



?>