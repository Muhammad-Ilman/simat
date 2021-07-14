<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected 	$db, 
				$suratmasuk, 
				$instansi, 
				$kategori;
				
	public function __construct()
	{
		$this->db 		= \Config\Database::connect();
		$this->suratmasuk = $this->db->table('surat_masuk');
		$this->instansi = $this->db->table('instansi');
		$this->kategori = $this->db->table('kategori');
	}
	
	public function index()
	{
	    
		$data = [
			'title' => 'Dashboard',
			'jumlah' => $this->suratmasuk->where('status','Diupload')->countAllResults(),
			'History' => $this->suratmasuk->where('status', 'Dihapus')->countAllResults()
		];
		
		return view('admin/dashboard', $data);
	}
	public function user()
	{
		$data = [
			'title' => 'User Management'
		];
		
		return view('admin/user-manage', $data);
	}
}
