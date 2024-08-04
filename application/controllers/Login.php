<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('CekLogin_Model');
    }

    public function index()
    {
		
		
		if(!$this->input->post())
		{
			$this->load->view('Login');
		}
		else
		{
			$cek_login_customer=$this->CekLogin_Model->cek_login_customer($this->input->post('Username'),$this->input->post('Password'));	
			$cek_login_petugas=$this->CekLogin_Model->cek_login_petugas($this->input->post('Username'),$this->input->post('Password'));
			if(!empty($cek_login_customer))
			{
				$this->session->set_userdata('Username_Customer',$cek_login_customer->Username);
				$this->session->set_userdata('logined',true);
				redirect('Home_Movies');
			}else if (!empty($cek_login_petugas)) 
			{
				$this->session->set_userdata('Username_Petugas',$cek_login_petugas->Username_Petugas);
				$this->session->set_userdata('Jabatan',$cek_login_petugas->Jabatan);
				$this->session->set_userdata('logined',true);
				if($cek_login_petugas->Jabatan == 'Admin') {
					redirect('Customer');
				}
				else {
					redirect('Tiket');
				}
				
			}
			else 
			{
				$this->session->set_flashdata('Gagal', '<div class="alert alert-danger text-center">Gagal Login</div>');
				redirect("login");
			}
		}       
    } 
	
	public function logout()
    {
		$this->session->unset_userdata('logined');
		$this->session->unset_userdata('Username_Customer');
		$this->session->unset_userdata('Username_Petugas');
		redirect("/");
		session_destroy();
		
    } 
}

/* End of file Workflows.php */
/* Location: ./application/controllers/Workflows.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-15 00:43:10 */
/* http://harviacode.com */