<?php
defined('BASEPATH') or exit('No direct script access allowed');

class employees extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');

        $this->data["menu_id"] = 3;
        $this->load->model('M_Employees');
    }

    public function index($employee_id)
    {

        $data = $this->data;

        $this->check_id_real($employee_id);
        $data["status"] = $this->Common_model->select_status();

        $data["operation"] = 'add';
        $data["employee_id"] = $employee_id;

        $data["employeeDetails"] = $this->Common_model->select_by_id('ci_employees', en_func($employee_id, 'd'), 'employee_id');
        $this->check_exists($data["employeeDetails"]);



        $this->template->views('admin/permanent_employees/details/index', $data);
    }



    /**
     * 
     *  Employee Personal details
     * 
     */

    public function personal_details($employee_id)
    {

        $data = $this->data;
        $this->check_id_real($employee_id);

        $data["status"] = $this->Common_model->select_status();
        $data['gender'] = $this->Common_model->select_all('ci_gender');
        $data['countries'] = $this->Common_model->select_all('tbl_countries');
        $data['religions'] = $this->Common_model->select_all('tbl_religion');
        $data['caste_category'] = $this->Common_model->select_all('tbl_caste_category');


        $user_id = en_func($employee_id, 'd');

        $employeeDetails = $data["employeeDetails"] = $this->M_Employees->select_employee_personal_details($user_id);

        $data["operation"] = (empty($employeeDetails)) ? "add" : "edit";

        $data["employee_id"] = $employee_id;



        $this->template->views('admin/permanent_employees/details/personal_details', $data);
    }


    public function update_personal_details()
    {
        $this->form_validation->set_rules('ep_id', 'Personal details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $ep_id = $this->input->post('ep_id');

        $employeeDetails = $this->Common_model->select_by_id('ci_employees_personal', en_func($ep_id, 'd'), 'ep_id');
        if (empty($employeeDetails)) {
            $data = array('status' => 'error', 'msg' => "There is no data to update,Please ask the employee to login and fill this form");
            $this->response(200, $data);
        }

        $this->save_personal_details('update', $ep_id);
    }


    public function save_personal_details($func = 'add', $ep_id = 0)
    {
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('pan_number', 'PAN Number', 'trim|required|exact_length[10]');

        if ($func == 'update')
            $this->form_validation->set_rules('ep_id', 'Personal details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = $this->user_id;
        $employee_id = $this->input->post('employee_id');

        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_id'), 'd'),
            'gender' => en_func($this->input->post('gender'), 'd'),
            'nationality' => en_func($this->input->post('nationality'), 'd'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'date_of_superannuation' => $this->input->post('date_of_superannuation'),
            'religion' => en_func($this->input->post('religion'), 'd'),
            'caste' => $this->input->post('caste'),
            'caste_category' => en_func($this->input->post('caste_category'), 'd'),
            'handicapped' => en_func($this->input->post('handicapped'), 'd'),
            'pan_number' => $this->input->post('pan_number'),
            'marital_status' => en_func($this->input->post('marital_status'), 'd'),
            'spouse_name' => $this->input->post('spouse_name'),
            'inter_caste' => en_func($this->input->post('inter_caste'), 'd'),
            'spouse_religion' => en_func($this->input->post('spouse_religion'), 'd'),
            'editable' => en_func($this->input->post('editable'), 'd'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );


        $ep_id =  en_func($ep_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $ep_id, 'ci_employees_personal', 'ep_id');
        // $this->add_activity_log("Updated personal details");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_employees_personal');
        // $this->add_activity_log("Added personal details");
        endif;

        // lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Personal details successfully added ! Redirecting to the next page', 'redirect_url' => base_url() . 'admin/employees/present_service/'.$employee_id);
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Personal details could not be added !');
        $this->response(200, $data);
    }



    /**
     * 
     *  Employee Present Service details
     * 
     */

    public function present_service($employee_id)
    {

        $data = $this->data;
        $this->check_id_real($employee_id);

        $data["status"] = $this->Common_model->select_status();
        $data['department'] = $this->Common_model->select_all('ci_service_departments');
        $data['scale_of_pay'] = $this->Common_model->select_all('ci_scale_of_pay');

        $user_id = en_func($employee_id, 'd');

        $employeeDetails = $data["employeeDetails"] = $this->M_Employees->select_employee_present_service($user_id);

        $data["operation"] = (empty($employeeDetails)) ? "add" : "edit";
        $data["employee_id"] = $employee_id;




        $this->template->views('admin/permanent_employees/details/present_service', $data);
    }



    public function update_present_service()
    {
        $this->form_validation->set_rules('eps_id', 'present Service details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $eps_id = $this->input->post('eps_id');

        $employeeDetails = $this->Common_model->select_by_id('ci_employees_present_service', en_func($eps_id, 'd'), 'eps_id');
        if (empty($employeeDetails)) {
            $data = array('status' => 'error', 'msg' => "There is no data to update,Please ask the employee to login and fill this form");
            $this->response(200, $data);
        }

        $this->save_present_service('update', $eps_id);
    }


    public function save_present_service($func = 'add', $eps_id = 0)
    {
        $this->form_validation->set_rules('service_department', 'Department', 'trim|required');
        $this->form_validation->set_rules('date_of_joining', 'Date of joining', 'trim|required');
        $this->form_validation->set_rules('scale_of_pay', 'Scale of Pay', 'trim|required');
        $this->form_validation->set_rules('present_pay', 'Present Pay', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('eps_id', 'present Service details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = $this->user_id;
        $employee_id = $this->input->post('employee_id');

        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_id'), 'd'),
            'service_department' => en_func($this->input->post('service_department'), 'd'),
            'date_of_joining' => $this->input->post('date_of_joining'),
            'scale_of_pay' => en_func($this->input->post('scale_of_pay'), 'd'),
            'present_pay' => $this->input->post('present_pay'),
            'editable' => en_func($this->input->post('editable'), 'd'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );


        $eps_id =  en_func($eps_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $eps_id, 'ci_employees_present_service', 'eps_id');
        // $this->add_activity_log("Updated personal details");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_employees_present_service');
        // $this->add_activity_log("Added personal details");
        endif;

        // lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Present Service details successfully added !  Redirecting to the next page', 'redirect_url' => base_url() . 'admin/employees/address_details/'.$employee_id);
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Present Service details could not be added !');
        $this->response(200, $data);
    }




    /**
     * 
     *  Employee Address details
     * 
     */

    public function address_details($employee_id)
    {

        $data = $this->data;
        $this->check_id_real($employee_id);

        $data["status"] = $this->Common_model->select_status();
        $data['gender'] = $this->Common_model->select_all('ci_gender');
        $data['states'] = $this->Common_model->select_all('tbl_states');
        $data['districts'] = $this->Common_model->select_all('tbl_districts');  // If multiple states occur, then call it in ajax

        $user_id = en_func($employee_id, 'd');

        $employeeDetails = $data["employeeDetails"] = $this->M_Employees->select_employee_address_details($user_id);

        $data["operation"] = (empty($employeeDetails)) ? "add" : "edit";

        $data["employee_id"] = $employee_id;

        $this->template->views('admin/permanent_employees/details/address_details', $data);
    }



    public function update_address_details()
    {
        $this->form_validation->set_rules('ea_id', 'Address details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $ea_id  = $this->input->post('ea_id');

        $employeeDetails = $this->Common_model->select_by_id('ci_employees_address', en_func($ea_id, 'd'), 'ea_id');
        if (empty($employeeDetails)) {
            $data = array('status' => 'error', 'msg' => "There is no data to update,Please ask the employee to login and fill this form");
            $this->response(200, $data);
        }

        $this->save_address_details('update', $ea_id);
    }


    public function save_address_details($func = 'add', $ea_id = 0)
    {
        $this->form_validation->set_rules('present_house_no_name', 'Present House no and name', 'trim|required');
        $this->form_validation->set_rules('present_street', 'Present Street', 'trim|required');
        $this->form_validation->set_rules('present_place', 'Present Place', 'trim|required');
        $this->form_validation->set_rules('present_pin', 'Present PIN', 'trim|required|numeric');
        $this->form_validation->set_rules('present_state', 'Present State', 'trim|required');
        $this->form_validation->set_rules('present_district', 'Present District', 'trim|required');
        $this->form_validation->set_rules('present_taluk', 'Present Taluk', 'trim|required');
        $this->form_validation->set_rules('present_village', 'Present Village', 'trim|required');
        $this->form_validation->set_rules('present_constituency', 'Present Constituency', 'trim|required');
        $this->form_validation->set_rules('present_phone', 'Present Phone', 'trim|required|numeric');

        $this->form_validation->set_rules('home_town', 'Home Town', 'trim|required');

        $this->form_validation->set_rules('permanent_house_no_name', 'Permanent House no and name', 'trim|required');
        $this->form_validation->set_rules('permanent_street', 'Permanent Street', 'trim|required');
        $this->form_validation->set_rules('permanent_place', 'Permanent Place', 'trim|required');
        $this->form_validation->set_rules('permanent_pin', 'Permanent PIN', 'trim|required|numeric');
        $this->form_validation->set_rules('permanent_state', 'Permanent State', 'trim|required');
        $this->form_validation->set_rules('permanent_district', 'Permanent District', 'trim|required');
        $this->form_validation->set_rules('permanent_taluk', 'Permanent Taluk', 'trim|required');
        $this->form_validation->set_rules('permanent_village', 'Permanent Village', 'trim|required');
        $this->form_validation->set_rules('permanent_constituency', 'Permanent Constituency', 'trim|required');
        $this->form_validation->set_rules('permanent_phone', 'Permanent Phone', 'trim|required|numeric');

        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|numeric');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');

        if ($func == 'update')
            $this->form_validation->set_rules('ea_id', 'Address details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = $this->user_id;
        $employee_id = $this->input->post('employee_id');

        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_id'), 'd'),
            'present_house_no_name' => $this->input->post('present_house_no_name'),
            'present_street' => $this->input->post('present_street'),
            'present_place' => $this->input->post('present_place'),
            'present_pin' => $this->input->post('present_pin'),
            'present_state' => en_func($this->input->post('present_state'), 'd'),
            'present_district' => en_func($this->input->post('present_district'), 'd'),
            'present_taluk' => $this->input->post('present_taluk'),
            'present_village' => $this->input->post('present_village'),
            'present_constituency' => $this->input->post('present_constituency'),
            'present_phone' => $this->input->post('present_phone'),
            'home_town' => $this->input->post('home_town'),
            'permanent_house_no_name' => $this->input->post('permanent_house_no_name'),
            'permanent_street' => $this->input->post('permanent_street'),
            'permanent_place' => $this->input->post('permanent_place'),
            'permanent_pin' => $this->input->post('permanent_pin'),
            'permanent_state' => en_func($this->input->post('permanent_state'), 'd'),
            'permanent_district' => en_func($this->input->post('permanent_district'), 'd'),
            'permanent_taluk' => $this->input->post('permanent_taluk'),
            'permanent_village' => $this->input->post('permanent_village'),
            'permanent_constituency' => $this->input->post('permanent_constituency'),
            'permanent_phone' => $this->input->post('permanent_phone'),
            'mobile_number' => $this->input->post('mobile_number'),
            'email_address' => $this->input->post('email_address'),
            'editable' => en_func($this->input->post('editable'), 'd'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );


        $ea_id  =  en_func($ea_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $ea_id, 'ci_employees_address', 'ea_id');
        // $this->add_activity_log("Updated personal details");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_employees_address');
        // $this->add_activity_log("Added personal details");
        endif;

        // lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Address details successfully added ! Redirecting to the next page', 'redirect_url' => base_url() . 'admin/employees/appoinment_details/'.$employee_id);
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Address details could not be added !');
        $this->response(200, $data);
    }




    /**
     * 
     *  Employee Qualification details
     * 
     */

    public function qualification_details($employee_id)
    {

        $data = $this->data;
        $this->check_id_real($employee_id);


        $user_id = en_func($employee_id, 'd');

        $data["educationDetails"] = $this->M_Employees->select_employee_qualification_details($user_id);
        $data["employee_id"] = $employee_id;


        $this->template->views('admin/permanent_employees/details/qualification_details', $data);
    }

    public function add_qualification_details()
    {

        $data = $this->data;
        $data["operation"] = 'add';
        $data['courses'] = $this->Common_model->select_all('ci_courses');


        $records["content"] = $this->load->view('admin/permanent_employees/details/add_qualification_details', $data, true);
        $records["heading"] = "Add Qualification details";
        $records["sub_heading"] = "Add a new qualification to the portal";

        $this->response(200, $records);
    }


    public function edit_qualification_details($eq_id)
    {

        $data = $this->data;
        $data["operation"] = 'edit';
        $data["eq_id"] = $eq_id;

        $eq_id = en_func($eq_id, 'd');


        $educationDetails = $data["educationDetails"] = $this->Common_model->select_by_id('ci_employees_qualifications', $eq_id, 'eq_id');

        $this->check_exists($data["educationDetails"]);



        $data["status"] = $this->Common_model->select_status();
        $data['courses'] = $this->Common_model->select_all('ci_courses');


        $records["content"] = $this->load->view('admin/permanent_employees/details/add_qualification_details', $data, true);
        $records["heading"] = "Add Qualification details";
        $records["sub_heading"] = "Add a new qualification to the portal";

        $this->response(200, $records);
    }



    public function update_qualification_details()
    {
        $this->form_validation->set_rules('eq_id', 'Qualification details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $eq_id  = $this->input->post('eq_id');

        $employeeDetails = $this->Common_model->select_by_id('ci_employees_qualifications', en_func($eq_id, 'd'), 'eq_id');

        if (empty($employeeDetails)) {
            $data = array('status' => 'error', 'msg' => "There is no data to update,Please ask the employee to login and fill this form");
            $this->response(200, $data);
        }

        $this->save_qualification_details('update', $eq_id);
    }


    public function save_qualification_details($func = 'add', $eq_id = 0)
    {
        $this->form_validation->set_rules('course', 'Course', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('university', 'University', 'trim|required');
        $this->form_validation->set_rules('institution', 'Institution', 'trim|required');
        $this->form_validation->set_rules('class_obtained', 'Class Obtained', 'trim|required');
        $this->form_validation->set_rules('reg_no', 'Registration No', 'trim|required');
        $this->form_validation->set_rules('year_of_pass', 'Year of Passing', 'trim|required|numeric');


        if ($func == 'update')
            $this->form_validation->set_rules('eq_id', 'Qualification details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $file_upload['filename'] = $this->input->post('current_document');
        if (empty($_FILES['document']['name']) & strlen($this->input->post('current_document')) == 0) :
            $data = array('status' => 'error', 'msg' => 'Qualification Document must be uploaded');
            $this->response(200, $data);
        endif;


        if (!empty($_FILES['document']['name'])) :

            $file_upload = $this->addFiles('document','qualification_documents');

            if ($file_upload['status'] == '500') :
                $data = array('status' => 'error', 'msg' => json_encode($file_upload['msg']['error']));
                $this->response(200, $data);
            endif;
        endif;


        $user_id = $this->user_id;
        $employee_id = $this->input->post('employee_id');

        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_id'), 'd'),
            'course' => en_func($this->input->post('course'), 'd'),
            'subject' => $this->input->post('subject'),
            'university' => $this->input->post('university'),
            'institution' => $this->input->post('institution'),
            'class_obtained' => en_func($this->input->post('class_obtained'), 'd'),
            'reg_no' => $this->input->post('reg_no'),
            'year_of_pass' => $this->input->post('year_of_pass'),
            'qualification_document' => $file_upload['filename'],
            'editable' => en_func($this->input->post('editable'), 'd'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );


        $eq_id  =  en_func($eq_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $eq_id, 'ci_employees_qualifications', 'eq_id');
        // $this->add_activity_log("Updated personal details");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_employees_qualifications');
        // $this->add_activity_log("Added personal details");
        endif;

        // lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Qualification details successfully added ! Redirecting to the next page', 'redirect_url' => base_url() . 'admin/employees/probation_details/'.$employee_id);
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Qualification details could not be added !');
        $this->response(200, $data);
    }



    /**
     * 
     *  Employee probation details
     * 
     */

    public function probation_details($employee_id)
    {

        $data = $this->data;
        $this->check_id_real($employee_id);

        $data["status"] = $this->Common_model->select_status();
        $data['gender'] = $this->Common_model->select_all('ci_gender');
        $data['department'] = $this->Common_model->select_all('ci_service_departments');
        $data['districts'] = $this->Common_model->select_all('tbl_districts');
        $data['offices'] = $this->Common_model->select_all('ci_office');
        $data['designations'] = $this->Common_model->select_all('ci_designations');


        $user_id = en_func($employee_id, 'd');

        $employeeDetails = $data["employeeDetails"] = $this->M_Employees->select_employee_probation_details($user_id);


        $data["operation"] = (empty($employeeDetails)) ? "add" : "edit";


        $data["employee_id"] = $employee_id;

        $this->template->views('admin/permanent_employees/details/probation_details', $data);
    }



    public function update_probation_details()
    {
        $this->form_validation->set_rules('epd_id', 'Probation details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $epd_id = $this->input->post('epd_id');

        $employeeDetails = $this->Common_model->select_by_id('ci_employees_probation_details', en_func($epd_id, 'd'), 'epd_id');
        if (empty($employeeDetails)) {
            $data = array('status' => 'error', 'msg' => "There is no data to update,Please ask the employee to login and fill this form");
            $this->response(200, $data);
        }

        $this->save_probation_details('update', $epd_id);
    }


    public function save_probation_details($func = 'add', $epd_id = 0)
    {
        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('district', 'District', 'trim|required');
        $this->form_validation->set_rules('office', 'Office', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('effect_from', 'Effect From', 'trim|required');
        $this->form_validation->set_rules('order_no', 'Order No', 'trim|required');
        $this->form_validation->set_rules('order_date', 'Order Date', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('epd_id', 'Probation details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = $this->user_id;
        $employee_id = $this->input->post('employee_id');

        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_id'), 'd'),
            'department' => en_func($this->input->post('department'), 'd'),
            'district' => en_func($this->input->post('district'), 'd'),
            'office' => en_func($this->input->post('office'), 'd'),
            'designation' => en_func($this->input->post('designation'), 'd'),
            'effect_from' => $this->input->post('effect_from'),
            'order_no' => $this->input->post('order_no'),
            'order_date' => $this->input->post('order_date'),
            'editable' => en_func($this->input->post('editable'), 'd'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );


        $epd_id =  en_func($epd_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $epd_id, 'ci_employees_probation_details', 'epd_id');
        // $this->add_activity_log("Updated personal details");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_employees_probation_details');
        // $this->add_activity_log("Added personal details");
        endif;

        // lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Probation details successfully added ! Redirecting to the next page', 'redirect_url' => base_url() . 'admin/employees/index/'.$employee_id);
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Probation details could not be added !');
        $this->response(200, $data);
    }



    /**
     * 
     *  Employee Appoinment details
     * 
     */

    public function appoinment_details($employee_id)
    {

        $data = $this->data;
        $this->check_id_real($employee_id);


        $user_id = en_func($employee_id, 'd');

        $data["appoinmentDetails"] = $this->M_Employees->select_employee_appoinment_details($user_id);
        $data["employee_id"] = $employee_id;


        $this->template->views('admin/permanent_employees/details/appoinment_details', $data);
    }

    public function add_appoinment_details()
    {

        $data = $this->data;
        $data["operation"] = 'add';
        $data["editable"] = true;
        $data['courses'] = $this->Common_model->select_all('ci_courses');
        $data['designations'] = $this->Common_model->select_all('ci_designations');


        $records["content"] = $this->load->view('admin/permanent_employees/details/add_appoinment_details', $data, true);
        $records["heading"] = "Add Appoinment details";
        $records["sub_heading"] = "Add a new appoinment to the portal";

        $this->response(200, $records);
    }


    public function edit_appoinment_details($ea_id)
    {

        $data = $this->data;
        $data["operation"] = 'edit';
        $data["ea_id"] = $ea_id;

        $ea_id = en_func($ea_id, 'd');


        $appoinmentDetails = $data["appoinmentDetails"] = $this->Common_model->select_by_id('ci_employees_appoinments', $ea_id, 'ea_id');

        $this->check_exists($data["appoinmentDetails"]);

        $data["editable"] = false;
        if (empty($appoinmentDetails))
            $data["editable"] = true;
        else if (!empty($appoinmentDetails) && $appoinmentDetails->editable == 1)
            $data["editable"] = true;


            $data['designations'] = $this->Common_model->select_all('ci_designations');


        $records["content"] = $this->load->view('admin/permanent_employees/details/add_appoinment_details', $data, true);
        $records["heading"] = "Add Appoinment details";
        $records["sub_heading"] = "Add a new appoinment to the portal";

        $this->response(200, $records);
    }



    public function update_appoinment_details()
    {
        $this->form_validation->set_rules('ea_id', 'Appoinment details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $ea_id  = $this->input->post('ea_id');

        $employeeDetails = $this->Common_model->select_by_id('ci_employees_appoinments', en_func($ea_id, 'd'), 'ea_id');

        if (empty($employeeDetails)) {
            $data = array('status' => 'error', 'msg' => "There is no data to update,Please ask the employee to login and fill this form");
            $this->response(200, $data);
        }

        $this->save_appoinment_details('update', $ea_id);
    }


    public function save_appoinment_details($func = 'add', $ea_id = 0)
    {
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('effect_from', 'With effect from', 'trim|required');
        $this->form_validation->set_rules('appoinment_order_no', 'Appoinment Order No', 'trim|required');
        $this->form_validation->set_rules('appoinment_date', 'Appoinment date', 'trim|required');
        // $this->form_validation->set_rules('approval_order_no', 'Approval Order No', 'trim|required');
        // $this->form_validation->set_rules('approval_order_date', 'Approval DATE', 'trim|required');


        if ($func == 'update')
            $this->form_validation->set_rules('ea_id', 'Appoinment details', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }

        $file_upload['filename'] = $this->input->post('current_document');
        if (empty($_FILES['document']['name']) & strlen($this->input->post('current_document')) == 0) :
            $data = array('status' => 'error', 'msg' => 'Appoinment Document must be uploaded');
            $this->response(200, $data);
        endif;


        if (!empty($_FILES['document']['name'])) :

            $file_upload = $this->addFiles('document', 'appoinment_documents');

            if ($file_upload['status'] == '500') :
                $data = array('status' => 'error', 'msg' => json_encode($file_upload['msg']['error']));
                $this->response(200, $data);
            endif;
        endif;


        $user_id = $this->user_id;
        $employee_id = $this->input->post('employee_id');

        $data_insert = array(
            'employee_id' => en_func($this->input->post('employee_id'), 'd'),
            'designation' => en_func($this->input->post('designation'),'d'),
            'effect_from' => $this->input->post('effect_from'),
            'appoinment_order_no' => $this->input->post('appoinment_order_no'),
            'appoinment_date' => $this->input->post('appoinment_date'),
            'approval_order_no' => !$this->input->post('approval_order_no') ? NULL : $this->input->post('approval_order_no'),
            'approval_order_date' => !$this->input->post('approval_order_date') ? NULL : $this->input->post('approval_order_date'),
            'appoinment_document' => $file_upload['filename'],
            'editable' => en_func($this->input->post('editable'), 'd'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );


        $ea_id  =  en_func($ea_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $ea_id, 'ci_employees_appoinments', 'ea_id');
        // $this->add_activity_log("Updated personal details");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_employees_appoinments');
        // $this->add_activity_log("Added personal details");
        endif;

        // lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Appoinment details successfully added ! Redirecting to the next page', 'redirect_url' => base_url() . 'admin/employees/qualification_details/'.$employee_id);
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Appoinment details could not be added !');
        $this->response(200, $data);
    }


    /***
     * 
     * 
     * 
     */
}
