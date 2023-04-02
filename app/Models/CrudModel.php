<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
    public function save_data($table, $data)
	{
		return $this->db->table($table)->insert($data);
	}

	public function read_all_data($table)
	{
		return $this->db->table($table)->get()->getResultArray();
	}

	public function select_1_cond($table, $param = "id", $id = 1)
	{
		return $this->db->table($table)->where([$param => $id])->get()->getResultArray();
	}

	public function update_data_input($table, $data, $param, $id)
	{
		return $this->db->table($table)->update($data, [$param => $id]);
	}

	public function delete_truncate($table)
	{
		return $this->db->table($table)->truncate();
	}

    public function delete_data($table, $param = "id", $id = 1)
	{
		return $this->db->table($table)->delete([$param => $id]);
	}

	public function solo_query($query)
	{
		return $this->db->query($query)->getResultArray();
	}

    public function num_rows($table, $where = false, $w_param = 'id', $id = 1, $select = '*', $like = false)
    {
        if ($where == false and $like == false) {
            return $this->db->table($table)->select($select)->countAllResults();
        } elseif ($where != false and $like == false) {
            return $this->db->table($table)->select($select)->where($w_param, $id)->countAllResults();
        } elseif ($where == false and $like != false) {
            return $this->db->table($table)->select($select)->like($w_param, $id)->countAllResults();
        }
    }

    public function data_rank()
    {
        $data = array();
        $alter = $this->read_all_data('tb_alternatif');
        for ($i = 0; $i < count($alter); $i++) {
            $id = $alter[$i]['id'];
            $jml = $this->num_rows('tb_perangkingan', true, 'id_alter', $id, 'id_alter');
            if ($jml > 0) {
                array_push($data, array(
                    "id_alternatif" => $alter[$i]['id'],
                    "nama_alternatif" => $alter[$i]['nama'],
                    "status" => "sudah",
                    "btn" => "<a href=''></a>"
                ));
            } else {
                array_push($data, array(
                    "id_alternatif" => $alter[$i]['id'],
                    "nama_alternatif" => $alter[$i]['nama'],
                    "status" => "belum"
                ));
            }
        }
        return $data;
    }

    public function data_form()
    {
        $data = array();
        $kriteria = $this->read_data_all_where1('tb_kriteria', false, 'id', 1, true);
        for ($i = 0; $i < count($kriteria); $i++) {
            $aa = array();
            $sub_krit = $this->read_data_all_where1('tb_sub_kriteria', true, 'kriteria_id', $kriteria[$i]['id'], true, 'id', 'ASC');
            for ($ii = 0; $ii < count($sub_krit); $ii++) {
                array_push($aa, array(
                    $sub_krit[$ii]['nama'] => $sub_krit[$ii]['id']
                ));
            }

            array_push($data, array(
                $kriteria[$i]['nama'] => [$aa]
            ));
        }

        return $data;
    }

    public function read_data_all_where1($table, $where = false, $param = 'id', $id = 1, $order = false, $o_param = 'id', $sort = 'ASC')
    {
        if ($where != false) {
            if ($order != false) {
                return $this->db->table($table)->where($param, $id)->orderBy($o_param, $sort)->get()->getResultArray();
            } else {
                return $this->db->table($table)->where($param, $id)->get()->getResultArray();
            }
        } else {
            if ($order != false) {
                return $this->db->table($table)->orderBy($o_param, $sort)->get()->getResultArray();
            }
        }
    }

    public function data_rank_alter($id_alter)
    {
        $data = array();
        $kriteria = $this->read_data_all_where1('tb_kriteria', false, 'id', 1, true, 'id', 'ASC');
        for ($i = 0; $i < count($kriteria); $i++) {
            $jml = $this->db->table('tb_perangkingan')->select('id')->where(['id_alter' => $id_alter, 'id_krit' => $kriteria[$i]['id']])->countAllResults();;
            if ($jml > 0) {
                $id_sub = $this->db->table('tb_perangkingan')->select('id_sub')->where(['id_alter' => $id_alter, 'id_krit' => $kriteria[$i]['id']])->get()->getResultArray();
                $bobot = $this->read_data_all_where1('tb_sub_kriteria', true, 'id', $id_sub[0]['id_sub']);
                array_push($data, array(
                    'nama_kriteria' => $kriteria[$i]['nama'],
                    'bobot' => $bobot[0]['nama']
                ));
            } else {
                array_push($data, array(
                    'nama_kriteria' => $kriteria[$i]['nama'],
                    'bobot' => '-'
                ));
            }
        }
        return $data;
    }

    public function save_data_rank($table, $id_alter, $data)
    {
        $jml = $this->num_rows($table, true, 'id_alter', $id_alter);
        if ($jml > 0) {
            for ($i = 0; $i < count($data)-1; $i++) {
                $id = $i + 1;
                $name = 'kriteria_' . $id;
                $input = array(
                    "id_sub" => $data[$name]
                );
                $this->update_data_input2($table, $input, ['id_alter' => $id_alter, 'id_krit' => $id]);
            }

            return true;
        } else {
            for ($i = 0; $i < count($data); $i++) {
                $id = $i + 1;
                $name = 'kriteria_' . $id;
                $input = array(
                    "id_alter" => $id_alter,
                    "id_krit" => $id,
                    "id_sub" => $data[$name]
                );

                $this->save_data_input($table, $input);
            }

            return true;
        }
    }

    public function update_data_input2($table, $data, $array_where)
    {
        return $this->db->table($table)->update($data, $array_where);
    }

    public function save_data_input($table, $data, $where = false, $param = 'id', $id = 1)
    {
        if ($where != false) {
            return $this->db->table($table)->where($param, $id)->insert($data);
        } else {
            return $this->db->table($table)->insert($data);
        }
    }

    public function persiapan()
	{
		$tb_hasil = $this->solo_query("SELECT id from tb_hasil");
		if (count($tb_hasil) > 0) {
			$this->delete_truncate("tb_hasil");
		}

		$jml = $this->solo_query("SELECT distinct(id_alter) from tb_perangkingan order by id_alter asc");

		foreach ($jml as $value) {
			$a = array();
			$id_alter = $value['id_alter'];
			$data = $this->solo_query("SELECT nilai,id_sub from tb_perangkingan tp left join tb_sub_kriteria ts on tp.id_sub=ts.id where id_alter = '$id_alter' order by id_krit asc");

			foreach ($data as $k) {
				array_push($a, $k['nilai']);
			}
			$data_awal[] = $a;
		}

		$jml_2 = $this->solo_query("SELECT id, kategori from tb_kriteria order by id asc");

		foreach ($jml_2 as $j) {
			$krit = $j['id'] - 1;
            if ($j['kategori'] == "benefit") {
                $kat = 1;
            }else{
                $kat = 2;
            }
			$data_akhir = $this->normalisasi($data_awal, $j['id'], $kat);
			for ($i = 0; $i < count($data_akhir); $i++) {
				$b = array();
				$value = $data_akhir[$i];
				array_push($b, $value);

				$dat_final[] = $b;
			}
		}

		$final = $this->pemisahan($dat_final, count($jml_2));
		$finall = $this->saw($final);
		$idx = 0;
		foreach ($jml as $aa) {
			$arr = array(
				"id_alter" => $aa['id_alter'],
				"hasil" 	=> $finall[$idx][0]
			);
			$this->save_data("tb_hasil", $arr);
			$idx++;
		}

		return true;
	}

    public function normalisasi($data, $no_krit, $type)
	{
		$a = array();
		$no = $no_krit - 1;
		for ($i = 0; $i < count($data); $i++) {
			array_push($a, $data[$i][$no]);
		}

		if ($type == 1) {
			$bagi = max($a);
			$normal = array();
			foreach ($a as $value) {
				$n = $value / $bagi;
				array_push($normal, round($n, 2));
			}
		} else {
			$bagi = min($a);
			$normal = array();
			foreach ($a as $value) {
				$n = $bagi / $value;
				array_push($normal, round($n, 2));
			}
		}

		return $normal;
	}

    public function pemisahan($data, $jml)
	{
		$t_krit = $this->solo_query("SELECT id from tb_kriteria order by id asc");
		$total = count($data);
		$pembagi = $total / $jml;
		for ($i = 0; $i < $pembagi; $i++) {
			$next = $i;
			$loop = $next + count($t_krit);
			$arr = array();
			for ($j = $next; $j < $loop; $j++) {
				$value = $data[$next][0];
				array_push($arr, $value);
				$next = $next + $pembagi;
			}
			$final[] = $arr;
		}
		return $final;
	}

    public function saw($data)
	{
		$bobot = $this->solo_query("SELECT bobot from tb_kriteria order by id asc");

		for ($i = 0; $i < count($data); $i++) {
			$arr = array();
			$no = 0;
			$hasil = 0;
			foreach ($data[$i] as $key) {
				$a = $bobot[$no]['bobot'];
				// echo "$a ,";
				$value = $key * $bobot[$no]['bobot'];
				$hasil = $hasil + $value;
				// echo "yang ke $no = $key * $a == $value <br/>";
				$no++;
			}
			array_push($arr, $hasil);
			$final[] = $arr;
		}
		return $final;
	}
}