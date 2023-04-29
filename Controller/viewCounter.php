<?php
/*

class viewCounter{

private static function __construct(){
}


public function countViews(){
    isset($_SESSION['views']) ? $_SESSION['views']++ : $_SESSION['views'] = 1;
}

}*/
class Counter{
        public static $count = 0;
        private static $instance = null;


        private function __construct() {}

        public static function getInstance() {
            if (self::$instance == null) {
           
  
                    if (self::$instance == null) {
                        self::$instance = new Counter();
                    }

                
            }
            return self::$instance;
        }

        public static function addOnce() {
            self::$count++;
            
}
}
?>