<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Kondisi agar user yang belum login tidak bisa akses menu melalui route
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'user/index';
        $this->load->view('layout', $data);

    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $this->form_validation->set_rules('name', 'Nama', "required|trim", [
            'required' => 'Nama wajib diisi',
        ]);

        $data['content'] = 'user/edit';

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {

            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek gambar yang diupload
            $upload_image = $_FILES['image']['name'];
            // var_dump($upload_image);
            // die;

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048'; //2MB limit
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['foto'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);

                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto', $new_image);

                } else {
                    echo $this->upload->display_errors();
                }

            }

            $this->db->set('nama', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profil anda diperbaharui! </div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'user/changepassword';

        $this->form_validation->set_rules('current_password', 'Password lama', 'required|trim', [
            'required' => 'Password sekarang wajib diisi',

        ]);
        $this->form_validation->set_rules('new_password1', 'Password baru', 'required|trim|min_length[6]|matches[new_password2]', [
            'required' => 'Password baru wajib diisi',
            'min_length[6]' => 'Password harus berisi minimal 6 karakter',
            'matches[new_password2]' => 'Password baru tidak cocok dengan konfirmasi password',

        ]);
        $this->form_validation->set_rules('new_password2', 'Password konfirmasi', 'required|trim|min_length[6]|matches[new_password1]', [
            'required' => 'Password konfirmasi wajib diisi',
            'min_length[6]' => 'Password harus berisi minimal 6 karakter',
            'matches[new_password1]' => 'Password konfirmasi tidak cocok dengan password baru',
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('layout', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password sekarang salah! </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                   Password baru tidak boleh sama dengan password lama </div>');
                    redirect('user/changepassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password changed </div>');
                    redirect('user/changepassword');
                }
            }

        }

    }

}