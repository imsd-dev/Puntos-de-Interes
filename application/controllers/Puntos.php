<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Puntos extends CI_Controller{

function __construct(){
		parent:: __construct();
		
		$this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->library('form_validation');
		$this ->load->library('encryption');
		$this->load->model('Marcadores');	
		$this->load->model('login_model');		
		$this->load->driver('session');
		
		$id= $this->session->mark_as_flash('item');
		$nivel= $this->session->userdata('nivel'); 
		$key['llave'] =bin2hex ($this->encryption->create_key(26));

	} 

	//Iniciar  pagina con el mapa
	public function index(){
		$cat = $this->input->post('selectcate');

		$data['categorias']= $this->Marcadores->getcat();
		
		$data['blogs'] = $this->Marcadores->getblog();
		$data['dato'] =$this->Marcadores->getblogs();
		

		$this->load->view('blog/mapa', $data);
	}
	//Agregar usuario
	public function insertar(){
		$cla = "qwe";
        $contra  =  md5($cla."Puntosdeinteres") ; 
       
        $passw= md5($cla);
		$data = array(
		'id'       =>"9",
		'username' =>"yo",
		'password' =>  $contra		
		);
		
		$this->login_model->form_insert($data);
	}

	//Inicializar pagina de administracion
	public function admin(){

          //get the posted values
          $username = $this->input->post("txt_username");
          $pass = $this->input->post("txt_password");
          $password = md5($pass."Puntosdeinteres");
          
          //set validations
          $this->form_validation->set_rules("txt_username", "Username", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
               $this->load->view('layout/header');
               $this->load->view('blog/login_view');
          }
          else
          {
             
               if ($this->input->post('btn_login') == "Iniciar Sesion")
               {
               	    
                    //Consultas a base de datos
               		
                    $usr_result = $this->login_model->get_user($username, $password);
                    $resu_id = $this->login_model->get_di($username, $password); 
                    $resu_pass = $this->login_model->get_pass($username, $password);

                    $id = $resu_id['id'];
                    $sistema= "Puntosdeinteres";
                   
					$permiso= $this->login_model->get_nivel($id,$sistema);
                    	                 
	                 if ($usr_result) 
		              {
		              	if ($permiso ) 
	                 	 {		                 
		                   $sessiondata = array(
		                        'username' => $username,
		                        'loginuser' => TRUE,
		                        'id_usuario'=> $id
		                   );
		                   
		                   $this->session->set_userdata('nivel',$permiso['nivel_acceso']);
		                   $this->session->set_userdata('username',$sessiondata['username']);
		                   $this->session->set_userdata('id_usuario',$sessiondata['id_usuario']);	

		                   //redirect(base_url('index.php/puntos/inde'));
		                   $data['blogs'] = $this->Marcadores->getall();
		                   $data['categorias']= $this->Marcadores->getcat();
		                   //$this->load->view('layout/header');
              			   //$this->load->view('blog/administracion', $data);
		                   redirect(base_url('index.php/puntos/administracion'),'refresh');
		                    }else{

		                      //$this->session->set_flashdata('err',$id );
			                  $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usted no tiene permisos para ingresar a este tramite!</div>');
			                  
			                  redirect($this->uri->uri_string());
	                 	  }
	                 
		              }else{
		              	//$this->session->set_flashdata('err',$permiso );
		 				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Nombre de usuario o contraseña invalidos!</div>');
		                   redirect($this->uri->uri_string());                   
		              }
                   
               }
               else

               {  echo "<script>alert('Falló el ingreso');</script>";
                   redirect(base_url(),'refresh');
               }
          }
     }

    //Cargar pagina de administracion
    function administracion(){
		$variable = $this->session->userdata('username');
		if (is_null($variable)) {
			
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe iniciar sesión</div>');
			redirect(base_url('index.php/puntos/admin'),'refresh');
		}else{

		$data['blog'] = null;
		$data['blogp'] = null;
		$data['blogs'] = $this->Marcadores->getall();
		$data['categorias']= $this->Marcadores->getcat();
	    
	   	$this->load->view('blog/administracion', $data);
		}
	}

	//Cerrar Session
	public function logout(){
 
	      $this->session->sess_destroy();
	      redirect(base_url('index.php/puntos/admin'),'refresh');
	}


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@********** CATEGORIAS **********@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//Agregar Categoria
	public function submitCate(){
		//verificar si existe
		$resu =$this->Marcadores->getCateById();	
			if($resu){
				$this->session->set_flashdata('add_msg', 'Registro ya existe');

				$this->session->set_flashdata('divAgregar', ' ');
				redirect(base_url('index.php/puntos/administracion'));
				
			}else{
				$result = $this->Marcadores->submitC();
					if($result){ 
						$this->session->set_flashdata('success_msg', 'Registro agregado');
					}else{
						$this->session->set_flashdata('error_msg', 'Registro No agregado');
					}
						$this->session->set_flashdata('divAgregar', ' ');
						redirect(base_url('index.php/puntos/administracion'), 'refresh');

			}			
	}

//Eliminar Categoria
	public function deleteCate($codigo){
		$nivel= $this->session->userdata('nivel'); 
		$variable = $this->session->userdata('username');

		if (is_null($variable)||$nivel==1||$nivel==2) {			
			redirect(base_url('index.php/puntos/admin'), 'refresh');
		}else{
						
			$result = $this->Marcadores->deleteC($codigo);
				
				
			if($result==TRUE){
				$this->session->set_flashdata('success_msg', 'Registro Eliminado');
			}else{
				$this->session->set_flashdata('error_msg', 'No se puede eliminar ya que hay un punto que esta usando esta categoria');
			}
			
			redirect(base_url('index.php/puntos/administracion'));
		}
	}

//Iniciar pagina para editar
	public function editeCate($id){
		$variable = $this->session->userdata('username');
		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe iniciar sesión</div>');
			redirect(base_url('index.php/puntos/admin'),'refresh');
		}else{
			$data['blogp'] = null;
			$data['blog'] = $this->Marcadores->getCatId($id);
			$data['blogs'] = $this->Marcadores->getall();
			$data['categorias']= $this->Marcadores->getcat();

			$this->session->set_flashdata('modificar', 'Modificar');
		   	$this->load->view('blog/administracion', $data);
		}
	}

//Editar Categoria	
	public function updateCate(){
		$result = $this->Marcadores->updateC();
		if($result){
			$this->session->set_flashdata('success_msg', 'Modificado Correctamente');
		}else{
			$this->session->set_flashdata('error_msg', 'Fallo la modificacion');
		}
		redirect(base_url('index.php/puntos/administracion'));
	}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@********** PUNTOS **********@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

//Agregar Punto
	public function submitP(){
		//verificar si existe
		$resu =$this->Marcadores->getPById();	
			if($resu){
				$this->session->set_flashdata('add_msg', 'Ya existe un punto con estas coodenadas');

				$this->session->set_flashdata('divAgregar', ' ');
				redirect(base_url('index.php/puntos/administracion'));
				
			}else{
				$result = $this->Marcadores->submitP();
					if($result){ 
						$this->session->set_flashdata('success_msg', 'Registro agregado');
					}else{
						$this->session->set_flashdata('error_msg', 'Registro No agregado');
					}
						$this->session->set_flashdata('divAgregar', ' ');
						redirect(base_url('index.php/puntos/administracion'), 'refresh');

			}			
	}

//Eliminar Punto
	public function deleteP($codigo){
		$nivel= $this->session->userdata('nivel'); 
		$variable = $this->session->userdata('username');
		if (is_null($variable)||$nivel==1||$nivel==2) {			
			redirect(base_url('index.php/puntos/admin'), 'refresh');
		}else{
			$result = $this->Marcadores->deleteP($codigo);
			if($result){
				$this->session->set_flashdata('success_msg', 'Registro Eliminado');
			}else{
				$this->session->set_flashdata('error_msg', 'Registro No Eliminado');
			}
			redirect(base_url('index.php/puntos/administracion'));
		}
	}

//Iniciar pagina para editar
	public function editeP($id){
		$variable = $this->session->userdata('username');
		if (is_null($variable)) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe iniciar sesión</div>');
			redirect(base_url('index.php/puntos/admin'),'refresh');
		}else{
			$data['blog'] = null;
			$data['blogp'] = $this->Marcadores->getPId($id);
			$data['blogs'] = $this->Marcadores->getall();
			$data['categorias']= $this->Marcadores->getcat();

			$this->session->set_flashdata('modificar', 'Modificar');
		   	$this->load->view('blog/administracion', $data);
		}
	}

//Editar Categoria	
	public function updateP(){
		$result = $this->Marcadores->updateP();
		if($result){
			$this->session->set_flashdata('success_msg', 'Modificado Correctamente');
		}else{
			$this->session->set_flashdata('error_msg', 'Fallo la modificacion');
		}
		redirect(base_url('index.php/puntos/administracion'));
	}



}
