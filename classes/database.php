<?php
	class dbConnection{
		protected $db_conn;
		private $db_name = "ipad";
		private $db_user = "root";
		private $db_pass = "root";
		private $db_host = "localhost";
		private $db_port = "3306";

		function connect(){
			try{
				$this->db_conn = new PDO("mysql:host=$this->db_host;port=$this->db_port;dbname=$this->db_name","$this->db_user","$this->db_pass");
				return $this->db_conn;
			}catch(PDOException $e){
				return $e->getMessage();
			}	
		}
	}