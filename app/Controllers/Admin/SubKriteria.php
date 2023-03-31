<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CrudModel;

class SubKriteria extends BaseController
{

    public function __construct()
	{
		$this->crud = new CrudModel();
	}

    public function index()
    {
        $data['title'] = "Kelola Sub Kriteria - SPK Traknus";
        $data['kriteria'] = $this->crud->read_all_data("tb_kriteria");

        return view('Content/SubKriteria/Index', $data);
    }

    public function search()
    {
        $a = array();
        $id = $this->request->getPost('id');
        $sub_kriteria = $this->crud->solo_query("select * from tb_sub_kriteria tsk left join tb_kriteria tk on tsk.kriteria_id=tk.id where tsk.kriteria_id = $id");
        array_push($a, array('data' => $sub_kriteria, 'token' => csrf_hash()));
        echo json_encode($a);
    }

    public function add($id)
    {
        $data['title'] = "Kelola Sub Kriteria - SPK Traknus";
        $data['kriteria'] = $this->crud->select_1_cond("tb_kriteria", "id", $id);
        $data['id'] = $id;

        return view('Content/SubKriteria/TambahSubKriteria', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        if ($data["nilai"] == 1) {
            $data["kategori"] = "Sangat Kurang(SK)";
        }else if ($data["nilai"] == 2) {
            $data["kategori"] = "Kurang(K)";
        }else if ($data["nilai"] == 3) {
            $data["kategori"] = "Cukup(C)";
        }else if ($data["nilai"] == 4) {
            $data["kategori"] = "Baik(B)";
        }else if ($data["nilai"] == 5) {
            $data["kategori"] = "Sangat Baik(SB)";
        }else{
            session()->set("f_i_kriteria", "gagal");
            return redirect()->to('/sub/kriteria/tambah/'.$data["kriteria_id"]);
        }

        if ($this->crud->save_data('tb_sub_kriteria', $data)) {
            session()->set("s_i_kriteria", "sukses");
            return redirect()->to('/sub/kriteria');
        } else {
            session()->set("f_i_kriteria", "gagal");
            return redirect()->to('/sub/kriteria/tambah'.$data["kriteria_id"]);
        }
    }
}
