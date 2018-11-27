<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller {
    public function Company(){
        parent::__construct();
        $this->load->model('query_model','qm',TRUE);
        $this->load->helper('url');
        if (!isset($this->session->userdata['admin'])) {
            redirect('admin');
        }
    }

    public function index(){
        $data['records'] = $this->qm->select_all('tbl_company');
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/company_list',$data);
        $this->load->view('super_admin/footer');
    }

    public function add_company()
    {
        $this->load->view('super_admin/header');
        if(isset($_POST['submit']))
        {   
                $finance = array();
                $symboles = $_POST['symbol'];
                $url = "https://query1.finance.yahoo.com/v7/finance/quote?symbols=".$symboles;
                $ch = curl_init(); 
                curl_setopt($ch, CURLOPT_URL, $url); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                $output = curl_exec($ch); 
                curl_close($ch);  
                $quoteResponse = json_decode($output)->quoteResponse;
                $result = $quoteResponse->result[0];
                if(count($quoteResponse->result)>0){
                    $results = $this->db->query("SELECT * FROM tbl_company WHERE symbol='$result->symbol'")->result();
                    if(count($results)==0){
                        $path = array (
                            "company_name" => $result->shortName,
                            "exchange_name" => $result->fullExchangeName,
                            "symbol" => $result->symbol,
                            "quote_type" => $result->quoteType,
                            "financial_currency" => $result->financialCurrency ? $result->financialCurrency:$result->currency,
                        );
                        $this->qm->ins('tbl_company',$path);
                    }
                }
            redirect('super_admin/company');
        }else{
            $this->load->view('super_admin/add_company');
        }
        $this->load->view('super_admin/footer');
    }

    //Delete
    function delete()
    {
        $id = $_REQUEST['id'];
        $where = array('company_id' => $id);
        $this->qm->dlt('tbl_company', $where);
        redirect('super_admin/company');
    }
}