<?php
require_once("connection.php");

class Abr extends Conectar{

    public function getDataGeneral($condition){
        //LLAMAMOS A LA CONEXION QUE CORRESPONDA CUANDO ES SAINT: CONEXION2
        //CUANDO ES APPWEB ES CONEXION.
        $conectar= parent::conexion();
        parent::set_names();
    
        //QUERY
    
            $sql="SELECT p.CodProd, p.Descrip, pd.Descrip AS Marca, EsExento, ISNULL(p.Precio1, 0) AS Precio1, ISNULL(pp.Precio1_B, 0) AS Precio1_B, pp.ImagenC
                            FROM SAPROD AS P 
                        INNER JOIN SAEXIS AS E ON P.CodProd = E.CodProd 
                        INNER JOIN SAINSTA AS pd ON p.CodInst = pd.CodInst
                        INNER JOIN saprod_02 AS pp ON p.codprod = pp.codprod
                    WHERE (e.codubic = '01') AND (e.existen >=0 or e.ExUnidad >= 0) AND $condition";
    
        //PREPARACION DE LA CONSULTA PARA EJECUTARLA.
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }

}

