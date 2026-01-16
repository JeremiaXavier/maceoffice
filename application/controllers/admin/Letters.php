<?php
defined('BASEPATH') or exit('No direct script access allowed');

class letters extends MY_Controller
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

        $this->template->views('admin/letters/index', $data);
    }

    public function add_letters()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data['ordersList'] = $this->Common_model->select_all('ci_letters_orders');

        $data['sendersList'] = $this->Common_model->select_all('ci_letters_senders');
        $data['recipientsList'] = $this->Common_model->select_all('ci_letters_recipients');


        $this->template->views('admin/letters/add_letters', $data);
    }



    public function edit_letters($letter_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["letter_id"] = $letter_id;

        $letter_id = en_func($letter_id, 'd');

        $data["lettersDetails"] = $this->Common_model->select_by_id('ci_letters', $letter_id, 'letter_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["lettersDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_letters_orders');

        $data['sendersList'] = $this->Common_model->select_all('ci_letters_senders');
        $data['recipientsList'] = $this->Common_model->select_all('ci_letters_recipients');



        $records["content"] = $this->load->view('admin/letters/add_letters', $data, true);
        $records["heading"] = "Edit Letters details";
        $records["sub_heading"] = "Edit a Letters in the portal";

        $this->response(200, $records);
    }

    public function view_letters($letter_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["letter_id"] = $letter_id;

        $letter_id = en_func($letter_id, 'd');

        $data["lettersDetails"] = $this->Common_model->select_by_id('ci_letters', $letter_id, 'letter_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["lettersDetails"]);

        $data['ordersList'] = $this->Common_model->select_all('ci_letters_orders');

        $data['sendersList'] = $this->Common_model->select_all('ci_letters_senders');
        $data['recipientsList'] = $this->Common_model->select_all('ci_letters_recipients');



        $records["content"] = $this->load->view('admin/letters/add_letters', $data, true);
        $records["heading"] = "View Letters details";
        $records["sub_heading"] = "View a Letters in the portal";

        $this->response(200, $records);
    }


    public function update_letters()
    {
        $letter_id = $this->input->post('letter_id');
        $this->save_letters('update', $letter_id);
    }


    public function save_letters($func = 'add', $letter_id = 0)
    {
        $this->form_validation->set_rules('points[]', 'Orders', 'trim|required');

        $this->form_validation->set_rules('order_no', 'Order no', 'trim|required');
        $this->form_validation->set_rules('letter_date', 'Letter date', 'trim|required');
        $this->form_validation->set_rules('letter_title', 'Letter title', 'trim|required');
        $this->form_validation->set_rules('sender', 'Sender', 'trim|required');
        $this->form_validation->set_rules('receiver', 'Receiver', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('salutation', 'Salutation', 'trim|required');
        $this->form_validation->set_rules('body', 'Body', 'trim|required');



        if ($func == 'update')
            $this->form_validation->set_rules('letter_id', 'Letter ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $orders = $this->input->post('points');
        $letter_orders = implode("~", $orders);


        $data_insert = array(
            'sender' => en_func($this->input->post('sender'), 'd'),
            'receiver' => en_func($this->input->post('receiver'), 'd'),
            'order_no' => $this->input->post('order_no'),
            'letter_date' => $this->input->post('letter_date'),
            'letter_orders' => $letter_orders,
            'letter_title' => $this->input->post('letter_title'),
            'subject' => $this->input->post('subject'),
            'salutation' => $this->input->post('salutation'),
            'body' => $this->input->post('body'),

            'generated' => 0,
            'letter_filename' => null,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $letter_id =  en_func($letter_id, 'd');


        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $letter_id, 'ci_letters', 'letter_id');
            $this->add_activity_log("Updated Letters");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_letters');
            $this->add_activity_log("Added Letters");
        endif;

        //lq();

        // dd($_POST);



        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Letters successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Letters could not be added !');
        $this->response(200, $data);
    }

    public function letters_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd'); 

        $records['data'] = $this->Common_model->select_all('ci_letters', $status); 
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $letter_id  = en_func($row->letter_id, 'e');

            $generated = $row->generated;

            $generated_reports = '';
            if ($generated)
                $generated_reports = '
                <div class="btn-group btn-group-sm">
            <a target="_blank" href="' . LETTERS . $row->letter_filename . '" title="Print letter" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
            </div>
            ';

            $data[] = array(
                ++$i,
                $row->letter_title,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                    <a data-url="' . base_url() . 'admin/letters/edit_letters/' . $letter_id . '" title="Edit letters" class="open-offcanvas btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/letters/view_letters/' . $letter_id . '" title="View letters" class="open-offcanvas btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <a data-id="' . $letter_id . '" title="Generate report" class="' . ($generated == 1 ? 'btn-primary' : 'generate-report btn-warning') . ' btn btn-sm">' . ($generated == 1 ? 'Generated' : 'Generate') . '</a>
                    
                    </div>',
                $generated_reports

            );
        }
        $this->response(200, $data);
    }


    public function delete_letters($letter_id)
    {
        $letter_id = en_func($letter_id, 'd');
        $response = $this->Common_model->delete_table($letter_id, 'ci_letters', 'letter_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Letter has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Letter could not be deleted!');

        
        redirect(base_url('admin/letters'));
    }



    public function generate_letter($letter_id = 0)
    {
        $data = $this->data;


        $letter_id = en_func($letter_id, 'd');
        $lettersDetails = $data["lettersDetails"] = $this->M_reports->select_letters_details($letter_id);
        // $this->check_exists($data["lettersDetails"]);

        // dd($lettersDetails);

        $letter_filename = str_replace(' ', '-', ucfirst($lettersDetails->letter_title)) . '-Letters-' . substr(en_func(strtotime("now"), 'e'), 0, 5) . '.pdf';

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

        $html = $this->load->view('admin/letters/letter_preview', $data, true);
        $mpdf->WriteHTML($html);

        $mpdf->Output('uploads/letters/' . $letter_filename, "F");
        // $mpdf->Output();
        // exit();



        $data_insert = array(
            'generated' => 1,
            'letter_filename' => $letter_filename,
            'updated_at' => date("Y-m-d h:i:s"),
        );
        $qry_response = $this->Common_model->update_table($data_insert, $letter_id, 'ci_letters', 'letter_id');

        $data = array('status' => 'success', 'msg' => 'Letters generated successfully !');
        $this->response(200, $data);
    }



    /**
     * 
     * Letters Senders
     * 
     * 
     */


    public function senders()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/letters/senders/index', $data);
    }

    public function add_senders()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/letters/senders/add_senders', $data, true);
        $records["heading"] = "Add Letters Order details";
        $records["sub_heading"] = "Add a new Letters order to the portal";

        $this->response(200, $records);
    }



    public function edit_senders($sender_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["sender_id"] = $sender_id;

        $sender_id = en_func($sender_id, 'd');

        $data["sendersDetails"] = $this->Common_model->select_by_id('ci_letters_senders', $sender_id, 'sender_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["sendersDetails"]);

        $records["content"] = $this->load->view('admin/letters/senders/add_senders', $data, true);
        $records["heading"] = "Edit Letters Order details";
        $records["sub_heading"] = "Edit a Letters order in the portal";

        $this->response(200, $records);
    }

    public function view_senders($sender_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["sender_id"] = $sender_id;

        $sender_id = en_func($sender_id, 'd');

        $data["sendersDetails"] = $this->Common_model->select_by_id('ci_letters_senders', $sender_id, 'sender_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["sendersDetails"]);

        $records["content"] = $this->load->view('admin/letters/senders/add_senders', $data, true);
        $records["heading"] = "View Letters Order details";
        $records["sub_heading"] = "View a Letters order in the portal";

        $this->response(200, $records);
    }


    public function update_senders()
    {
        $sender_id = $this->input->post('sender_id');
        $this->save_senders('update', $sender_id);
    }


    public function save_senders($func = 'add', $sender_id = 0)
    {
        $this->form_validation->set_rules('sender_name', 'Sender name', 'trim|required');
        $this->form_validation->set_rules('sender_name_mal', 'Sender name Malayalam', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('sender_id', 'senders ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'sender_name' => $this->input->post('sender_name'),
            'sender_name_mal' => $this->input->post('sender_name_mal'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $sender_id =  en_func($sender_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $sender_id, 'ci_letters_senders', 'sender_id');
            $this->add_activity_log("Updated Sender");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_letters_senders');
            $this->add_activity_log("Added Sender");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Sender successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'Sender could not be added !');
        $this->response(200, $data);
    }

    public function senders_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_letters_senders', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $sender_id  = en_func($row->sender_id, 'e');
            $data[] = array(
                ++$i,
                $row->sender_name,
                $row->sender_name_mal,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-md">
                    <a data-url="' . base_url() . 'admin/letters/edit_senders/' . $sender_id . '" title="Edit senders" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/letters/view_senders/' . $sender_id . '" title="View senders" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }
    /**
     * 
     * Letters Recievers
     * 
     * 
     */


    public function receivers()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/letters/receivers/index', $data);
    }

    public function add_receivers()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/letters/receivers/add_receivers', $data, true);
        $records["heading"] = "Add Letters Order details";
        $records["sub_heading"] = "Add a new Letters order to the portal";

        $this->response(200, $records);
    }



    public function edit_receivers($recipient_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["recipient_id"] = $recipient_id;

        $recipient_id = en_func($recipient_id, 'd');

        $data["receiversDetails"] = $this->Common_model->select_by_id('ci_letters_recipients', $recipient_id, 'recipient_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["receiversDetails"]);

        $records["content"] = $this->load->view('admin/letters/receivers/add_receivers', $data, true);
        $records["heading"] = "Edit Letters Order details";
        $records["sub_heading"] = "Edit a Letters order in the portal";

        $this->response(200, $records);
    }

    public function view_receivers($recipient_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["recipient_id"] = $recipient_id;

        $recipient_id = en_func($recipient_id, 'd');

        $data["receiversDetails"] = $this->Common_model->select_by_id('ci_letters_recipients', $recipient_id, 'recipient_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["receiversDetails"]);

        $records["content"] = $this->load->view('admin/letters/receivers/add_receivers', $data, true);
        $records["heading"] = "View Letters Order details";
        $records["sub_heading"] = "View a Letters order in the portal";

        $this->response(200, $records);
    }


    public function update_receivers()
    {
        $recipient_id = $this->input->post('recipient_id');
        $this->save_receivers('update', $recipient_id);
    }


    public function save_receivers($func = 'add', $recipient_id = 0)
    {
        $this->form_validation->set_rules('recipient_name', 'receiver name', 'trim|required');
        $this->form_validation->set_rules('recipient_name_mal', 'receiver name Malayalam', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('recipient_id', 'receivers ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            $this->response(200, $data);
        }


        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');


        $data_insert = array(
            'recipient_name' => $this->input->post('recipient_name'),
            'recipient_name_mal' => $this->input->post('recipient_name_mal'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $recipient_id =  en_func($recipient_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $recipient_id, 'ci_letters_recipients', 'recipient_id');
            $this->add_activity_log("Updated receiver");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_letters_recipients');
            $this->add_activity_log("Added receiver");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'receiver successfully added !');
            $this->response(200, $data);

        endif;

        $data = array('status' => 'error', 'msg' => 'receiver could not be added !');
        $this->response(200, $data);
    }

    public function receivers_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_letters_recipients', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $recipient_id  = en_func($row->recipient_id, 'e');
            $data[] = array(
                ++$i,
                $row->recipient_name,
                $row->recipient_name_mal,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-md">
                    <a data-url="' . base_url() . 'admin/letters/edit_receivers/' . $recipient_id . '" title="Edit receivers" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/letters/view_receivers/' . $recipient_id . '" title="View receivers" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }

    /**
     * 
     * Letters Orders
     * 
     * 
     */


    public function orders()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/letters/orders/index', $data);
    }

    public function add_orders()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/letters/orders/add_orders', $data, true);
        $records["heading"] = "Add Letters Order details";
        $records["sub_heading"] = "Add a new Letters order to the portal";

        $this->response(200, $records);
    }



    public function edit_orders($order_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_letters_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/letters/orders/add_orders', $data, true);
        $records["heading"] = "Edit Letters Order details";
        $records["sub_heading"] = "Edit a Letters order in the portal";

        $this->response(200, $records);
    }

    public function view_orders($order_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["order_id"] = $order_id;

        $order_id = en_func($order_id, 'd');

        $data["ordersDetails"] = $this->Common_model->select_by_id('ci_letters_orders', $order_id, 'order_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["ordersDetails"]);

        $records["content"] = $this->load->view('admin/letters/orders/add_orders', $data, true);
        $records["heading"] = "View Letters Order details";
        $records["sub_heading"] = "View a Letters order in the portal";

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
            $qry_response = $this->Common_model->update_table($data_insert, $order_id, 'ci_letters_orders', 'order_id');
            $this->add_activity_log("Updated order");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_letters_orders');
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

        $records['data'] = $this->Common_model->select_all('ci_letters_orders', $status);
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
                    <a data-url="' . base_url() . 'admin/letters/edit_orders/' . $order_id . '" title="Edit orders" class="btn btn-sm btn-warning open-offcanvas"><i class="fa fa-pencil"></i></a>
                    <a data-url="' . base_url() . 'admin/letters/view_orders/' . $order_id . '" title="View orders" class="btn btn-sm btn-info open-offcanvas"><i class="fa fa-eye"></i></a>
                </div>'

            );
        }
        $this->response(200, $data);
    }
}
