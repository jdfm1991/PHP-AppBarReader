<?php
# BASES DE DATOS
/* base de datos de SAINT **/
const SERVER_BD_1 = "localhost";
const NAME_BD_1 = "CONFIMANIA";
const USER_BD_1 = "sa";
const PASSWORD_BD_1 = "GconfiSql.2022..";
class Conectar {
	protected $dbh;
	protected function conexion() {
		try {
			$conectar = $this->dbh = new PDO("sqlsrv:Server=".SERVER_BD_1.";Database=".NAME_BD_1,USER_BD_1,PASSWORD_BD_1);
			return $conectar;
		} catch (Exception $e) {
			print "¡Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function set_names(){
		return $this->dbh->query("SET NAMES 'utf8'");
	}
}
?>