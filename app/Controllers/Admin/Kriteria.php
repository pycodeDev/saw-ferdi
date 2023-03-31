<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CrudModel;

class Kriteria extends BaseController
{

    public function __construct()
	{
		$this->crud = new CrudModel();
	}

	public function index()
	{
		$data['title'] = "SPK Penentu Jurusan - Kelola Kriteria";
        $data['data'] = $this->crud->read_all_data("tb_kriteria");

		return view('Content/Kriteria/Index', $data);
	}
	
    public function view_tambah_kriteria()
	{
		$data['title'] = "SPK Penentu Jurusan - Tambah Kriteria";
		return view('Content/Kriteria/TambahKriteria', $data);
	}

    public function store()
    {
        $data = $this->request->getPost();

        if ($this->crud->save_data('tb_kriteria', $data)) {
            session()->set("s_i_kriteria", "sukses");
            return redirect()->to('/kriteria');
        } else {
            session()->set("f_i_kriteria", "gagal");
            return redirect()->to('/kriteria/tambah');
        }
    }
}
