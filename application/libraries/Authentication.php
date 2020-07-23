<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
    }

    public function check_ad($rtarfMail, $password)
    {
        $url = "https://itdev.rtarf.mi.th/welfare/index.php/authentication_2";
        $curlAD = curl_init();
        curl_setopt($curlAD, CURLOPT_URL, $url);
        curl_setopt($curlAD, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlAD, CURLOPT_POST, true);
        curl_setopt($curlAD, CURLOPT_POSTFIELDS, "username={$rtarfMail}&password={$password}");
        curl_setopt($curlAD, CURLOPT_CAINFO, FCPATH . "assets/ca/cacert.pem");
        $output     = curl_exec($curlAD);
        $curlErr    = curl_error($curlAD);

        if ($curlErr) {
            $data['status']  = false;
            $data['errno']   = curl_errno($curlAD);
            $data['error']   = curl_error($curlAD);
        } else {
            $data['status']     = true;
            $data['http_code']  = curl_getinfo($curlAD, CURLINFO_HTTP_CODE);
            $data['response']   = $output;
        }

        curl_close($curlAD);

        return $data;
    }

    public function check_token($token)
    {
        $url = "https://itdev.rtarf.mi.th/welfare/index.php/profile?token={$token}";
        $curlAD = curl_init();
        curl_setopt($curlAD, CURLOPT_URL, $url);
        curl_setopt($curlAD, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlAD, CURLOPT_CAINFO, FCPATH . "assets/ca/cacert.pem");
        $output = curl_exec($curlAD);
        $curlErr = curl_error($curlAD);

        if ($curlErr) {
            $data['status']  = false;
            $data['errno']   = curl_errno($curlAD);
            $data['error']   = curl_error($curlAD);
        } else {
            $data['status']     = true;
            $data['http_code']  = curl_getinfo($curlAD, CURLINFO_HTTP_CODE);
            $data['response']   = $output;
        }
        curl_close($curlAD);
        return $data;
    }

    protected function check_login()
    {
        $isLogged = $this->CI->session->isLogged;

        return $isLogged;
    }

    public function check_type_user($userType)
    {
        $isLogged = $this->check_login();
        if ($isLogged) {
            $result = ($userType == $this->CI->session->usertype) ? true : false;
        } else {
            $result = false;
        }

        return $result;
    }

    public function go_home()
    {
        $userType =  $this->CI->session->usertype;
        switch ($userType) {
            case 'admin':
                redirect('admin/index');
                break;
            case 'user':
                redirect('user/index');
                break;

            default:
                redirect('main/index');
                break;
        }
        return;
    }
}
