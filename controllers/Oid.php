<?php
/* 
 * Generated by CRUDigniter v3.0 Beta 
 * www.crudigniter.com
 */
 
class Oid extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Oid_model');
    } 

    /*
     * Listing of oid
     */
    function index()
	
	
    {
		
		 if($this->session->userdata('logged_in'))
                {
                  $session_data = $this->session->userdata('logged_in');
                  $data['nom'] = $session_data['nom'];
                  $data['prenom'] = $session_data['prenom'];
                  $data['email'] = $session_data['email'];
				  $data['role'] = $session_data['role'];
				  
        $data['oid'] = $this->Oid_model->get_all_oid();

        $data['_view'] = 'oid/index';
        $this->load->view('layouts/main',$data);
		
			}
          else
                {
                  //If no session, redirect to login page
                  redirect(site_url('login'), 'refresh');
                }
    }

    /*
     * Adding a new oid
     */
    function add()
    {   
	 if($this->session->userdata('logged_in'))
                {
                  $session_data = $this->session->userdata('logged_in');
                  $data['nom'] = $session_data['nom'];
                  $data['prenom'] = $session_data['prenom'];
                  $data['email'] = $session_data['email'];
				  $data['role'] = $session_data['role'];
				  
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'nom_mib' => $this->input->post('nom_mib'),
				'description' => $this->input->post('description'),
				'oid' => $this->input->post('oid'),
            );
            
            $oid_id = $this->Oid_model->add_oid($params);
            redirect('oid/index');
        }
        else
        {            
            $data['_view'] = 'oid/add';
            $this->load->view('layouts/main',$data);
        }
		
			}
          else
                {
                  //If no session, redirect to login page
                  redirect(site_url('login'), 'refresh');
                }
    }  

    /*
     * Editing a oid
     */
    function edit($id)
    {   
	 if($this->session->userdata('logged_in'))
                {
                  $session_data = $this->session->userdata('logged_in');
                  $data['nom'] = $session_data['nom'];
                  $data['prenom'] = $session_data['prenom'];
                  $data['email'] = $session_data['email'];
				  $data['role'] = $session_data['role'];
				  
        // check if the oid exists before trying to edit it
        $data['oid'] = $this->Oid_model->get_oid($id);
        
        if(isset($data['oid']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'nom_mib' => $this->input->post('nom_mib'),
					'description' => $this->input->post('description'),
					'oid' => $this->input->post('oid'),
                );

                $this->Oid_model->update_oid($id,$params);            
                redirect('oid/index');
            }
            else
            {
                $data['_view'] = 'oid/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The oid you are trying to edit does not exist.');
		
			}
          else
                {
                  //If no session, redirect to login page
                  redirect(site_url('login'), 'refresh');
                }
				
    } 

    /*
     * Deleting oid
     */
    function remove($id)
    {
		 if($this->session->userdata('logged_in'))
                {
                  $session_data = $this->session->userdata('logged_in');
                  $data['nom'] = $session_data['nom'];
                  $data['prenom'] = $session_data['prenom'];
                  $data['email'] = $session_data['email'];
				  $data['role'] = $session_data['role'];
				  
        $oid = $this->Oid_model->get_oid($id);

        // check if the oid exists before trying to delete it
        if(isset($oid['id']))
				{
					$this->Oid_model->delete_oid($id);
					redirect('oid/index');
				}
				else
				{
					show_error('The oid you are trying to delete does not exist.');
				}
	
		}
          else
                {
                  //If no session, redirect to login page
                  redirect(site_url('login'), 'refresh');
                }
    
}
}