<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Contact extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'form' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'fullname' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'address' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'message' => array(
				'type' => 'TEXT',
			),
			'created_date' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
			),
			'lang' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('contact');
		
		// Page tablosuna sayfayı ekler
        $this->insert_default_page_contact();
	}

	public function down()
	{
		$this->dbforge->drop_table('contact');
	}

	public function insert_default_page_contact()
	{
		$data = array(
			'module' => "contact",
			'lang_id' => md5(date('YmdHis')),
			'title' => "İletişim",
			'header_img' => "",
			'list_img' => "",
			'summary' => "",
			'content' => "",
			'extra' => '[{"key":"","value":""}]',
			'description' => "",
			'keywords' => "",
			'lang' => "tr"
		);
		
		$this->db->insert('page', $data);
		
		// Rotes tablosuna sayfayı ekler
        $this->insert_default_route_contact($this->db->insert_id());
	}

	public function insert_default_route_contact($id)
	{
		$data = array(
			'real_url' => "contact/index/".$id,
			'seo_url' => "iletisim",
			'lang' => "tr",
		);
		
		$this->db->insert('routes', $data);
	}
}