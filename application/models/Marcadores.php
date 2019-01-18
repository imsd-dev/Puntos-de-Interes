<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Marcadores extends CI_model{


// Extraer marcadores segun categoria para el mapa
public function getBlog(){	

		$cat = $this->input->post('selectcate');
		//$cat = 1;
		if ($cat!=1) {
			$this->db->where('categoria', $cat);
		}
		$this->db->order_by('id','desc');		
		$query = $this->db->get('puntos');

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
// Extraer  datos marcadores para administracion
public function getall(){	

		$this->db->select('a.id as id, 
			a.nombre as nombre , 
			a.descripcion as descripcion, 
			a.latitud as latitud, 
			a.longitud as longitud, 
			a.img as img,
			b.categoria as categoria' );
		$this->db->join('categorias b', 'a.categoria = b.id', 'left');
		$this->db->order_by('id','asc');		
		$query = $this->db->get('puntos a');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
//Devolver categoria consultada para mantener seleccionado el select 
public function getBlogs(){	

		$cat = $this->input->post('selectcate');
		//$cat = 1;
		if ($cat!=1) {
		 $this->db->where('categoria', $cat);
		} 
		$this->db->order_by('id','desc');		
		$query = $this->db->get('puntos');
		

		if($query->num_rows() > 0){
			return $cat;
		}else{
			return false;
		}
	
	}
//Extraer datos de categorias para Select del mapa
public function getcat(){	 
		
		$this->db->order_by('id','asc');
		$query = $this->db->get('categorias');

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@********** CATEGORIAS **********@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// Verificar si existe categoria
public function getCateById(){	
	$cate = $this->input->post('txt_categoria');
	$this->db->where('categoria', $cate);
	$query = $this->db->get('categorias');
	if($query->num_rows() > 0){
		return true;
	}else{
		return false;
	}
}
//Agregar categoria
public function submitC(){	
	
	$field = array(
	'categoria'=>$this->input->post('txt_categoria')
	);
	$this->db->insert('categorias', $field);
	if($this->db->affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}
//Eliminar categoria
public function deleteC($cat){

		$this->db->where('id', $cat);
		
		if ( ! $this->db->delete('categorias')){

	        $error = $this->db->error();
	        return false;

		}else{
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
}		
//Extraer datos de categoria para editar
public function getCatId($id){	

	$this->db->where('id', $id);
	$query = $this->db->get('categorias');
	if($query->num_rows() > 0){
		return $query->row();
	}else{
		return false;
	}
}
//Editar categoria

public function updateC(){	
	$id = $this->input->post('txtid');
	$field = array(
	'categoria'=>$this->input->post('txt_categoria')
	);
	$this->db->where('id', $id);
	$this->db->update('categorias', $field);
	if($this->db->affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@********** PUNTOS **********@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// Verificar si existe punto
public function getPById(){	
	$lat  = $this->input->post('txt_latitud');
	$long = $this->input->post('txt_longitud');
	$this->db->where('latitud', $lat);
	$this->db->where('longitud', $long);
	$query = $this->db->get('puntos');
	if($query->num_rows() > 0){
		return true;
	}else{
		return false;
	}
}

//Agregar punto
public function submitP(){	
	
	$field = array(
	'nombre     '=>$this->input->post('txt_nombre'),
	'descripcion'=>$this->input->post('txt_descripcion'),
	'latitud    '=>$this->input->post('txt_latitud'),
	'longitud   '=>$this->input->post('txt_longitud'),
	'img        '=>$this->input->post('txt_imagen'),	
	'categoria  '=>$this->input->post('txt_categoria')
	);
	$this->db->insert('puntos', $field);
	if($this->db->affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}

//Eliminar punto
public function deleteP($id){
	$this->db->where('id', $id);
	$this->db->delete('puntos');
	if($this->db->affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}	

//Extraer datos de punto para editar
public function getPId($id){
		
		$this->db->where('id', $id);
		$query = $this->db->get('puntos');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

public function updateP(){	
	$id = $this->input->post('txtid');
	
	$field = array(
	'nombre     '=>$this->input->post('txt_nombre'),
	'descripcion'=>$this->input->post('txt_descripcion'),
	'latitud    '=>$this->input->post('txt_latitud'),
	'longitud   '=>$this->input->post('txt_longitud'),
	'img        '=>$this->input->post('txt_imagen'),	
	'categoria  '=>$this->input->post('txt_categoria')

	);
	$this->db->where('id', $id);
	$this->db->update('puntos', $field);
	if($this->db->affected_rows() > 0){
		return true;
	}else{
		return false;
	}
}


















}