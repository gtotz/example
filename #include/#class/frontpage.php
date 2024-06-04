<?php
    namespace App;
    use App\DB;

    class frontPage {
        private $db;
        private $tbl_chef = 'chef';
        private $tbl_cake = 'cake';
    
        public function __construct() {
            $this->db = new DB(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        }
    
        public function select_table($table, $field, $where, $order, $limit){
			$sql = "SELECT $field FROM $table $where $order $limit";
			$data = $this->db->queryFetchAllAssoc($sql);
			return $data;
		}

        public function select_chef($field, $where, $order, $limit){
            $data = $this->select_table($this->tbl_chef, $field, $where, $order, $limit);
            return $data;
        }

        public function select_cake($field, $where, $order, $limit){
            $data = $this->select_table($this->tbl_cake, $field, $where, $order, $limit);
            return $data;
        }

        public function cake_byid($id){
            $sql = "SELECT * FROM ".$this->tbl_cake." WHERE id = ?";
			$data = $this->db->squery_single($sql, array($id));
			return $data;
        }
    }
?>