<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Autentifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'UserModel');
    }

    public function index()
    {
        $title['title'] = ['header' => 'User Autentifikasi', 'dash' => 'User_autentifikasi'];
        $this->load->view('login', $title);
    }

    public function login()
    {
        $data = $this->input->post();
        $result = $this->UserModel->select($data);
        if (count($result) == 0) {
            $this->session->set_flashdata('pesan', 'Gagal Login, error');
            redirect('autentifikasi');
        } else {
            $this->session->set_userdata($result);
            if ($result['jenis'] == "Admin")
                redirect('admin/home');
            else
                redirect('member/home');
        }
    }
    public function registrasi()
    {
        $title['title'] = ['header' => 'User Registration', 'dash' => 'User_registrasi'];
        $this->load->view('registrasi', $title);
    }
    public function simpan()
    {
        $this->load->model('admin/Pelanggan_model', 'PelangganModel');
        $data = $this->input->post();
        $result = $this->PelangganModel->insert($data);
        if ($result)
            $this->session->set_flashdata('pesan', 'Data berhasil disimpan, success');
        else
            $this->session->set_flashdata('pesan', 'Data gagal disimpan, error');
        redirect('autentifikasi');
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect('autentifikasi');
    }
}

/* End of file Controllername.php */
