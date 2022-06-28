<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Direct_Payment extends CI_Migration
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
			'description' => array(
				'type' => 'TEXT',
				),
			'price' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'token' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'status' => array(
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
		$this->dbforge->create_table('direct_payment');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('direct_payment');
	}

}