<?php
	class BazaPodataka{
		public $db_F ;
		public $Num;

		/* 
			KONSTRUKTORI I DEKONSTRUKTORI
		*/
		public function __construct($query = ""){
			$this->konekt();
			if($query != "") $this->q($query);
		}
		public function __destruct(){ $this->diskonekt(); }

		/*
			CONNECT i DISCONNECT
		*/
		private function konekt() { 
				mysql_connect("localhost", "adpzid_user", "adpzid_pass") or die("Greska sa bazom (1)");
				//mysql_connect("mysql15.000webhost.com", "a4763871_root", "root1234") or die("Greska sa bazom (1)");
				//mysql_select_db("a4763871_ezm") or die("Greska sa bazom (2)");
				mysql_select_db("evropazamlade_") or die("Greska sa bazom (2)");
				mysql_query("SET NAMES UTF8");
		}
		private function diskonekt(){ mysql_close(); }

		/*
			FUNKCIJE
		*/
		public function q($query){
			$db_R = mysql_query($query) or die("Greska sa upitom! q");
			$this->db_F= mysql_fetch_array($db_R, MYSQL_ASSOC);
			return $this->db_F;
		}
		public function qMul($query, $izbroj = false){
			$db_R = mysql_query($query) or die("Greska sa upitom! qMul ");
			if($izbroj) { $this->Num = mysql_num_rows($db_R);  } 
			return $db_R;
		}

		function e($query){
			mysql_query($query) or die("Greska sa upitom! e "  .mysql_error());
		}
	}
?>