<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Slider extends CI_Migration
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
			'order' => array(
				'type' => 'INT',
				'constraint' => 10,
				'default' => 0,
			),
			'lang_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'media' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'media_mobile' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE
			),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'video_type' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'description' => array(
				'type' => 'TEXT',
			),
			'btn_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'link' => array(
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
		$this->dbforge->create_table('slider');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('slider');
	}

}