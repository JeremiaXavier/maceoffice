<?php
defined('BASEPATH') or exit('No direct script access allowed');

class guest_employees extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');

        $this->data["menu_id"] = 2;

    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_departments');
        $data['designation'] = $this->Common_model->select_all('ci_designations');
        $data['gender'] = $this->Common_model->select_all('ci_gender');


        $this->template->views('admin/guest_employees/index', $data);
    }

    public function add_guest_employees()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_departments');
        $data['designation'] = $this->Common_model->select_all('ci_designations');
        $data['gender'] = $this->Common_model->select_all('ci_gender');


        $records["content"] = $this->load->view('admin/guest_employees/add_guest_employees', $data, true);
        $records["heading"] = "Add Guest lecturer details";
        $records["sub_heading"] = "Add a new guest lecturer to the portal";

        $this->response(200, $records);
    }



    public function edit_guest_employees($teacher_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["teacher_id"] = $teacher_id;

        $teacher_id = en_func($teacher_id, 'd');

        $data["employeeDetails"] = $this->Common_model->select_by_id('ci_guest_employees', $teacher_id, 'teacher_id');
        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_departments');
        $data['designation'] = $this->Common_model->select_all('ci_designations');
        $data['gender'] = $this->Common_model->select_all('ci_gender');

        $this->check_exists($data["employeeDetails"]);

        $records["content"] = $this->load->view('admin/guest_employees/add_guest_employees', $data, true);
        $records["heading"] = "Edit Guest lecturer details";
        $records["sub_heading"] = "Edit a guest lecturer in the portal";

        $this->response(200, $records);
    }

    public function view_guest_employees($teacher_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["teacher_id"] = $teacher_id;

        $teacher_id = en_func($teacher_id, 'd');

        $data["employeeDetails"] = $this->Common_model->select_by_id('ci_guest_employees', $teacher_id, 'teacher_id');
        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_departments');
        $data['designation'] = $this->Common_model->select_all('ci_designations');
        $data['gender'] = $this->Common_model->select_all('ci_gender');

        $this->check_exists($data["employeeDetails"]);


        $records["content"] = $this->load->view('admin/guest_employees/add_guest_employees', $data, true);
        $records["heading"] = "View Guest lecturer details";
        $records["sub_heading"] = "View a guest lecturer in the portal";

        $this->response(200, $records);
    }


    public function update_guest_employees()
    {
        $teacher_id = $this->input->post('teacher_id');
        $this->save_guest_employees('update', $teacher_id);
    }


    public function save_guest_employees($func = 'add', $teacher_id = 0)
    {
        $this->form_validation->set_rules('teacher_name', 'Teacher name', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
        $this->form_validation->set_rules('last_date', 'Last date', 'trim|required');
        $this->form_validation->set_rules('teacher_code', 'Teacher code', 'trim|required');
        $this->form_validation->set_rules('daily_wage', 'Daily wage', 'trim|required|numeric');
        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('teacher_id', 'teachers ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
                   $this->response(200, $data);

        }


        if ($this->input->post('last_date') < $this->input->post('start_date')) {
            $data = array('status' => 'error', 'msg' => 'Last date should be greater than start date');
            $this->response(200, $data);

        }


        $this->check_encrypted($this->input->post('department'), 'Department');

        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'teacher_name' => $this->input->post('teacher_name'),
            'start_date' => $this->input->post('start_date'),
            'last_date' => $this->input->post('last_date'),
            'teacher_code' => $this->input->post('teacher_code'),
            'daily_wage' => $this->input->post('daily_wage'),
            'gender' => en_func($this->input->post('gender'), 'd'),
            'department' => en_func($this->input->post('department'), 'd'),
            'designation' => en_func($this->input->post('designation'), 'd'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $teacher_id =  en_func($teacher_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $teacher_id, 'ci_guest_employees', 'teacher_id');
            $this->add_activity_log("Updated teacher");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_guest_employees');
            $this->add_activity_log("Added teacher");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Teacher successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Teacher could not be added !');
        $this->response(200, $data);

    }

    public function guest_employees_json()
    {

        $this->load->model('M_Employees_guest');

        $status = (int) en_func($this->input->get('status'), 'd');
        $department = (int) en_func($this->input->get('department'), 'd');
        $designation = (int) en_func($this->input->get('designation'), 'd');
        $gender = (int) en_func($this->input->get('gender'), 'd');

        $records['data'] = $this->M_Employees_guest->select_all_guest_lecturers($department, $designation, $gender, $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $teacher_id  = en_func($row->teacher_id, 'e');
            $data[] = array(
                ++$i,
                $row->teacher_name .' - ' . $row->teacher_code,
                $row->department_name,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/guest_employees/edit_guest_employees/' . $teacher_id . '"  title="Edit guest employee" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/guest_employees/view_guest_employees/' . $teacher_id . '"  title="View guest employee" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }
}
