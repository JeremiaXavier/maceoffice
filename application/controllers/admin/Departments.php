<?php
defined('BASEPATH') or exit('No direct script access allowed');

class departments extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');

        $this->data["menu_id"] = 5;

    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/departments/index', $data);
    }

    public function add_departments()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();


        $records["content"] = $this->load->view('admin/departments/add_departments', $data, true);
        $records["heading"] = "Add Department details";
        $records["sub_heading"] = "Add a new department to the portal";

        $this->response(200, $records);
    }

 

    public function edit_departments($department_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["department_id"] = $department_id;

        $department_id = en_func($department_id, 'd');

        $data["departmentsDetails"] = $this->Common_model->select_by_id('ci_departments', $department_id, 'department_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["departmentsDetails"]);

        $records["content"] = $this->load->view('admin/departments/add_departments', $data, true);
        $records["heading"] = "Edit Department details";
        $records["sub_heading"] = "Edit a department in the portal";

        $this->response(200, $records);
    }

    public function view_departments($department_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["department_id"] = $department_id;

        $department_id = en_func($department_id, 'd');

        $data["departmentsDetails"] = $this->Common_model->select_by_id('ci_departments', $department_id, 'department_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["departmentsDetails"]);

        $records["content"] = $this->load->view('admin/departments/add_departments', $data, true);
        $records["heading"] = "View Department details";
        $records["sub_heading"] = "View a department in the portal";

        $this->response(200, $records);
    }


    public function update_departments()
    {
        $department_id = $this->input->post('department_id');
        $this->save_departments('update', $department_id);
    }


    public function save_departments($func = 'add', $department_id = 0)
    {
        $this->form_validation->set_rules('department_name', 'Department name', 'trim|required');
        $this->form_validation->set_rules('department_name_mal', 'Department name (Mal)', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('department_id', 'departments ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);

        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'department_name' => $this->input->post('department_name'),
            'department_name_mal' => $this->input->post('department_name_mal'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $department_id =  en_func($department_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $department_id, 'ci_departments', 'department_id');
            $this->add_activity_log("Updated department");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_departments');
            $this->add_activity_log("Added department");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Department successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Department could not be added !');
        $this->response(200, $data);

    }

    public function departments_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_departments', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $department_id  = en_func($row->department_id, 'e');
            $data[] = array(
                ++$i,
                $row->department_name,
                $row->department_name_mal,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/departments/edit_departments/' . $department_id . '" title="Edit departments" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/departments/view_departments/' . $department_id . '" title="View departments" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }



}
