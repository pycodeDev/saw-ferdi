<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CrudModel;

class Alternatif extends BaseController
{

    public function __construct()
	{
		$this->crud = new CrudModel();
	}

    public function index()
    {
        $data['title'] = "SPK Penentu Jurusan - Kelola Alternatif";
        $data['data'] = $this->crud->read_all_data("tb_alternatif");

		return view('Content/Alternatif/Index', $data);
    }

    public function add()
	{
		$data['title'] = "SPK Penentu Jurusan - Tambah Alternatif";
		return view('Content/Alternatif/TambahAlternatif', $data);
	}

    public function store()
    {
        $data = $this->request->getPost();

        if ($this->crud->save_data('tb_alternatif', $data)) {
            session()->set("s_i_kriteria", "sukses");
            return redirect()->to('/alternatif');
        } else {
            session()->set("f_i_kriteria", "gagal");
            return redirect()->to('/alternatif/tambah');
        }
    }
}
