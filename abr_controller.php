<?php
session_name('N3wKt@10go');
session_start();

//LLAMAMOS A LA CONEXION BASE DE DATOS.
require_once("connection.php");

//LLAMAMOS AL MODELO DE ACTIVACIONCLIENTES
require_once("abr_model.php");

//INSTANCIAMOS EL MODELO
$abr = new Abr();

$barcode = (isset($_POST['barcode'])) ? $_POST['barcode'] : '';
$name = (isset($_POST['name'])) ? $_POST['name'] : '';

switch($_GET["op"]){
    
    case 'enlist':
        $condition = " p.CodProd = '$barcode'";
        $data = $abr->getDataGeneral($condition);


        foreach ($data as $row) {
            if ($row['EsExento'] != 0) {
                $monto = $row['Precio1'];
            }else {
                $monto = $row['Precio1']*1.16;
            }
            if ($row['ImagenC'] == NULL) {
                $image = 'confimania.png';
            } else {
                $image = '../appweb-CONFIMANIA/public/img/gallery/'.$row['ImagenC'];
            }
            
        echo '
                <img src="'.$image.'" class="card-img-top rounded mx-auto d-block" alt="..."  style="width: 350px;">
                <div class="col-12 text-center">
                    <h1><strong><label class="form-label">'.$row['Descrip'].'</label></strong></h1>
                    <h3><strong><label class="form-label">'.$row['Marca'].'</label></strong></h3>
                    <h4><strong><label class="form-label">'.$row['CodProd'].'</label></strong></h4>
                </div>
                <div class="col-6">
                    <div class="col text-center">
                        <h2><strong><label class="form-label">Precio En Bolivares</label></strong></h2>
                    </div>
                    <span class="input-group-text fs-1 justify-content-center">'.number_format($monto,2).'</span>
                </div>
                <div class="col-6">
                    <div class="col text-center">
                        <h2><strong><label class="form-label">Precio En Dolares</label></strong></h2>
                    </div>
                    <span class="input-group-text fs-1 justify-content-center">'.number_format($row['Precio1_B'],2).'</span>
                </div>
                ';

        }

        //echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;
        
    case 'barcode':
        $condition = " p.Descrip LIKE '%$name%'";

        $data = $abr->getDataGeneral($condition);
        $i = 1;
        foreach ($data as $row) {
       
        echo '
            <div class="col-6 text-center">
                <buttom id="generate'.$i.'" class="btn btn-primary text-center" role="button" style="margin-bottom: 20px;">
                    <input type="hidden" id="refer'.$i.'" value="'.$row['CodProd'].'">
                    <label for=""><strong>'.$row['CodProd'].'</strong></label><br>
                    <span for=""><strong>'.$row['Descrip'].'</strong></span>
                </buttom>
            </div>
            <br>
            ';
        $i++;
        }
        
        


       

        //echo json_encode($dato, JSON_UNESCAPED_UNICODE); 
        break;

}





