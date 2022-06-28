<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Content extends CI_Migration
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
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'header_img' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			),
			'list_img' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
			),
			'summary' => array(
				'type' => 'TEXT',
			),
			'content' => array(
				'type' => 'LONGTEXT',
			),
			'description' => array(
				'type' => 'TEXT',
			),
			'keywords' => array(
				'type' => 'TEXT',
			),
			'extra' => array(
				'type' => 'TEXT',
			),
			'created_date' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
			),
			'updated_date' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
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
		$this->dbforge->create_table('content');
		
		// Content galeri migrationunu çalıştırır
        $this->up_content_gallery();
	}

	public function down()
	{
		$this->dbforge->drop_table('content');
	}
	
	public function up_content_gallery()
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
			'url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'content' => array(
				'type' => 'TEXT',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('content_gallery');
	}

	public function down_content_gallery()
	{
		$this->dbforge->drop_table('content_gallery');
	}
}