<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKeluar extends Migration
{
	public function up()
	{
		$forge = \Config\Database::forge();
		
		$this->db->disableForeignKeyChecks();
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
                        'tanggal'  	=> [
                                'type'		 	=> 'VARCHAR',
                                'constraint' 	=> '100',
                        ],
                        'nomor' 	=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'lampiran'	=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'perihal'	=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'deskripsi'	=> [
                        		'type'			=> 'TEXT',
                        ],
                        'tertanda'	=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'tembusan'	=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'file_surat'=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'status' 	=> [
                        		'type' 			=> 'ENUM',
                        		'constraint'	=> ['Diupload','Dilihat', 'Diubah', 'Dihapus', 'Restored'],
                        		'default'		=> 'Diupload',
                        ],
                        'kategori'	=> [
                        		'type'			=> 'INT',
                        		'constraint'	=> 25,
                        		'unsigned'      => TRUE,
                        ],
                        'tag'		=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '500',
                        ],
                        'pengirim'	=> [
                        		'type'			=> 'VARCHAR',
                        		'constraint'	=> '255',
                        ],
                        'penerima'	=> [
                        		'type'			=> 'INT',
                        		'constraint'	=> 25,
                        		'unsigned'      => TRUE,
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
            			'restore_at'=> [
            					'type' 			=> 'datetime', 
            					'null'			=> true
            			],
                ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('penerima', 'instansi', 'id');
        $this->forge->addForeignKey('kategori', 'kategori', 'id');
		$this->db->enableForeignKeyChecks();
        $attributes = ['ENGINE' => 'InnoDB'];
		$this->forge->createTable('surat_keluar', true, $attributes);
	}

	public function down()
	{
		$this->forge->dropTable('surat_keluar', true);
	}
}
