<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fraccionamiento_model extends CI_Model {

	/*Obtener biberones por tipo de leche pasada por parametro */
	 public function getBiberonesTipoLeche($tipoLeche)
	 {
	 	try {
	 		$this->db->where('tipoDeLeche', $tipoLeche);
	 		return $this->db->get('biberon')->result();
	 	} catch (Exception $e) {
	 		return FALSE;
	 	}
	 }
	 /*Obtener prescripciones medicas discriminadas
	  por tipo de leche pasada por parametro */
	 public function getPmedicasPorTipo($tipoLeche)
	 {
	 	try {
	 		$this->db->where('tipoDeLecheBanco', $tipoLeche);
	 		return $this->db->get('prescripcionmedica')->result();
	 	} catch (Exception $e) {
	 		return FALSE;
	 	}
	 }
	 public function getUnaPmedica($idPmedica)
	 /*Obtener una prescricion medica a partir de un id */		
	 {
	 	try {
	 		$this->db->where('idPrescripcionMedica', $idPmedica);
	 		return $this->db->get('prescripcionmedica')->result();
	 	} catch (Exception $e) {
	 		return FALSE;
	 	}
	 }
	public function insertFraccionamiento($fraccionamiento)
	{
		try {
			$this->db->insert('fraccionamiento', $fraccionamiento);
			return $this->db->insert_id();
		} catch (Exception $e) {
			return FALSE;
		}
	}
	public function getAllFraccionamientos()
	{
		try {
			return $this->db->get('fraccionamiento')->result();
		} catch (Exception $e) {
			return FALSE;
		}
	}
	//arregla el formato de las fechas
	public function arreglarFecha($fechaParametro){
		if (isset($fechaParametro)) {
			$fechaArray = explode('-', $fechaParametro);
                         $date = new DateTime();
                         $date->setDate($fechaArray[0], $fechaArray[1], $fechaArray[2]);
                         $fecha= $date->format('d/m/Y');
		} else {
			$fecha = '';
		}
		return $fecha;
	}


	

}

/* End of file Fraccionamiento_model.php */
/* Location: ./application/models/Fraccionamiento_model.php */