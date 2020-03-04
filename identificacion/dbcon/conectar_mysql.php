<?php
set_time_limit(500);
class ConectarMySQL{
	
	private $conexion; private $total_consultas;

	public function ConectarMySQL(){ 
		if(!isset($this->conexion)){
		  $this->conexion = (mysqli_connect("localhost","root",""))
			or die("Problemas con la conexion: ".mysqli_error($this->conexion));
		  mysqli_select_db($this->conexion,"identificacion") or die("Problemas con la BD: ".mysqli_error($this->conexion));
		}	
	}
	
	public function sentencia($sentencia){ 
		$this->total_consultas++; 
		$resultado = mysqli_query($this->conexion,$sentencia);
		if(!$resultado){ 
		  echo 'Error en la sentencia SQL: ' . mysqli_error($this->conexion);
		  exit;
		}
		return $resultado;
  }
  
   public function traer_matriz($registros){
   		$resultado=array();
		if($registros)
		while($fila=mysqli_fetch_row($registros))
		{
			array_push($resultado,$fila);
		}
		return $resultado;
  }
  
    public function num_filas($registros){
   		return mysqli_num_rows($registros);
  }
  
  public function cerrar_conexion(){
	  mysqli_close($this->conexion);
	  }
}
?> 