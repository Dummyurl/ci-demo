<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shopping extends CI_Controller {
    public function Shopping(){
        parent::__construct();
        $this->load->model('query_model','qm',TRUE);
        $this->load->helper('url');
        if (!isset($this->session->userdata['admin'])) {
            redirect('admin');
        }
    }

    public function index(){
        $data['id'] = 'Gujrati';
        $id = $this->uri->segment(4);

        if($id!='' && $id!='all') {
            $data['records'] = $this->qm->select_where('tbl_shopping',array('category'=>$id));
        }else{
            $data['records'] = $this->qm->select_all('tbl_shopping');
        }
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/shopping_list',$data);
        $this->load->view('super_admin/footer');
    }

    public function add_shopping()
    {   
        
        $this->load->view('super_admin/header');
        if(isset($_POST['submit']))
        {   
            if(isset($_FILES['thumb_image']) && $_FILES['thumb_image']['name'] != "") {
                $type = pathinfo($_FILES['thumb_image']['name'],PATHINFO_EXTENSION);
                $file_name = rand(11111111, 99999999).time().".".$type;
                $this->upload->initialize($this->set_upload_options($file_name));
                if($this->upload->do_upload('thumb_image')) {
                    $_POST['thumb_image'] = $file_name;
                   
                } else {
                    echo $this->upload->display_errors();
                }
            }
            if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $files = $_FILES;
                $count = count($_FILES['image']['name']);
                $image_path_list = array();                
                for($i=0; $i<$count; $i++) {
                    $type = pathinfo($files['image']['name'][$i],PATHINFO_EXTENSION);
                    $file_name = rand(11111111, 99999999).time().".".$type;
                    $_FILES['image']['name']= $file_name;
                    $_FILES['image']['type']= $files['image']['type'][$i];
                    $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
                    $_FILES['image']['error']= $files['image']['error'][$i];
                    $_FILES['image']['size']= $files['image']['size'][$i];
                    $this->upload->initialize($this->set_upload_options($file_name));
                    if($this->upload->do_upload('image')) {
                        
                        $image_path_list[$i]=$_FILES['image']['name'];

                    } else {
                        echo $this->upload->display_errors();
                    }
                }
                $path = array (
                    "images" => implode(",",$image_path_list),
                    "category" => $_POST['category'],
                    "title" => $_POST['title'],
                    "price" => $_POST['price'],
                    "quantity" => $_POST['quantity'],
                    'thumbnail'=>$_POST['thumb_image'],
                    "description" => $_POST['description'],
                    "status" => 0
                );
                $this->qm->upload('tbl_shopping',$path);
            }
            redirect('super_admin/shopping');


        }else{
            $this->load->view('super_admin/add_shopping');
        }
        $this->load->view('super_admin/footer');
    }

    function set_upload_options($file_name){
        $config = array();
        $config['file_name'] = $file_name;
        $config['upload_path'] = 'images/products';
        $config['max_size'] = '500000';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|avi|mkv|3gp|mov|mpeg';
        return $config;
    }

    function edit()
    {
        $id = $_REQUEST['id'];
        
        if(isset($_POST['submit']))
        {   
            if(isset($_FILES['thumb_image']) && $_FILES['thumb_image']['name'] != "") {
                $type = pathinfo($_FILES['thumb_image']['name'],PATHINFO_EXTENSION);
                $file_name = rand(11111111, 99999999).time().".".$type;
                $this->upload->initialize($this->set_upload_options($file_name));
                if($this->upload->do_upload('thumb_image')) {
                    $_POST['thumb_image'] = $file_name;
                } else {
                    echo $this->upload->display_errors();
                }
            }else{
                $_POST['thumb_image'] = $_POST['thumbnail_old'];
            }

            if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $files = $_FILES;
                $count = count($_FILES['image']['name']);
                $image_path_list = explode(',',$_POST['image_old']);
                for($i=0; $i<$count; $i++) {
                    $type = pathinfo($files['image']['name'][$i],PATHINFO_EXTENSION);
                    $file_name = rand(11111111, 99999999).time().".".$type;
                    $_FILES['image']['name']= $file_name;
                    $_FILES['image']['type']= $files['image']['type'][$i];
                    $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
                    $_FILES['image']['error']= $files['image']['error'][$i];
                    $_FILES['image']['size']= $files['image']['size'][$i];
                    $this->upload->initialize($this->set_upload_options($file_name));
                    if($this->upload->do_upload('image')) {
                        array_push($image_path_list,$_FILES['image']['name']);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }
                $what = array (
                    "images" => implode(",",$image_path_list),
                    "category" => $_POST['category'],
                    "title" => $_POST['title'],
                    "price" => $_POST['price'],
                    "quantity" => $_POST['quantity'],
                    'thumbnail'=>$_POST['thumb_image'],
                    "description" => $_POST['description'],
                    'status'=>$_POST['status']
                );
                $where=array('shopping_id'=>$id);
                $this->qm->updt('tbl_shopping',$what,$where);
            }
            redirect('super_admin/shopping');
        }else{
            $data['records'] = $this->qm->select_where('tbl_shopping',array('shopping_id'=>$id));
            $this->load->view('super_admin/header');
            $this->load->view('super_admin/edit_shopping',$data);
            $this->load->view('super_admin/footer');
        }
       
       

        
    }
//Delete
    function delete()
    {
        $id = $_REQUEST['id'];
       
        $data['tbl'] = 'tbl_shopping';
        $data['select_field'] = 'images';
        $data['where_field'] = "shopping_id='".$id."'";
        $imgpath = 'images/product';
        $sql = $this->db->query("SELECT images from tbl_shopping where shopping_id=$id");
        $rows = $sql->result();
        foreach ($rows as $p) {
                $path = $imgpath . '/' . $p->images;
                if (file_exists($path)) {
                    unlink($path);
                }
        }
        $where = array('shopping_id' => $id);
        $this->qm->dlt('tbl_shopping', $where);
        redirect('super_admin/shopping');
    }

    function delete_img_list()
    {
        $id = $_REQUEST['id'];
        $remove_image = $_REQUEST['images_id'];
        $imgpath = 'images/product';
        $records = $this->qm->select_where('tbl_shopping',array('shopping_id'=>$id));
        foreach($records as $record){
            
            $images = explode(',',$record['images']);
            if (($key = array_search($remove_image, $images)) !== false) {
                unset($images[$key]);

                $path = $imgpath . '/' . $remove_image;
                if (file_exists($path)) {
                    unlink($path);
                }
                
               
                $images_updt = implode(',',$images);
                $what = array('images'=>$images_updt);
                $where=array('shopping_id'=>$id);
                $this->qm->updt('tbl_shopping',$what,$where);
            }

        }
        redirect('super_admin/shopping/edit?id='.$id);
    }
}