<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Reservation extends CI_Migration
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
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'surname' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '127',
			),
			'city' => array(
				'type' => 'VARCHAR',
				'constraint' => '127',
			),
			'town' => array(
				'type' => 'VARCHAR',
				'constraint' => '127',
			),
			'address' => array(
				'type' => 'TEXT'
			),
			'last_login' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
			),
			'created_date' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
			),
			'secret_key' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'active' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 1,
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('reservation');
	}

	public function down()
	{
		$this->dbforge->drop_table('reservation');
	}
}