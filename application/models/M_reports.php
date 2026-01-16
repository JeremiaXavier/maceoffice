<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_reports extends CI_Model
{




    public function select_letters_details($letter_id = 0)
    {
        $multiplewhere = array(
            'ci_letters.status' => 1,
            'ci_letters.letter_id' => $letter_id,
        );




        $this->db->select('ci_letters.*,ci_letters_senders.sender_name_mal,ci_letters_senders.sender_name as sender_name_eng,,ci_letters_recipients.recipient_name_mal,ci_letters_recipients.recipient_name as recipient_name_eng');
        $this->db->where($multiplewhere);
        $this->db->join('ci_letters_senders', 'ci_letters_senders.sender_id  = ci_letters.sender', 'left');
        $this->db->join('ci_letters_recipients', 'ci_letters_recipients.recipient_id  = ci_letters.receiver', 'left');

        return $this->db->get('ci_letters')->row();
    }

    public function select_confirmation_report_details($report_id = 0)
    {
        $multiplewhere = array(
            'ci_confirmation_reports.status' => 1,
            'ci_confirmation_reports.report_id' => $report_id,
        );




        $this->db->select('ci_confirmation_reports.*,ci_employees.employee_name_mal,ci_employees.employee_name as employee_name_eng,ci_designations.designation_name_mal
        ,ci_departments.department_name_mal,ci_office.office_name_mal');
        $this->db->where($multiplewhere);
        $this->db->join('ci_employees', 'ci_employees.employee_id  = ci_confirmation_reports.employee_name', 'left');
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_confirmation_reports.employee_designation', 'left');
        $this->db->join('ci_departments', 'ci_departments.department_id  = ci_confirmation_reports.employee_department', 'left');
        $this->db->join('ci_office', 'ci_office.office_id  = ci_confirmation_reports.office', 'left');

        return $this->db->get('ci_confirmation_reports')->row();
    }


    public function select_grade_promotion_report_details($report_id = 0)
    {
        $multiplewhere = array(
            'ci_grade_promotion_reports.status' => 1,
            'ci_grade_promotion_reports.report_id' => $report_id,
        );




        $this->db->select('ci_grade_promotion_reports.*,ci_employees.employee_name_mal,ci_employees.employee_name as employee_name_eng,ci_designations.designation_name_mal
        ,ci_departments.department_name_mal,ci_office.office_name_mal,ci_scale_of_pay.pay_range,ci_scale_of_pay.pay_range_full');
        $this->db->where($multiplewhere);
        $this->db->join('ci_employees', 'ci_employees.employee_id  = ci_grade_promotion_reports.employee_name', 'left');
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_grade_promotion_reports.employee_designation', 'left');
        $this->db->join('ci_departments', 'ci_departments.department_id  = ci_grade_promotion_reports.employee_department', 'left');
        $this->db->join('ci_office', 'ci_office.office_id  = ci_grade_promotion_reports.office', 'left');
        $this->db->join('ci_scale_of_pay', 'ci_scale_of_pay.sop_id  = ci_grade_promotion_reports.scale_of_pay', 'left');

        return $this->db->get('ci_grade_promotion_reports')->row();
    }


    public function select_promotion_report_details($report_id = 0)
    {
        $multiplewhere = array(
            'ci_promotion_reports.status' => 1,
            'ci_promotion_reports.report_id' => $report_id,
        );




        $this->db->select('ci_promotion_reports.*,ci_employees.employee_name_mal,ci_employees.employee_name as employee_name_eng,ci_designations.designation_name_mal
        ,ci_departments.department_name_mal,ci_office.office_name_mal,ci_scale_of_pay.pay_range,ci_scale_of_pay.pay_range_full,ci_vacancy_nature.nature,ci_vacancy_nature.nature_mal');
        $this->db->where($multiplewhere);
        $this->db->join('ci_employees', 'ci_employees.employee_id  = ci_promotion_reports.employee_name', 'left');
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_promotion_reports.employee_designation', 'left');
        $this->db->join('ci_departments', 'ci_departments.department_id  = ci_promotion_reports.employee_department', 'left');
        $this->db->join('ci_office', 'ci_office.office_id  = ci_promotion_reports.office', 'left');
        $this->db->join('ci_scale_of_pay', 'ci_scale_of_pay.sop_id  = ci_promotion_reports.scale_of_pay', 'left');
        $this->db->join('ci_vacancy_nature', 'ci_vacancy_nature.nature_id  = ci_promotion_reports.vacancy_nature', 'left');

        return $this->db->get('ci_promotion_reports')->row();
    }

    public function select_appoinment_report_details($report_id = 0)
    {
        $multiplewhere = array(
            'ci_appoinment_reports.status' => 1,
            'ci_appoinment_reports.report_id' => $report_id,
        );




        $this->db->select('ci_appoinment_reports.*,ci_employees.employee_name_mal,ci_employees.employee_name as employee_name_eng,ci_designations.designation_name_mal
        ,ci_departments.department_name_mal,ci_office.office_name_mal,ci_scale_of_pay.pay_range,ci_scale_of_pay.pay_range_full,ci_vacancy_nature.nature,ci_vacancy_nature.nature_mal');
        $this->db->where($multiplewhere);
        $this->db->join('ci_employees', 'ci_employees.employee_id  = ci_appoinment_reports.employee_name', 'left');
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_appoinment_reports.employee_designation', 'left');
        $this->db->join('ci_departments', 'ci_departments.department_id  = ci_appoinment_reports.employee_department', 'left');
        $this->db->join('ci_office', 'ci_office.office_id  = ci_appoinment_reports.office', 'left');
        $this->db->join('ci_scale_of_pay', 'ci_scale_of_pay.sop_id  = ci_appoinment_reports.scale_of_pay', 'left');
        $this->db->join('ci_vacancy_nature', 'ci_vacancy_nature.nature_id  = ci_appoinment_reports.vacancy_nature', 'left');

        return $this->db->get('ci_appoinment_reports')->row();
    }

    public function select_probation_report_details($report_id = 0)
    {
        $multiplewhere = array(
            'ci_probation_reports.status' => 1,
            'ci_probation_reports.report_id' => $report_id,
        );




        $this->db->select('ci_probation_reports.*,ci_employees.employee_name_mal,ci_employees.employee_name as employee_name_eng,ci_designations.designation_name_mal
        ,ci_departments.department_name_mal,ci_office.office_name_mal,ci_scale_of_pay.pay_range');
        $this->db->where($multiplewhere);
        $this->db->join('ci_employees', 'ci_employees.employee_id  = ci_probation_reports.employee_name', 'left');
        $this->db->join('ci_designations', 'ci_designations.designation_id  = ci_probation_reports.employee_designation', 'left');
        $this->db->join('ci_departments', 'ci_departments.department_id  = ci_probation_reports.employee_department', 'left');
        $this->db->join('ci_office', 'ci_office.office_id  = ci_probation_reports.office', 'left');
        $this->db->join('ci_scale_of_pay', 'ci_scale_of_pay.sop_id  = ci_probation_reports.scale_of_pay', 'left');

        return $this->db->get('ci_probation_reports')->row();
    }


    public function select_probation_absence_of($probation_report_id = 0)
    {
        $multiplewhere = array(
            'ci_probation_absence.status' => 1,
            'ci_probation_absence.probation_report_id' => $probation_report_id,
        );




        $this->db->select('ci_probation_absence.*');
        $this->db->where($multiplewhere);

        return $this->db->get('ci_probation_absence')->result();
    }
    public function select_probation_service_of($probation_report_id = 0)
    {
        $multiplewhere = array(
            'ci_probation_service.status' => 1,
            'ci_probation_service.probation_report_id' => $probation_report_id,
        );




        $this->db->select('ci_probation_service.*');
        $this->db->where($multiplewhere);

        return $this->db->get('ci_probation_service')->result();
    }

    public function select_grade_promotion_temporary($promotion_report_id = 0)
    {
        $multiplewhere = array(
            'ci_grade_promotion_temporary_service.status' => 1,
            'ci_grade_promotion_temporary_service.promotion_report_id' => $promotion_report_id,
        );




        $this->db->select('ci_grade_promotion_temporary_service.*');
        $this->db->where($multiplewhere);

        return $this->db->get('ci_grade_promotion_temporary_service')->result();
    }
    public function select_grade_promotion_service($promotion_report_id = 0)
    {
        $multiplewhere = array(
            'ci_grade_promotion_service.status' => 1,
            'ci_grade_promotion_service.promotion_report_id' => $promotion_report_id,
        );




        $this->db->select('ci_grade_promotion_service.*');
        $this->db->where($multiplewhere);

        return $this->db->get('ci_grade_promotion_service')->result();
    }
}
