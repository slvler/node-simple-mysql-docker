<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Menu extends CI_Migration
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
			'parent' => array(
				'type' => 'INT',
				'constraint' => 10
			),
			'order' => array(
				'type' => 'INT',
				'constraint' => 10,
				'default' => 0,
			),
			'lang_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'list_img' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			),
			'icon' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'content' => array(
				'type' => 'TEXT',
			),
			'url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'target' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'lang' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			),
			'active' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 1,
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('menu');
		
		// Default değerlerin girileceği fonksiyonu çalıştırır
        $this->insert_default();
	}

	public function down()
	{
		$this->dbforge->drop_table('menu');
	}

	public function insert_default()
	{
		$data = array(
			'parent' => 0,
			'lang_id' => md5(date('YmdHis')),
			'title' => "ANA MENÜ",
			'url' => "",
			'target' => "",
			'lang' => "tr"
		);
		
		$this->db->insert('menu', $data);
	}
}