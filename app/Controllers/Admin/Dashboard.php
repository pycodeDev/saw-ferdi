<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	public function index()
	{
		$data['title'] = "Sistem Pendukung Penentu Jurusan";
		return view('Content/Dashboard', $data);
	}
}
