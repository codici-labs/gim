<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('layout');
		$this->layout->setFolder('admin');
		$this->load->library('pagination');
		$this->load->helper("url");
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} 
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	public function index(){
		$this->db->from('fichas');

		$fichas = $this->db->get();
		$rowcount = $fichas->num_rows();

		$config['base_url'] = base_url().'admin/index/';
		$config['total_rows'] = $rowcount;
		$config['per_page'] = 15;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = "<ul class='pagination'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);

		


		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'fichas';

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->db->limit($config['per_page'] , $page);
		$this->db->select('f.*, s.nombre as sede, p.name as puesto');
		$this->db->from('fichas f');
		$this->db->join('sedes s', 'f.sede_id = s.id');
		$this->db->join('puestos p', 'f.puesto = p.id');
		$this->db->order_by('lower(lastname), lower(firstname)');
		$query = $this->db->get();

		$data['puestos'] = $this->db->get('puestos')->result();
		$data['fichas'] = $query->result();




		$this->layout->view('fichas',$data);
	}

	public function sedes($order_field = false){
		

		$this->db->from('sedes');

		$sedes = $this->db->get();
		$rowcount = $sedes->num_rows();

		if(($order_field == 'nombre')||($order_field == 'direccion')||($order_field == 'codigo')||($order_field == 'contacto')||($order_field == 'mail_list')){
			$config['base_url'] = base_url().'admin/sedes/'.$order_field;
			$config["uri_segment"] = 4;
		}else{
			$config['base_url'] = base_url().'admin/sedes';
			$config["uri_segment"] = 3;
		}

		
		$config['total_rows'] = $rowcount;
		$config['per_page'] = 15;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);

		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'sedes';
		
		
		if(($order_field == 'nombre')||($order_field == 'direccion')||($order_field == 'codigo')||($order_field == 'contacto')||($order_field == 'mail_list')){
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		}else{
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		}

		

		$this->db->limit($config['per_page'] , $page);
		if(($order_field == 'nombre')||($order_field == 'direccion')||($order_field == 'codigo')||($order_field == 'contacto')||($order_field == 'mail_list')){
			$this->db->order_by('lower('.$order_field.')', 'asc');
		}else{
			$this->db->order_by('lower(nombre)');
		}
		$data['sedes'] = $this->db->get('sedes')->result();
	
		$this->layout->view('sedes',$data);
	}

	
	public function agregar_sede(){

		if($_POST){
			
			$insert['nombre'] = $_POST['nombre'];
			$insert['codigo'] = $_POST['codigo'];
			$insert['direccion'] = $_POST['direccion'];
			$insert['contacto'] = $_POST['contacto'];
			$insert['mail_list'] = $_POST['listacorreo'];
			
			$this->db->insert('sedes', $insert);
			$this->session->set_flashdata('message', 'Sede agregada con correctamente.');
			redirect('admin/sedes');
		}

		
		$data['active_tab'] = 'sedes';
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();

		if ($data['role'] == "user")
			redirect('admin/sedes');
		else if (($data['role'] == "sysadmin") || ($data['role'] == "admin"))
			$this->layout->view('agregar_sede', $data, $return=false);
	}

	public function perfil(){
		$data['role'] = $this->tank_auth->get_role();
		if($_POST){
			$update['username'] = $_POST['username'];
			$update['email'] = $_POST['email'];

			$this->db->where('id', $this->tank_auth->get_user_id());
			$this->db->update('users', $update);
			if ($data['role'] == "sysadmin")
				redirect('auth/logout');
			else
				redirect('admin/usuarios');
		
		}

		$data['active_tab'] = 'usuarios';

		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		
		$data['user'] = $this->db->get_where('users',array('id'=>$this->tank_auth->get_user_id()))->row();
		$this->layout->view('perfil', $data);
	}


	
	public function editar_sede($id){

		if($_POST){
			$update['nombre'] = $_POST['nombre'];
			$update['codigo'] = $_POST['codigo'];
			$update['direccion'] = $_POST['direccion'];
			$update['contacto'] = $_POST['contacto'];
			$update['mail_list'] = $_POST['listacorreo'];

			$this->db->where('id',$id);
			$this->db->update('sedes',$update);
			$this->session->set_flashdata('message', 'Sede editada correctamente.');
			redirect('admin/sedes');
		
		}
		$data['active_tab'] = 'sedes';

		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();

		$data['sede'] = $this->db->get_where('sedes',array('id'=>$id))->row();

		if ($data['role'] == "user")
			redirect('admin/sedes');
		else if (($data['role'] == "sysadmin") || ($data['role'] == "admin"))
			$this->layout->view('editar_sede', $data);
	}

	public function borrar_sede($id){
		$this->db->delete('sedes',array('id'=>$id));
		$this->session->set_flashdata('message', 'Sede borrada correctamente.');
		redirect('admin/sedes');
	}	
	
	
	
	public function editar_usuario($id){

		if($_POST){
			$update['username'] = $_POST['username'];
			$update['role_id'] = $_POST['role_id'];
			$update['email'] = $_POST['email'];


			$this->db->where('id',$id);
			$this->db->update('users', $update);
			$this->session->set_flashdata('message', 'Usuario editado correctamente.');
			redirect('admin/usuarios');
		
		}

		$data['active_tab'] = 'usuarios';

		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();

		$data['roles'] = $this->db->get('roles')->result();

		$data['user'] = $this->db->get_where('users',array('id'=>$id))->row();

		if ($data['role'] == "user")
			redirect('admin/usuarios');
		else if (($data['role'] == "sysadmin") || ($data['role'] == "admin")) //el admin solo puede ver/modificar mails, eso debe cambiarse en la vista?
			$this->layout->view('editar_usuario', $data);
	}


	public function usuarios($order_field = false){
		$this->db->from('users');

		$usuarios = $this->db->get();
		$rowcount = $usuarios->num_rows();

		if(($order_field == 'username')||($order_field == 'email')||($order_field == 'role')){
			$config['base_url'] = base_url().'admin/usuarios/'.$order_field;
			$config["uri_segment"] = 4;
		}else{
			$config['base_url'] = base_url().'admin/usuarios';
			$config["uri_segment"] = 3;
		}

		
		$config['total_rows'] = $rowcount;
		$config['per_page'] = 15;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'usuarios';

		if(($order_field == 'username')||($order_field == 'email')||($order_field == 'role')){
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		}else{
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		}

		

		$this->db->limit($config['per_page'] , $page);
		$this->db->select('u.*, r.role as role');
		$this->db->from('users u');
		$this->db->join('roles r', 'u.role_id = r.id');
		
		if(($order_field == 'username')||($order_field == 'email')||($order_field == 'role')){
			$this->db->order_by('lower('.$order_field.')', 'asc');
		}else{
			$this->db->order_by('lower(username)');
		}
		$data['usuarios'] = $this->db->get()->result();
		if ($data['role'] == "sysadmin") {
			$this->layout->view('usuarios',$data); 
		}
		else 
			redirect('admin/fichas');
	}


	public function get_contactos(){
		$rows = $this->db->get('contacts');
		$array = array();
		foreach ($rows->result() as $row) {
			$array[] = $row;
		}
		echo json_encode($array);
	}

	

	public function borrar_usuario($id){
		
		$this->db->delete('users',array('id'=>$id));
		$this->session->set_flashdata('message', 'Usuario borrado correctamente.');
		redirect('admin/usuarios');
	}	


	public function puestos($order_field = false){
		$this->db->from('puestos');

		$puestos = $this->db->get();
		$rowcount = $puestos->num_rows();

		if(($order_field == 'name')||($order_field == 'code')){
			$config['base_url'] = base_url().'admin/puestos/'.$order_field;
			$config["uri_segment"] = 4;
		} else {
			$config['base_url'] = base_url().'admin/puestos';
			$config["uri_segment"] = 3;
		}

		
		$config['total_rows'] = $rowcount;
		$config['per_page'] = 15;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
		
		

		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'puestos';
		
		if(($order_field == 'name')||($order_field == 'code')){
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		} else {
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		}

		$this->pagination->initialize($config);

		$this->db->limit($config['per_page'] , $page);
		if(($order_field == 'name')||($order_field == 'code')){
			$this->db->order_by('lower('.$order_field.')', 'asc');
		} else{
			$this->db->order_by('name', 'asc');
		}
		$data['puestos'] = $this->db->get('puestos')->result();
		$this->layout->view('puestos',$data);
	}

	
	public function agregar_puesto(){

		if($_POST){
			
			$insert['name'] = $_POST['nombre'];
			$insert['code'] = $_POST['codigo'];
			
			$this->db->order_by('lower(name)');
			$this->db->insert('puestos', $insert);
			$this->session->set_flashdata('message', 'Puesto agregado correctamente.');
			redirect('admin/puestos');
		}

		
		$data['active_tab'] = 'puestos';
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();

		if ($data['role'] == "user")
			redirect('admin/puestos');
		else if (($data['role'] == "sysadmin") || ($data['role'] == "admin"))
			$this->layout->view('agregar_puesto', $data, $return=false);
	}

	
	public function editar_puesto($id){

		if($_POST){
			$update['name'] = $_POST['nombre'];
			$update['code'] = $_POST['codigo'];


			$this->db->where('id',$id);
			$this->db->update('puestos',$update);
			$this->session->set_flashdata('message', 'Puesto editado correctamente.');
			redirect('admin/puestos');
		
		}
		$data['active_tab'] = 'puestos';

		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();

		$data['puesto'] = $this->db->get_where('puestos',array('id'=>$id))->row();

		if ($data['role'] == "user")
			redirect('admin/puestos');
		else if (($data['role'] == "sysadmin") || ($data['role'] == "admin"))
			$this->layout->view('editar_puesto', $data);
	}

	public function borrar_puesto($id){
		
		$this->db->delete('puestos',array('id'=>$id));
		$this->session->set_flashdata('message', 'Puesto borrado correctamente.');
		redirect('admin/puestos');
	}	
	
	public function fichas($order_field = false){

		$this->db->from('fichas');

		$fichas = $this->db->get();
		$rowcount = $fichas->num_rows();



		if(($order_field == 'lastname')||($order_field == 'firstname')||($order_field == 'telefono')||($order_field == 'interno')||($order_field == 'celular')||($order_field == 'sede')||($order_field == 'f.puesto')||($order_field == 'email')){
			$config['base_url'] = base_url().'admin/fichas/'.$order_field;
			$config["uri_segment"] = 4;
		}else{
			$config['base_url'] = base_url().'admin/fichas';
			$config["uri_segment"] = 3;
		}

		


		$config['total_rows'] = $rowcount;
		$config['per_page'] = 15;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
		
		

		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'fichas';

		if(($order_field == 'lastname')||($order_field == 'firstname')||($order_field == 'telefono')||($order_field == 'interno')||($order_field == 'celular')||($order_field == 'sede')||($order_field == 'f.puesto')||($order_field == 'email')){
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		}else{
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		}

		$this->pagination->initialize($config);

		$this->db->limit($config['per_page'] , $page);
		$this->db->select('f.*, s.nombre as sede, p.name as puesto');
		$this->db->from('fichas f');
		$this->db->join('sedes s', 'f.sede_id = s.id');
		$this->db->join('puestos p', 'f.puesto = p.id');
		if(($order_field == 'lastname')||($order_field == 'firstname')||($order_field == 'telefono')||($order_field == 'interno')||($order_field == 'celular')||($order_field == 'sede')||($order_field == 'f.puesto')||($order_field == 'email')){
			$this->db->order_by('lower('.$order_field.')', 'asc');
		}else{
			$this->db->order_by('lastname', 'asc');
		}
		$data['fichas'] = $this->db->get()->result();
		$data['puestos'] = $this->db->get('puestos')->result();
		$this->layout->view('fichas',$data); 

	}

	public function agregar_ficha(){

		if($_POST){
			
			$insert['firstname'] = $_POST['nombre'];
			$insert['lastname'] = $_POST['apellido'];
			$insert['telefono'] = $_POST['telefono'];
			$insert['sede_id'] = $_POST['sede_id'];
			$insert['interno'] = $_POST['interno'];
			$insert['celular'] = $_POST['celular'];
			$insert['email'] = $_POST['email'];
			$insert['puesto'] = $_POST['puesto'];
			$this->db->insert('fichas', $insert);
			$this->session->set_flashdata('message', 'Ficha agregada correctamente.');
			redirect('admin/fichas');
		}

		
		$data['active_tab'] = 'fichas';
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['sedes'] = $this->db->get('sedes')->result();
		$data['puestos'] = $this->db->get('puestos')->result();

		if ($data['role'] == "user")
			redirect('admin/fichas');
		else if (($data['role'] == "sysadmin") || ($data['role'] == "admin"))
			$this->layout->view('agregar_ficha', $data, $return=false);
	}

	public function editar_ficha($id){

		if($_POST){
			$update['firstname'] = $_POST['nombre'];
			$update['lastname'] = $_POST['apellido'];
			$update['telefono'] = $_POST['telefono'];
			$update['sede_id'] = $_POST['sede_id'];
			$update['interno'] = $_POST['interno'];
			$update['celular'] = $_POST['celular'];
			$update['email'] = $_POST['email'];
			$update['puesto'] = $_POST['puesto'];
			$this->db->where('id',$id);
			$this->db->update('fichas', $update);
			$this->session->set_flashdata('message', 'Ficha editada correctamente.');
			redirect('admin/fichas');
		
		}

		$data['active_tab'] = 'fichas';

		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['sedes'] = $this->db->get('sedes')->result();
		$data['puestos'] = $this->db->get('puestos')->result();

		$data['ficha'] = $this->db->get_where('fichas',array('id'=>$id))->row();

		if ($data['role'] == "user")
			redirect('admin/usuarios');
		else if (($data['role'] == "sysadmin") || ($data['role'] == "admin"))
			$this->layout->view('editar_ficha', $data);
	}

	public function borrar_ficha($id){
		
		$this->db->delete('fichas',array('id'=>$id));
		$this->session->set_flashdata('message', 'Ficha borrada correctamente.');
		redirect('admin/fichas');
	}	
}