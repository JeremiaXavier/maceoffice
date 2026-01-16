<?php
defined('BASEPATH') or exit('No direct script access allowed');

class promotion_reports extends MY_Controller
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

        $this->template->views('admin/promotion_reports/index', $data);
    }


    public function add_promotion_reports()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');
        $data['promotionReasons'] = $this->Common_model->select_all('ci_promotion_reasons');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['vacancy_nature'] = $this->Common_model->select_all('ci_vacancy_nature');

        $this->template->views('admin/promotion_reports/add_promotion_reports', $data);
    }



    public function edit_promotion_reports($report_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_promotion_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);


        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');
        $data['promotionReasons'] = $this->Common_model->select_all('ci_promotion_reasons');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['vacancy_nature'] = $this->Common_model->select_all('ci_vacancy_nature');


        $records["content"] = $this->load->view('admin/promotion_reports/add_promotion_reports', $data, true);
        $records["heading"] = "Edit Promotion report details";
        $records["sub_heading"] = "Edit a Promotion report in the portal";

        $this->response(200, $records);
    }

    public function view_promotion_reports($report_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_promotion_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);


        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');
        $data['promotionReasons'] = $this->Common_model->select_all('ci_promotion_reasons');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['vacancy_nature'] = $this->Common_model->select_all('ci_vacancy_nature');




        $records["content"] = $this->load->view('admin/promotion_reports/add_promotion_reports', $data, true);
        $records["heading"] = "View Promotion report details";
        $records["sub_heading"] = "View a Promotion report in the portal";

        $this->response(200, $records);
    }


    public function update_promotion_reports()
    {
        $report_id = $this->input->post('report_id');
        $this->save_promotion_reports('update', $report_id);
    }


    public function save_promotion_reports($func = 'add', $report_id = 0)
    {

        $this->form_validation->set_rules('employee_name', 'Employee name', 'trim|required');
        $this->form_validation->set_rules('employee_designation', 'Employee designation', 'trim|required');
        $this->form_validation->set_rules('employee_department', 'Employee department', 'trim|required');

        $this->form_validation->set_rules('previous_employee_name', 'Previous Employee name', 'trim|required');
        $this->form_validation->set_rules('previous_employee_designation', 'Previous Employee designation', 'trim|required');
        $this->form_validation->set_rules('previous_employee_department', 'Previous Employee department', 'trim|required');

        $this->form_validation->set_rules('promotion_reason', 'Promotion reason', 'trim|required');
        $this->form_validation->set_rules('scale_of_pay', 'Scale of Pay', 'trim|required');
        $this->form_validation->set_rules('present_pay', 'Present Pay', 'trim|required');

        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('date_of_birth_text', 'Date of Birth in text', 'trim|required');
        $this->form_validation->set_rules('employee_address', 'Address', 'trim|required');
        $this->form_validation->set_rules('employee_religion', 'Religion', 'trim|required');
        $this->form_validation->set_rules('employee_caste', 'Caste', 'trim|required');
        $this->form_validation->set_rules('age_concession', 'Age concession', 'trim|required');
        $this->form_validation->set_rules('rank', 'Rank', 'trim|required');

        $this->form_validation->set_rules('promotion_date', 'Promotion date', 'trim|required');
        $this->form_validation->set_rules('previous_employee_date', 'Previous Employee date', 'trim|required');
        $this->form_validation->set_rules('vacancy_reason', 'Vacancy reason', 'trim|required');

        $this->form_validation->set_rules('report_no', 'Report no', 'trim|required');
        $this->form_validation->set_rules('report_title', 'Report title', 'trim|required');
        $this->form_validation->set_rules('report_date', 'Report date', 'trim|required');
      


        if ($func == 'update')
            $this->form_validation->set_rules('report_id', 'reports ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
      


        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_name'), 'd'),
            'report_no' => $this->input->post('report_no'),
            'report_title' => $this->input->post('report_title'),
            'report_date' => $this->input->post('report_date'),
            'employee_salutation' => en_func($this->input->post('employee_salutation'), 'd'),
            'employee_salutation' => en_func($this->input->post('employee_salutation'), 'd'),
            'employee_name' => en_func($this->input->post('employee_name'), 'd'),
            'employee_designation' => en_func($this->input->post('employee_designation'), 'd'),
            'employee_department' => en_func($this->input->post('employee_department'), 'd'),
            'office' => en_func($this->input->post('office'), 'd'),
            'scale_of_pay' => en_func($this->input->post('scale_of_pay'), 'd'),
            'present_pay' => $this->input->post('present_pay'),
            'previous_employee_salutation' => en_func($this->input->post('previous_employee_salutation'), 'd'),
            'previous_employee_name' => en_func($this->input->post('previous_employee_name'), 'd'),
            'previous_employee_designation' => en_func($this->input->post('previous_employee_designation'), 'd'),
            'previous_employee_department' => en_func($this->input->post('previous_employee_department'), 'd'),
            'promotion_reason' => $this->input->post('promotion_reason'),
            'promotion_date' => $this->input->post('promotion_date'),
            'previous_employee_date' => $this->input->post('previous_employee_date'),
            'vacancy_reason' => $this->input->post('vacancy_reason'),
            'vacancy_text' => $this->input->post('vacancy_text'),
            'vacancy_due_higher_category' => en_func($this->input->post('vacancy_due_higher_category'),'d'),
            'director_order_no' => $this->input->post('director_order_no'),
            'diretor_order_date' => $this->input->post('diretor_order_date'),
            'pen_number' => $this->input->post('pen_number'),
            'vacancy_nature' => en_func($this->input->post('vacancy_nature'), 'd'),
            'employee_address' => $this->input->post('employee_address'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'date_of_birth_text' => $this->input->post('date_of_birth_text'),
            'employee_religion' => $this->input->post('employee_religion'),
            'employee_caste' => $this->input->post('employee_caste'),
            'age_concession' => en_func($this->input->post('age_concession'), 'd'),
            'general_qualification' => $this->input->post('general_qualification'),
            'technical_qualification' => $this->input->post('technical_qualification'),
            'employee_experience' => $this->input->post('employee_experience'),
            'rank' => $this->input->post('rank'),
            'rank_details' => $this->input->post('rank_details'),
            'committee_selected' => en_func($this->input->post('committee_selected'), 'd'),
            'committee_details' => $this->input->post('committee_details'),
            'governing_order_attached' => en_func($this->input->post('governing_order_attached'), 'd'),
            'qualified_for_promotion' => en_func($this->input->post('qualified_for_promotion'), 'd'),
            'promotion_order_attached' => en_func($this->input->post('promotion_order_attached'), 'd'),
            'date_of_joining' => $this->input->post('date_of_joining'),
            'date_of_joining_time' => en_func($this->input->post('date_of_joining_time'), 'd'),
            'promotion_no' => $this->input->post('promotion_no'),
            'promotion_date_of_order' => $this->input->post('promotion_date_of_order'),
            'original_certificates_list' => $this->input->post('original_certificates_list'),
            'original_certificates_attached' => en_func($this->input->post('original_certificates_attached'), 'd'),
            'service_book_attached' => en_func($this->input->post('service_book_attached'), 'd'),
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
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_promotion_reports', 'report_id');
            $this->add_activity_log("Updated Promotion report");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_promotion_reports');
            $this->add_activity_log("Added Promotion report");
        endif;

        //lq();

        // dd($_POST);

     




        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Promotion report successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Promotion report could not be added !');
        $this->response(200, $data);
    }

    public function promotion_reports_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_promotion_reports', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $report_id  = en_func($row->report_id, 'e');

            $generated = $row->generated;

            $generated_reports = '';
            if ($generated)
                $generated_reports = '
                <div class="btn-group btn-group-sm">
            <a target="_blank" href="' . PROMOTION_REPORTS . $row->report_filename . '" title="Print reports" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
            </div>
            ';

            $data[] = array(
                ++$i,
                $row->report_title,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/promotion_reports/edit_promotion_reports/' . $report_id . '" title="Edit promotion_reports" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/promotion_reports/view_promotion_reports/' . $report_id . '" title="View promotion_reports" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <a data-id="' . $report_id . '" title="Generate report" class="' . ($generated == 1 ? 'btn-primary' : 'generate-report btn-warning') . ' btn btn-sm">' . ($generated == 1 ? 'Generated' : 'Generate') . '</a>
                    <a data-id="' . $report_id . '" title="Delete report" class="delete-report btn-danger btn btn-sm"><i class="fa fa-trash"></i></a>
                    
                    </div>',
                $generated_reports

            );
        }
        $this->response(200, $data);
    }




    public function generate_promotion_report($report_id = 0)
    {
        $data = $this->data;


        $report_id = en_func($report_id, 'd');
        $reportsDetails = $data["reportsDetails"] = $this->M_reports->select_promotion_report_details($report_id);
        // $this->check_exists($data["reportsDetails"]);

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');
        $data['promotionReasons'] = $this->Common_model->select_all('ci_promotion_reasons');


        // dd($reportsDetails);

        $report_filename = str_replace(' ', '-', $reportsDetails->employee_name_eng) . '-Promotion-' . substr(en_func(strtotime("now"), 'e'), 0, 5) . '.pdf';

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

        $html = $this->load->view('admin/promotion_reports/report_preview_page_1', $data, true);
        $mpdf->WriteHTML($html);


        $mpdf->AddPage();

        $html = $this->load->view('admin/promotion_reports/report_preview_page_2', $data, true);
        $mpdf->WriteHTML($html);



        $mpdf->Output('uploads/promotion_reports/' . $report_filename, "F");
        // $mpdf->Output();
        // exit();



        $data_insert = array(
            'generated' => 1,
            'report_filename' => $report_filename,
            'generated_date' => date('Y-m-d'),
            'updated_at' => date("Y-m-d h:i:s"),
        );
        $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_promotion_reports', 'report_id');

        $data = array('status' => 'success', 'msg' => 'Promotion Report generated successfully !');
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
