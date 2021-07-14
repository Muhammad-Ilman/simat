<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
	public function up()
	{
		
		$this->forge->addField([
                        'id'        => [
                                'type'           => 'INT',
                                'constraint'     => 25,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'slug_url'	=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'nama'     	=> [
                                'type'       	=> 'VARCHAR',
                                'constraint' 	=> '255',
                        ],
                        'deskripsi'	=> [
                        		'type'			=> 'TEXT',
                        ],
                        'created_at'=> [
                        		'type' 			=> 'datetime', 
                        		'null' 			=> true,
                        ],
            			'updated_at'=> [
            					'type' 			=> 'datetime', 
            					'null' 			=> true,
            			],
            			'deleted_at'=> [
            					'type' 			=> 'datetime', 
            					'null'			=> true
            			],
                ]);
        $this->forge->addKey('id', true);
       	$attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('kategori', FALSE, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('kategori', true);
	}
}
