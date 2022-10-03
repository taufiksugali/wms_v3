<?php

namespace App\Controllers;
use App\Models\UsersModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();

        helper(['form']);
    } 

    public function index()
    {
        if (session('logged_in') == TRUE) 
        {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Login - WMS'
        ];

        echo view('auth/login', $data);
    }

    public function login(){

        if (session('logged_in') == TRUE) 
        {
            return redirect()->to(base_url('dashboard'));
            exit;
        }

        $appid_key = "posloghris-v1";

        $nik = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $ArrayParse = array(
            'username' => $nik,
            'password' => $password,
            'appid_key' => $appid_key,
            'your_apps_id' => "APPS-009"
        );

        $signature = hash_hmac('sha256', json_encode($ArrayParse), "0a05252241f3bc45ffc4abaeca369963");
        
        $JsonFormatParse = json_encode($ArrayParse);
        $ch = curl_init();
        
        $headers  = array(
            'Content-Type: text/plain',
            'Cookie: ci_session=3v1e45vqid18dcrtiuqahh882siltv7l',
            'signature:' . $signature . ''
        );
        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/loginWeb');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JsonFormatParse);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        // var_dump($dataObject);
        // die();

        $user_email = $this->request->getPost('email');
        $user_password = hash('sha256', $this->request->getPost('password'));
        $valid_user = $this->users->login($user_email, $user_password);
        
        // $test = hash('sha256',$password);
        // $verify = password_verify($password, $test);
        // var_dump($password);
        // echo "<br>";
        // var_dump($test);
        // echo "<br>";
        // var_dump($verify);
        // die();

        if ($valid_user) {
            if ($valid_user->status == 1) {
                if (hash('sha256', $password, $valid_user->password)) {
                    $data = [
                        'user_id' => $valid_user->user_id,
                        'email' => $valid_user->email,
                        'level_id' => $valid_user->level_id,
                        'fullname' => $valid_user->fullname,
                        'phone' => $valid_user->phone,
                        'company' => $valid_user->company,
                        'logged_in' => TRUE,
                        'wh_id' => $valid_user->warehouse_id
                    ];
                    session()->set($data);
                    // echo "password is verified";
                    // die();
                    // if ($valid_user->level_id == 'LVL-003') {
                    session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Log in success; Welcome '.$data['fullname'].'.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                    return redirect()->to(base_url('dashboard'));

                    exit;
                    // }
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Wrong Email or HRIS NIK; or Password! Please try again.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                    return redirect()->to(base_url('auth'));
                }
            } else {
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">This Email has not been activated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('auth'));
            }
        } else if (@$dataObject->code == '200') {
            if (@$dataObject->data->division_id == 'DIV-002' || @$dataObject->data->division_id == 'DIV-003') {
                $data = array(
                    'user_id' => $dataObject->data->employee_number,
                    'email' => $dataObject->data->official_email,
                    'fullname' => $dataObject->data->full_name,
                    'division_id' => $dataObject->data->division_id,
                    'division_name' => $dataObject->data->division_name,
                    'employee_photo' => $dataObject->data->employee_photo,
                    'level_name' => $dataObject->data->level_name,
                    'job_title' => $dataObject->data->job_title,
                    'office_name' => $dataObject->data->office_name,
                    'logged_in' => TRUE
                );
                session()->set($data);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">You cannot access with this credentials.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('auth'));
            }   
        } else {
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">'.$dataObject->message.'</div>
                <div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
        }
    }

    public function logout()
    {
      session()->destroy();
      return redirect()->to(base_url('auth'));
  }

  public function register()
  {
    $data = [
        'title' => 'Register - OMS',
        'autogen' => $this->users->generate_id(),
        'validation' => \Config\Services::validation()
    ];

    echo view('auth/register', $data);
}

public function signup()
{
    $data = [
        'title' => 'Signing Up - WMS'

    ];

    $validate = $this->validate([
        'fullname' => ['label' => 'Fullname', 'rules' => 'required'],
        'email' => ['label' => 'Email Address', 'rules' => 'required|valid_email|is_unique[users.email]'],
        'password' => ['label' => 'Password', 'rules' => 'required|min_length[6]|matches[repassword]'],
        'repassword' => ['label' => 'Re-Password', 'rules' => 'required|min_length[6]'],
        'phone' => ['label' => 'Contact Phone', 'rules' => 'required|is_unique[users.phone]'],
        'company' => ['label' => 'Company', 'rules' => 'required'],
    ],[
        'email' => [
            'is_unique' => 'This email is already used!'
        ],
        'phone' => [
            'is_unique' => 'This phone number is already used!'
        ],
    ]);

    if (!$validate) {
        return redirect()->to(base_url('register'))->withInput();
    } else{
        $user_id = $this->users->generate_id();
        $email = $this->request->getPost('email');
        $fullname = $this->request->getPost('fullname');
        $data_users = [
            'user_id' => @$user_id,
            'fullname' => $fullname,
            'email' => $email,
            'password' => hash('sha256', $this->request->getPost('password')),
            'level_id' => 'LVL-003',
            'phone' => $this->request->getPost('phone'),
            'company' => $this->request->getPost('company'),
            'email_verification' => 0,
            'req_reset_pass' => 0,
            'status' => 0,
            'created_time' => date('Y-m-d H:i:s')
        ];

        $this->users->insert_data($data_users);
        $email_message = $this->_send_email_verification($user_id, $email, $fullname, 'verify');

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Congratulations! Please check your email for verification.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
        return redirect()->to(base_url('auth'));
    }
}

public function forgot_password()
{
    $data = [
        'title' => 'Forgot Password - WMS',
        'validation' => \Config\Services::validation()
    ];

    echo view('auth/forgot_password', $data);
}

public function forgot()
{
    $data = [
        'title' => 'Forgotten Password - WMS'
    ];

    $validate = $this->validate([
        'email' => ['label' => 'Email Address', 'rules' => 'required|valid_email']
    ],[
        'email' => [
            'required' => 'Please enter your email!'
        ]
    ]);

    if (!$validate) {
        return redirect()->to(base_url('/forgot'))->withInput();
    } else{
        $checkEmail = $this->users->checkEmail($this->request->getPost('email'));

        if (!$checkEmail) {
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">We couldn\'t find your account with that information.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('/forgot'));
        } else {
            $id = $checkEmail->user_id;
            $fullname = $checkEmail->fullname;
            $email = $checkEmail->email;
            $userData = array(
                'req_reset_pass' => 1
            );

            $this->users->update_user($id, $userData);

            $email_message = $this->_send_email_verification($id, $email, $fullname, 'forgot');

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Password reset has been successfully requested, please check your email ('. $checkEmail->email .').</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
        }
    }
}

protected function _send_email_verification($user_id, $email, $fullname, $type)
{
    $to                 = $email;
    $subjectverif       = '[Email Verification] Warehouse Management System';
    $subjectforgot      = '[Forgot Password] Warehouse Management System';

    $mail = new PHPMailer(true);

    $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host         = 'smtp.googlemail.com';   
    $mail->SMTPAuth     = true;
    $mail->Username     = 'admin.hris@poslogistics.co.id'; 
    $mail->Password     = 'Hris0987';
    $mail->SMTPSecure   = 'ssl';
    $mail->Port         = 465;

    $mail->setFrom('admin.hris@poslogistics.co.id', 'Warehouse Management System'); 
    $mail->addAddress($to);
    $mail->addReplyTo($to, 'Warehouse Management System'); 
        // Content
    $mail->isHTML(true);

    if ($type == 'verify') {
        $data = [
            'email' => $email,
            'fullname' => $fullname,
            'user_id' => $user_id
        ];
        $email_verifs = view('email/verify', $data);
        $mail->Subject = $subjectverif;
        $mail->Body    = $email_verifs;
    } else if ($type == 'forgot') {
        $data = [
            'email' => $email,
            'fullname' => $fullname,
            'user_id' => $user_id
        ];
        $forgot_password = view('email/forgot-password', $data);
        $mail->Subject = $subjectforgot;
        $mail->Body    = $forgot_password;
    }

    if ($mail->send()) {
        return true;
    } else {
        echo $mail->ErrorInfo;
        die;
    }
}

public function verify($id)
{
    $user = $this->users->get_userbyid($id);
    if(@$user->email_verification == 0 AND @$user->status == 0){
     $user_data = array(
        'email_verification' => 1,
        'status' => 1
    );
     $this->users->update_user($id, $user_data);

     session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Congratulations! Your email address is successfully verified!</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
 }
 return redirect()->to(base_url('auth'));
}

public function reset_password($id)
{
    $user = $this->users->get_userbyid($id);
    if($user->req_reset_pass == 1){
        $validate = $this->validate([
            'user_password' => ['label' => 'New Password', 'rules' => 'required|min_length[6]|matches[user_repassword]'],
            'user_repassword' => ['label' => 'Confirm Password', 'rules' => 'required|min_length[6]']
        ]);

        $data = [
            'title' => 'Reset Password - WMS',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        if(!$validate){
            echo view('auth/reset-password', $data);
        } else {
            $userData = array(
               'password' => hash('sha256', $this->request->getPost('user_password')),
               'req_reset_pass' => 0
           );

            $this->users->update_user($id, $userData);

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your password has been successfully changed!</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
        }
    } else {
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">You did not request to reset your password!</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
        return redirect()->to(base_url('auth'));
    }
}

}
?>