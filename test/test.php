<?php
	class DB_Test extends DB {
		public function __construct($name) {
			parent::__construct("sqlite:" . $name . ".sqlite");
		}
		
		public function getData() {
			return $this->query("SELECT * FROM test");
		}
	}
	
	class APP_Test extends APP {
		protected $db = null;
		protected $template = null;
		protected $get_table = array(
			"/" => "test",
			"/a" => "test",
			"/b" => "test_redirect",
		);
		
		public function __construct() {
			parent::__construct();
			$this->db = new DB_Test("test");
			$this->template = new XML();
			$this->template->setParameter("LANGUAGE", "cz");
			$this->template->setParameter("BASE", $this->BASE);
			$this->template->addFilter(new FILTER_TYPO());
			$this->template->addFilter(new FILTER_NBSP());
			$this->template->addFilter(new FILTER_FRACTIONS());
			
			$this->dispatch();
		}

		protected function test() {
			$this->template->setTemplate("xsl/test.xsl");
			$str = "3/4 -> <- <-> => <= <=> >> << -- --- 640x480 (c) (tm) (r) 1/2 a1/2 11/2 1/2";
			$data = array(
				"root"=>array(
					"id"=>"whatever",
					""=>$str,
					"doe"=>"<em>text with html markup</em>",
					"data"=>$this->db->getData()
				)
			);
			$this->template->setData($data);
			echo $this->template->toString();
		}
		
		protected function test_redirect() {
			$this->redirect("/a");
		}
		
		protected function error($code) {
			parent::error($code);
			echo "<h1>Error $code</h1>";
		}
	}
?>
