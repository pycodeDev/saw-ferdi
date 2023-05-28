<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CrudModel;
use Spipu\Html2Pdf\Html2Pdf;

class Laporan extends BaseController
{

    public function __construct()
	{
		$this->crud = new CrudModel();
	}

    public function index()
    {
        $data['title'] = "SPK Penentu Jurusan - Data Rank";
        $data['rank'] = $this->crud->solo_query("SELECT ta.nama, th.hasil from tb_hasil th left join tb_alternatif ta on th.id_alter=ta.id order by th.hasil desc");
        // dd($data['rank']);
		return view('Content/Laporan/Index', $data);
    }

    public function coba()
    {
        $data = $this->crud->solo_query("SELECT ta.nama, th.hasil, th.id_alter from tb_hasil th left join tb_alternatif ta on th.id_alter=ta.id order by th.hasil desc");
        $no = 1;
        $table = '';
        foreach ($data as $value) {
            $perangkingan = '';
            $id = $value['id_alter'];
            $kri = $this->crud->solo_query("SELECT tsk.nama,tp.id_krit FROM `tb_perangkingan` tp left join tb_sub_kriteria tsk on tp.id_sub=tsk.id where id_alter ='$id'");

            foreach ($kri as $key) {
                $perangkingan .= '
                    <td>' . $key['nama'] . '</td>
                ';
            }

            $table .= '
            <tr>
                <td>' . $no++ . '</td>
                <td>' . $value['nama'] . '</td>
                ' . $perangkingan . '
                <td>' . $value['hasil'] . '</td>                         
            </tr>';
        }
        $atribut = "";
        $atrr = "";
        $atr = $this->crud->solo_query("SELECT * FROM `tb_kriteria`");
        foreach ($atr as $key => $value) {
            $atrr .= '
                <th style="width:100px">' . $value['nama'] . '</th>
            ';
        }

        $atribut .= '
            <th>No</th>
            <th>Nama</th>
            ' . $atrr . '
            <th>Hasil</th>
        ';

        $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'UTF-8', array(10, 7, 10, 7));
        $html2pdf->writeHTML('
                <div style="text-align:center">
                    <img src="./assets/img/dms.png" alt="" style="width:100px;height:100px;">
                    <h3 style="font-weight:bold;color:green">Sekolah</h3>
                    <h5 style="margin-top:-9px">Sekolah Menengah Atas</h5>
                    <h5 style="margin-top:-9px">KABUPATEN Pekanbaru</h5>
                </div>
                <hr/>
                <div style="text-align:center">
                    <h3 style="font-weight:bold">Laporan Data Hasil Penentuan Jurusan Siswa SMA</h3>
                </div>
                <div style="margin:auto;width:50%">
                    <table border="1" style="width:100%;margin-top:10px">
                        <thead>
                            <tr>
                            ' . $atribut . '
                            </tr>
                        </thead>
                        <tbody>
                        ' . $table . '
                        </tbody>
                    </table>
                </div>
                
                <div style="text-align:left;font-weight:bold;position:absolute;bottom:20">
                    <div >Kepala Sekolah SMA</div>
                    <div >Kota Pekanbaru</div>
                    <div > </div>
                    <div > </div>
                    <div > </div>
                    <div > </div>   
                    <div > </div>
                    <div >(___________________)</div>
                    <div > Kepala Sekolah</div>
                </div>
        ');
        $html2pdf->output('Laporan.pdf');
        exit;
    }
}
