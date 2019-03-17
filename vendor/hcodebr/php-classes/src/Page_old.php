<?php

namespace Hcode;

use Rain\Tpl;

class Page{

	private $tpl;
	private $option = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,		
		"data"=>[]
	];

	public function __construct($opts = array()){

		$this->options = array_merge($this->defaults, $opts);
		
		$config = array(
			"base_url"		=>null,
			"tpl_dir"       => $_SERVER['DOCUMENT_ROOT']."/views/",
			"cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
			"debug"			=> false
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");

	}

	public function __destruct(){

		$this->tpl->draw("footer");

	}

	private function setData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
	}

	public function setTpl($tplname, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($tplname, $returnHTML);
	}

	
}

?>