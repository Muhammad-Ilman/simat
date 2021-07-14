<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Suratkeluar extends BaseController
{
    protected 	$db, 
				$suratkeluar, 
				$instansi, 
				$kategori;
    
    public function __construct()
    {
        $this->db 		= \Config\Database::connect();
		$this->suratkeluar = $this->db->table('surat_keluar');
		$this->instansi = $this->db->table('instansi');
		$this->kategori = $this->db->table('kategori');    
    }
    
	public function index()
	{
        $status = ['Diupload', 'Dilihat', 'Diubah', 'Restored'];
        
		$this->suratkeluar->select('surat_keluar.id as sm_id,
		                           surat_keluar.nama as sm_nama,
		                           surat_keluar.slug_url as sm_slug,
		                           surat_keluar.status,
		                           lampiran,
		                           perihal,
		                           pengirim,
		                           instansi.nama as in_nama');
		$this->suratkeluar->join('instansi', 'instansi.id = surat_keluar.penerima');
		$this->suratkeluar->whereIn('status', $status);
		$this->suratkeluar->orderBy('sm_id', 'DESC');
		$result = $this->suratkeluar->get();
        
	//	dd($result->getResultArray());

		$data = [
			'title' => 'Data surat keluar - SIMAT',
			'suratkeluar'	=> $result->getResultArray(),
		     'History' => 0,
			'jumlah' => $this->suratkeluar->whereIn('status',$status)->countAllResults(),];

	
		return view('admin/surat_keluar/index', $data);
	}
	
	public function create()
	{
		//session(); dialihkan ke base BaseController !
		$data = [
			'title' => 'Tambahkan data surat keluar',
            'validation' => \Config\Services::validation(),
            'instansi' => $this->instansi->get()->getResult(),
            'kategori' => $this->kategori->get()->getResult(),
		];
		return view('admin/surat_keluar/create', $data);
	}
	
	public function save()
	{
		if (!$this->validate([

            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama atau Judul Surat Wajib diisi !'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Surat Wajib diisi !'
                ]
            ],
            'nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Surat Wajib diisi !'
                ]
            ],
            'lampiran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lampiran Surat Wajib diisi !'
                ]
            ],
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perihal Surat Wajib diisi !'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Surat Wajib diisi !'
                ]
            ],
            'tertanda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tertanda Surat Wajib diisi !'
                ]
            ],
            'tembusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tembusan Surat Wajib diisi !'
                ]
            ],
            'instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Instansi Pengirim Wajib diisi !'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Surat Wajib diisi !'
                ]
            ],
            
            'file_surat' => [
                'rules' => 'uploaded[file_surat]|max_size[file_surat,10240]|mime_in[file_surat,image/jpg,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => 'pilih file terlebih dahulu',
                    'max_size' => 'pilih file dibawah 10 mb',
                    'mime_in' => 'upload file gambar atau pdf'
                ]
                
            ]
            
        ])) {
        	
            return redirect()->to(base_url('/suratkeluar/create'))->withInput();
        }
        // dd($this->request->getVar());
          // ambil file
        $fileSurat = $this->request->getFile('file_surat');
          // nama file random
        $namaFile = $fileSurat->getRandomName();
          // pindahkan file ke folder assets/file
        $fileSurat->move('assets/file', $namaFile);
        
        
       // $slug_url = url_title($this->request->getVar('nama'), '-', true);
       // slug tukar jadi -> csrf_test_name
       
		$data = [
			'nama' => $this->request->getVar('nama'),
			'slug_url' => $this->request->getVar('csrf_test_name'),
			'tanggal' => $this->request->getVar('tanggal'),
			'nomor' => $this->request->getVar('nomor'),
			'lampiran' => $this->request->getVar('lampiran'),
			'perihal' => $this->request->getVar('perihal'),
			'deskripsi' => $this->request->getVar('deskripsi'),
			'tertanda' => $this->request->getVar('tertanda'),
			'tembusan' => $this->request->getVar('tembusan'),
			'file_surat' => $namaFile,
			'status' => 'Diupload',
			'kategori' => $this->request->getVar('kategori'),
			'tag' => $this->request->getVar('tag'),
			'penerima' => $this->request->getVar('instansi'),
			'pengirim' => user()->username,
			'created_at' => Time::now('Asia/Jakarta')
		];
		
		$this->suratkeluar->insert($data);
		
        session()->setFlashData('suratkeluar', 'kamu berhasil menambahkan surat masuk baru');
        
        return redirect()->to(base_url('/suratkeluar'));
	}
	
	public function detail($slug_url)
	{
		$update_status = [
			'status' => 'Dilihat'
		];
		$this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		$this->suratkeluar->update($update_status);
		$this->suratkeluar->select('surat_keluar.id as sm_id,
								   surat_keluar.nama as sm_nama,
								   surat_keluar.slug_url as sm_slug,
								   surat_keluar.deskripsi as sm_deskripsi,
								   surat_keluar.created_at as sm_created,
								   surat_keluar.updated_at as sm_updated,
								 surat_keluar.restore_at as sm_restored,
								   tanggal,
								   nomor,
								   lampiran,
								   perihal, 
								   tertanda,
								   tembusan,
								   file_surat,
								   status,
								   tag,
								   pengirim, 
								   instansi.nama as in_nama, 
								   kategori.nama as ka_nama');
		$this->suratkeluar->join('instansi', 'instansi.id = surat_keluar.penerima');
		$this->suratkeluar->join('kategori', 'kategori.id = surat_keluar.kategori');
		$this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		
		
		$result = $this->suratkeluar->get();
	//	dd($result->getResult());
		$data = [
			'title' => 'Detail surat Keluar - SIMAT',
			'surat_keluar'	=> $result->getRow(),
		];
		if (empty($data['surat_keluar'])) {
			return redirect()->to('/suratkeluar');
		}
		return view('admin/surat_keluar/detail', $data);
		
	}
	
	public function print($slug_url)
	{
		$this->suratkeluar->select('surat_keluar.id as sm_id,
								   surat_keluar.nama as sm_nama,
								   surat_keluar.slug_url as sm_slug,
								   surat_keluar.deskripsi as sm_deskripsi,
								   surat_keluar.created_at as sm_created,
								   surat_keluar.updated_at as sm_updated,
								   tanggal,
								   nomor,
								   lampiran,
								   perihal, 
								   tertanda,
								   tembusan,
								   file_surat,
								   status,
								   tag,
								   pengirim, 
								   instansi.nama as in_nama, 
								   kategori.nama as ka_nama');
		$this->suratkeluar->join('instansi', 'instansi.id = surat_keluar.penerima');
		$this->suratkeluar->join('kategori', 'kategori.id = surat_keluar.kategori');
		$this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		$result = $this->suratkeluar->get();
	//	dd($result->getResult());
		$data = [
			'surat_keluar'	=> $result->getRow(),
			'title' => 'Print surat keluar - SIMAT',
		];
		if (empty($data['surat_keluar'])) {
			return redirect()->to('/suratkeluar');
		}
		return view('admin/surat_keluar/print', $data);
		
	}

	public function download($slug_url)
	{
		$this->suratkeluar->select('file_surat');
		$this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		$result = $this->suratkeluar->get();
		$datanama = $result->getRow('file_surat');
		
		if (empty($datanama)) {
			return redirect()->to('/suratkeluar');
		}
		
		return $this->response->download('assets/file/'.$datanama,NULL);
	}
	
	public function trash($slug_url)
	{
		$data = [
			'title' => 'Hapus data surat'	
		];
		$deleteToHistory = [
		    'status' => 'Dihapus',
		    'deleted_at' => Time::now('Asia/Jakarta')
		];
		$this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		$this->suratkeluar->update($deleteToHistory);
		
		session()->setFlashData('suratkeluar', 'kamu berhasil menghapus satu surat masuk');
        
        return redirect()->to(base_url('/suratkeluar'));
	}
	
	public function restore($slug_url)
	{
		$data = [
			'title' => 'Restore data surat keluar'	
		];
		$deleteToHistory = [
		    'status' => 'Restored',
		    'restore_at' => Time::now('Asia/Jakarta')
		];
		$this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		$this->suratkeluar->update($deleteToHistory);
		
		session()->setFlashData('suratkeluar', 'kamu berhasil mengembalikan satu surat masuk');
        
        return redirect()->to(base_url('/suratkeluar'));
	}
	
	public function history()
	{
        $status = ['Dihapus'];
        
		$this->suratkeluar->select('surat_keluar.id as sm_id, surat_keluar.nama as sm_nama, lampiran, perihal,surat_keluar.status, pengirim, surat_keluar.slug_url as sm_slug, instansi.nama as in_nama, ');
		$this->suratkeluar->join('instansi', 'instansi.id = surat_keluar.penerima');
		$this->suratkeluar->whereIn('status', $status);
		$this->suratkeluar->orderBy('sm_id', 'DESC');
		$result = $this->suratkeluar->get();
        
	//	dd($result->getResultArray());
		$data = [
			'title' => 'Data surat masuk - SIMAT',
			'suratkeluar'	=> $result->getResultArray(),
			'History' => $this->suratkeluar->where('status', 'Dihapus')->countAllResults()
		];
		return view('admin/surat_keluar/history', $data);
	}
	
	public function delete($slug_url) 
	{
        $this->suratkeluar->select('surat_keluar.id as sm_id, surat_keluar.nama as sm_nama, lampiran, perihal,surat_keluar.status,file_surat, penerima, surat_keluar.slug_url as sm_slug,  ');
		
        $this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		$result = $this->suratkeluar->get();
        
		$suratkeluar = $result->getResultArray();
	//	dd($suratkeluar[0]['file_surat']);
		
      // jika gambar tidak sama dengan default.png
      if ($suratkeluar[0]['file_surat'] != 'default.png') {
        // hapus file
        unlink('assets/file/'. $suratkeluar[0]['file_surat']);
      }
      
      
        $this->suratkeluar->delete(['slug_url' => $slug_url]);
        session()->setFlashData('suratkeluar', 'Data surat berhasil dihapus');
        return redirect()->to(base_url('/suratkeluar/history'));
    }
    
    public function update($slug_url)
    {
        $this->suratkeluar->select('surat_keluar.id as sm_id,
								   surat_keluar.nama as sm_nama,
								   surat_keluar.deskripsi as sm_deskripsi,
								   surat_keluar.slug_url as sm_slug,
								   surat_keluar.created_at as sm_created,
								   surat_keluar.updated_at as sm_updated,
								   surat_keluar.restore_at as sm_restored,
								   tanggal,
								   nomor,
								   lampiran,
								   perihal, 
								   tertanda,
								   tembusan,
								   file_surat,
								   status,
								   tag,
								   penerima, 
								   instansi.nama as in_nama, 
								   kategori.nama as ka_nama');

        $this->suratkeluar->join('instansi', 'instansi.id = surat_keluar.penerima');
		$this->suratkeluar->join('kategori', 'kategori.id = surat_keluar.kategori');
		$this->suratkeluar->where('surat_keluar.slug_url', $slug_url);
		
		
		$result = $this->suratkeluar->get();
	//	dd($result->getResult());
        $data = [
			'title' => 'Edit data surat masuk',
            'validation' => \Config\Services::validation(),
            'instansi' => $this->instansi->get()->getResult(),
            'kategori' => $this->kategori->get()->getResult(),
         			'suratkeluar'	=> $result->getRow(),
		];
        return view('admin/surat_keluar/update', $data);
    }
    
    public function saveupdate()
    {
        	if (!$this->validate([

            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama atau Judul Surat Wajib diisi !'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Surat Wajib diisi !'
                ]
            ],
            'nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Surat Wajib diisi !'
                ]
            ],
            'lampiran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lampiran Surat Wajib diisi !'
                ]
            ],
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perihal Surat Wajib diisi !'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Surat Wajib diisi !'
                ]
            ],
            'tertanda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tertanda Surat Wajib diisi !'
                ]
            ],
            'tembusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tembusan Surat Wajib diisi !'
                ]
            ],
            'instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Instansi Pengirim Wajib diisi !'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Surat Wajib diisi !'
                ]
            ],
            
            'file_surat' => [
                'rules' => 'max_size[file_surat,10240]|mime_in[file_surat,image/jpg,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    
                    'max_size' => 'pilih file dibawah 10 mb',
                    'mime_in' => 'upload file gambar atau pdf'
                ]
                
            ]
            
        ])) {
        	
            return redirect()->to(base_url('/suratkeluar/update/'.$this->request->getVar('slug_url')))->withInput();
        }
       // dd($this->request->getVar());
          // ambil file
        $fileSurat = $this->request->getFile('file_surat');
          // nama file random
        //$namaFile = $fileSurat->getRandomName();
        
        if ($fileSurat->getError() == 4) {
            $namaFile = $this->request->getVar('lastfile');
        } else {
            unlink('assets/file/'. $this->request->getVar('lastfile'));
            $namaFile = $fileSurat->getRandomName();
              // pindahkan file ke folder assets/file
            $fileSurat->move('assets/file', $namaFile);
        }
        
    /*if ($this->request->getVar('lastfile') != 'default.png') {
        // hapus file lama
          unlink('assets/file/'. $this->request->getVar('lastfile'));
    }
            */
       // $slug_url = url_title($this->request->getVar('nama'), '-', true);
       // slug tukar jadi -> csrf_test_name
       
		$data = [
			'nama' => $this->request->getVar('nama'),
			'slug_url' => $this->request->getVar('csrf_test_name'),
			'tanggal' => $this->request->getVar('tanggal'),
			'nomor' => $this->request->getVar('nomor'),
			'lampiran' => $this->request->getVar('lampiran'),
			'perihal' => $this->request->getVar('perihal'),
			'deskripsi' => $this->request->getVar('deskripsi'),
			'tertanda' => $this->request->getVar('tertanda'),
			'tembusan' => $this->request->getVar('tembusan'),
			'file_surat' => $namaFile,
			'status' => 'Diubah',
			'kategori' => $this->request->getVar('kategori'),
			'tag' => $this->request->getVar('tag'),
			'pengirim' => user()->username,
			'penerima' => $this->request->getVar('instansi'),
			'updated_at' => Time::now('Asia/Jakarta')
		];
		$sluglama = $this->request->getVar('slug_url');
		
		$this->suratkeluar->where('surat_keluar.slug_url', $sluglama);

		$this->suratkeluar->update($data);
		
        session()->setFlashData('suratkeluar', 'kamu berhasil mengubah surat keluar ');
        
        return redirect()->to(base_url('/suratkeluar'));
    }
}
