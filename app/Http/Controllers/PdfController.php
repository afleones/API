<?php

namespace App\Http\Controllers;

// use App\PDF\maitePDF;
use PDF;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Utils\DatabaseUtils;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\CryptDBController;


class PdfController extends Controller
{
    //
    public function numerotexto($numero)
    {
        $extras= array("/[\$]/","/ /","/,/","/-/"); 
        $limpio=preg_replace($extras,"",$numero); 
        $partes=explode(".",$limpio); 
        if (count($partes)>2) { 
            return "Error, el numero no es correcto"; 
            exit(); 
        } 
        
        $digitos_piezas=chunk_split ($partes[0],1,"#"); 
        $digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1); 
        $digitos=explode("#",$digitos_piezas); 
        $todos=count($digitos); 
        $grupos=ceil (count($digitos)/3); 
        
        // comenzamos a dar formato a cada grupo 
        
        $unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve'); 
        $decenas = array ('diez','once','doce', 'trece','catorce','quince'); 
        $decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa'); 
        $centena = array   ('ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos'); 
        $resto=$todos; 
        
        for ($i=1; $i<=$grupos; $i++) { 
            
            // Hacemos el grupo 
            if ($resto>=3) { 
                $corte=3; } else { 
                $corte=$resto; 
            } 
                $offset=(($i*3)-3)+$corte; 
                $offset=$offset*(-1); 
            
            // la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB 
            
            $num=implode("",array_slice ($digitos,$offset,$corte)); 
            $resultado[$i] = ""; 
            $cen = (int) ($num / 100);              //Cifra de las centenas 
            $doble = $num - ($cen*100);             //Cifras de las decenas y unidades 
            $dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas 
            $uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades 
            if ($cen > 0) { 
            if ($num == 100) $resultado[$i] = "cien"; 
            else $resultado[$i] = $centena[$cen-1].' '; 
            }//end if 
            if ($doble>0) { 
            if ($doble == 20) { 
                $resultado[$i] .= " veinte"; 
            }elseif (($doble < 16) and ($doble>9)) { 
                $resultado[$i] .= $decenas[$doble-10]; 
            }else { 
                $resultado[$i] .= ($dec >= 1) ? ' ' . $decena[$dec-1] : '';
            }//end if 
            if ($dec>2 and $uni<>0) $resultado[$i] .=' y '; 
            if (($uni>0) and ($doble>15) or ($dec==0)) { 
                if ($i==1 && $uni == 1) $resultado[$i].="uno"; 
                elseif ($i==2 && $num == 1) $resultado[$i].=""; 
                else $resultado[$i].=$unidad[$uni-1]; 
            } 
            } 

            // Le agregamos la terminacion del grupo 
            switch ($i) { 
                case 2: 
                $resultado[$i].= ($resultado[$i]=="") ? "" : " mil "; 
                break; 
                case 3: 
                $resultado[$i].= ($num==1) ? " millon " : " millones "; 
                break; 
            } 
            $resto-=$corte; 
        } 
        
        // Sacamos el resultado (primero invertimos el array) 
        $resultado_inv= array_reverse($resultado, TRUE); 
        $final=""; 
        foreach ($resultado_inv as $parte){ 
            $final.=$parte; 
        } 
        return 'SON: '.strtoupper(trim($final)). ' PESOS.'; 
    }

    public function kripiDB($DBNameX)
    {
        $dbname = Crypt::decryptString($DBNameX);
        $result = DB::connection('master')->table('accounts')
                ->whereRaw("CONCAT(dbprefix, LPAD(dbsufix, 6, '0')) = '".$dbname."'")
                ->first();
                
                if ($result) {
                    return $result->codename;
                }
            
                return null;
    }
    public function ReconnectDB($DBNameX)
    {
        $dbname = Crypt::decryptString($DBNameX);
        putenv("IVX_DATABASE={$dbname}");
        DB::purge('maite');
        $connectionConfig = Config::get("database.connections.maite");
        $connectionConfig['database'] = $dbname;
        Config::set("database.connections.maite", $connectionConfig);
        DB::reconnect('maite');
        // return $dbname;
    }
    public function quotexPdf($invoice)
    {
        $DBName = DB::connection('maite')->getDatabaseName();
        // $encryptedDBName = Crypt::encryptString($DBName);
        $encryptedDBName = DatabaseUtils::enkryptString();
        $this->quotePdf($encryptedDBName, $invoice);
    }
    public function quotePdf($dbname, $invoice)
    {
        // Conectamos a la BD donde esta el documento 
        $this->ReconnectDB($dbname);
        // Obtenemos los datos necesarios para generar el PDF
        // Datos de la compañía que factura
        $head_invoice = DB::connection('maite')->table('view_data_head_quote')->where('maite', $invoice)->first();
        $encryptedDBName = $this->kripiDB($dbname);
         $info_data = [
            'nit' => $head_invoice->nit,
            'mycomercialname' => $head_invoice->mycomercialname,
            'myname' => $head_invoice->myname,
            'myphone' => $head_invoice->myphone,
            'myaddress' => $head_invoice->myaddress,
            'order_date' => $head_invoice->order_date,
            'order_receiver_nit' => $head_invoice->order_receiver_nit,
            'order_receiver_name' => $head_invoice->order_receiver_name,
            'comercialname' => $head_invoice->comercialname,
            'order_receiver_address' => $head_invoice->order_receiver_address,
            'order_receiver_phone' => $head_invoice->order_receiver_phone,
            'order_resolution_info' => $head_invoice->order_resolution_info,
            'order_total_before_tax' => $head_invoice->order_total_before_tax,
            'order_total_tax' => $head_invoice->order_total_tax,
            'order_total_after_tax' => $head_invoice->order_total_after_tax,
            'note' => $head_invoice->note,
            'cufe' =>$head_invoice->cufe,
            'logo_company' => asset('images/'.$encryptedDBName.'/logo.jpg'),
            'invoice_number' => $head_invoice->maite,
            'numerotexto' => $this->numerotexto($head_invoice->order_total_after_tax),

         ];
         // Datos de la compañía que factura
        $det_invoice = DB::connection('maite')->table('view_data_detail_quote')->where('maite', $invoice)->get();
        
        $item_data = [];
        foreach ($det_invoice as $det) {
        $item_data[] = [
            'maite' => $det->maite,
            'order_item_id' => $det->order_item_id,
            'item_code' => $det->item_code,
            'item_name' => $det->item_name,
            'reference' => $det->reference,
            'descripcion' => '['.$det->descripcion.']',
            'order_item_quantity' => $det->order_item_quantity,
            'order_item_price' => $det->order_item_price,
            'order_item_iva' => $det->order_item_iva,
            'order_item_desc' => $det->order_item_desc,
            'order_item_final_amount' => $det->order_item_final_amount,
        ];
        }
        $pdf = PDF::loadView('maite.quote.template_1', ['info_data'=>$info_data, 'item_data'=>$item_data])->setPaper('letter', 'portrait');
        //return $pdf->download('maite.pdf');
        return $pdf->stream('maite.pdf');
    }
    public function maitePdf($invoice)
    {
        $DBName = DB::connection('maite')->getDatabaseName();
        // $encryptedDBName = Crypt::encryptString($DBName);
        $dbname = DatabaseUtils::enkryptString();
        //dd($dbname);
        $this->invoicePdf($dbname, $invoice);
    }

    public function invoicePdf($dbname, $invoice)
    {
        // Conectamos a la BD donde esta el documento 
        $this->ReconnectDB($dbname);
        // dd($dbname);
        // Obtenemos los datos necesarios para generar el PDF
        // Datos de la compañía que factura
        $head_invoice = DB::connection('maite')->table('view_data_head_invoice')->where('maite', $invoice)->first();
        $encryptedDBName = $this->kripiDB($dbname);
//        dd($encryptedDBName.'  .  '.$dbname);
        $CUFE = $head_invoice->cufe;
        $qrdir='';
        if ($CUFE!='0') {
            
			$qrtext='NumFac: '.$head_invoice->maite.PHP_EOL
					.'FecFac: '.date('Y-M-d', strtotime($head_invoice->order_date)).PHP_EOL
					.'HorFac: '.date('H:i:s', strtotime($head_invoice->order_date)).PHP_EOL
					.'NitFac: '.$head_invoice->nit.PHP_EOL
					.'DocAdq: '.$head_invoice->order_receiver_nit.PHP_EOL
					.'ValFac: '.$head_invoice->order_total_before_tax.PHP_EOL
					.'ValIva: '.$head_invoice->order_total_tax.PHP_EOL
					.'ValOtroIm: 0.00'.PHP_EOL
					.'ValTotal: '.$head_invoice->order_total_after_tax.PHP_EOL
					.'CUFE: '.$CUFE.PHP_EOL
					.'QRCode: https://catalogo-vpfe.dian.gov.co/document/ShowDocumentToPublic/'.$CUFE
					;
            $folderPath = public_path('images/'.$encryptedDBName.'/qr');
            if (!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }
			$qrdir=public_path('images/'.$encryptedDBName.'/qr/'.$CUFE.'.png');
            QrCode::size(300)->generate($qrtext, $qrdir);
			$qrdir=asset('images/'.$encryptedDBName.'/qr/'.$CUFE.'.png');
        }
         $info_data = [
            'nit' => $head_invoice->nit,
            'mycomercialname' => $head_invoice->mycomercialname,
            'myname' => $head_invoice->myname,
            'myphone' => $head_invoice->myphone,
            'myaddress' => $head_invoice->myaddress,
            'order_date' => $head_invoice->order_date,
            'order_receiver_nit' => $head_invoice->order_receiver_nit,
            'order_receiver_name' => $head_invoice->order_receiver_name,
            'comercialname' => $head_invoice->comercialname,
            'order_receiver_address' => $head_invoice->order_receiver_address,
            'order_receiver_phone' => $head_invoice->order_receiver_phone,
            'order_resolution_info' => $head_invoice->order_resolution_info,
            'order_total_desc' => $head_invoice->order_total_desc,
            'order_subtotal_before_tax' => $head_invoice->order_subtotal_before_tax,
            'order_total_before_tax' => $head_invoice->order_total_before_tax,
            'order_total_tax' => $head_invoice->order_total_tax,
            'order_total_after_tax' => $head_invoice->order_total_after_tax,
            'note' => $head_invoice->note,
            'cufe' =>$head_invoice->cufe,
            'logo_company' => asset('images/'.$encryptedDBName.'/logo.jpg'),
            'invoice_number' => $head_invoice->maite,
            'qrdir' => $qrdir,
            'numerotexto' => $this->numerotexto($head_invoice->order_total_after_tax),
         ];
         // Datos de la compañía que factura
        $det_invoice = DB::connection('maite')->table('view_data_detail_invoice')->where('maite', $invoice)->get();
        
        $item_data = [];
        foreach ($det_invoice as $det) {
        $item_data[] = [
            'maite' => $det->maite,
            'order_item_id' => $det->order_item_id,
            'item_code' => $det->item_code,
            'item_name' => $det->item_name,
            'reference' => $det->reference,
            'descripcion' => '['.$det->descripcion.']',
            'order_item_quantity' => $det->order_item_quantity,
            'order_item_price' => $det->order_item_price,
            'order_item_iva' => $det->order_item_iva,
            'order_item_desc' => $det->order_item_desc,
            'order_item_final_amount' => $det->order_item_final_amount,
        ];
        }
        $pdf = PDF::loadView('maite.invoice.template_1', ['info_data'=>$info_data, 'item_data'=>$item_data])->setPaper('letter', 'portrait');
        //return $pdf->download('maite.pdf');
        return $pdf->stream('maite.pdf');
    }

    
    public function calculateTotal($items)
    {
        // Lógica para calcular el total de los elementos
        $total = 0;
        foreach ($items as $item) {
            $total += $item->price;
        }
        return $total;
    }
}
