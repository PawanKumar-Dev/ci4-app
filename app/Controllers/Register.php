<?php
namespace App\Controllers;

use \App\Models\Registermodel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register extends BaseController
{
  public $request;
  public $session;


  // Constructor Loading Session, Request Library, and Helpers
  // =========================================================
  public function __construct()
  {
    helper(['url', 'form']);

    $this->session = \Config\Services::session();
    $this->request = \Config\Services::request();
  }


  // Loading view of Register
  // ========================
  public function index()
  {
    return view('register');
  }


  // Validating Register Field and Inserting Data
  // ============================================
  public function check()
  {
    $validation = \Config\Services::validation();

    $rules = [
      'username' => 'required|alpha_space|is_unique[users.username]',
      'email' => 'required|valid_email',
      'mobile' => 'required|numeric|max_length[10]',
      'password' => 'required|min_length[3]',
      'cpassword' => 'required|min_length[3]|matches[password]'
    ];

    if ($this->validate($rules)) {
      $uniid = md5("abcdefghijklmnoqrst") . time();
      $inData = [
        'username' => $this->request->getVar('username'),
        'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'mobile' => $this->request->getVar('mobile'),
        'profile_pic' => 'public/assets/img/capture.png',
        'status' => 'inactive',
        'uniid' => $uniid
      ];

      if ($this->sendmail($this->request->getVar('username'), $this->request->getVar('email'), $uniid)) {
        $registermodel = new Registermodel;
        
        if ($result = $registermodel->registerUser($inData)) {
          $this->session->setFlashdata('success', 'Registration is successful! Check you email id for link!');
          return redirect()->to('/register');
        }
      }
      else
      {
        $this->session->setFlashdata('error', 'Registration mail failed to be sent!');
        return redirect()->to('/register');
      }
    } else {
      $data['validation'] = $this->validator;
      return view('register', $data);
    }
  }


  // Sending email with PHPmailer when registering
  // =============================================
  public function sendmail($name, $email, $uniid)
  {
    require 'vendor/autoload.php';
    $mail = new PHPMailer();

    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com;';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'pk687376alternative@gmail.com';
      $mail->Password   = 'pk110085';
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;

      $mail->setFrom('pk687376alternative@gmail.com', 'Codeigniter 4 Register');
      $mail->addAddress($email, 'Hello, ' . $name);

      $mail->isHTML(true);
      $mail->Subject = 'Codeigniter 4 Register Activation Email';
      $mail->Body    = "Hey $name, click on this link to activate your account. Here is the link http://localhost/ci4-app/activate/$uniid";
      
      $mail->send();
      return true;

    } catch (Exception $e) {
      return false;
    }
  }
}
