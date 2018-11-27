<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Application extends CI_Controller {
    public function Application()
    {
        parent::__construct();
        $this->load->model('query_model','qm',TRUE);
        $this->load->helper('url');
        if (!isset($this->session->userdata['admin'])) {
            redirect('admin');
        }
	}
    public function index()
    {
        $data['records'] = $this->qm->select_all('tbl_application');
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/application_list',$data);
        $this->load->view('super_admin/footer');
    }

    public function add_application()
    {
        $this->load->view('super_admin/header');
        $app_id = $this->uri->segment(4);
        if ($app_id != "") {
            $where = array('app_id' => $app_id);
            if (isset($_POST['submit'])) {
                $post_data = array();
                if (isset($_FILES['icon']['name']) && ($_FILES['icon']['name']) != "") {
                    $data['tbl'] = 'tbl_application';
                    $data['select_field'] = 'icon';
                    $data['where_field'] = "app_id='".$app_id."'";
                    $imgpath = 'images/app_icon';
                    $data['img_path'] = glob($imgpath.'*');
                    $this->qm->delete_img($data);
                    $type = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
                    $icon = rand(1111, 9999) . time() . "." . $type;
                    $config['file_name'] = $icon;
                    $config['upload_path'] = "images/app_icon/";
                    $config['allowed_types'] = "jpg|jpeg|png|bmp";
                    $this->upload->initialize($config);
                    $this->upload->do_upload('icon');
                    $post_data['icon'] = $icon;
                }
              
                $post_data['application_name'] = ucfirst($_POST['application_name']);
                $post_data['g_id'] = $_POST['g_id'];
                $post_data['impression'] = $_POST['impression'];
                $post_data['click'] = $_POST['click'];
                $post_data['application_link'] = $_POST['application_link'];
                $this->qm->updt('tbl_application', $post_data, $where);
                redirect('super_admin/application');
            }
            else
            {
                $view_data['app_data'] = $this->qm->select_where('tbl_application', $where);
                $this->load->view('super_admin/add_application', $view_data);
            }
        }
        else
        {
            if(isset($_POST['submit']))
            {
                $icon = "";
                if (isset($_FILES['icon']['name']) && ($_FILES['icon']['name']) != "") {
                    $type = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
                    $icon = rand(1111, 9999) . time() . "." . $type;
                    $config['file_name'] = $icon;
                    $config['upload_path'] = "images/app_icon/";
                    $config['allowed_types'] = "jpg|jpeg|png|bmp";
                    $this->upload->initialize($config);
                    $this->upload->do_upload('icon');
                }
                $post_data = array(
                    'application_name' => ucfirst($_POST['application_name']),
                    'application_link' => $_POST['application_link'],
                    'icon' => $icon,
                    'g_id' => $_POST['g_id'],
                    'impression' => $_POST['impression'],
                    'click' => $_POST['click']
                );
                $this->qm->ins('tbl_application', $post_data);
                redirect('super_admin/application');
            }
            $this->load->view('super_admin/add_application');
        }
        $this->load->view('super_admin/footer');
    }

//Delete 
    function delete($admin_id='')
    {
        if($admin_id=='')
            $apps=$this->input->post('app');
        else
            $apps = array($admin_id);
        foreach($apps as $admin_id) {

            $data['tbl'] = 'tbl_application';
            $data['select_field'] = 'icon';
            $data['where_field'] = "app_id='".$admin_id."'";
            $imgpath = 'images/app_icon';
            $data['img_path'] = glob($imgpath.'*');
            $this->qm->delete_img($data);

            $where=array('app_id'=>$admin_id);
	    $this->qm->dlt("tbl_application",$where);
        }
        redirect('super_admin/application');
    }
}