<?php
namespace App\Controllers;

class Login extends BaseController
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

  
  // Loading view of Login
  // =====================
  public function index()
  {
    return view('login');
  }


  // Validating Login
  // ================
  public function check()
  {
    $validation = \Config\Services::validation();

    $rules = [
      'username' => 'required|alpha_space',
      'password' => 'required|max_length[3]'
    ];

    if ($this->validate($rules))
    {
      echo "Success";
    }
    else
    {
      $data['validation'] = $this->validator;
      return view('login', $data);
    }
  }

  
}