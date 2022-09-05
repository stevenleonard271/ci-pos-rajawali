<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    //Kembali ke halaman default sesuai role masing2
    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id' == 2)) {
            redirect('user');
        }
    }

    //Method Login
    public function index()
    {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email wajib diisi',
            'valid_email' => 'Email harus email yang valid',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password wajib diisi',

        ]);

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login';
            $this->load->view('templates/auth_header');
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer');
        } else {
            //Validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            //cek password pada database

            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                ];
                //simpan pada session user dan role id
                $this->session->set_userdata($data);

                //kondisi pengenalan role
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password anda salah </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           Email anda belum terdaftar </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Anda telah keluar </div>');
        redirect('auth');
    }

    public function blocked()
    {

        $this->load->view('auth/blocked');
    }

    // public function registration()
    // {
    //     $this->form_validation->set_rules('name', 'Name', 'required|trim');
    //     $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
    //         'is_unique' => 'This email has already registered!',
    //     ]);
    //     $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
    //         'matches' => "Password don't match!",
    //         'min_length' => "Password too short!",
    //     ]);
    //     $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    //     if ($this->form_validation->run() == false) {

    //         $data['title'] = 'User Registration';
    //         $this->load->view('templates/auth_header');
    //         $this->load->view('auth/registration', $data);
    //         $this->load->view('templates/auth_footer');
    //     } else {
    //         $data = [
    //             'nama' => htmlspecialchars($this->input->post('name', true)),
    //             'email' => htmlspecialchars($this->input->post('email', true)),
    //             'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
    //             'foto' => 'default.jpg',
    //             'role_id' => 2,
    //             'created_at' => time(),
    //         ];
    //         $this->db->insert('user', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //        Your account has been created. Please Login! </div>');
    //         redirect('auth');
    //     }
    // }

}