<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bebeasociado_model extends CI_Model {

	public function insertNewBebeasociado($bebeasociado)
	{
		try {
			$this->db->insert('bebeasociado', $bebeasociado);
			return $this->db->insert_id();
		} catch (Exception $e) {
			return false;
		}
	}

	public function getAllBebeasociado()
	{
		try {

			return $this->db->get('bebeasociado', 0, 10)->result();

		} 	catch (Exception $e) {
			return false;
		}
	}

	public function deleteBebeasociado($idBebeAsociado)
	{
		try {
			
			$this->$this->db->where('idBebeAsociado', $idBebeAsociado);
			return $this->db->delete('bebeasociado');
		} catch (Exception $e) {
			
		}
	}

	public function updateBebeasociado($bebeasociado, $idBA)
	{
		try {
			$this->db->where('idBebeAsociado',  $idBA);
			return $this->db->update('bebeasociado', $bebeasociado);
		} catch (Exception $e) {
			return false;
		}
		
	}

	public function getBebeasociado($idBebeAsociado)
	{
		try {
			$this->db->where('idBebeAsociado', $idBebeAsociado);
			$query = $this->db->get('bebeasociado');
			
				return $query;
			
			
		} catch (Exception $e) {
			return FALSE;
		}
	}
	
	   public function getDatosBebeAsociado($unNumero){
	
   		   $this->db->select('nombreBebeAsociado,apellidoBebeAsociado,edadGestBebAsociado');
   		   $this->db->from('bebeasociado');
		   $this->db->where('Consentimiento_nroConsentimiento', $unNumero);
		   $consulta = $this->db->get();
		   $resultado = $consulta->row(2);
		   return $resultado;
			}

}

/* End of file Donantes_model.php */
/* Location: ./application/models/Donantes_model.php */