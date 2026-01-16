<?php
defined('BASEPATH') or exit('No direct script access allowed');

class orders extends MY_Controller
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

        $this->template->views('admin/orders/index', $data);
    }

    public function add_orders()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/orders/add_orders', $data, true);
        $records["heading"] = "Add Order details";
        $records["sub_heading"] = "Add a new order to the portal";

        $this->response(200, $records);
    }



    public function edit_orders($order_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/orders/add_orders', $data, true);
        $records["heading"] = "Edit Order details";
        $records["sub_heading"] = "Edit a order in the portal";

        $this->response(200, $records);
    }

    public function view_orders($order_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/orders/add_orders', $data, true);
        $records["heading"] = "View Order details";
        $records["sub_heading"] = "View a order in the portal";

        $this->response(200, $records);
    }


    public function update_orders()
    {
        $order_id = $this->input->post('order_id');
        $this->save_orders('update', $order_id);
    }


    public function save_orders($func = 'add', $order_id = 0)
    {
        $this->form_validation->set_rules('order_content', 'order name', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('order_id', 'orders ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);

        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'order_content' => $this->input->post('order_content'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $order_id =  en_func($order_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $order_id, 'ci_orders', 'order_id');
            $this->add_activity_log("Updated order");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_orders');
            $this->add_activity_log("Added order");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Order successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Order could not be added !');
        $this->response(200, $data);

    }

    public function orders_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_orders', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $order_id  = en_func($row->order_id, 'e');
            $data[] = array(
                ++$i,
                $row->order_content,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/orders/edit_orders/' . $order_id . '" title="Edit orders" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/orders/view_orders/' . $order_id . '" title="View orders" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }
}
