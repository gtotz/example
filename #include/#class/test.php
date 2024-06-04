<?php
    namespace App;
    use App\DB;

    class Test {
        private $db;
    
        public function __construct() {
            $this->db = new DB(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        }
    
        public function getSessions() {
            $data = $this->db->query('SELECT * FROM `sessions`');
            return $data;
        }
    }
?>