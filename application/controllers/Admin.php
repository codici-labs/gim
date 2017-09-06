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
		$this->layout->view('agregar_sede', $data, $return=false);
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
		$this->layout->view('editar_sede', $data);
	}

	public function borrar_sede($id){
		
		$this->db->delete('sedes',array('id'=>$id));
		redirect('admin/sedes');
	}	
	
	
	
	public function editar_usuario($id){

		if($_POST){
			$update['firstname'] = $_POST['nombre'];
			$update['lastname'] = $_POST['apellido'];
			$update['puesto'] = $_POST['puesto'];
			$update['telefono'] = $_POST['telefono'];
			$update['sede_id'] = $_POST['sede_id'];
			$update['interno'] = $_POST['interno'];
			$update['celular'] = $_POST['celular'];


			$this->db->where('id',$id);
			$this->db->update('users', $update);
			
			redirect('admin/usuarios');
		
		}

		$data['active_tab'] = 'usuarios';

		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['sedes'] = $this->db->get('sedes')->result();
		$data['puestos'] = $this->db->get('puestos')->result();

		$data['user'] = $this->db->get_where('users',array('id'=>$id))->row();
		$this->layout->view('editar_usuario', $data);
	}


	public function usuarios(){
		
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'usuarios';

		$this->db->select('u.*, s.nombre as sede, p.name as puesto');
		$this->db->from('users u');
		$this->db->join('sedes s', 'u.sede_id = s.id');
		$this->db->join('puestos p', 'u.puesto = p.id');
		$data['usuarios'] = $this->db->get()->result();

		$this->layout->view('usuarios',$data);

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
		$data['active_tab'] = 'sedes';
		
		
		$data['puestos'] = $this->db->get('puestos')->result();
	
		$this->layout->view('puestos',$data);
	}

	
	public function agregar_puesto(){

		if($_POST){
			
			$insert['name'] = $_POST['nombre'];
			$insert['code'] = $_POST['codigo'];
			
			
			$this->db->insert('puestos', $insert);
			redirect('admin/puestos');
		}

		
		$data['active_tab'] = 'puestos';
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_email();
		$data['role'] = $this->tank_auth->get_role();
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
		$this->layout->view('editar_puesto', $data);
	}

	public function borrar_puesto($id){
		
		$this->db->delete('puestos',array('id'=>$id));
		redirect('admin/puestos');
	}	
	
}