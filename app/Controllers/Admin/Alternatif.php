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

    public function edit($id)
	{
		$data['title'] = "SPK Penentu Jurusan - Edit Alternatif";
        $data['alternatif'] = $this->crud->select_1_cond("tb_alternatif", "id", $id);
		return view('Content/Alternatif/EditAlternatif', $data);
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

    public function update()
	{
		$data = $this->request->getPost();
		$a['nama'] = $data['nama'];
		$a['id'] = $data['id'];
        $id = $data['id'];

		if ($this->crud->update_data_input('tb_alternatif', $a, 'id', $id)) {
			session()->set("s_u_kriteria", "Berhasil Ubah Data Kriteria");
			return redirect()->to('/alternatif');
		} else {
			session()->set('f_u_kriteria', "Gagal Ubah Data Kriteria");
			return redirect()->to("/alternatif/edit/$id");
		}
	}

    public function delete($id)
    {
        if ($this->crud->delete_data('tb_alternatif', "id", $id)) {
            $this->crud->delete_data('tb_perangkingan', "id_alter", $id);
            $this->crud->delete_data('tb_hasil', "id_alter", $id);
			session()->set("s_d_subkriteria", "Berhasil Menghapus Data Alternatif");
			return redirect()->to('/alternatif');
		} else {
			session()->set("f_d_subkriteria", "Gagal Menghapus Data Alternatif");
			return redirect()->to('/alternatif');
		}
    }
}
