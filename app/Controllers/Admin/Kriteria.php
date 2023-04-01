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
    
    public function view_edit_kriteria($id)
	{
		$data['title'] = "SPK Penentu Jurusan - Edit Kriteria";
        $data['data'] = $this->crud->select_1_cond("tb_kriteria", "id", $id);
		return view('Content/Kriteria/EditKriteria', $data);
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
    public function update($id)
	{
		$data = $this->request->getPost();
		$a['nama'] = $data['nama'];
		$a['kategori'] = $data['kategori'];
		$a['bobot'] = $data['bobot'];

		if ($this->crud->update_data_input('tb_kriteria', $a, 'id', $id)) {
			session()->set("s_u_kriteria", "Berhasil Ubah Data Kriteria");
			return redirect()->to('/kriteria');
		} else {
			session()->set('f_u_kriteria', "Gagal Ubah Data Kriteria");
			return redirect()->to("/kriteria/edit/$id");
		}
	}
}
