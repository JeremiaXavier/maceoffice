<?php
defined('BASEPATH') or exit('No direct script access allowed');

class grade_promotion_reports extends MY_Controller
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

        $this->template->views('admin/grade_promotion_reports/index', $data);
    }


    public function add_grade_promotion_reports()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');
        $data['vacancy_nature'] = $this->Common_model->select_all('ci_vacancy_nature');

        $this->template->views('admin/grade_promotion_reports/add_grade_promotion_reports', $data);
    }



    public function edit_grade_promotion_reports($report_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_grade_promotion_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);


        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');

        $data['temporaryService'] = $this->M_reports->select_grade_promotion_temporary($report_id);
        $data['serviceDetails'] = $this->M_reports->select_grade_promotion_service($report_id);

        $records["content"] = $this->load->view('admin/grade_promotion_reports/add_grade_promotion_reports', $data, true);
        $records["heading"] = "Edit Grade Promotion report details";
        $records["sub_heading"] = "Edit a Grade Promotion report in the portal";

        $this->response(200, $records);
    }

    public function view_grade_promotion_reports($report_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_grade_promotion_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["reportsDetails"]);


        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');

        $data['temporaryService'] = $this->M_reports->select_grade_promotion_temporary($report_id);
        $data['serviceDetails'] = $this->M_reports->select_grade_promotion_service($report_id);




        $records["content"] = $this->load->view('admin/grade_promotion_reports/add_grade_promotion_reports', $data, true);
        $records["heading"] = "View Grade Promotion report details";
        $records["sub_heading"] = "View a Grade Promotion report in the portal";

        $this->response(200, $records);
    }


    public function update_grade_promotion_reports()
    {
        $report_id = $this->input->post('report_id');
        $this->save_grade_promotion_reports('update', $report_id);
    }


    public function save_grade_promotion_reports($func = 'add', $report_id = 0)
    {

        $this->form_validation->set_rules('employee_name', 'Employee name', 'trim|required');
        $this->form_validation->set_rules('employee_designation', 'Employee designation', 'trim|required');
        $this->form_validation->set_rules('employee_department', 'Employee department', 'trim|required');

        $this->form_validation->set_rules('scale_of_pay', 'Scale of Pay', 'trim|required');
        $this->form_validation->set_rules('service_period', 'Service Period', 'trim|required');

      

        $this->form_validation->set_rules('promotion_date', 'Promotion date', 'trim|required');
        $this->form_validation->set_rules('end_service_date', 'End of Service date', 'trim|required');
        $this->form_validation->set_rules('higher_grade_type', 'Higher Grade type', 'trim|required');
        $this->form_validation->set_rules('qualification', 'Quailification', 'trim|required');

        $this->form_validation->set_rules('from_designation', 'From Designation', 'trim|required');
        $this->form_validation->set_rules('from_scale_of_pay', 'From Scale of pay', 'trim|required');
        $this->form_validation->set_rules('from_date', 'From date', 'trim|required');

        $this->form_validation->set_rules('to_designation', 'To Designation', 'trim|required');
        $this->form_validation->set_rules('to_scale_of_pay', 'To Scale of pay', 'trim|required');
        $this->form_validation->set_rules('to_date', 'To date', 'trim|required');

        $this->form_validation->set_rules('lwa_granted', 'LWA granted', 'trim|required');
        $this->form_validation->set_rules('increment_barred_period', 'Increment barred period', 'trim|required');
        $this->form_validation->set_rules('higher_post_period', 'Higher Post period', 'trim|required');
        $this->form_validation->set_rules('other_period', 'Other period', 'trim|required');
        $this->form_validation->set_rules('leave_without_allowance', 'Leave without allowance', 'trim|required');
        $this->form_validation->set_rules('next_promotion_post', 'Next promotion post', 'trim|required');
        $this->form_validation->set_rules('superior_academic_qualification', 'Superiod academic qualification', 'trim|required');
        $this->form_validation->set_rules('option_enclosed', 'Option enclosed', 'trim|required');

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
            'employee_name' => en_func($this->input->post('employee_name'), 'd'),
            'employee_designation' => en_func($this->input->post('employee_designation'), 'd'),
            'employee_department' => en_func($this->input->post('employee_department'), 'd'),
            'office' => en_func($this->input->post('office'), 'd'),
            'scale_of_pay' => en_func($this->input->post('scale_of_pay'), 'd'),
            'service_period' => $this->input->post('service_period'),
            'promotion_date' => $this->input->post('promotion_date'),
            'end_service_date' => $this->input->post('end_service_date'),
            'higher_grade_type' => $this->input->post('higher_grade_type'),
            'qualification' => $this->input->post('qualification'),
            'marks_percentage' => $this->input->post('marks_percentage'),
            'date_of_pg' => $this->input->post('date_of_pg'),
            'from_designation' => en_func($this->input->post('from_designation'), 'd'),
            'from_scale_of_pay' => en_func($this->input->post('from_scale_of_pay'), 'd'),
            'from_date' => $this->input->post('from_date'),
            'to_designation' => en_func($this->input->post('to_designation'), 'd'),
            'to_scale_of_pay' => en_func($this->input->post('to_scale_of_pay'), 'd'),
            'to_date' => $this->input->post('to_date'),
            'lwa_granted' => $this->input->post('lwa_granted'),
            'increment_barred_period' => $this->input->post('increment_barred_period'),
            'higher_post_period' => $this->input->post('higher_post_period'),
            'other_period' => $this->input->post('other_period'),
            'leave_without_allowance' => $this->input->post('leave_without_allowance'),
            'next_promotion_post' => $this->input->post('next_promotion_post'),
            'superior_academic_qualification' => $this->input->post('superior_academic_qualification'),
            'option_enclosed' => $this->input->post('option_enclosed'),
          
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
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_grade_promotion_reports', 'report_id');
            $this->add_activity_log("Updated Grade Promotion report");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_grade_promotion_reports');
            $this->add_activity_log("Added Grade Promotion report");
        endif;

        //lq();

        // dd($_POST);

     
        if ($this->input->post('service_from_date'))
            if (strlen($this->input->post('service_from_date')[0]) > 0)
                for ($i = 0; $i < sizeof($this->input->post('service_from_date')); $i++) {
                    $data_insert = array(
                        'promotion_report_id' => $qry_response,
                        'service_post' => $this->input->post('service_post')[$i],
                        'service_scale_of_pay' => $this->input->post('service_scale_of_pay')[$i],
                        'service_from_date' => $this->input->post('service_from_date')[$i],
                        'service_to_date' => $this->input->post('service_to_date')[$i],
                        'service_years' => $this->input->post('service_years')[$i],
                        'service_months' => $this->input->post('service_months')[$i],
                        'service_days' => $this->input->post('service_days')[$i],
                        'created_at' => date("Y-m-d h:i:s"),
                        'updated_at' => date("Y-m-d h:i:s"),
                        'added_by' => $user_id,
                        'status' => 1
                    );


                    if (isset($this->input->post('ps_id')[$i])) :
                        if ($func == 'update')
                            $data_insert['promotion_report_id'] = $report_id;

                        $ps_id = en_func($this->input->post('ps_id')[$i], 'd');
                        unset($data_insert['created_at']);
                        $qry_response2 = $this->Common_model->update_table($data_insert, $ps_id, 'ci_grade_promotion_service', 'ps_id');
                    else :
                        if ($func == 'update')
                            $data_insert['promotion_report_id'] = $report_id;

                        $qry_response2 = $this->Common_model->insert_table($data_insert, 'ci_grade_promotion_service');
                    endif;
                }

        if ($this->input->post('temporary_from_date'))
            if (strlen($this->input->post('temporary_from_date')[0]) > 0)
                for ($i = 0; $i < sizeof($this->input->post('temporary_from_date')); $i++) {
                    $data_insert = array(
                        'promotion_report_id' => $qry_response,
                        'temporary_post' => $this->input->post('temporary_post')[$i],
                        'temporary_scale_of_pay' => $this->input->post('temporary_scale_of_pay')[$i],
                        'temporary_from_date' => $this->input->post('temporary_from_date')[$i],
                        'temporary_to_date' => $this->input->post('temporary_to_date')[$i],
                        'temporary_years' => $this->input->post('temporary_years')[$i],
                        'temporary_months' => $this->input->post('temporary_months')[$i],
                        'temporary_days' => $this->input->post('temporary_days')[$i],
                        'created_at' => date("Y-m-d h:i:s"),
                        'updated_at' => date("Y-m-d h:i:s"),
                        'added_by' => $user_id,
                        'status' => 1
                    );


                    if (isset($this->input->post('pts_id')[$i])) :
                        if ($func == 'update')
                            $data_insert['promotion_report_id'] = $report_id;

                        $pts_id = en_func($this->input->post('pts_id')[$i], 'd');
                        unset($data_insert['created_at']);
                        $qry_response = $this->Common_model->update_table($data_insert, $pts_id, 'ci_grade_promotion_temporary_service', 'pts_id');
                    else :
                        if ($func == 'update')
                            $data_insert['promotion_report_id'] = $report_id;

                        $qry_response = $this->Common_model->insert_table($data_insert, 'ci_grade_promotion_temporary_service');
                    endif;
                }


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            $this->db->trans_rollback();
        else
            $this->db->trans_commit();


        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Grade Promotion report successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Grade Promotion report could not be added !');
        $this->response(200, $data);
    }

    public function grade_promotion_reports_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_grade_promotion_reports', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $report_id  = en_func($row->report_id, 'e');

            $generated = $row->generated;

            $generated_reports = '';
            if ($generated)
                $generated_reports = '
                <div class="btn-group btn-group-sm">
            <a target="_blank" href="' . GRADE_PROMOTION_REPORTS . $row->report_filename . '" title="Print reports" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
            </div>
            ';

            $data[] = array(
                ++$i,
                $row->report_title,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/grade_promotion_reports/edit_grade_promotion_reports/' . $report_id . '" title="Edit grade_promotion_reports" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/grade_promotion_reports/view_grade_promotion_reports/' . $report_id . '" title="View grade_promotion_reports" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
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
        $reportsDetails = $data["reportsDetails"] = $this->M_reports->select_grade_promotion_report_details($report_id);
        // $this->check_exists($data["reportsDetails"]);

        $data['employeesList'] = $this->Common_model->select_all('ci_employees');
        $data['designationsList'] = $this->Common_model->select_all('ci_designations');
        $data['departmentsList'] = $this->Common_model->select_all('ci_departments');
        $data['performanceStatuses'] = $this->Common_model->select_all('performance_status');
        $data['payScalesList'] = $this->Common_model->select_all('ci_scale_of_pay');


        
        $data['temporaryService'] = $this->M_reports->select_grade_promotion_temporary($report_id);
        $data['serviceDetails'] = $this->M_reports->select_grade_promotion_service($report_id);


        
        // dd($reportsDetails);

        $report_filename = str_replace(' ', '-', $reportsDetails->employee_name_eng) . '-GradePromotion-' . substr(en_func(strtotime("now"), 'e'), 0, 5) . '.pdf';

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

        $html = $this->load->view('admin/grade_promotion_reports/report_preview_page_1', $data, true);
        $mpdf->WriteHTML($html);


        $mpdf->AddPage();

        $html = $this->load->view('admin/grade_promotion_reports/report_preview_page_2', $data, true);
        $mpdf->WriteHTML($html);



        $mpdf->Output('uploads/grade_promotion_reports/' . $report_filename, "F");
        // $mpdf->Output();
        // exit();



        $data_insert = array(
            'generated' => 1,
            'report_filename' => $report_filename,
            'generated_date' => date('Y-m-d'),
            'updated_at' => date("Y-m-d h:i:s"),
        );
        $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_grade_promotion_reports', 'report_id');

        $data = array('status' => 'success', 'msg' => 'Grade Promotion report generated successfully !');
        $this->response(200, $data);
    }


    public function delete_temporary($pts_id)
    {
        $pts_id = en_func($pts_id, 'd');
        $response = $this->Common_model->delete_table($pts_id, 'ci_grade_promotion_temporary_service', 'pts_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Grade Promotion Temporary Service has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Grade Promotion Temporary Service could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_grade_promotion_temporary_service', $pts_id, 'pts_id')->promotion_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_grade_promotion_reports', 'report_id');
        }

        redirect(base_url('admin/grade_promotion_reports'));
    }

    public function delete_service($ps_id)
    {
        $ps_id = en_func($ps_id, 'd');
        $response = $this->Common_model->delete_table($ps_id, 'ci_grade_promotion_service', 'ps_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Grade Promotion Service has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Grade Promotion Service could not be deleted!');

        if ($response > 0) {
            $report_id = $this->Common_model->select_by_id('ci_grade_promotion_service', $ps_id, 'ps_id')->promotion_report_id;
            $data_insert = array(
                'generated' => 0,
                'updated_at' => date("Y-m-d h:i:s")

            );
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_grade_promotion_reports', 'report_id');
        }

        
        redirect(base_url('admin/grade_promotion_reports'));
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
