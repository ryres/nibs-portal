<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `sub_user_menu`.*, `user_menu`.`menu`
        FROM `sub_user_menu` JOIN `user_menu`
        ON `sub_user_menu`.`menu_id` = `user_menu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }
}
