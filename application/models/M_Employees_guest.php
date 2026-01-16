<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Employees_guest extends CI_Model
{






    public function select_all_guest_lecturers($department = 0, $designation = 0, $gender = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_guest_employees.status' => $status
        );

        if ($department > 0)
            $multiplewhere['ci_guest_employees.department'] = $department;


        if ($designation > 0)
            $multiplewhere['ci_guest_employees.designation'] = $designation;


        if ($gender > 0)
            $multiplewhere['ci_guest_employees.gender'] = $gender;


        if ($status == 0)
            unset($multiplewhere['ci_guest_employees.status']);




        $this->db->select('ci_guest_employees.*,ci_departments.department_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_departments', 'ci_departments.department_id  = ci_guest_employees.department', 'left');
        $this->db->order_by("ci_guest_employees.teacher_id", "desc");

        return $this->db->get('ci_guest_employees')->result();
    }
}
