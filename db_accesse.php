<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

class DB{
  private $USER = 'LibAdmin';
  private $PW = 'MyLib120';
  private $dnsinfo = "mysql:dbname=MyLibraly;host=localhost;charset=utf8";

  private function Connectdb(){
    try{
      $pdo = new PDO($this->dnsinfo,$this->USER,$this->PW);
      return $pdo;
    }catch(Exception $e){
      return false;
    }
  }

    public function executeSQL($sql,$array){
      try{
        if(!$pdo = $this->Connectdb())return false;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($array);
        return $stmt;

      }catch(Exception $e){
        return false;
      }
    }
}
 ?>
