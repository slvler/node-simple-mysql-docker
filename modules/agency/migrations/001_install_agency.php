<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Agency extends CI_Migration
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
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'discount' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				),
			'code' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				),
			'active' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0,
				),
			'created_date' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
				),
			));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('agency');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('agency');
	}

}