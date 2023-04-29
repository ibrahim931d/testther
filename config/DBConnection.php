<?php


class DBConnection{
    // the next comment is for ahmed DB if you want run it uncomment my code
    
    /*public $conn;
    public function __construct(){
        
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        if($conn->connect_errno){
            die("<h1>Connection Error</h1>");
        }
        // echo("Connection success");
        return $this->conn = $conn;}
        
        */


    //Ibrahim DB code
    public $DB_HOST="localhost";
    public $DB_USER="root";
    public $DB_PASSWORD="";
    public $DB_NAME="prayerprojectdb";
    public $connection;
    private $DB;
   
    public function openConnection()
    {
        $this->connection=new mysqli($this->DB_HOST,$this->DB_USER,$this->DB_PASSWORD,$this->DB_NAME);
        if($this->connection->connect_error)
        {
            die("<h1>Connection Error</h1>");
            return false;
        }
        else
        {
            return true;
        }
    }

    // is the same as openConnection() function but return MYSQLI insted of boolean
    public function openConnectionMYSQLIreturn()
    {
        $this->connection=new mysqli($this->DB_HOST,$this->DB_USER,$this->DB_PASSWORD,$this->DB_NAME);
        if($this->connection->connect_error)
        {
            die("<h1>Connection Error</h1>");
            return false;
        }
        else
        {
            return $this->connection;
        }
    }
    public function closeConnection()
    {
        if($this->connection)
        {
            $this->connection->close();
        }
        else
        {
            echo "Connection is not opened";
        }
    }
    public function select($query)
    {
        $result=$this->connection->query($query);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
            //return array to db
            
             return $result->fetch_all(MYSQLI_ASSOC);
        }

    }
    public function selectMYSQLI($query)
    {
        $result=$this->connection->query($query);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
            //return array to db
            
             return $result;
        }

    }
    
    public function insert($query)
    {
        $result=$this->connection->query($query);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
            //return id for inserted value
             return $this->connection->insert_id;
        }

    }
    
    public function delete($query)
    {
        $result=$this->connection->query($query);
        if(!$result)
        {
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        else
        {
             return $result;
        }

    }
    
    public function grepHalalResturent(){
        $DB=new DBConnection;
        $DB->openConnection();
        $query="select id, RestName,ResturantPlace,
        ResturantDescription,latitude,longitude from halalresturant;";
        $result=$DB->select($query);
        
        return $result;
    }
    public function grepFeedback(){
        $DB=new DBConnection;
        $DB->openConnection();
        $query="select subject,content from feedback;";
        $result=$DB->select($query);
    
        return $result;
    }
    public function grepAllUsers(){
        $DB=new DBConnection;
        $DB->openConnection();
        $query="select fname,lname,email,password,latitude,longitude from users;";
        $result=$DB->select($query);
    
        return $result;
    }
    public function grepSadaqat(){
        $DB=new DBConnection;
        $DB->openConnection();
        $query="select transaction_number,sender,amount,type from sadaqa;";
        $result=$DB->select($query);
    
        return $result;
    }
    public function grepHadith(){
        $DB=new DBConnection;
        $DB->openConnection();
        $query="select id as Hadith_Number,hadith from ahadith;";
        $result=$DB->select($query);
    
        return $result;
    }
    public function grepMosque(){
        $DB=new DBConnection;
        $DB->openConnection();
        $query="select id,Mosque_Name,Mosque_Place,Latitude,longitude from mosque;";
        $result=$DB->select($query);

        return $result;
    }
    public function assignFeedback(feedback $feedback)  
    {
            $this->DB=new DBConnection;
            $subj=$feedback->getSubject();
            $cont=$feedback->getContent();
            $this->DB->openConnection();
             $query="insert into feedback(subject,content)
             VALUES('$subj',
            '$cont');";
            if($this->DB->insert($query) != false){
                $this->DB->closeConnection();
                return true;
            }else{
                return false;
            }
           
    }


    
   

}









?>