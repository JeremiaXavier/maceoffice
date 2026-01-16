<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{




	public function select_teachers_in_month($report_time){
	$qry = "SELECT * FROM `ci_guest_employees` where '$report_time' between start_date and last_date and ci_guest_employees.status = 1";
	$query = $this->db->query($qry);
    return $query->result();
		/*$multiplewhere = array(
		'ci_guest_employees.status' => 1,
		'ci_guest_employees.start_date'
		);
		
		
		$this->db->select('ci_guest_employees.*');
		$this->db->where($multiplewhere);

		return $this->db->get('ci_guest_employees')->result();
		*/
	}


	public function select_all_generated_reports($status,){
		$multiplewhere = array(
		'ci_guest_reports.generated' => 1,
		'ci_guest_reports.status' => $status
		);
		
		
		$this->db->select('ci_guest_reports.*');
		$this->db->where($multiplewhere);

		return $this->db->get('ci_guest_reports')->result();
	}

	public function select_report_teacher_details($report_id){
		$multiplewhere = array(
		'ci_guest_employee_reports.report_id' => $report_id
		);
		
		
		// $this->db->distinct();
		$this->db->select('ci_guest_employee_reports.*,ci_guest_employees.teacher_name,ci_guest_employees.teacher_code,
		ci_guest_employees.daily_wage,ci_guest_employees.gender,ci_guest_employees.department,
		ci_departments.department_name,
		ci_guest_reports.report_month,ci_guest_reports.report_date,ci_guest_reports.report_no,ci_guest_reports.head_of_account,ci_guest_reports.report_orders,ci_guest_reports.report_year,
		ci_designations.designation_name');
		$this->db->where($multiplewhere);
        $this->db->join('ci_guest_reports','ci_guest_reports.report_id   = ci_guest_employee_reports.report_id ','left');
        $this->db->join('ci_guest_employees','ci_guest_employees.teacher_id   = ci_guest_employee_reports.teacher_id ','left');
        $this->db->join('ci_designations','ci_designations.designation_id   = ci_guest_employees.designation','left');
        $this->db->join('ci_departments','ci_departments.department_id   = ci_guest_employees.department','left');

		$this->db->order_by('ci_departments.department_id', 'asc');
		return $this->db->get('ci_guest_employee_reports')->result();
	}

	public function select_all_gallery($status,$gallery_category){
		$multiplewhere = array(
		'ci_image_gallery.status' => $status,
		'gallery_category' => $gallery_category,
		);
		
		if($gallery_category == 0)
			unset($multiplewhere['gallery_category']);
	 
		$this->db->select('ci_image_gallery.*,category_name');
		$this->db->where($multiplewhere);
        $this->db->join('ci_gallery_categories','ci_gallery_categories.category_id   = ci_image_gallery.gallery_category ','left');

		return $this->db->get('ci_image_gallery')->result();
	}


	public function select_all_messages($status, $message_status){
		$user_id = $this->user_id;


		$multiplewhere = array(
		'ci_messages.status' => $status,
		'ci_messages.message_seen' => $message_status,
		'ci_messages.message_from' => $user_id,
		);
		
		if($message_status == 0)
			unset($multiplewhere['message_seen']);
	 
		$this->db->select('ci_messages.*,user_name,full_name,user_email');
		$this->db->where($multiplewhere);
        $this->db->join('users','users.user_id   = ci_messages.message_to ','left');

		return $this->db->get('ci_messages')->result();
	}

	public function get_allocated_messages($user_id){
		$multiplewhere = array(
		'ci_messages.status' => 1,
		'ci_messages.show_all' => 0,
		'ci_messages.message_to' => $user_id
		);
	
	 
		$this->db->select('ci_messages.message,ci_message_types.message_type_name,ci_message_types.color_code,user_name,full_name,user_email,user_photo');
		$this->db->where($multiplewhere);
        $this->db->join('users','users.user_id   = ci_messages.message_to ','left');
        $this->db->join('ci_message_types','ci_message_types.type_id   = ci_messages.message_type ','left');

		return $this->db->get('ci_messages')->result();
	}

	public function get_all_messages($user_id){
		$multiplewhere = array(
		'ci_messages.status' => 1,
		'ci_messages.message_to' => $user_id
		);
	
	 
		$this->db->select('ci_messages.message,ci_message_types.message_type_name,ci_message_types.color_code,user_name,full_name,user_email,user_photo');
		$this->db->where($multiplewhere);
        $this->db->join('users','users.user_id   = ci_messages.message_from ','left');
        $this->db->join('ci_message_types','ci_message_types.type_id   = ci_messages.message_type ','left');

		return $this->db->get('ci_messages')->result();
	}

	public function select_all_items($status = 0, $item_type = 0, $result_type = 'array'){
		$multiplewhere = array(
		'ci_items.status' => $status,
		'ci_items.item_type' => $item_type
		);
	
		if($status == 0)
			unset($multiplewhere['ci_items.status']);
	 
		if($item_type == 0)
			unset($multiplewhere['ci_items.item_type']);
	 
		$this->db->select('ci_items.*,ci_menu_types.menu_type_name');
		$this->db->where($multiplewhere);
        $this->db->join('ci_menu_types','ci_menu_types.menu_type_id   = ci_items.item_type ','left');

		if($result_type == 'array')
		return $this->db->get('ci_items')->result_array();

		return $this->db->get('ci_items')->result();
	}

}
