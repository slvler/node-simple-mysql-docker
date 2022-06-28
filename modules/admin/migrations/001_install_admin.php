<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Admin extends CI_Migration
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
			'user' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'power' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'default' => 'standart',
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');
		
		// Default değerlerin girileceği fonksiyonu çalıştırır
        $this->insert_default();
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}

	public function insert_default()
	{
		$data = array(
			'user' => "root",
			'password' => md5("egegen"),
			'power' => "root"
		);
		
		$this->db->insert('users', $data);
		
		// Language migrationunu çalıştırır
        $this->up_language();
	}
	
	public function up_language()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'lang' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			),
			'language' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'default' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('language');
		
		// Default değerlerin girileceği fonksiyonu çalıştırır
        $this->insert_default_language();
	}
	
	public function down_language()
	{
		$this->dbforge->drop_table('language');
	}

	public function insert_default_language()
	{
		$data = array(
			'lang' => "tr",
			'language' => "Türkçe",
			'default' => 1
		);
		
		$this->db->insert('language', $data);
		
		// Settings migrationunu çalıştırır
        $this->up_settings();
	}
	
	public function up_settings()
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
			'logo' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'logo2' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'description' => array(
				'type' => 'TEXT',
			),
			'keywords' => array(
				'type' => 'TEXT',
			),
			'google_analytics' => array(
				'type' => 'TEXT',
			),
			'yandex_metrica' => array(
				'type' => 'TEXT',
			),
			'smtp_host' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'smtp_port' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'smtp_user' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'smtp_pass' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'smtp_to' => array(
				'type' => 'TEXT',
			),
			'social_facebook_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'social_instagram_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'social_twitter_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'social_youtube_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'social_googleplus_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'social_linkedin_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'social_pinterest_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'footer_text' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'search_module' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'page_cache' => array(
				'type' => 'INT',
				'constraint' => 1,
			),
			'css_js_cache' => array(
				'type' => 'INT',
				'constraint' => 1,
			),
			'lang' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('settings');
		
		// Default değerlerin girileceği fonksiyonu çalıştırır
        $this->insert_default_settings();
	}
	
	public function down_settings()
	{
		$this->dbforge->drop_table('settings');
	}

	public function insert_default_settings()
	{
		$data = array(
			'title' 		=> "Egegen CMS",
			'smtp_host' 	=> "mail.egegeninternet.com",
			'smtp_port' 	=> "587",
			'smtp_user' 	=> "smtp@egegeninternet.com",
			'smtp_pass' 	=> "SmTp:4528+",
			'smtp_to'		=> "noreply@egegeninternet.com",
			'footer_text'	=> "&copy; Egegen",
			'lang'			=> "tr"
		);
		
		$this->db->insert('settings', $data);
		
		// Routes migrationunu çalıştırır
        $this->up_routes();
	}
	
	public function up_routes()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'real_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'seo_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'lang' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('routes');
		
		// Page migrationunu çalıştırır
        $this->up_pages();
	}
	
	public function down_routes()
	{
		$this->dbforge->drop_table('routes');
	}
	
	public function up_pages()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'module' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
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
				'type' => 'TEXT',
			),
			'extra' => array(
				'type' => 'TEXT',
			),
			'description' => array(
				'type' => 'TEXT',
			),
			'keywords' => array(
				'type' => 'TEXT',
			),
			'updated_date' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
			),
			'lang' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('page');
		
		// Static lang migrationunu çalıştırır
        $this->up_static_lang();
	}
	
	public function down_pages()
	{
		$this->dbforge->drop_table('page');
	}
	
	public function up_static_lang()
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
			'values' => array(
				'type' => 'TEXT',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('static_lang');
	}
	
	public function down_static_lang()
	{
		$this->dbforge->drop_table('static_lang');
	}
}