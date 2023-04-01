<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CrudModel;

class Perangkingan extends BaseController
{

    public function __construct()
	{
		$this->crud = new CrudModel();
	}

    public function index()
    {
        $data['title'] = "SPK Penentu Jurusan - Kelola Data Rank";
        $data['jml'] = $this->crud->num_rows('tb_perangkingan');
        $data['rank'] = $this->crud->data_rank();
        return view('Content/Rank/Index', $data);
    }

    public function add($id)
    {
        $data['alternatif'] = $this->crud->read_data_all_where1('tb_alternatif', true, 'id', $id);
        $data['d_alter'] = $this->crud->data_rank_alter($id);
        $data['title'] = "SPK Penentu Jurusan - Tambah Data Rank";
        $data['form'] = $this->crud->data_form();
        return view('Content/Rank/TambahRank', $data);
    }

    public function store($id)
    {
        $data = $this->request->getPost();

        if ($this->crud->save_data_rank('tb_perangkingan', $id, $data)) {
            session()->set("s_i_perangkingan", "sukses");
            return redirect()->to('/rank');
        } else {
            session()->set("f_i_perangkingan", "gagal");
            return redirect()->to('/rank/add/'.$id);
        }
    }

    public function saw()
    {
        $this->crud->persiapan();
        $data['rank'] = $this->crud->solo_query("SELECT ta.nama, th.hasil from tb_hasil th left join tb_alternatif ta on th.id_alter=ta.id order by th.hasil desc");
		$data['title'] = "Data Rank";
		return view('Content/Rank/Eksekusi', $data);
    }
}
