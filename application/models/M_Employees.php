<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Employees extends CI_Model
{

    public function check_password($password, $user_id)
    {
        $result = $this->db->get_where('ci_employees', array('employee_id' => $user_id, 'employee_password' => $password));
        return $this->db->affected_rows();
    }


    public function select_employee_personal_details($employee_id = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_personal.status' => 1,
            'ci_employees_personal.employee_id' => $employee_id,
        );




        $this->db->select('ci_employees_personal.*,tbl_countries.name as country,tbl_caste_category.name as caste_category_name');
        $this->db->where($multiplewhere);
        $this->db->join('tbl_countries', 'tbl_countries.id  = ci_employees_personal.nationality', 'left');
        $this->db->join('tbl_caste_category', 'tbl_caste_category.id  = ci_employees_personal.caste_category', 'left');

        return $this->db->get('ci_employees_personal')->row();
    }

    public function select_employee_present_service($employee_id = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_present_service.status' => 1,
            'ci_employees_present_service.employee_id' => $employee_id,
        );




        $this->db->select('ci_employees_present_service.*,ci_service_departments.department_name,ci_scale_of_pay.pay_range');
        $this->db->where($multiplewhere);
        $this->db->join('ci_service_departments', 'ci_service_departments.department_id  = ci_employees_present_service.service_department', 'left');
        $this->db->join('ci_scale_of_pay', 'ci_scale_of_pay.sop_id  = ci_employees_present_service.scale_of_pay', 'left');

        return $this->db->get('ci_employees_present_service')->row();
    }

    public function select_employee_address_details($employee_id = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_address.status' => 1,
            'ci_employees_address.employee_id' => $employee_id,
        );




        $this->db->select('ci_employees_address.*');
        $this->db->where($multiplewhere);


        return $this->db->get('ci_employees_address')->row();
    }

    public function select_employee_qualification_details($employee_id = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_qualifications.status' => 1,
            'ci_employees_qualifications.employee_id' => $employee_id,
        );




        $this->db->select('ci_employees_qualifications.*,ci_courses.course_type,ci_courses.course_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_courses', 'ci_courses.course_id  = ci_employees_qualifications.course', 'left');

        return $this->db->get('ci_employees_qualifications')->result();
    }

    public function select_employee_qualification_detail_by_id($eq_id = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_qualifications.status' => 1,
            'ci_employees_qualifications.eq_id' => $eq_id,
        );




        $this->db->select('ci_employees_qualifications.*,ci_courses.course_type,ci_courses.course_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_courses', 'ci_courses.course_id  = ci_employees_qualifications.course', 'left');

        return $this->db->get('ci_employees_qualifications')->row();
    }

    public function select_employee_appoinment_details($employee_id = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_appoinments.status' => 1,
            'ci_employees_appoinments.employee_id' => $employee_id,
        );




        $this->db->select('ci_employees_appoinments.*,ci_designations.designation_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_employees_appoinments.designation', 'left');

        return $this->db->get('ci_employees_appoinments')->result();
    }

    public function select_employee_appoinment_detail_by_id($ea_id  = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_appoinments.status' => 1,
            'ci_employees_appoinments.ea_id' => $ea_id,
        );




        $this->db->select('ci_employees_appoinments.*');
        $this->db->where($multiplewhere);

        return $this->db->get('ci_employees_appoinments')->row();
    }


    public function select_employee_probation_details($employee_id = 0, $status = 0)
    {
        $multiplewhere = array(
            'ci_employees_probation_details.status' => 1,
            'ci_employees_probation_details.employee_id' => $employee_id,
        );




        $this->db->select('ci_employees_probation_details.*,ci_service_departments.department_name,tbl_districts.name as district_name,ci_office.office_name,ci_designations.designation_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_service_departments', 'ci_service_departments.department_id  = ci_employees_probation_details.department', 'left');
        $this->db->join('tbl_districts', 'tbl_districts.id  = ci_employees_probation_details.district', 'left');
        $this->db->join('ci_office', 'ci_office.office_id  = ci_employees_probation_details.office', 'left');
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_employees_probation_details.designation', 'left');

        return $this->db->get('ci_employees_probation_details')->row();
    }


    /**
     * 
     * 
     */

    public function select_employee_uploaded_data($personal = 0, $present_service = 0, $address = 0, $appoinments = 0, $qualifications = 0, $probation = 0, $status = 1)
    {
        $multiplewhere = array(
            'ci_employees.status' => $status
        );

        if ($personal == 1)
            $multiplewhere['ci_employees_personal.ep_id'] = NULL;
        if ($personal == 2)
            $multiplewhere['ci_employees_personal.ep_id !='] = NULL;



        if ($present_service == 1)
            $multiplewhere['ci_employees_present_service.eps_id'] = NULL;
        if ($present_service == 2)
            $multiplewhere['ci_employees_present_service.eps_id !='] = NULL;


        if ($address == 1)
            $multiplewhere['ci_employees_address.ea_id'] = NULL;
        if ($address == 2)
            $multiplewhere['ci_employees_address.ea_id !='] = NULL;


        if ($appoinments == 1)
            $multiplewhere['ci_employees_appoinments.ea_id'] = NULL;
        if ($appoinments == 2)
            $multiplewhere['ci_employees_appoinments.ea_id !='] = NULL;


        if ($qualifications == 1)
            $multiplewhere['ci_employees_qualifications.eq_id'] = NULL;
        if ($qualifications == 2)
            $multiplewhere['ci_employees_qualifications.eq_id !='] = NULL;

        if ($probation == 1)
            $multiplewhere['ci_employees_probation_details.epd_id'] = NULL;
        if ($probation == 2)
            $multiplewhere['ci_employees_probation_details.epd_id !='] = NULL;



        if ($status == 0)
            unset($multiplewhere['ci_employees.status']);



        $this->db->distinct();
        $this->db->select('ci_employees.*');
        $this->db->where($multiplewhere);
        if ($personal > 0)
            $this->db->join('ci_employees_personal', 'ci_employees_personal.employee_id  = ci_employees.employee_id', 'left');
        if ($present_service > 0)
            $this->db->join('ci_employees_present_service', 'ci_employees_present_service.employee_id  = ci_employees.employee_id', 'left');
        if ($address > 0)
            $this->db->join('ci_employees_address', 'ci_employees_address.employee_id  = ci_employees.employee_id', 'left');
        if ($appoinments > 0)
            $this->db->join('ci_employees_appoinments', 'ci_employees_appoinments.employee_id  = ci_employees.employee_id', 'left');
        if ($qualifications > 0)
            $this->db->join('ci_employees_qualifications', 'ci_employees_qualifications.employee_id  = ci_employees.employee_id', 'left');
        if ($probation > 0)
            $this->db->join('ci_employees_probation_details', 'ci_employees_probation_details.employee_id  = ci_employees.employee_id', 'left');

        return $this->db->get('ci_employees')->result();
    }



    public function select_employee_detail_by_id($employee_id)
    {
        $multiplewhere = array(
            'ci_employees.employee_id' => $employee_id,
            'ci_employees.status' => 1,
            'ci_employees_probation_details.status' => 1,
        );



        $this->db->distinct();
        $this->db->select('ci_employees.employee_number,ci_employees.employee_name');
        $this->db->select('ci_employees_present_service.date_of_joining,ci_employees_present_service.present_pay');
        $this->db->select('ci_scale_of_pay.pay_range');
        $this->db->select('ci_departments.department_name');
        $this->db->select('ci_designations.designation_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_employees_present_service', 'ci_employees_present_service.employee_id  = ci_employees.employee_id', 'left');
        $this->db->join('ci_scale_of_pay', 'ci_scale_of_pay.sop_id  = ci_employees_present_service.scale_of_pay', 'left');
        $this->db->join('ci_employees_probation_details', 'ci_employees_probation_details.employee_id  = ci_employees.employee_id', 'left');
        $this->db->join('ci_departments', 'ci_departments.department_id  = ci_employees_probation_details.department', 'left');
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_employees_probation_details.designation', 'left');

        return $this->db->get('ci_employees')->row();
    }
}
