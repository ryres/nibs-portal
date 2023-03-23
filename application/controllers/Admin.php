<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public  function index()

    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public  function role()

    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }
    public  function roleaccess($role_id)

    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed
          </div>');
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sub_user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success Deleted
          </div>');
        redirect('menu/submenu');
    }
    public  function pegawai()
    {
        $data['title'] = 'Data Pegawai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pegawai'] = $this->db->get('pegawai')->result_array();

        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('akad_ke', 'Akad Ke', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pegawai', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->insert('pegawai', ['pegawai' => $this->input->post('nip')]);
            $this->db->insert('pegawai', ['pegawai' => $this->input->post('nama')]);
            $this->db->insert('pegawai', ['pegawai' => $this->input->post('jabatan')]);
            $this->db->insert('pegawai', ['pegawai' => $this->input->post('divisi')]);
            $this->db->insert('pegawai', ['pegawai' => $this->input->post('tgl_lahir')]);
            $this->db->insert('pegawai', ['pegawai' => $this->input->post('akad_ke')]);
            $this->db->insert('pegawai', ['pegawai' => $this->input->post('status')]);


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Add data successfully !
               </div>');
            redirect('menu');
        }
    }
    public  function jabatan()
    {
        $data['title'] = 'Jabatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jabatan'] = $this->db->get('jabatan')->result_array();

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/jabatan', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->insert('jabatan', ['jabatan' => $this->input->post('jabatan')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                New Jabatan added !
               </div>');
            redirect('jabatan');
        }
    }
    // public function delete($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('jabatan');
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Success Deleted
    //       </div>');
    //     redirect('menu/submenu');
    // }
}
