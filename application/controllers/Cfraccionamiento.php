<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cfraccionamiento extends CI_Controller {

	public function view($page="home", $param1="", $param2="",$param3="")
	{
		
		if ( ! file_exists(APPPATH.'/views/fraccionamiento/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
     switch ($page) {
			
			case 'verBiberonesPorTipo':
				$data['biberonesPorTipo'] =$this->fraccionamiento_model->getBiberonesTipoLeche($param1);
				//var_dump($data['biberonesPorTipo'] );
				$data['tipoLeche'] = $param1;
				break;
			case 'verPmedicasPorTipo':
				$data['pmedicasPorTipo']= $this->fraccionamiento_model->getPmedicasPorTipo($param1);
				$data['tipoLeche'] = $param1;
				break;
			case 'verTodosLosFraccionamientos':
				$data['fraccionamientos'] = $this->fraccionamiento_model->getAllFraccionamientos();
				break;
			case 'registrarConsumoBr':
				$data["bebereceptor"] = $this->bebereceptor_model->getAllBebereceptor();
				break;
			case 'verFraccionesUnBr':
				$data["unFraccionamiento"]=$this->fraccionamiento_model->getFraccionamientosUnBr($param);
				$data["unReceptor"] = $this->bebereceptor_model->getBebereceptor($param);
				break;
			//la idea de ver un fraccionamiento es ver nombre por lo menos del bebe que tomó
			case 'verUnFraccionamiento':
				$data["unFraccionamiento"]=$this->fraccionamiento_model->getUnFraccionamiento($param);
				$data["unReceptor"] = $this->bebereceptor_model->getBebereceptor($param);
				break;
			default:
				# code...
			break;
		}
		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/cabecera', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('fraccionamiento/'.$page, $data);
		$this->load->view('templates/pie', $data);
	}
	public function registrarFrac_sel()
	/* Funcion que capta el valor elegido del tipo de leche a buscar
	para obtener biberones y realiza la busqueda  */
	{
		$tipoLeche = $this->input->post('tipoLeche');
		redirect('Cfraccionamiento/view/verPmedicasPorTipo/'.$tipoLeche,'refresh');
	}

	public function fraccionarBiberon($idBiberon)
	/*  */	
	{
		
	}
	public function agregarPmedicas()
	{ 
		$volTotal= 0;
		$tipoLeche = $this->input->post('tipoLeche');
		
			foreach ($this->input->post("consSel") as $value) {
				$pMedica = $this->pmedica_model->getUnaPmedica("$value");
				if ($pMedica) {
					/*Suma el volumen total entre las prescripcioes seleccionadas */
					$volTotal = $volTotal + $pMedica[0]->cant_tomas * $pMedica[0]->volumen;
					//var_dump($volTotal);
				} else {
					# code...
				}
			} //end foreach

			/*Busca los biberones que coincidan con el tipo de leche de la prescripciones 
			seleccionadas */
			$biberones = $this->fraccionamiento_model->getBiberonesTipoLeche("$tipoLeche");
			
			/*Volumen fraccionado, sera utilizado para controlar que se cumplan todas
			las fracciones de prescripciones medicas */
			$volFraccionado = 0;
			
			//numero de orden en el arreglo de biberones
			$orden = 0;

			//cantidad de tomas en cada prescripcion
			$cant_tomas = 0;

			//volumen por tomas en cada prescripcion
			$volTomas = 0;

			//con esta forma se toma el formato de fecha
			$datestring = "%Y-%m-%d";
			//la funcion mdate con un solo parametro da la fecha actual
			$now        = mdate($datestring);

			/*Por cada prescripcion medica se hara el fraccionamiento correspondiente */
			foreach ($this->input->post("consSel") as $value) {
				$pMedica = $this->pmedica_model->getUnaPmedica("$value");
				$estadoPmedica = $pMedica[0]->estadoPresMedica;
				if (($volTotal == $volFraccionado) 
					&& ($estadoPmedica =='Fraccionado')) {
				//se cumplio las demandas de las prescripciones medicas
				} else {
					//Se elige un biberon y se fracciona.
					$unBiberon = $this->biberon_model->getUnBiberon($biberones[$orden]->idBiberon);
					/* Obtener un biberon que no este fraccionado 
					mediante una consulta en la base de datos*/

					// pasar al siguiente biberon disponible
					$orden = $orden +1;
					
					//var_dump($unBiberon);
					$cant_tomas = $pMedica[0]->cant_tomas;
					$volTomas = $pMedica[0]->volumen;
					$volBiberon = $unBiberon->volumenDeLeche;
					//por cada toma se crea una fraccion
					for ($i=0; $i <= $cant_tomas; $i++) { 
						$unFraccionamiento = array(
							'fechaFraccionamiento' =>$now , 
							'volumen' =>$volTomas ,
							'PrescripcionMedica_idPrescripcionMedica' =>$pMedica[0]->idPrescripcionMedica ,
							'PrescripcionMedica_fechaPrescripcion' =>$pMedica[0]->fechaPrescripcion ,
							'BebeReceptor_idBebeReceptor' =>$pMedica[0]->BebeReceptor_idBebeReceptor ,
							'Biberon_idBiberon' =>$unBiberon[0]->idBiberon 
							);
						//vaciar biberon
						$volBiberon = $volBiberon - $volTomas; 
						$idFraccionamiento = $this->fraccionamiento_model->insertFraccionamiento($unFraccionamiento);

					}
					//cambiar estado de biberon a fraccionado --> falta

					//indicar que la prescripcion medica ya fue fraccionada
					$unaPmedica = array('estadoPresMedica' => 'Fraccionado', );
					$idPmedica = $value;
					$this->pmedica_model->updatePmedica($unaPmedica, $idPmedica);
				}
			} //end foreach
						$data['title'] = ucfirst("home");
						redirect('cfraccionamiento/view/verTodosLosFraccionamientos/','refresh');	

			
	}

}

/* End of file Cfraccionamiento.php */
/* Location: ./application/controllers/Cfraccionamiento.php */
