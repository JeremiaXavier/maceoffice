<?php
defined('BASEPATH') or exit('No direct script access allowed');

class probation_reports extends MY_Controller
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

        $this->template->views('admin/probation_reports/index', $data);
    }

    public function add_probation_reports()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data['ordersList'] = $this->Common_model->select_all('ci_probation_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');

        $this->template->views('admin/probation_reports/add_probation_reports', $data);
    }



    public function edit_probation_reports($report_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_probation_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_probation_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');

        $data['probationAbsence'] = $this->M_reports->select_probation_absence_of($report_id);
        $data['probationService'] = $this->M_reports->select_probation_service_of($report_id);

        $records["content"] = $this->load->view('admin/probation_reports/add_probation_reports', $data, true);
        $records["heading"] = "Edit Probation report details";
        $records["sub_heading"] = "Edit a probation report in the portal";

        $this->response(200, $records);
    }

    public function view_probation_reports($report_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_probation_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_probation_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');


        $data['probationAbsence'] = $this->M_reports->select_probation_absence_of($report_id);
        $data['probationService'] = $this->M_reports->select_probation_service_of($report_id);


        $records["content"] = $this->load->view('admin/probation_reports/add_probation_reports', $data, true);
        $records["heading"] = "View Probation report details";
        $records["sub_heading"] = "View a probation report in the portal";

        $this->response(200, $records);
    }


    public function update_probation_reports()
    {
        $report_id = $this->input->post('report_id');
        $this->save_probation_reports('update', $report_id);
    }


    public function save_probation_reports($func = 'add', $report_id = 0)
    {
        $this->form_validation->set_rules('points[]', 'Orders', 'trim|required');

        $this->form_validation->set_rules('employee_name', 'Employee name', 'trim|required');
        $this->form_validation->set_rules('employee_designation', 'Employee designation', 'trim|required');
        $this->form_validation->set_rules('employee_department', 'Employee department', 'trim|required');
        $this->form_validation->set_rules('pen_number', 'Employee PEN', 'trim|required');

        $this->form_validation->set_rules('report_no', 'Report no', 'trim|required');
        $this->form_validation->set_rules('report_title', 'Report title', 'trim|required');
        $this->form_validation->set_rules('report_date', 'Report date', 'trim|required');
        $this->form_validation->set_rules('probation_date_1', 'Probation date 1', 'trim|required');
        $this->form_validation->set_rules('probation_date_2', 'Probation date 2', 'trim|required');

        // $this->form_validation->set_rules('probation_service_remarks[]', 'Service remarks', 'required');
        // $this->form_validation->set_rules('probation_absence_remarks[]', 'Absence remarks', 'required');

        $this->form_validation->set_rules('probation_service_months[]', 'Service months', 'numeric');
        $this->form_validation->set_rules('probation_service_days[]', 'Service days', 'numeric');
        $this->form_validation->set_rules('probation_absence_months[]', 'Service months', 'numeric');
        $this->form_validation->set_rules('probation_absence_days[]', 'Service days', 'numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('report_id', 'reports ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $orders = $this->input->post('points');
        $report_orders = implode("~", $orders);


        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_name'), 'd'),
            'report_no' => $this->input->post('report_no'),
            'report_orders' => $report_orders,
            'report_title' => $this->input->post('report_title'),
            'report_date' => $this->input->post('report_date'),
            'probation_date_1' => $this->input->post('probation_date_1'),
            'probation_date_2' => $this->input->post('probation_date_2'),
            'pen_number' => $this->input->post('pen_number'),
            'employee_name' => en_func($this->input->post('employee_name'), 'd'),
            'employee_designation' => en_func($this->input->post('employee_designation'), 'd'),
            'employee_department' => en_func($this->input->post('employee_department'), 'd'),
            'office' => en_func($this->input->post('office'), 'd'),
            'scale_of_pay' => en_func($this->input->post('scale_of_pay'), 'd'),
            'present_pay' => $this->input->post('present_pay'),
            'edt_no' => $this->input->post('edt_no'),
            'edt_date' => $this->input->post('edt_date'),
            'assumption_of_charge' => $this->input->post('assumption_of_charge'),
            'test_required' => en_func($this->input->post('test_required'), 'd'),
            'test_details' => $this->input->post('test_details'),
            'test_date' => $this->input->post('test_date'),
            'eligible_for_probation' => $this->input->post('eligible_for_probation'),
            'reason_for_delaying_probation' => $this->input->post('reason_for_delaying_probation'),
            'records_enclosed' => en_func($this->input->post('records_enclosed'), 'd'),
            'date_of_first_appoinment' => $this->input->post('date_of_first_appoinment'),
            'first_designation' => en_func($this->input->post('first_designation'), 'd'),
            'date_of_current_appoinment' => $this->input->post('date_of_current_appoinment'),
            'efficiency_in_work' => en_func($this->input->post('efficiency_in_work'), 'd'),
            'willingness_shown' => en_func($this->input->post('willingness_shown'), 'd'),
            'getalong_with_people' => en_func($this->input->post('getalong_with_people'), 'd'),
            'loyalty' => en_func($this->input->post('loyalty'), 'd'),
            'discipline' => en_func($this->input->post('discipline'), 'd'),
            'sincerity_dependability_coperation' => en_func($this->input->post('sincerity_dependability_coperation'), 'd'),
            'satisfactory_performance' => en_func($this->input->post('satisfactory_performance'), 'd'),
            'generated' => 0,
            'report_filename' => null,
            'generated_date' => NULL,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $report_id =  en_func($report_id, 'd');


        $this->db->trans_begin();


        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_probation_reports', 'report_id');
            $this->add_activity_log("Updated Probation report");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_probation_reports');
            $this->add_activity_log("Added Probation report");
        endif;

        //lq();

        // dd($_POST);

        if ($this->input->post('probation_absence_from_date'))
            if (strlen($this->input->post('probation_absence_from_date')[0]) > 0)
                for ($i = 0; $i < sizeof($this->input->post('probation_absence_from_date')); $i++) {
                    $data_insert = array(
                        'probation_report_id' => $qry_response,
                        'probation_absence_from_date' => $this->input->post('probation_absence_from_date')[$i],
                        'probation_absence_to_date' => $this->input->post('probation_absence_to_date')[$i],
                        'probation_absence_months' => $this->input->post('probation_absence_months')[$i],
                        'probation_absence_days' => $this->input->post('probation_absence_days')[$i],
                        'probation_absence_remarks' => $this->input->post('probation_absence_remarks')[$i],
                        'created_at' => date("Y-m-d h:i:s"),
                        'updated_at' => date("Y-m-d h:i:s"),
                        'added_by' => $user_id,
                        'status' => 1
                    );


                    if (isset($this->input->post('pa_id')[$i])) :
                        if ($func == 'update')
                            $data_insert['probation_report_id'] = $report_id;

                        $pa_id = en_func($this->input->post('pa_id')[$i], 'd');
                        unset($data_insert['created_at']);
                        $qry_response2 = $this->Common_model->update_table($data_insert, $pa_id, 'ci_probation_absence', 'pa_id');
                    else :
                        if ($func == 'update')
                            $data_insert['probation_report_id'] = $report_id;

                        $qry_response2 = $this->Common_model->insert_table($data_insert, 'ci_probation_absence');
                    endif;
                }

        if ($this->input->post('probation_service_from_date'))
            if (strlen($this->input->post('probation_service_from_date')[0]) > 0)
                for ($i = 0; $i < sizeof($this->input->post('probation_service_from_date')); $i++) {
                    $data_insert = array(
                        'probation_report_id' => $qry_response,
                        'probation_service_from_date' => $this->input->post('probation_service_from_date')[$i],
                        'probation_service_to_date' => $this->input->post('probation_service_to_date')[$i],
                        'probation_service_months' => $this->input->post('probation_service_months')[$i],
                        'probation_service_days' => $this->input->post('probation_service_days')[$i],
                        'probation_service_remarks' => $this->input->post('probation_service_remarks')[$i],
                        'created_at' => date("Y-m-d h:i:s"),
                        'updated_at' => date("Y-m-d h:i:s"),
                        'added_by' => $user_id,
                        'status' => 1
                    );


                    if (isset($this->input->post('ps_id')[$i])) :
                        if ($func == 'update')
                            $data_insert['probation_report_id'] = $report_id;

                        $ps_id = en_func($this->input->post('ps_id')[$i], 'd');
                        unset($data_insert['created_at']);
                        $qry_response = $this->Common_model->update_table($data_insert, $ps_id, 'ci_probation_service', 'ps_id');
                    else :
                        if ($func == 'update')
                            $data_insert['probation_report_id'] = $report_id;

                        $qry_response = $this->Common_model->insert_table($data_insert, 'ci_probation_service');
                    endif;
                }


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            $this->db->trans_rollback();
        else
            $this->db->trans_commit();



        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Probation report successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Probation report could not be added !');
        $this->response(200, $data);
    }

    public function probation_reports_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_probation_reports', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $report_id  = en_func($row->report_id, 'e');

            $generated = $row->generated;

            $generated_reports = '';
            if ($generated)
                $generated_reports = '
                <div class="btn-group btn-group-sm">
            <a target="_blank" href="' . PROBATION_REPORTS . $row->report_filename . '" title="Print reports" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
            </div>
            ';

            $data[] = array(
                ++$i,
                $row->report_title,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/probation_reports/edit_probation_reports/' . $report_id . '" title="Edit probation_reports" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/probation_reports/view_probation_reports/' . $report_id . '" title="View probation_reports" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <a data-id="' . $report_id . '" title="Generate report" class="' . ($generated == 1 ? 'btn-primary' : 'generate-report btn-warning') . ' btn btn-sm">' . ($generated == 1 ? 'Generated' : 'Generate') . '</a>
                    <a data-id="' . $report_id . '" title="Delete report" class="delete-report btn-danger btn btn-sm"><i class="fa fa-trash"></i></a>
                    
                    </div>',
                $generated_reports

            );
        }
        $this->response(200, $data);
    }




    public function generate_probation_report($report_id = 0)
    {
        $data = $this->data;


        $report_id = en_func($report_id, 'd');
        $reportsDetails = $data["reportsDetails"] = $this->M_reports->select_probation_report_details($report_id);
        // $this->check_exists($data["reportsDetails"]);

        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');

        $data['ordersList'] = $this->Common_model->select_all('ci_probation_orders');


        $data['probationAbsence'] = $this->M_reports->select_probation_absence_of($report_id);
        $data['probationService'] = $this->M_reports->select_probation_service_of($report_id);

        // dd($reportsDetails);

        $report_filename = str_replace(' ', '-', $reportsDetails->employee_name_eng) . '-Probation-' . substr(en_func(strtotime("now"), 'e'), 0, 5) . '.pdf';

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

        $html = $this->load->view('admin/probation_reports/report_preview_page_1', $data, true);
        $mpdf->WriteHTML($html);


        $mpdf->AddPage();

        $html = $this->load->view('admin/probation_reports/report_preview_page_2', $data, true);
        $mpdf->WriteHTML($html);


        $mpdf->AddPage();

        $html = $this->load->view('admin/probation_reports/report_preview_page_3', $data, true);
        $mpdf->WriteHTML($html);

        $mpdf->Output('uploads/probation_reports/' . $report_filename, "F");
        // $mpdf->Output();
        // exit();



        $data_insert = array(
            'generated' => 1,
            'report_filename' => $report_filename,
            'generated_date' => date('Y-m-d'),
            'updated_at' => date("Y-m-d h:i:s"),
        );
        $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_probation_reports', 'report_id');

        $data = array('status' => 'success', 'msg' => 'Probation Report generated successfully !');
        $this->response(200, $data);
    }


    public function delete_absence($pa_id)
    {
        $pa_id = en_func($pa_id, 'd');
        $response = $this->Common_model->delete_table($pa_id, 'ci_probation_absence', 'pa_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Probation Absence has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Probation Absence could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_probation_absence', $pa_id, 'pa_id')->probation_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_probation_reports', 'report_id');
        }

        redirect(base_url('admin/probation_reports'));
    }

    public function delete_service($ps_id)
    {
        $ps_id = en_func($ps_id, 'd');
        $response = $this->Common_model->delete_table($ps_id, 'ci_probation_service', 'ps_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Probation Service has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Probation Service could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_probation_service', $ps_id, 'ps_id')->probation_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_probation_reports', 'report_id');
        }

        
        redirect(base_url('admin/probation_reports'));
    }

    /**
     * 
     * Probation Orders
     * 
     * 
     */


    public function orders()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/probation_reports/orders/index', $data);
    }

    public function add_orders()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/probation_reports/orders/add_orders', $data, true);
        $records["heading"] = "Add Probation Order details";
        $records["sub_heading"] = "Add a new probation order to the portal";

        $this->response(200, $records);
    }



    public function edit_orders($order_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_probation_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/probation_reports/orders/add_orders', $data, true);
        $records["heading"] = "Edit Probation Order details";
        $records["sub_heading"] = "Edit a probation order in the portal";

        $this->response(200, $records);
    }

    public function view_orders($order_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_probation_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/probation_reports/orders/add_orders', $data, true);
        $records["heading"] = "View Probation Order details";
        $records["sub_heading"] = "View a probation order in the portal";

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
            $qry_response = $this->Common_model->update_table($data_insert, $order_id, 'ci_probation_orders', 'order_id');
            $this->add_activity_log("Updated order");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_probation_orders');
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

        $records['data'] = $this->Common_model->select_all('ci_probation_orders', $status);
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
                    <a data-url="' . base_url() . 'admin/probation_reports/edit_orders/' . $order_id . '" title="Edit orders" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/probation_reports/view_orders/' . $order_id . '" title="View orders" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
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
