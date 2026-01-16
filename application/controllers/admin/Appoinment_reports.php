<?php
defined('BASEPATH') or exit('No direct script access allowed');

class appoinment_reports extends MY_Controller
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

        $this->template->views('admin/appoinment_reports/index', $data);
    }

    public function add_appoinment_reports()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data['ordersList'] = $this->Common_model->select_all('ci_appoinment_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');
        $data['vacancy_nature'] = $this->Common_model->select_all('ci_vacancy_nature');

        $this->template->views('admin/appoinment_reports/add_appoinment_reports', $data);
    }



    public function edit_appoinment_reports($report_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_appoinment_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_appoinment_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');

        $data['vacancy_nature'] = $this->Common_model->select_all('ci_vacancy_nature');
     

        $records["content"] = $this->load->view('admin/appoinment_reports/add_appoinment_reports', $data, true);
        $records["heading"] = "Edit Appoinment report details";
        $records["sub_heading"] = "Edit a Appoinment report in the portal";

        $this->response(200, $records);
    }

    public function view_appoinment_reports($report_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_appoinment_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_appoinment_orders');

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');

        $data['vacancy_nature'] = $this->Common_model->select_all('ci_vacancy_nature');



        $records["content"] = $this->load->view('admin/appoinment_reports/add_appoinment_reports', $data, true);
        $records["heading"] = "View Appoinment report details";
        $records["sub_heading"] = "View a Appoinment report in the portal";

        $this->response(200, $records);
    }


    public function update_appoinment_reports()
    {
        $report_id = $this->input->post('report_id');
        $this->save_appoinment_reports('update', $report_id);
    }


    public function save_appoinment_reports($func = 'add', $report_id = 0)
    {
        $this->form_validation->set_rules('points[]', 'Orders', 'trim|required');

        $this->form_validation->set_rules('employee_name', 'Employee name', 'trim|required');
        $this->form_validation->set_rules('employee_designation', 'Employee designation', 'trim|required');
        $this->form_validation->set_rules('employee_department', 'Employee department', 'trim|required');
        $this->form_validation->set_rules('pen_number', 'Employee PEN', 'trim|required');

        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('date_of_birth_text', 'Date of Birth in text', 'trim|required');
        $this->form_validation->set_rules('employee_religion', 'Religion', 'trim|required');
        $this->form_validation->set_rules('employee_caste', 'Caste', 'trim|required');
        $this->form_validation->set_rules('age_concession', 'Age concession', 'trim|required');
        $this->form_validation->set_rules('rank', 'Rank', 'trim|required');

        $this->form_validation->set_rules('vacancy_reason', 'Vacancy reason', 'trim|required');

        $this->form_validation->set_rules('report_no', 'Report no', 'trim|required');
        $this->form_validation->set_rules('report_title', 'Report title', 'trim|required');
        $this->form_validation->set_rules('report_date', 'Report date', 'trim|required');
        $this->form_validation->set_rules('appoinment_date', 'appoinment date', 'trim|required');

       

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
            'appoinment_date' => $this->input->post('appoinment_date'),
            'pen_number' => $this->input->post('pen_number'),
            'employee_salutation' => en_func($this->input->post('employee_salutation'), 'd'),
            'employee_name' => en_func($this->input->post('employee_name'), 'd'),
            'employee_designation' => en_func($this->input->post('employee_designation'), 'd'),
            'employee_department' => en_func($this->input->post('employee_department'), 'd'),
            'office' => en_func($this->input->post('office'), 'd'),
            'scale_of_pay' => en_func($this->input->post('scale_of_pay'), 'd'),
            'new_pay' => $this->input->post('new_pay'),
            'employee_housename' => $this->input->post('employee_housename'),
            'employee_postoffice' => $this->input->post('employee_postoffice'),
            'employee_city' => $this->input->post('employee_city'),
            'employee_city' => $this->input->post('employee_city'),
            'new_designation' => en_func($this->input->post('new_designation'), 'd'),
            'old_employee_salutation' => en_func($this->input->post('old_employee_salutation'), 'd'),
            'old_employee_name' => en_func($this->input->post('old_employee_name'), 'd'),
            'appoinment_date' => $this->input->post('appoinment_date'),
            'service_years' => $this->input->post('service_years'),
            'monitoring_service_years' => $this->input->post('monitoring_service_years'),
            'reading_no_1' => $this->input->post('reading_no_1'),
            'reading_no_2' => $this->input->post('reading_no_2'),
            'reading_no_3' => $this->input->post('reading_no_3'),
            'rank_details' => $this->input->post('rank_details'),
            'any_department' => $this->input->post('any_department'),
            'any_department_rank' => $this->input->post('any_department_rank'),
           
            'date_of_vacancy' => $this->input->post('date_of_vacancy'),
            'vacancy_reason' => $this->input->post('vacancy_reason'),
            'director_order_no' => $this->input->post('director_order_no'),
            'director_order_date' => $this->input->post('director_order_date'),
            'vacancy_nature' => en_func($this->input->post('vacancy_nature'), 'd'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'date_of_birth_text' => $this->input->post('date_of_birth_text'),
            'employee_religion' => $this->input->post('employee_religion'),
            'employee_caste' => $this->input->post('employee_caste'),
            'age_concession' => en_func($this->input->post('age_concession'), 'd'),
            'general_qualification' => $this->input->post('general_qualification'),
            'technical_qualification' => $this->input->post('technical_qualification'),
            'employee_experience' => $this->input->post('employee_experience'),
            'rank' => $this->input->post('rank'),
            'the_rank_details' => $this->input->post('the_rank_details'),
            'committee_selected' => en_func($this->input->post('committee_selected'), 'd'),
            'governing_order_attached' => en_func($this->input->post('governing_order_attached'), 'd'),
            'qualified_for_promotion' => en_func($this->input->post('qualified_for_promotion'), 'd'),
            'university_order_attached' => en_func($this->input->post('university_order_attached'), 'd'),
            'date_of_joining' => $this->input->post('date_of_joining'),
            'date_of_joining_time' => en_func($this->input->post('date_of_joining_time'), 'd'),
            'original_certificates_attached' => en_func($this->input->post('original_certificates_attached'), 'd'),
            'service_book_attached' => en_func($this->input->post('service_book_attached'), 'd'),

            'generated' => 0,
            'report_filename' => null,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $report_id =  en_func($report_id, 'd');



        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_appoinment_reports', 'report_id');
            $this->add_activity_log("Updated Appoinment report");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_appoinment_reports');
            $this->add_activity_log("Added Appoinment report");
        endif;

        //lq();

        // dd($_POST);

        




        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Appoinment report successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Appoinment report could not be added !');
        $this->response(200, $data);
    }

    public function appoinment_reports_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_appoinment_reports', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $report_id  = en_func($row->report_id, 'e');

            $generated = $row->generated;

            $generated_reports = '';
            if ($generated)
                $generated_reports = '
                <div class="btn-group btn-group-sm">
            <a target="_blank" href="' . APPOINMENT_REPORTS . $row->report_filename . '" title="Print reports" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
            </div>
            ';

            $data[] = array(
                ++$i,
                $row->report_title,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/appoinment_reports/edit_appoinment_reports/' . $report_id . '" title="Edit appoinment_reports" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/appoinment_reports/view_appoinment_reports/' . $report_id . '" title="View appoinment_reports" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <a data-id="' . $report_id . '" title="Generate report" class="' . ($generated == 1 ? 'btn-primary' : 'generate-report btn-warning') . ' btn btn-sm">' . ($generated == 1 ? 'Generated' : 'Generate') . '</a>
                    <a data-id="' . $report_id . '" title="Delete report" class="delete-report btn-danger btn btn-sm"><i class="fa fa-trash"></i></a>
                    
                    </div>',
                $generated_reports

            );
        }
        $this->response(200, $data);
    }




    public function generate_appoinment_report($report_id = 0)
    {
        $data = $this->data;


        $report_id = en_func($report_id, 'd');
        $reportsDetails = $data["reportsDetails"] = $this->M_reports->select_appoinment_report_details($report_id); 
        // $this->check_exists($data["reportsDetails"]);

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');

        $data['ordersList'] = $this->Common_model->select_all('ci_appoinment_orders');


        // dd($reportsDetails);

        $report_filename = str_replace(' ', '-', $reportsDetails->employee_name_eng) . '-appoinment-' . substr(en_func(strtotime("now"), 'e'), 0, 5) . '.pdf';

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

        $html = $this->load->view('admin/appoinment_reports/report_preview_page_1', $data, true);
        $mpdf->WriteHTML($html);


        $mpdf->AddPage();

        $html = $this->load->view('admin/appoinment_reports/report_preview_page_2', $data, true);
        $mpdf->WriteHTML($html);


        $mpdf->AddPage();

        // $html = $this->load->view('admin/appoinment_reports/report_preview_page_3', $data, true);
        // $mpdf->WriteHTML($html);

        $mpdf->Output('uploads/appoinment_reports/' . $report_filename, "F");
        // $mpdf->Output();
        // exit();



        $data_insert = array(
            'generated' => 1,
            'report_filename' => $report_filename,
            'updated_at' => date("Y-m-d h:i:s"),
        );
        $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_appoinment_reports', 'report_id');

        $data = array('status' => 'success', 'msg' => 'Appoinment report generated successfully !');
        $this->response(200, $data);
    }


    public function delete_absence($pa_id)
    {
        $pa_id = en_func($pa_id, 'd');
        $response = $this->Common_model->delete_table($pa_id, 'ci_appoinment_absence', 'pa_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'appoinment Absence has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'appoinment Absence could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_appoinment_absence', $pa_id, 'pa_id')->appoinment_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_appoinment_reports', 'report_id');
        }

        redirect(base_url('admin/appoinment_reports'));
    }

    public function delete_service($ps_id)
    {
        $ps_id = en_func($ps_id, 'd');
        $response = $this->Common_model->delete_table($ps_id, 'ci_appoinment_service', 'ps_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'appoinment Service has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'appoinment Service could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_appoinment_service', $ps_id, 'ps_id')->appoinment_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_appoinment_reports', 'report_id');
        }

        
        redirect(base_url('admin/appoinment_reports'));
    }

    /**
     * 
     * appoinment Orders
     * 
     * 
     */


    public function orders()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/appoinment_reports/orders/index', $data);
    }

    public function add_orders()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/appoinment_reports/orders/add_orders', $data, true);
        $records["heading"] = "Add appoinment Order details";
        $records["sub_heading"] = "Add a new appoinment order to the portal";

        $this->response(200, $records);
    }



    public function edit_orders($order_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_appoinment_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/appoinment_reports/orders/add_orders', $data, true);
        $records["heading"] = "Edit appoinment Order details";
        $records["sub_heading"] = "Edit a appoinment order in the portal";

        $this->response(200, $records);
    }

    public function view_orders($order_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_appoinment_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/appoinment_reports/orders/add_orders', $data, true);
        $records["heading"] = "View appoinment Order details";
        $records["sub_heading"] = "View a appoinment order in the portal";

        $this->response(200, $records);
    }


    public function update_orders()
    {
        $order_id = $this->input->post('order_id');
        $this->save_orders('update', $order_id);
    }


    public function save_orders($func = 'add', $order_id = 0)
    {
        $this->form_validation->set_rules('order_number', 'order number', 'trim|required');
        $this->form_validation->set_rules('order_content', 'order name', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('order_id', 'orders ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'order_number' => $this->input->post('order_number'),
            'order_content' => $this->input->post('order_content'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $order_id =  en_func($order_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $order_id, 'ci_appoinment_orders', 'order_id');
            $this->add_activity_log("Updated order");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_appoinment_orders');
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

        $records['data'] = $this->Common_model->select_all('ci_appoinment_orders', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $order_id  = en_func($row->order_id, 'e');
            $data[] = array(
                ++$i,
                $row->order_number,
                $row->order_content,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-md">
                    <a data-url="' . base_url() . 'admin/appoinment_reports/edit_orders/' . $order_id . '" title="Edit orders" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/appoinment_reports/view_orders/' . $order_id . '" title="View orders" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
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
