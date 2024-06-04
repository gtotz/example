<?php
    namespace App;

    use PDO;
    use PDOException;
    class DB {
        /**
        * The singleton instance
        *
        */
        static private $PDOInstance;
        private $host;
        private $port;
        private $user;
        private $pass;
        private $db;
        
        /**
        * Creates a PDO instance representing a connection to a database and makes the instance available as a singleton
        *
        * @param string $dsn The full DSN, eg: mysql:host=localhost;dbname=testdb
        * @param string $username The user name for the DSN string. This parameter is optional for some PDO drivers.
        * @param string $password The password for the DSN string. This parameter is optional for some PDO drivers.
        * @param array $driver_options A key=>value array of driver-specific connection options
        *
        * @return PDO
        */
        public function __construct($host, $user, $pass, $db, $port = '3306') {
            $this->host = $host;
            $this->port = $port;
            $this->user = $user;
            $this->pass = $pass;
            $this->db = $db;
            
            if(!self::$PDOInstance) {
                try {
                    self::$PDOInstance = new PDO('mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->db, $this->user, $this->pass);
                    //self::$PDOInstance = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->pass);
                }
                catch (PDOException $e) {
                    die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
                }
            }
            return self::$PDOInstance;
        }

        public static function getInstance($host, $user, $pass, $db, $port = '3306') {
            if (self::$PDOInstance === null) {
                new self($host, $user, $pass, $db, $port);
            }
            return self::$PDOInstance;
        }

    /**
        * Initiates a transaction
        *
        * @return bool
        */
        public function beginTransaction() {
            return self::$PDOInstance->beginTransaction();
        }
            
        /**
        * Commits a transaction
        *
        * @return bool
        */
        public function commit() {
            return self::$PDOInstance->commit();
        }

        /**
        * Fetch the SQLSTATE associated with the last operation on the database handle
        *
        * @return string
        */
        public function errorCode() {
            return self::$PDOInstance->errorCode();
        }
        
        /**
        * Fetch extended error information associated with the last operation on the database handle
        *
        * @return array
        */
        public function errorInfo() {
            return self::$PDOInstance->errorInfo();
        }
        
        /**
        * Execute an SQL statement and return the number of affected rows
        *
        * @param string $statement
        */
        public function exec($statement) {
            return self::$PDOInstance->exec($statement);
        }
        
        /**
        * Retrieve a database connection attribute
        *
        * @param int $attribute
        * @return mixed
        */
        public function getAttribute($attribute) {
            return self::$PDOInstance->getAttribute($attribute);
        }

        /**
        * Return an array of available PDO drivers
        *
        * @return array
        */
        public function getAvailableDrivers(){
            return Self::$PDOInstance->getAvailableDrivers();
        }
            
        /**
        * Prepares a statement for execution and returns a statement object
        *
        * @param string $statement A valid SQL statement for the target database server
        * @param array $driver_options Array of one or more key=>value pairs to set attribute values for the PDOStatement obj returned
        * @return PDOStatement
        */
        public function prepare ($statement, $driver_options=false) {
            if(!$driver_options) $driver_options=array();
            return self::$PDOInstance->prepare($statement, $driver_options);
        }
        
        public function query_single($sql) {
            $result = self::$PDOInstance->query($sql);
            $data = array();
            if($result !== false) {
                $data = $result->fetch(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function squery($statement, $array_condition) {
            $data = array();
            $PDOStatement = self::$PDOInstance->prepare($statement);
            $result = $PDOStatement->execute($array_condition);
            if($result !== false) {
                $data = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function squery_single($statement, $array_condition) {
            $data = array();
            $PDOStatement = self::$PDOInstance->prepare($statement);
            $result = $PDOStatement->execute($array_condition);
            if($result !== false) {
                $data = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function squery_cache_single($statement, $array_condition, $cache_key = '', $apc_ttl = 300) {
            $data = array();
            if(empty($cache_key)) {
                $PDOStatement = self::$PDOInstance->prepare($statement);
                $result = $PDOStatement->execute($array_condition);
                if($result !== false) {
                    $data = $PDOStatement->fetch(PDO::FETCH_ASSOC);
                }
            }
            elseif(apc_exists($cache_key)===false) {
                $PDOStatement = self::$PDOInstance->prepare($statement);
                $result = $PDOStatement->execute($array_condition);
                if($result!==false) {
                    $data = $PDOStatement->fetch(PDO::FETCH_ASSOC);
                }
                apc_store($cache_key, serialize($data), $apc_ttl); 
            }
            else
            {
                $data = unserialize(apc_fetch($cache_key));
            }
            return $data;
        }

        public function squery_cache($statement, $array_condition, $cache_key = '', $apc_ttl = 300) {
            $data = array();
            if(empty($cache_key)) {
                $PDOStatement = self::$PDOInstance->prepare($statement);
                $result = $PDOStatement->execute($array_condition);
                if($result !== false) {
                    $data = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            elseif(apc_exists($cache_key)===false) {
                $PDOStatement = self::$PDOInstance->prepare($statement);
                $result = $PDOStatement->execute($array_condition);
                if($result !== false) {
                    $data = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
                }
                apc_store($cache_key, serialize($data), $apc_ttl); 
            }
            else
            {
                $data = unserialize(apc_fetch($cache_key));
            }
            return $data;
        }

        public function supdate($statement, $array_condition) {
            $PDOStatement = self::$PDOInstance->prepare($statement);
            $PDOStatement->execute($array_condition);
            return true;
        }

        public function sdelete($statement, $array_condition) {
            $PDOStatement = self::$PDOInstance->prepare($statement);
            $affected_rows = $PDOStatement->execute($array_condition);
            return $affected_rows;
        }

        public function sinsert($statement, $array_condition) {
            try {
                $PDOStatement = self::$PDOInstance->prepare($statement);
                $inserted = $PDOStatement->execute($array_condition);
                return $inserted;
            } catch (PDOException $e) {
                return($e);
            }
        }
        
        /**
        * Executes an SQL statement, returning a result set as a PDOStatement object
        *
        * @param string $statement
        * @return PDOStatement
        */
        public function query($sql) {
            $result = self::$PDOInstance->query($sql);
            $data = array();
            if($result !== false) {
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }
        
        public function query_utf8($sql) {
            $data = array();
            self::$PDOInstance->exec("SET CHARACTER SET utf8");
            $result = self::$PDOInstance->query($sql);
            if($result !== false) {
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }
        
        public function queryAll($sql) {
            $result = self::$PDOInstance->query($sql);
            $data = array();
            if($result !== false) {
                $data = $result->fetchAll();
            }
            return $data;
        }

        public function squeryAllRow($statement, $array_condition) {
            $PDOStatement = self::$PDOInstance->prepare($statement);
            $result = $PDOStatement->execute($array_condition);
            $data = array();
            if($result !== false) {
                $data['result'] = $PDOStatement->fetchAll(PDO::FETCH_NUM);
                $data['count'] = $PDOStatement->rowCount();
            }
            return $data;
        }	

        public function squeryAllNew($statement, $array_condition) {
            $PDOStatement = self::$PDOInstance->prepare($statement);
            $result = $PDOStatement->execute($array_condition);
            $data = array();
            if($result !== false) {
                $data = $result->fetchAll(PDO::FETCH_NUM);
            }
            return $data;
        }

        public function queryAllRow($sql) {
            $result = self::$PDOInstance->prepare($sql);
            $result->execute();
            $data = array();
            if($result !== false) {
                $data['result'] = $result->fetchAll(PDO::FETCH_NUM);
                $data['count'] = $result->rowCount();
            }
            return $data;
        }

        public function queryAllNew($sql) {
            $result = self::$PDOInstance->query($sql);
            $data = array();
            if($result !== false) {
                $data = $result->fetchAll(PDO::FETCH_NUM);
            }
            return $data;
        }	

        function queryXLS($sql, $headerxls=1){
            $result = self::$PDOInstance->query($sql);
            $data = array();
            if($result !== false) {
                if($headerxls==1) {
                    $jumlahkolom = $result->columnCount() - 1;
                    foreach(range(0, $jumlahkolom) as $column_index) {
                        $kolom = $result->getColumnMeta($column_index);
                        $data[0][] = $kolom['name'];
                    }
                    $data2 = $result->fetchAll();
                    $data = array_merge($data, $data2);
                }
                else
                {
                    $data = $result->fetchAll();
                }
            }
            return $data;
        }

        public function insertAndGetId($sql) {
            self::$PDOInstance->exec($sql);
            return self::$PDOInstance->lastInsertId();
        }
        public function sinsertAndGetId($statement, $array_condition) {
            $PDOStatement = self::$PDOInstance->prepare($statement);
            $PDOStatement->execute($array_condition);
            return self::$PDOInstance->lastInsertId();
        }
        
        public function insert($sql) {
            self::$PDOInstance->exec($sql);
            return true;
        }
        
        public function update($sql) {
            self::$PDOInstance->exec($sql);
            return true;
        }
        
        public function delete($sql) {
            $affected_rows = self::$PDOInstance->exec($sql);
            return $affected_rows;
        }
        
        public function sanitize($input, $parameter_type=0) {
            return self::$PDOInstance->quote($input, $parameter_type);
        }

        /**
        * Returns the ID of the last inserted row or sequence value
        *
        * @param string $name Name of the sequence object from which the ID should be returned.
        * @return string
        */
        public function lastInsertId($name) {
            return self::$PDOInstance->lastInsertId($name);
        }
        public function lastInsertId2() {
            return self::$PDOInstance->lastInsertId();
        }
        
        /**
        * Execute query and return all rows in assoc array
        *
        * @param string $statement
        * @return array
        */
        public function queryFetchAllAssoc($statement) {
            return self::$PDOInstance->query($statement)->fetchAll(PDO::FETCH_ASSOC);
        }
        
        /**
        * Execute query and return one row in assoc array
        *
        * @param string $statement
        * @return array
        */
        public function queryFetchRowAssoc($statement) {
            return self::$PDOInstance->query($statement)->fetch(PDO::FETCH_ASSOC);
        }
        
        /**
        * Execute query and select one column only
        *
        * @param string $statement
        * @return mixed
        */
        public function queryFetchColAssoc($statement) {
            return self::$PDOInstance->query($statement)->fetchColumn();
        }
        
        /**
        * Quotes a string for use in a query
        *
        * @param string $input
        * @param int $parameter_type
        * @return string
        */
        public function quote($input, $parameter_type=0) {
            return self::$PDOInstance->quote($input, $parameter_type);
        }
        
        /**
        * Rolls back a transaction
        *
        * @return bool
        */
        public function rollBack() {
            return self::$PDOInstance->rollBack();
        }
        
        /**
        * Set an attribute
        *
        * @param int $attribute
        * @param mixed $value
        * @return bool
        */
        public function setAttribute($attribute, $value ) {
            return self::$PDOInstance->setAttribute($attribute, $value);
        }
    }
?>