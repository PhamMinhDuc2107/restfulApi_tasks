<?php
   class Database {
      private $db_host;
      private $db_name;
      private $db_user;
      private $db_password;
      public function connect()
   {
      $this->db_host = "localhost";
      $this->db_name="restful_api";
      $this->db_user= "root";
      $this->db_password= "";
      try {
         $string = "mysql:hostname=".$this->db_host.";dbname=".$this->db_name;
         $con = new PDO($string,$this->db_user,$this->db_password);
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $con;
      }catch(PDOException $e)
      {
         echo "". $e->getMessage();
      }
   }
   }
?>