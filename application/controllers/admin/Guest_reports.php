<?php
defined('BASEPATH') or exit('No direct script access allowed');

class guest_reports extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('Admin_model');

        $this->data["menu_id"] = 2;

    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/guest_reports/index', $data);
    }

    public function add_guest_reports()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_departments');
        $data['teachersList'] = $this->Common_model->select_all('ci_guest_employees');
        $data['ordersList'] = $this->Common_model->select_all('ci_orders');
        $data["menu_id"] = 4;

        $this->template->views('admin/guest_reports/add_guest_reports', $data);
    }


    public function guest_employees_list()
    {
        $report_time = $data['report_time'] = $this->input->get('report_time');

        $data['teachersList'] = array();
        if ($report_time)
            $data['teachersList'] = $this->Admin_model->select_teachers_in_month($report_time);
        //lq();
        $this->load->view('admin/guest_reports/guest_employees_list', $data);
    }


    public function edit_guest_reports($report_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["report_id"] = $report_id;
        $data["menu_id"] = 4;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_guest_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_departments');
        $data['teachersList'] = $this->Common_model->select_all('ci_guest_employees');
        $data['ordersList'] = $this->Common_model->select_all('ci_orders');

        $this->check_exists($data["reportsDetails"]);

        $data["teacherDetails"] = $this->Admin_model->select_report_teacher_details($report_id);

        $this->check_exists($data["teacherDetails"]);

        $this->template->views('admin/guest_reports/edit_guest_reports', $data);
    }

    public function view_guest_reports()
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $report_id = $this->input->get('report_id');
        $data["report_id"] = $report_id;

        $report_id = en_func($report_id, 'd');

        $data["reportsDetails"] = $this->Common_model->select_by_id('ci_guest_reports', $report_id, 'report_id');
        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_departments');
        $data['teachersList'] = $this->Common_model->select_all('ci_guest_employees');

        $this->check_exists($data["reportsDetails"]);

        $data["teacherDetails"] = $this->Admin_model->select_report_teacher_details($report_id);

        $this->check_exists($data["teacherDetails"]);

        $this->load->view('admin/guest_reports/preview_guest_report', $data);
    }


    public function update_guest_reports()
    {
        $report_id = $this->input->post('report_id');
        $this->save_guest_reports('update', $report_id);
    }


    public function save_guest_reports($func = 'add', $report_id = 0)
    {
        $this->form_validation->set_rules('points[]', 'Orders', 'trim|required');

        $this->form_validation->set_rules('report_no', 'Report no', 'trim|required');
        $this->form_validation->set_rules('report_title', 'Report title', 'trim|required');
        $this->form_validation->set_rules('report_date', 'Report date', 'trim|required');
        // $this->form_validation->set_rules('report_month', 'Report month', 'trim|required');
        $this->form_validation->set_rules('head_of_account', 'Head of account', 'trim|required');

        $this->form_validation->set_rules('teachers[]', 'Teachers', 'trim|required');
        $this->form_validation->set_rules('days[]', 'Days', 'trim|required|numeric');
        $this->form_validation->set_rules('income_tax[]', 'Income tax', 'trim|required|numeric');

        if ($func == 'add')
            $this->form_validation->set_rules('report_time', 'Report time', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('report_id', 'reports ID', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);

        }


        // dd($_POST);
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');

        $orders = $this->input->post('points');
        $report_orders = implode("~", $orders);


        $data_insert = array(
            'report_no' => $this->input->post('report_no'),
            'report_orders' => $report_orders,
            'report_title' => $this->input->post('report_title'),
            'report_date' => $this->input->post('report_date'),
            'head_of_account' => $this->input->post('head_of_account'),
            'generated' => 0,
            'report_filename' => null,
            'generated_date' => NULL,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        if ($func == 'add') :
            $report_month = date('m', strtotime($this->input->post('report_time')));
            $report_year = date('Y', strtotime($this->input->post('report_time')));
            $data_insert['report_month'] = $report_month;
            $data_insert['report_year'] = $report_year;
        endif;

        $report_id =  en_func($report_id, 'd');


        $this->db->trans_begin();

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_guest_reports', 'report_id');
            $this->add_activity_log("Updated report");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_guest_reports');
            $this->add_activity_log("Added report");
        endif;


        for ($i = 0; $i < sizeof($this->input->post('teachers')); $i++) :


            $data_insert = array(
                'report_id' => $qry_response,
                'teacher_id' => en_func($this->input->post('teachers')[$i], 'd'),
                'days' => $this->input->post('days')[$i],
                'income_tax' => $this->input->post('income_tax')[$i],
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
                'added_by' => $user_id,
                'status' => en_func($this->input->post('status'), 'd')
            );


            if ($func == 'update')
                $data_insert['report_id'] = $report_id;

            // dd($data_insert);

            if ($func == 'update') :
                $rt_id = en_func($this->input->post('rt_id')[$i], 'd');
                unset($data_insert['created_at']);
                $qry_response2 = $this->Common_model->update_table($data_insert, $rt_id, 'ci_guest_employee_reports', 'rt_id');
                $this->add_activity_log("Updated report");
            else :
                $qry_response2 = $this->Common_model->insert_table($data_insert, 'ci_guest_employee_reports');
                $this->add_activity_log("Added report");
            endif;

        endfor;


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            $this->db->trans_rollback();
        else
            $this->db->trans_commit();




        if ($qry_response2 > 0) :
            $data = array('status' => 'success', 'msg' => 'Report successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Report could not be added !');
        $this->response(200, $data);

    }

    public function guest_reports_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');
        $status = ($status) ? $status : 1;
       

        $records['data'] = $this->Common_model->select_all('ci_guest_reports', $status);
        
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $report_id  = en_func($row->report_id, 'e');
            $generated = $row->generated;

            $generated_reports = '';
            if ($generated)
                $generated_reports = '
                <div class="btn-group btn-group-sm">
            <a target="_blank" href="' . REPORTS . $row->report_filename . '" title="Print reports" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
            <a target="_blank" href="' . REPORTS . $row->salary_report . '" title="Print teachers reports" class="btn btn-sm btn-danger"><i class="fa fa-user-circle-o"></i></a>
            </div>
            ';

            $data[] = array(
                ++$i,
                $row->report_title . ' - ' . $row->report_no,
                $row->report_date . ' - ' . date('F', strtotime("2012-$row->report_month-01")),
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)) . ' - <br>' .
                    date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a href="' . base_url() . 'admin/guest_reports/edit_guest_reports/' . $report_id . '" title="Edit reports" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-id="' . $report_id . '" title="View reports" class="show-report btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
            
                <a data-id="' . $report_id . '" title="Generate report" class="' . ($generated == 1 ? 'btn-primary' : 'generate-report btn-warning') . ' btn btn-sm">' . ($generated == 1 ? 'Generated' : 'Generate') . '</a>
                <a data-id="' . $report_id . '" title="Delete report" class="delete-report btn-danger btn btn-sm"><i class="fa fa-trash"></i></a>
                </div>',
                $generated_reports

            );
        }
        $this->response(200, $data);
    }




    public function generate_guest_report($report_id = 0)
    {
        $report_id = en_func($report_id, 'd');
        $reportsDetails = $data["reportsDetails"] = $this->Common_model->select_by_id('ci_guest_reports', $report_id, 'report_id');
        $this->check_exists($data["reportsDetails"]);

        $data["teacherDetails"] = $this->Admin_model->select_report_teacher_details($report_id);
        $this->check_exists($data["teacherDetails"]);

        $report_filename = str_replace(' ', '-', $reportsDetails->report_title) . '-' . substr(en_func(strtotime("now"), 'e'), 0, 4) . '.pdf';
        $salary_report = str_replace(' ', '-', $reportsDetails->report_title) . '-teachers-' . substr(en_func(strtotime("now"), 'e'), 0, 4) . '.pdf';

        $mpdf = new \Mpdf\Mpdf();

        // $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        // $fontDirs = $defaultConfig['fontDir'];

        // $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        // $fontData = $defaultFontConfig['fontdata'];

        // $mpdf = new \Mpdf\Mpdf([
        //     'fontDir' => array_merge($fontDirs, [
        //         __DIR__ . '/custom/font/directory',
        //     ]),
        //     'fontdata' => $fontData + [ 
        //         'manjari-mal' => [
        //             'R' => 'Manjari-Bold.ttf',
        //             'I' => 'Manjari-Bold.ttf',
        //             'useOTL' => 0xFF,
        //             'useKashida' => 75
        //         ]
        //     ]
        // ]);

        $html = $this->load->view('admin/guest_reports/preview_guest_report', $data, true);


        $mpdf->WriteHTML($html);
        $mpdf->Output('uploads/reports/' . $report_filename, "F");


        // $mpdf->Output();
        // exit();



        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('admin/guest_reports/guest_employees_reports', $data, true);

        // $mpdf->SetWatermarkText("MACE");
        // $mpdf->showWatermarkText = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output('uploads/reports/' . $salary_report, "F");


        // $mpdf->Output();
        // exit();


        $data_insert = array(
            'generated' => 1,
            'report_filename' => $report_filename,
            'salary_report' => $salary_report,
            'generated_date' => date('Y-m-d'),
            'updated_at' => date("Y-m-d h:i:s"),
        );
        $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_guest_reports', 'report_id');

        $data = array('status' => 'success', 'msg' => 'Report generated successfully !');
        $this->response(200, $data);

    }

    public function delete_guest_report($report_id)
    {
        $report_id = en_func($report_id, 'd');

        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');




        $data_insert = array(
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 3
        );

        $qry_response = $this->Common_model->update_table($data_insert, $report_id, 'ci_guest_reports', 'report_id');
        $this->add_activity_log("Deleted Report");


        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Report successfully deleted !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Report could not be deleted !');
        $this->response(200, $data);

    }

    /***
     * 
     * 
     * Print reports
     * 
     * 
     */
    public function print_reports()
    {
        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();
        $data["menu_id"] = 5;

        $this->template->views('admin/guest_reports/guest_reports_list', $data);
    }



    public function generated_guest_reports_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Admin_model->select_all_generated_reports($status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $report_id  = en_func($row->report_id, 'e');



            $data[] = array(
                ++$i,
                $row->report_title . ' - ' . $row->report_no,
                $row->report_date . ' - ' . date('F', strtotime("2012-$row->report_month-01")),
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)) . ' - <br>' .
                    date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-id="' . $report_id . '" title="View reports" class="show-report btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <a target="_blank" href="' . REPORTS . $row->report_filename . '" title="Print reports" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
                    <a target="_blank" href="' . REPORTS . $row->salary_report . '" title="Print teachers reports" class="btn btn-sm btn-danger"><i class="fa fa-user-circle-o"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }
}
