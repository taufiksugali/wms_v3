<?php

namespace App\Controllers;
use App\Models\UsersModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Dashboard extends BaseController
{
    public function index()
	{
		$data = [
            'title' => 'Dashboard',
			'title_menu' => 'Dashboard',
            'sidebar' => 'Dashboard'
        ];

		echo view('layout/header', $data);
		echo view('dashboard/dashboard');
		echo view('layout/footer');
	}
}
?>