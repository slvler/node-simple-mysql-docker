<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Season extends CI_Migration
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
			'start_date' => array(
				'type' => 'DATE',
				'null' => FALSE,
				),
			'end_date' => array(
				'type' => 'DATE',
				'null' => FALSE,
				),
			'lang_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
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
		$this->dbforge->create_table('season');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('season');
	}

}