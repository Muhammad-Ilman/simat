<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use Irsyadulibad\DataTables\DataTables;
use \Mpdf\Mpdf;

class Suratmasuk extends BaseController
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
    $status = ['Diupload', 'Dilihat', 'Diubah', 'Restored'];
        
		$this->suratmasuk->select('surat_masuk.id as sm_id, surat_masuk.nama as sm_nama, lampiran, perihal,surat_masuk.status, penerima, surat_masuk.slug_url as sm_slug, instansi.nama as in_nama');
		$this->suratmasuk->join('instansi', 'instansi.id = surat_masuk.pengirim');
		$this->suratmasuk->whereIn('status', $status);
		$this->suratmasuk->orderBy('sm_id', 'DESC');
		$result = $this->suratmasuk->get();
        
	//	dd($result->getResultArray());
	$status = ['Diupload','Dilihat', 'Diubah', 'Restored'];
	    
		$data = [
			'title' => 'Data surat masuk - SIMAT',
			'suratmasuk'	=> $result->getResultArray(),
		            
			'jumlah' => $this->suratmasuk->whereIn('status',$status)->countAllResults(),

	'History' => $this->suratmasuk->where('status', 'Dihapus')->countAllResults()
		];
		return view('admin/surat_masuk/index', $data);
	}
	
	public function create()
	{
		//session(); dialihkan ke base BaseController !
		$data = [
			'title' => 'Tambahkan data surat masuk',
            'validation' => \Config\Services::validation(),
            'instansi' => $this->instansi->get()->getResult(),
            'kategori' => $this->kategori->get()->getResult(),
			'History' => $this->suratmasuk->where('status', 'Dihapus')->countAllResults()
		];
		return view('admin/surat_masuk/create', $data);
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
        	
            return redirect()->to(base_url('/suratmasuk/create'))->withInput();
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
			'pengirim' => $this->request->getVar('instansi'),
			'penerima' => user()->username,
			'created_at' => Time::now('Asia/Jakarta')
		];
		
		$this->suratmasuk->insert($data);
		
        session()->setFlashData('suratmasuk', 'kamu berhasil menambahkan surat masuk baru');
        
        return redirect()->to(base_url('/suratmasuk'));
	}
	
	public function detail($slug_url)
	{
		$update_status = [
			'status' => 'Dilihat'
		];
		$this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		$this->suratmasuk->update($update_status);
		$this->suratmasuk->select('surat_masuk.id as sm_id,
								   surat_masuk.nama as sm_nama,
								   surat_masuk.slug_url as sm_slug,
								   surat_masuk.deskripsi as sm_deskripsi,
								   surat_masuk.created_at as sm_created,
								   surat_masuk.updated_at as sm_updated,
								 surat_masuk.restore_at as sm_restored,
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
		$this->suratmasuk->join('instansi', 'instansi.id = surat_masuk.pengirim');
		$this->suratmasuk->join('kategori', 'kategori.id = surat_masuk.kategori');
		$this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		
		
		$result = $this->suratmasuk->get();
	//	dd($result->getResult());
		$data = [
			'title' => 'Detail surat masuk - SIMAT',
			'surat_masuk'	=> $result->getRow(),
				'History' => $this->suratmasuk->where('status', 'Dihapus')->countAllResults()

		];
		if (empty($data['surat_masuk'])) {
			return redirect()->to('/suratmasuk');
		}
		return view('admin/surat_masuk/detail', $data);
		
	}
	
	public function print($slug_url)
	{
		$this->suratmasuk->select('surat_masuk.id as sm_id,
								   surat_masuk.nama as sm_nama,
								   surat_masuk.slug_url as sm_slug,
								   surat_masuk.deskripsi as sm_deskripsi,
								   surat_masuk.created_at as sm_created,
								   surat_masuk.updated_at as sm_updated,
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
		$this->suratmasuk->join('instansi', 'instansi.id = surat_masuk.pengirim');
		$this->suratmasuk->join('kategori', 'kategori.id = surat_masuk.kategori');
		$this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		$result = $this->suratmasuk->get();
	//	dd($result->getResult());
		$data = [
			'surat_masuk'	=> $result->getRow(),
			'title' => 'Print surat masuk - SIMAT',
		];
		if (empty($data['surat_masuk'])) {
			return redirect()->to('/suratmasuk');
		}
		return view('admin/surat_masuk/print', $data);
		
	}

	public function download($slug_url)
	{
		$this->suratmasuk->select('file_surat');
		$this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		$result = $this->suratmasuk->get();
		$datanama = $result->getRow('file_surat');
		
		if (empty($datanama)) {
			return redirect()->to('/suratmasuk');
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
		$this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		$this->suratmasuk->update($deleteToHistory);
		
		session()->setFlashData('suratmasuk', 'kamu berhasil menghapus satu surat masuk');
        
        return redirect()->to(base_url('/suratmasuk'));
	}
	
	public function restore($slug_url)
	{
		$data = [
			'title' => 'Restore data surat'	
		];
		$deleteToHistory = [
		    'status' => 'Restored',
		    'restore_at' => Time::now('Asia/Jakarta')
		];
		$this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		$this->suratmasuk->update($deleteToHistory);
		
		session()->setFlashData('suratmasuk', 'kamu berhasil mengembalikan satu surat masuk');
        
        return redirect()->to(base_url('/suratmasuk'));
	}
	
	public function history()
	{
        $status = ['Dihapus'];
        
		$this->suratmasuk->select('surat_masuk.id as sm_id, surat_masuk.nama as sm_nama, lampiran, perihal,surat_masuk.status, penerima, surat_masuk.slug_url as sm_slug, instansi.nama as in_nama, ');
		$this->suratmasuk->join('instansi', 'instansi.id = surat_masuk.pengirim');
		$this->suratmasuk->whereIn('status', $status);
		$this->suratmasuk->orderBy('sm_id', 'DESC');
		$result = $this->suratmasuk->get();
        
	//	dd($result->getResultArray());
		$data = [
			'title' => 'Data surat masuk - SIMAT',
			'suratmasuk'	=> $result->getResultArray(),
			'History' => $this->suratmasuk->where('status', 'Dihapus')->countAllResults()
		];
		return view('admin/surat_masuk/history', $data);
	}
	
	public function delete($slug_url) 
	{
        $this->suratmasuk->select('surat_masuk.id as sm_id, surat_masuk.nama as sm_nama, lampiran, perihal,surat_masuk.status,file_surat, penerima, surat_masuk.slug_url as sm_slug,  ');
		
        $this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		$result = $this->suratmasuk->get();
        
		$suratmasuk = $result->getResultArray();
	//	dd($suratmasuk[0]['file_surat']);
		
      // jika gambar tidak sama dengan default.png
      if ($suratmasuk[0]['file_surat'] != 'default.png') {
        // hapus file
        unlink('assets/file/'. $suratmasuk[0]['file_surat']);
      }
      
      
        $this->suratmasuk->delete(['slug_url' => $slug_url]);
        session()->setFlashData('suratmasuk', 'Data surat berhasil dihapus');
        return redirect()->to(base_url('/suratmasuk/history'));
    }
    
    public function update($slug_url)
    {
        $this->suratmasuk->select('surat_masuk.id as sm_id,
								   surat_masuk.nama as sm_nama,
								   surat_masuk.slug_url as sm_slug,
								   surat_masuk.deskripsi as sm_deskripsi,
								   surat_masuk.created_at as sm_created,
								   surat_masuk.updated_at as sm_updated,
								   surat_masuk.restore_at as sm_restored,
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

        $this->suratmasuk->join('instansi', 'instansi.id = surat_masuk.pengirim');
		$this->suratmasuk->join('kategori', 'kategori.id = surat_masuk.kategori');
		$this->suratmasuk->where('surat_masuk.slug_url', $slug_url);
		
		
		$result = $this->suratmasuk->get();
	//	dd($result->getResult());
        $data = [
			'title' => 'Edit data surat masuk',
            'validation' => \Config\Services::validation(),
            'instansi' => $this->instansi->get()->getResult(),
            'kategori' => $this->kategori->get()->getResult(),
         			'suratmasuk'	=> $result->getRow(),
			'History' => $this->suratmasuk->where('status', 'Dihapus')->countAllResults()
		];
        return view('admin/surat_masuk/update', $data);
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
        	
            return redirect()->to(base_url('/suratmasuk/update/'.$this->request->getVar('slug_url')))->withInput();
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
			'pengirim' => $this->request->getVar('instansi'),
			'penerima' => user()->username,
			'updated_at' => Time::now('Asia/Jakarta')
		];
		$sluglama = $this->request->getVar('slug_url');
		
		$this->suratmasuk->where('surat_masuk.slug_url', $sluglama);

		$this->suratmasuk->update($data);
		
        session()->setFlashData('suratmasuk', 'kamu berhasil mengubah surat masuk ');
        
        return redirect()->to(base_url('/suratmasuk'));
    }
}
