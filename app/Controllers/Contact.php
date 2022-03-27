<?php
namespace App\Controllers;
use \App\Models\Contactmodel;

class Contact extends BaseController
{
  public $session;
  public $request;

  // Constructor Loading Session, Request Library, and Helpers
  // =========================================================
  public function __construct()
  {
    helper(['url', 'form']);
    
    $this->session = \Config\Services::session();
    $this->request = \Config\Services::request();
  }


  // Loading view of Contact Page
  // ============================
  public function index()
  {
    return view('contactus');
  }

  // Validating Contact Form and insert Data
  // =======================================
  public function check()
  {
    $validation = \Config\Services::validation();
    
    $rules = [
      'name' => 'required|alpha_space',
      'email' => 'required|valid_email',
      'mobile' => 'required|numeric|max_length[10]',
      'message' => 'required'
    ];

    if ($this->validate($rules)) {
      $name = $this->request->getVar('name');
      $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
      $mobile = $this->request->getVar('mobile');
      $message = $this->request->getVar('message');

      $inData = [
        'name' => $name,
        'email' => $email,
        'mobile' => $mobile,
        'message' => $message,
      ];

      $contactmodel = new Contactmodel();
      if($result = $contactmodel->insertDataInDB($inData))
      {
        $this->session->setFlashdata('success', 'Data Inserted');
        return redirect()->to('/contact');
      }
      else
      {
        $this->session->setFlashdata('error', 'Data Failed to be inserted');
      }
    }
    else
    {      
      $data['validation'] = $this->validator;
      return view('contactus', $data);
    }
  }
}
