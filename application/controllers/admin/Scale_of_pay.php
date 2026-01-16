<?php
defined('BASEPATH') or exit('No direct script access allowed');

class scale_of_pay extends MY_Controller
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

        $this->template->views('admin/scale_of_pay/index', $data);
    }

    public function add_scale_of_pay()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();


        $records["content"] = $this->load->view('admin/scale_of_pay/add_scale_of_pay', $data, true);
        $records["heading"] = "Add Scale of pay details";
        $records["sub_heading"] = "Add a new scale of pay to the portal";

        $this->response(200, $records);
    }

 

    public function edit_scale_of_pay($sop_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["sop_id"] = $sop_id;

        $sop_id = en_func($sop_id, 'd');

        $data["scale_of_payDetails"] = $this->Common_model->select_by_id('ci_scale_of_pay', $sop_id, 'sop_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["scale_of_payDetails"]);

        $records["content"] = $this->load->view('admin/scale_of_pay/add_scale_of_pay', $data, true);
        $records["heading"] = "Edit Scale of pay details";
        $records["sub_heading"] = "Edit a scale of pay in the portal";

        $this->response(200, $records);
    }

    public function view_scale_of_pay($sop_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["sop_id"] = $sop_id;

        $sop_id = en_func($sop_id, 'd');

        $data["scale_of_payDetails"] = $this->Common_model->select_by_id('ci_scale_of_pay', $sop_id, 'sop_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["scale_of_payDetails"]);

        $records["content"] = $this->load->view('admin/scale_of_pay/add_scale_of_pay', $data, true);
        $records["heading"] = "View Scale of pay details";
        $records["sub_heading"] = "View a scale of pay in the portal";

        $this->response(200, $records);
    }


    public function update_scale_of_pay()
    {
        $sop_id = $this->input->post('sop_id');
        $this->save_scale_of_pay('update', $sop_id);
    }


    public function save_scale_of_pay($func = 'add', $sop_id = 0)
    {
        $this->form_validation->set_rules('pay_range', 'Scale of pay', 'trim|required');
        $this->form_validation->set_rules('pay_range_full', 'Scale of pay Full', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('sop_id', 'scale_of_pay ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);

        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'pay_range' => $this->input->post('pay_range'),
            'pay_range_full' => $this->input->post('pay_range_full'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $sop_id =  en_func($sop_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $sop_id, 'ci_scale_of_pay', 'sop_id');
            $this->add_activity_log("Updated scale of pay");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_scale_of_pay');
            $this->add_activity_log("Added scale of pay");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Scale of pay successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Scale of pay could not be added !');
        $this->response(200, $data);

    }

    public function scale_of_pay_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_scale_of_pay', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $sop_id  = en_func($row->sop_id, 'e');
            $data[] = array(
                ++$i,
                $row->pay_range,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/scale_of_pay/edit_scale_of_pay/' . $sop_id . '" title="Edit scale_of_pay" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/scale_of_pay/view_scale_of_pay/' . $sop_id . '" title="View scale_of_pay" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }



}
