<?php

namespace App\Controllers;

use \App\Models\Registermodel;

class Activate extends BaseController
{
  public $session;
  public $request;

  // Constructor Loading Session, Request Library, and Helpers
  // =========================================================
  public function __construct()
  {
    helper(['url', 'form', 'date']);

    $this->session = \Config\Services::session();
    $this->request = \Config\Services::request();
  }


  // Activating the account with unique ID
  // =====================================
  public function index($uniqueid)
  {
    // Connect to DB and get Data based on unique ID
    $registermodel = new Registermodel;
    if ($result = $registermodel->getDataById($uniqueid)) {

      // Checking account status
      if ($result['status'] != 'active') {
        $registerTime = strtotime($result['created_at']);
        $currentTime = now();

        $timediff = $currentTime - $registerTime;

        // Check if link is older than 1 hr
        if (3600 < $timediff) {
          $this->session->setFlashdata('error', 'Link is Expired! Plz try again');
          return view('activate');
        } else {
          $upStatus = ['status' => 'active'];
          $user_id = $result['id'];

          if ($registermodel->updateStatus($upStatus, $user_id)) {
            $this->session->setFlashdata('success', 'Account is activated');
            return redirect()->to('/login');            
          }
        }
      }
      else
      {
        $this->session->setFlashdata('error', 'Your Account is already active');
        return view('activate');
      }
    }
    else
    {
      $this->session->setFlashdata('error', 'Wrong ID! Action not permitted');
      return view('activate');
    }
  }
}
