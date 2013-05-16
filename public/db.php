<?
  class db{
    protected $db = "practice";
    protected $user = "root";
    protected $pass = "";
    protected $host = "localhost";
    protected $connection = false;

    public function __construct(){
      if($this->connection = $this->connect()){
        $this->create_table();
      }

    }

    public function connect(){
      if($connect = mysqli_connect($this->host,$this->user,$this->pass,$this->db)) return $connect;
        else return false;
    }

    public function create_table(){
      $sql = 'CREATE TABLE people (first_name CHAR(30),surname CHAR(30),email CHAR(30))';
      if(mysqli_query($this->connection,$sql)) return true;
        else return false;
    }

    public function insert($array,$table){
      $total = count($array);
      $i = 1;
      $sql = 'INSERT INTO `'.$table.'` (';
        foreach($array as $column=>$value){
          if($i == $total) $sql .= $column;
            else $sql .= $column.",";          
          $i++;
        }
      $sql .= ') VALUES (';
      $i = 1;
        foreach($array as $column=>$value){
          if($i == $total) $sql .= "'".$value."'";
            else $sql .= "'".$value."',";
          $i++;
        }
      $sql .=');';
      if($result = mysqli_query($this->connection,$this->escape_string($sql))) return true;
        else return false;
    }

    public function posted_data($array){
      $errors = array();
      foreach($array as $column=>$field){
        if(empty($field)) $errors[] = $column." is empty";
      }

      if(empty($errors)) return $array;
        else $this->show_errors($errors);
    }

    public function show_errors($array){
      foreach($array as $error){
        echo "<span class='error'>".$error."</span><br>";
      }
    }

    public function escape_string($str){
      return mysqli_real_escape_string($this->connection,$str);
    }   
  }
?>