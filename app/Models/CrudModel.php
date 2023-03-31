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
            for ($i = 0; $i < count($data); $i++) {
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
}