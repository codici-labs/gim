<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('layout');
		$this->layout->setFolder('admin');
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} 
	}

	public function index(){
		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'sedes';
		
		
		$data['sedes'] = $this->db->get('sedes')->result();
	
		$this->layout->view('sedes',$data);
	}

	public function sedes(){
		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'sedes';
		
		$this->db->order_by('lower(nombre)');
		$data['sedes'] = $this->db->get('sedes')->result();
	
		$this->layout->view('sedes',$data);
	}

	
	public function agregar_sede(){

		if($_POST){
			
			$insert['nombre'] = $_POST['nombre'];
			$insert['codigo'] = $_POST['codigo'];
			$insert['direccion'] = $_POST['direccion'];
			$insert['contacto'] = $_POST['contacto'];
			
			$this->db->insert('sedes', $insert);
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


			$this->db->where('id',$id);
			$this->db->update('sedes',$update);
			
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
		redirect('admin/sedes');
	}	
	
	
	
	public function editar_usuario($id){

		if($_POST){
			$update['username'] = $_POST['username'];
			$update['role_id'] = $_POST['role_id'];
			$update['email'] = $_POST['email'];


			$this->db->where('id',$id);
			$this->db->update('users', $update);
			
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


	public function usuarios(){
		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'usuarios';

		$this->db->select('u.*, r.role as role');
		$this->db->from('users u');
		$this->db->join('roles r', 'u.role_id = r.id');
		$this->db->order_by('lower(username)');
		$data['usuarios'] = $this->db->get()->result();
		if ($data['role'] == "sysadmin") {
			$this->layout->view('usuarios',$data); 
		}
		else 
			redirect('admin/sedes');
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
		redirect('admin/usuarios');
	}	


	public function puestos(){
		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'puestos';
		
		
		$data['puestos'] = $this->db->get('puestos')->result();
		$this->layout->view('puestos',$data);
	}

	
	public function agregar_puesto(){

		if($_POST){
			
			$insert['name'] = $_POST['nombre'];
			$insert['code'] = $_POST['codigo'];
			
			$this->db->order_by('lower(name)');
			$this->db->insert('puestos', $insert);
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
		redirect('admin/puestos');
	}	
	
	public function fichas(){
		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'fichas';

		$this->db->select('f.*, s.nombre as sede, p.name as puesto');
		$this->db->from('fichas f');
		$this->db->join('sedes s', 'f.sede_id = s.id');
		$this->db->join('puestos p', 'f.puesto = p.id');
		$this->db->order_by('lower(lastname), lower(firstname)');
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
		redirect('admin/fichas');
	}	
}