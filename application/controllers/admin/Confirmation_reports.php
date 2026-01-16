<?php
defined('BASEPATH') or exit('No direct script access allowed');

class confirmation_reports extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('M_reports');

        $this->data["menu_id"] = 4;
    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/confirmation_reports/index', $data);
    }

    public function add_confirmation_reports()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data['ordersList'] = $this->Common_model->select_all('ci_confirmation_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');

        $this->template->views('admin/confirmation_reports/add_confirmation_reports', $data);
    }



    public function edit_confirmation_reports($report_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_confirmation_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_confirmation_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');


        $records["content"] = $this->load->view('admin/confirmation_reports/add_confirmation_reports', $data, true);
        $records["heading"] = "Edit Confirmation report details";
        $records["sub_heading"] = "Edit a Confirmation report in the portal";

        $this->response(200, $records);
    }

    public function view_confirmation_reports($report_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_confirmation_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_confirmation_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
    

        $records["content"] = $this->load->view('admin/confirmation_reports/add_confirmation_reports', $data, true);
        $records["heading"] = "View Confirmation report details";
        $records["sub_heading"] = "View a Confirmation report in the portal";

        $this->response(200, $records);
    }


    public function update_confirmation_reports()
    {
        $report_id = $this->input->post('report_id');
        $this->save_confirmation_reports('update', $report_id);
    }


    public function save_confirmation_reports($func = 'add', $report_id = 0)
    {
        // $this->form_validation->set_rules('points[]', 'Orders', 'trim|required');

        $this->form_validation->set_rules('employee_name', 'Employee name', 'trim|required');
        $this->form_validation->set_rules('employee_designation', 'Employee designation', 'trim|required');
        $this->form_validation->set_rules('employee_department', 'Employee department', 'trim|required');
        $this->form_validation->set_rules('pen_number', 'Employee PEN', 'trim|required');

        $this->form_validation->set_rules('report_no', 'Report no', 'trim|required');
        $this->form_validation->set_rules('report_title', 'Report title', 'trim|required');
        $this->form_validation->set_rules('report_date', 'Report date', 'trim|required');
        
        $this->form_validation->set_rules('order_date_orders_1', 'Order date 1', 'trim|required');
        $this->form_validation->set_rules('order_no_orders_1', 'Order Report no 1', 'trim|required');
        $this->form_validation->set_rules('order_date_orders_2', 'Order date 2', 'trim|required');
        $this->form_validation->set_rules('order_no_orders_2', 'Order Report no 2', 'trim|required');

        $this->form_validation->set_rules('start_service_date', 'Start service date', 'trim|required');
     

        if ($func == 'update')
            $this->form_validation->set_rules('report_id', 'reports ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $orders = $this->input->post('points');


        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_name'), 'd'),
            'report_no' => $this->input->post('report_no'),
            'report_title' => $this->input->post('report_title'),
            'report_date' => $this->input->post('report_date'),
            'pen_number' => $this->input->post('pen_number'),
            'employee_name' => en_func($this->input->post('employee_name'), 'd'),
            'employee_designation' => en_func($this->input->post('employee_designation'), 'd'),
            'employee_department' => en_func($this->input->post('employee_department'), 'd'),
            'office' => en_func($this->input->post('office'), 'd'),
            
            'order_date_orders_1' => $this->input->post('order_date_orders_1'),
            'order_no_orders_1' => $this->input->post('order_no_orders_1'),
            'order_date_orders_2' => $this->input->post('order_date_orders_2'),
            'order_no_orders_2' => $this->input->post('order_no_orders_2'),

            'start_service_date' => $this->input->post('start_service_date'),
       
            'generated' => 0,
            'report_filename' => null,
            'generated_date' => NULL,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $report_id =  en_func($report_id, 'd');


        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_confirmation_reports', 'report_id');
            $this->add_activity_log("Updated Confirmation report");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_confirmation_reports');
            $this->add_activity_log("Added Confirmation report");
        endif;

        //lq();

        // dd($_POST);



        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Confirmation report successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Confirmation report could not be added !');
        $this->response(200, $data);
    }

    public function confirmation_reports_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_confirmation_reports', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $report_id  = en_func($row->report_id, 'e');

            $generated = $row->generated;

            $generated_reports = '';
            if ($generated)
                $generated_reports = '
                <div class="btn-group btn-group-sm">
            <a target="_blank" href="' . CONFIRMATION_REPORTS . $row->report_filename . '" title="Print reports" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
            </div>
            ';

            $data[] = array(
                ++$i,
                $row->report_title,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/confirmation_reports/edit_confirmation_reports/' . $report_id . '" title="Edit confirmation_reports" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/confirmation_reports/view_confirmation_reports/' . $report_id . '" title="View confirmation_reports" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <a data-id="' . $report_id . '" title="Generate report" class="' . ($generated == 1 ? 'btn-primary' : 'generate-report btn-warning') . ' btn btn-sm">' . ($generated == 1 ? 'Generated' : 'Generate') . '</a>
                    <a data-id="' . $report_id . '" title="Delete report" class="delete-report btn-danger btn btn-sm"><i class="fa fa-trash"></i></a>
                    
                    </div>',
                $generated_reports

            );
        }
        $this->response(200, $data);
    }




    public function generate_confirmation_report($report_id = 0)
    {
        $data = $this->data;


        $report_id = en_func($report_id, 'd');
        $reportsDetails = $data["reportsDetails"] = $this->M_reports->select_confirmation_report_details($report_id);
        // $this->check_exists($data["reportsDetails"]);

        // dd($reportsDetails);

        $report_filename = str_replace(' ', '-', $reportsDetails->employee_name_eng) . '-Confirmation-' . substr(en_func(strtotime("now"), 'e'), 0, 5) . '.pdf';

        $mpdf = new \Mpdf\Mpdf();

        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/custom/font/directory',
            ]),
            'fontdata' => $fontData + [
                'manjari-mal' => [
                    'R' => 'Manjari-Bold.ttf',
                    'I' => 'Manjari-Bold.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75
                ]
            ]
        ]);

        $html = $this->load->view('admin/confirmation_reports/report_preview_page_1', $data, true);
        $mpdf->WriteHTML($html);

        $mpdf->Output('uploads/confirmation_reports/' . $report_filename, "F");
        // $mpdf->Output();
        // exit();



        $data_insert = array(
            'generated' => 1,
            'report_filename' => $report_filename,
            'generated_date' => date('Y-m-d'),
            'updated_at' => date("Y-m-d h:i:s"),
        );
        $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_confirmation_reports', 'report_id');

        $data = array('status' => 'success', 'msg' => 'Confirmation Report generated successfully !');
        $this->response(200, $data);
    }


    public function delete_absence($pa_id)
    {
        $pa_id = en_func($pa_id, 'd');
        $response = $this->Common_model->delete_table($pa_id, 'ci_Confirmation_absence', 'pa_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Confirmation Absence has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Confirmation Absence could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_Confirmation_absence', $pa_id, 'pa_id')->Confirmation_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_confirmation_reports', 'report_id');
        }

        redirect(base_url('admin/confirmation_reports'));
    }

    public function delete_service($ps_id)
    {
        $ps_id = en_func($ps_id, 'd');
        $response = $this->Common_model->delete_table($ps_id, 'ci_Confirmation_service', 'ps_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Confirmation Service has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Confirmation Service could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_Confirmation_service', $ps_id, 'ps_id')->Confirmation_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_confirmation_reports', 'report_id');
        }

        
        redirect(base_url('admin/confirmation_reports'));
    }

    /**
     * 
     * Confirmation Orders
     * 
     * 
     */


    public function orders()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/confirmation_reports/orders/index', $data);
    }

    public function add_orders()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/confirmation_reports/orders/add_orders', $data, true);
        $records["heading"] = "Add Confirmation Order details";
        $records["sub_heading"] = "Add a new Confirmation order to the portal";

        $this->response(200, $records);
    }



    public function edit_orders($order_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_confirmation_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/confirmation_reports/orders/add_orders', $data, true);
        $records["heading"] = "Edit Confirmation Order details";
        $records["sub_heading"] = "Edit a Confirmation order in the portal";

        $this->response(200, $records);
    }

    public function view_orders($order_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_confirmation_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/confirmation_reports/orders/add_orders', $data, true);
        $records["heading"] = "View Confirmation Order details";
        $records["sub_heading"] = "View a Confirmation order in the portal";

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
            $qry_response = $this->Common_model->update_table($data_insert, $order_id, 'ci_confirmation_orders', 'order_id');
            $this->add_activity_log("Updated order");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_confirmation_orders');
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

        $records['data'] = $this->Common_model->select_all('ci_confirmation_orders', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $order_id  = en_func($row->order_id, 'e');
            $data[] = array(
                ++$i,
                $row->order_content,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-md">
                    <a data-url="' . base_url() . 'admin/confirmation_reports/edit_orders/' . $order_id . '" title="Edit orders" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/confirmation_reports/view_orders/' . $order_id . '" title="View orders" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }

    /**
     * 
     *  AJAX Call for employee details
     * 
     */

    public function get_employee_details_prefill()
    {
        $this->load->model('M_Employees');
        $employee_id = $this->input->get('employee_id');
        $this->check_encrypted($employee_id, 'Employee');

        $employee_id = en_func($employee_id, 'd');

        $employee_response = $this->Common_model->select_by_id('ci_employees', $employee_id, 'employee_id');

        $qry_response = $this->M_Employees->select_employee_detail_by_id($employee_id);
        $records = (array) $qry_response;

        $records["msg"] = (empty($records)) ? 'No data found' : 'Details loaded';

        if (!empty($employee_response)) :
            $records['employee_number'] = $employee_response->employee_number;
        endif;

        $this->response(200, $records);
    }
}
