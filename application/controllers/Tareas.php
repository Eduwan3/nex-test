<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tareas extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('TareasModel');
		$this->load->helper('form');
		$this->load->helper('url');

	}
	function index(){

		$data['tareas']=$this->TareasModel->get_tareas();
		// var_dump($data);

		$this->load->view('templates/cabecera');
		$this->load->view('nex_test', $data);
		$this->load->view('templates/scripts');
	}
	function show(){
		$data['tareas']=$this->TareasModel->get_tareas();
		echo json_encode($data['tareas']);
	}

	

	function save(){
		// die('hola');
		$data=$this->TareasModel->save();
		echo json_encode($data);
	}
	function update(){
		$data=$this->TareasModel->update();
		echo json_encode($data);
	}
	function delete(){
		$data=$this->TareasModel->delete();
		echo json_encode($data);
	}

	function subir_elemento(){
		$data=$this->TareasModel->subir_elemento();
		echo json_encode($data);
	}

	function bajar_elemento(){
		$data=$this->TareasModel->bajar_elemento();
		echo json_encode($data);
	}
}
