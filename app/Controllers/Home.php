<?php

namespace App\Controllers;
use \Mpdf\Mpdf;
class Home extends BaseController
{
	
	public function index()
	{
		return view('auth/login');
	}
	public function prints()
	{
		
		$mpdf = new \Mpdf\Mpdf();
	
		$datav = view('admin/surat_masuk/detail');
		
		$mpdf->charset_in = 'UTF-8';
		$mpdf->WriteHTML($datav);
		$mpdf->Output("welcome.pdf" ,'I');
exit;
	}
	public function register()
	{
		return view('auth/register');
	}
}
