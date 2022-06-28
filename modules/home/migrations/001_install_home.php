<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Home extends CI_Migration
{
	public function up()
	{
		// Page tablosuna sayfayı ekler
        $this->insert_default_page_home();
	}

	public function down()
	{
		$this->dbforge->drop_table('contact');
	}

	public function insert_default_page_home()
	{
		$data = array(
			'module' => "home",
			'lang_id' => md5(date('YmdHis')),
			'title' => "Ana Sayfa",
			'header_img' => "",
			'list_img' => "",
			'summary' => "",
			'content' => "",
			'extra' => "",
			'description' => "",
			'keywords' => "",
			'lang' => "tr"
		);
		
		$this->db->insert('page', $data);
	}
}