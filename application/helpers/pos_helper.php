<?php
//Kondisi agar user yang belum login tidak bisa akses menu melalui route
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        // var_dump($menu);
        // die;

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id,
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }

}

// FUNCTION DEBUG
function dd($function)
{
    var_dump($function);
    die;
}
//FUNCTION JSON ENCODE
if (!function_exists('ej')) {
    function ej($params)
    {
        echo json_encode($params);
    }
}

function generateTimeNow()
{
    date_default_timezone_set('Asia/Jakarta');
    $today = date('Y-m-d');

}