<?php
defined('BASEPATH') or exit('No direct script access allowed');

class designations extends MY_Controller
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

        $this->template->views('admin/designations/index', $data);
    }

    public function add_designations()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();


        $records["content"] = $this->load->view('admin/designations/add_designations', $data, true);
        $records["heading"] = "Add Designations details";
        $records["sub_heading"] = "Add a new designation to the portal";
        
        $this->response(200, $records);
    }

 

    public function edit_designations($designation_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["designation_id"] = $designation_id;

        $designation_id = en_func($designation_id, 'd');

        $data["designationsDetails"] = $this->Common_model->select_by_id('ci_designations', $designation_id, 'designation_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["designationsDetails"]);

        $records["content"] = $this->load->view('admin/designations/add_designations', $data, true);
        $records["heading"] = "Edit Designations details";
        $records["sub_heading"] = "Edit a designation in the portal";
        
        $this->response(200, $records);
    }

    public function view_designations($designation_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["designation_id"] = $designation_id;
        
        $designation_id = en_func($designation_id, 'd');
        
        $data["designationsDetails"] = $this->Common_model->select_by_id('ci_designations', $designation_id, 'designation_id');
        $data["status"] = $this->Common_model->select_status();
        
        $this->check_exists($data["designationsDetails"]);

        
        $records["content"] = $this->load->view('admin/designations/add_designations', $data, true);
        $records["heading"] = "View Designations details";
        $records["sub_heading"] = "View a designation in the portal";

        $this->response(200, $records);

    }


    public function update_designations()
    {
        $designation_id = $this->input->post('designation_id');
        $this->save_designations('update', $designation_id);
    }


    public function save_designations($func = 'add', $designation_id = 0)
    {
        $this->form_validation->set_rules('designation_name', 'Designation name', 'trim|required');
        $this->form_validation->set_rules('designation_name_mal', 'Designation name (Mal)', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('designation_id', 'designations ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);

        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'designation_name' => $this->input->post('designation_name'),
            'designation_name_mal' => $this->input->post('designation_name_mal'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $designation_id =  en_func($designation_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $designation_id, 'ci_designations', 'designation_id');
            $this->add_activity_log("Updated designation");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_designations');
            $this->add_activity_log("Added designation");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Designation successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Designation could not be added !');
        $this->response(200, $data);

    }

    public function designations_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_designations', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $designation_id  = en_func($row->designation_id, 'e');
            $data[] = array(
                ++$i,
                $row->designation_name,
                $row->designation_name_mal,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/designations/edit_designations/' . $designation_id . '" title="Edit designations" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/designations/view_designations/' . $designation_id . '" title="View designations" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }



}
