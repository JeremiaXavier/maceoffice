<?php
defined('BASEPATH') or exit('No direct script access allowed');

class permanent_employees extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('M_Employees');

        $this->data["menu_id"] = 3;
    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/permanent_employees/index', $data);
    }

    public function add_permanent_employees()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();


        $records["content"] = $this->load->view('admin/permanent_employees/add_permanent_employees', $data, true);
        $records["heading"] = "Add Permanent employee details";
        $records["sub_heading"] = "Add a new PErmanent employee to the portal";

        $this->response(200, $records);
    }



    public function edit_permanent_employees($employee_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["employee_id"] = $employee_id;

        $employee_id = en_func($employee_id, 'd');

        $data["employeeDetails"] = $this->Common_model->select_by_id('ci_employees', $employee_id, 'employee_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["employeeDetails"]);

        $records["content"] = $this->load->view('admin/permanent_employees/add_permanent_employees', $data, true);
        $records["heading"] = "Edit Permanent employee details";
        $records["sub_heading"] = "Edit a Permanent employee in the portal";

        $this->response(200, $records);
    }

    public function view_permanent_employees($employee_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["employee_id"] = $employee_id;

        $employee_id = en_func($employee_id, 'd');

        $data["employeeDetails"] = $this->Common_model->select_by_id('ci_employees', $employee_id, 'employee_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["employeeDetails"]);

        $records["content"] = $this->load->view('admin/permanent_employees/add_permanent_employees', $data, true);
        $records["heading"] = "View Permanent employee details";
        $records["sub_heading"] = "View a Permanent employee in the portal";


        $this->response(200, $records);
    }


    public function update_permanent_employees()
    {
        $employee_id = $this->input->post('employee_id');
        $this->save_permanent_employees('update', $employee_id);
    }


    public function save_permanent_employees($func = 'add', $employee_id = 0)
    {
        $this->form_validation->set_rules('employee_name', 'Employee name', 'trim|required');
        $this->form_validation->set_rules('password_status', 'Password status', 'trim|required');
        $this->form_validation->set_rules('employee_name_mal', 'Employee name (Mal)', 'trim|required');
        $this->form_validation->set_rules('employee_number', 'Employee PEN', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('employee_id', 'permanent_employees ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'employee_number' => $this->input->post('employee_number'),
            'employee_name' => $this->input->post('employee_name'),
            'employee_name_mal' => $this->input->post('employee_name_mal'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => en_func($this->input->post('status'), 'd')

        );

        if (en_func($this->input->post('password_status'), 'd') == 1)
            $data_insert['employee_password'] = md5($data_insert['employee_number']);

        if ($func == 'add')
            $data_insert['employee_password'] = md5($data_insert['employee_number']);

        $employee_id =  en_func($employee_id, 'd');


        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $employee_id, 'ci_employees', 'employee_id');
            $this->add_activity_log("Updated Employee");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_employees');
            $this->add_activity_log("Added Employee");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Employee successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Employee could not be added !');
        $this->response(200, $data);
    }

    public function permanent_employees_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_employees', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $employee_id  = en_func($row->employee_id, 'e');
            $data[] = array(
                ++$i,
                $row->employee_number,
                $row->employee_name,
                '<div class="btn-group btn-group-md">
                    <a data-url="' . base_url() . 'admin/permanent_employees/edit_permanent_employees/' . $employee_id . '" title="Edit permanent employee" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/permanent_employees/view_permanent_employees/' . $employee_id . '" title="View permanent employee" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }



    /**
     * 
     * 
     * 
     */


    public function data()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/permanent_employees/index_data', $data);
    }


    public function permanent_employees_data_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');
        $personal = (int) en_func($this->input->get('personal'), 'd');
        $present_service = (int) en_func($this->input->get('present_service'), 'd');
        $address = (int) en_func($this->input->get('address'), 'd');
        $appoinments = (int) en_func($this->input->get('appoinments'), 'd');
        $qualifications = (int) en_func($this->input->get('qualifications'), 'd');
        $probation = (int) en_func($this->input->get('probation'), 'd');

        $records['data'] = $this->M_Employees->select_employee_uploaded_data($personal, $present_service, $address, $appoinments, $qualifications, $probation, $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $employee_id  = en_func($row->employee_id, 'e');
            $data[] = array(
                ++$i,
                $row->employee_number,
                $row->employee_name,

                '<div class="btn-group btn-group-md">
                <a onclick="return confirm(\'Do you want to open a new tab of all data uploaded by ' . $row->employee_name . ' ?\')" target="_blank" href="' . base_url() . 'admin/employees/index/' . $employee_id . '" class="btn btn-sm btn-warning mr-10" title="Employee Details"><i class="fa fa-upload mr-5"></i>Edit</a>
                <a data-url="' . base_url() . 'admin/permanent_employees/edit_permanent_employees_data_details/' . $employee_id . '" class="btn btn-sm btn-danger mr-10 open-offcanvas" title="Employee Details"><i class="fa fa-upload mr-5"></i>View</a>
                </div>',
                '<div class="btn-group btn-group-md">
                <a href="' . base_url() . 'admin/permanent_employees/print_all_details/' . $employee_id . '" target="_blank" class="btn btn-warning btn-sm"> <i class="fa fa-print"></i> All details</a>
                </div>'

            );
        }
        $this->response(200, $data);
    }


    public function edit_permanent_employees_data_details($employee_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["employee_id"] = $employee_id;

        $employee_id = en_func($employee_id, 'd');

        $data["employeeDetails"] = $this->Common_model->select_by_id('ci_employees', $employee_id, 'employee_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["employeeDetails"]);

        $data['gender'] = $this->Common_model->select_all('ci_gender');
        $data['countries'] = $this->Common_model->select_all('tbl_countries');
        $data['religions'] = $this->Common_model->select_all('tbl_religion');
        $data['caste_category'] = $this->Common_model->select_all('tbl_caste_category');

        $data['department'] = $this->Common_model->select_all('ci_service_departments');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');

        $data['states'] = $this->Common_model->select_all('tbl_states');
        $data['districts'] = $this->Common_model->select_all('tbl_districts');  // If multiple states occur, then call it in ajax

        $data['courses'] = $this->Common_model->select_all('ci_courses');

        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['designations'] = $this->Common_model->select_all('ci_designations');

        $data["personalDetails"] = $this->M_Employees->select_employee_personal_details($employee_id);
        $data["presentserviceDetails"] = $this->M_Employees->select_employee_present_service($employee_id);
        $data["addressDetails"] = $this->M_Employees->select_employee_address_details($employee_id);
        $data["educationDetails"] = $this->M_Employees->select_employee_qualification_details($employee_id);
        $data["probationDetails"] = $this->M_Employees->select_employee_probation_details($employee_id);
        $data["appoinmentDetails"] = $this->M_Employees->select_employee_appoinment_details($employee_id);


        $records["content"] = $this->load->view('admin/permanent_employees/add_permanent_employees_data', $data, true);
        $records["heading"] = "Edit Permanent employee whole details";
        $records["sub_heading"] = "Edit a Permanent employee whole detail in the portal";

        $this->response(200, $records);
    }

    /**
     * 
     *  Print all details of an employee
     * 
     */

    public function print_all_details($employee_id)
    {
        $data = $this->data;
        $this->check_id_real($employee_id);

        $employee_id = en_func($employee_id, 'd');

        $data["employeeDetails"] = $this->Common_model->select_by_id('ci_employees', $employee_id, 'employee_id');
        $this->check_exists($data["employeeDetails"]);


        // Make it as a single query
        $data["personalDetails"] = $this->M_Employees->select_employee_personal_details($employee_id);
        $data["presentserviceDetails"] = $this->M_Employees->select_employee_present_service($employee_id);
        $data["addressDetails"] = $this->M_Employees->select_employee_address_details($employee_id);
        $data["educationDetails"] = $this->M_Employees->select_employee_qualification_details($employee_id);
        $data["probationDetails"] = $this->M_Employees->select_employee_probation_details($employee_id);
        $data["appoinmentDetails"] = $this->M_Employees->select_employee_appoinment_details($employee_id);

        $data['religions'] = $this->Common_model->select_all('tbl_religion');
        $data['states'] = $this->Common_model->select_all('tbl_states');
        $data['districts'] = $this->Common_model->select_all('tbl_districts');


        $this->check_exists($data["personalDetails"]);
        $this->check_exists($data["presentserviceDetails"]);
        $this->check_exists($data["addressDetails"]);
        $this->check_exists($data["educationDetails"]);
        $this->check_exists($data["probationDetails"]);
        $this->check_exists($data["appoinmentDetails"]);


        $file_name = 'EmployeeDataSheet-' . $data["employeeDetails"]->employee_number . '-' . str_replace(" ", "_", $data["employeeDetails"]->employee_name) . '-' . substr(en_func(strtotime("now"), 'e'), 0, 6) . '.pdf';

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $html = $this->load->view('admin/employee_reports/preview_employee_single', $data, true);
        $mpdf->WriteHTML($html);
        // $mpdf->Output('uploads/reports/' . $report_filename, "F");
        $mpdf->Output($file_name, 'D');

        $mpdf->Output();
        exit();
    }
}
