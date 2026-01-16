<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller

{
    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');



        date_default_timezone_set("Asia/Kolkata");


        auth_check();
        //check_access();





        $this->load->model('M_users');
        $this->load->model('M_activities');
        $this->load->model('Common_model');




        /***
         * 
         * Common arrays
         * 
         * **/

        $this->data['message_status'] = array(
            array('status_id' => 1, 'status' => 'Read'),
            array('status_id' => 2, 'status' => 'Unread')
        );


        $this->data['yeah_and_not_enum'] = array(
            array('id' => 'Y', 'value' => 'ഉവ്വ്'),
            array('id' => 'N', 'value' => 'ഇല്ല')
        );

        $this->data['have_and_not_enum'] = array(
            array('id' => 'Y', 'value' => 'ഉണ്ട്'),
            array('id' => 'N', 'value' => 'ഇല്ല')
        );

        $this->data['salutation_enum'] = array(
            array('id' => 'M', 'value' => 'ശ്രീ'),
            array('id' => 'F', 'value' => 'ശ്രീമതി')
        );

        $this->data['fn_and_an_enum'] = array(
            array('id' => 1, 'value' => 'FN', 'value_mal' => 'പൂര്‍വ്വാഹ്നം'),
            array('id' => 2, 'value' => 'AN', 'value_mal' => 'അപരാഹ്നം')
        );

        $this->data['yes_and_no_enum'] = array(
            array('id' => 'Y', 'value' => 'Yes'),
            array('id' => 'N', 'value' => 'No')
        );


        $this->data['yes_and_no_enum_mal'] = array(
            array('id' => 'Y', 'value' => 'അതേ'),
            array('id' => 'N', 'value' => 'അല്ല')
        );


        $this->data['marital_enum'] = array(
            array('id' => 'M', 'value' => 'Married'),
            array('id' => 'U', 'value' => 'Un-Married'),
            array('id' => 'W', 'value' => 'Widowed')
        );



        $user_id = en_func(ss('user_id'), 'd');

        $this->data['menu_id'] = 1;
        $this->user_id = (int) en_func($this->session->userdata('user_id'), 'd');
    }


    public function addFiles($image, $path)
    {
        $config['upload_path'] = './uploads/employees/' . $path . '/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 4000;

        $ext = pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION);



        $this->load->library('upload', $config);



        if (!$this->upload->do_upload($image)) {
            $msg['msg'] = $error = array('error' => $this->upload->display_errors());
            $msg["status"] = '500';
        } else {
            $msg['msg'] = $data = array('image_metadata' => $this->upload->data());
            $msg["status"] = '200';
            $msg["filename"] = $data['image_metadata']['file_name'];
        }
        // print_r($msg); exit();
        return $msg;
    }


    public function addImage($image)
    {
        $config['upload_path'] = './uploads/prescriptions/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['max_size'] = 4000;

        $ext = pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION);



        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($image)) {
            $msg['msg'] = $error = array('error' => $this->upload->display_errors());
            $msg["status"] = '500';
        } else {
            $msg['msg'] = $data = array('image_metadata' => $this->upload->data());
            $msg["status"] = '200';
            $msg["filename"] = $data['image_metadata']['file_name'];
        }
        //print_r($msg); exit();
        return $msg;
    }

    function add_activity_log($activity)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');

        $data_insert = array(
            'activity' => $activity,
            'user_id' => $user_id,
            'created_at' => date("Y-m-d h:i:s"),
            'created_date' => date("Y-m-d")
        );
        $this->db->insert('activity_logs', $data_insert);
    }


    function response($status, $data)
    {
        // header("HTTP/1.1 " . $status);
        header('Content-Type: application/json; charset=utf-8');
        $response['status'] = $status;
        $response['data'] = $data;

        $json_response = json_encode($response);
        echo $json_response;
        exit();
    }

    function check_encrypted($data_en, $data_val)
    {
        if ((int) en_func($data_en, 'd') < 1) {
            $data = array('status' => 'error', 'msg' => $data_val . ' is not defined');
            $this->response(200, $data);
        }
    }


    function check_exists($data_arr)
    {
        if (empty($data_arr))
            redirect_to_404();
    }

    function remove_p_tag($data)
    {
        $data = str_replace("<p>", "", $data);
        $data = str_replace("</p>", "", $data);
        return $data;
    }


    function upload_base64Images($imageData, $imagePath)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $im_data = $imageData;
        list($type, $im_data) = explode(';', $im_data);
        list(, $im_data)      = explode(',', $im_data);
        $im_data = base64_decode($im_data);
        $image_name = time() . '.jpeg';

        $bin = $im_data;
        $img_file = $imagePath . $image_name;
        $im = imageCreateFromString($bin);
        imagejpeg($im, $img_file, 80);
        // $up_response = file_put_contents($imagePath.$image_name, $im_data);
        return $image_name;
    }

    function check_id_real($id)
    {
        if ((int) en_func($id, 'd') < 1) {
            redirect_to_404();
        }
    }


}




/*
*
* Home page Class
*
*/


class US_Controller extends CI_Controller

{
    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');



        date_default_timezone_set("Asia/Kolkata");

        user_auth_check();

        $this->load->model('M_Employees');
        $this->load->model('Common_model');


        $this->data = array();

        $this->user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $this->data['menu_id'] = 1;


        /***
         * 
         * Common arrays
         * 
         * **/



        $this->data['yes_and_no_enum'] = array(
            array('id' => 'Y', 'value' => 'Yes'),
            array('id' => 'N', 'value' => 'No')
        );


        $this->data['marital_enum'] = array(
            array('id' => 'M', 'value' => 'Married'),
            array('id' => 'U', 'value' => 'Un-Married'),
            array('id' => 'W', 'value' => 'Widowed')
        );



        //exit();
    }


    public function addFiles($image, $path)
    {
        $config['upload_path'] = './uploads/employees/' . $path . '/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 4000;

        $ext = pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION);



        $this->load->library('upload', $config);



        if (!$this->upload->do_upload($image)) {
            $msg['msg'] = $error = array('error' => $this->upload->display_errors());
            $msg["status"] = '500';
        } else {
            $msg['msg'] = $data = array('image_metadata' => $this->upload->data());
            $msg["status"] = '200';
            $msg["filename"] = $data['image_metadata']['file_name'];
        }
        // print_r($msg); exit();
        return $msg;
    }


    public function addImage($image)
    {
        $config['upload_path'] = './uploads/news/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 4000;

        $ext = pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION);



        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($image)) {
            $msg['msg'] = $error = array('error' => $this->upload->display_errors());
            $msg["status"] = '500';
        } else {
            $msg['msg'] = $data = array('image_metadata' => $this->upload->data());
            $msg["status"] = '200';
            $msg["filename"] = $data['image_metadata']['file_name'];
        }
        //print_r($msg); exit();
        return $msg;
    }

    function add_activity_log($activity)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');

        $data_insert = array(
            'activity' => $activity,
            'user_id' => $user_id,
            'created_at' => date("Y-m-d h:i:s"),
            'created_date' => date("Y-m-d")
        );
        $this->db->insert('activity_logs', $data_insert);
    }


    function response($status, $data)
    {
        header('Content-Type: application/json; charset=utf-8');

        $response['status'] = $status;
        $response['data'] = $data;

        $json_response = json_encode($response);
        echo $json_response;
        exit();
    }

    function check_encrypted($data_en, $data_val)
    {
        if ((int) en_func($data_en, 'd') < 1) {
            $data = array('status' => 'error', 'msg' => $data_val . ' is not defined');
            echo json_encode($data);
            exit();
        }
    }


    function check_exists($data_arr)
    {
        if (empty($data_arr))
            redirect_to_404_ajax();
    }

    function check_id_real($id)
    {
        if ((int) en_func($id, 'd') < 1) {
            redirect_to_404();
        }
    }

    function remove_p_tag($data)
    {
        $data = str_replace("<p>", "", $data);
        $data = str_replace("</p>", "", $data);
        return $data;
    }


    function upload_base64Images($imageData, $imagePath)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $im_data = $imageData;
        list($type, $im_data) = explode(';', $im_data);
        list(, $im_data)      = explode(',', $im_data);
        $im_data = base64_decode($im_data);
        $image_name = time() . '.jpeg';

        $bin = $im_data;
        $img_file = $imagePath . $image_name;
        $im = imageCreateFromString($bin);
        imagejpeg($im, $img_file, 80);
        // $up_response = file_put_contents($imagePath.$image_name, $im_data);
        return $image_name;
    }
}
