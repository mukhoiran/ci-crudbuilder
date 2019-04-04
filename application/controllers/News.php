<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('news/news_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->News_model->json();
    }

    public function read($id) 
    {
        $row = $this->News_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'title' => $row->title,
		'description' => $row->description,
		'author' => $row->author,
		'created_at' => $row->created_at,
	    );
            $this->load->view('news/news_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('news/create_action'),
	    'id' => set_value('id'),
	    'title' => set_value('title'),
	    'description' => set_value('description'),
	    'author' => set_value('author'),
	    'created_at' => set_value('created_at'),
	);
        $this->load->view('news/news_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'description' => $this->input->post('description',TRUE),
		'author' => $this->input->post('author',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->News_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('news'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('news/update_action'),
		'id' => set_value('id', $row->id),
		'title' => set_value('title', $row->title),
		'description' => set_value('description', $row->description),
		'author' => set_value('author', $row->author),
		'created_at' => set_value('created_at', $row->created_at),
	    );
            $this->load->view('news/news_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'description' => $this->input->post('description',TRUE),
		'author' => $this->input->post('author',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->News_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('news'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $this->News_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('news'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('author', 'author', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "news.xls";
        $judul = "news";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Title");
	xlsWriteLabel($tablehead, $kolomhead++, "Description");
	xlsWriteLabel($tablehead, $kolomhead++, "Author");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");

	foreach ($this->News_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->title);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description);
	    xlsWriteLabel($tablebody, $kolombody++, $data->author);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=news.doc");

        $data = array(
            'news_data' => $this->News_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('news/news_doc',$data);
    }

}

/* End of file News.php */
/* Location: ./application/controllers/News.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-04-04 17:31:23 */
/* http://harviacode.com */