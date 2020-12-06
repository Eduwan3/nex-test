<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TareasModel extends CI_Model{

	function __construct() {
	    parent::__construct();
	    $autoload['libraries'] = array('database');
	  }

	function get_tareas(){
		$query  = $this->db->select('*')
                   ->from('tareas')
                   ->order_by('orden','ASC')
                   ->get();

        if($query->num_rows()>0){

	        foreach ($query->result() as $key => $row)
			{
		        $tareas[$key]['id']=$row->id;
		        $tareas[$key]['nombre']=$row->nombre;
		        $tareas[$key]['orden']=$row->orden;
			}
			return $tareas;
	      }
	}

	function save(){
		$data = array(				
				'nombre' 			=> $this->input->post('nombre'), 
				'orden' 			=> $this->input->post('orden'), 
			);
		$result=$this->db->insert('tareas', $data);
		return $result;
	}

	function delete(){
		$id=$this->input->post('id');
		$this->db->where('id', $id);
		$result=$this->db->delete('tareas');
		return $result;
	}

	function subir_elemento(){
		$id=$this->input->post('id');
		$query  = $this->db->select('*')
                   ->from('tareas')
                   ->where('id', $id)
                   ->get();
        foreach ($query->result() as $key => $row)
			{
		        $tarea_seleccionada['id']=$row->id;
		        $tarea_seleccionada['nombre']=$row->nombre;
		        $tarea_seleccionada['orden']=$row->orden;
			}
		$query2  = $this->db->select('*')
                   ->from('tareas')
                   ->where('orden <=', $tarea_seleccionada['orden'])
                   ->where('id !=', $id)
                   ->order_by('orden', 'DESC')
                   ->limit(1)
                   ->get();

        if($query2->num_rows()==0){
			// var_dump($query2->result()); die();
        	return 0;
        }else{
			 foreach ($query2->result() as $key => $row)
			{
		        $tarea_desplazada['id']=$row->id;
		        $tarea_desplazada['nombre']=$row->nombre;
		        if ($tarea_seleccionada['orden'] == $row->orden){
		        	$tarea_desplazada['orden'] = $tarea_seleccionada['orden'] + 1;
		        }else{
		        	$tarea_desplazada['orden'] = $row->orden;
		        }
			}
			$this->db->set('orden', $tarea_desplazada['orden']);
			$this->db->where('id', $id);
			$result=$this->db->update('tareas');
			$this->db->set('orden', $tarea_seleccionada['orden']);
			$this->db->where('id', $tarea_desplazada['id']);
			$result=$this->db->update('tareas');

			return $id;
        }

	}	

	function bajar_elemento(){
		$id=$this->input->post('id');
		$query  = $this->db->select('*')
                   ->from('tareas')
                   ->where('id', $id)
                   ->get();
        foreach ($query->result() as $key => $row)
			{
		        $tarea_seleccionada['id']=$row->id;
		        $tarea_seleccionada['nombre']=$row->nombre;
		        $tarea_seleccionada['orden']=$row->orden;
			}
		$query2  = $this->db->select('*')
                   ->from('tareas')
                   ->where('orden >=', $tarea_seleccionada['orden'])
                   ->where('id !=', $id)
                   ->order_by('orden', 'ASC')
                   ->limit(1)
                   ->get();

        if($query2->num_rows()==0){
			// var_dump($query2->result()); die();
        	return 0;
        }else{
			 foreach ($query2->result() as $key => $row)
			{
		        $tarea_desplazada['id']=$row->id;
		        $tarea_desplazada['nombre']=$row->nombre;
		        if ($tarea_seleccionada['orden'] == $row->orden){
		        	$tarea_desplazada['orden'] = $tarea_seleccionada['orden'] - 1;
		        }else{
		        	$tarea_desplazada['orden'] = $row->orden;
		        }
		        
			}
			$this->db->set('orden', $tarea_desplazada['orden']);
			$this->db->where('id', $id);
			$result=$this->db->update('tareas');
			$this->db->set('orden', $tarea_seleccionada['orden']);
			$this->db->where('id', $tarea_desplazada['id']);
			$result=$this->db->update('tareas');
			
			return $id;
        }

	}	

}