<?php

namespace App\Http\Controllers;

use App\Models\putsendmaite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\maite;
use App\Models\detailmaite;
use App\Models\registercompany;

class PutsendmaiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, putsendmaite $putsendmaite)
    {

         $data = $request->json()->all();
         //var_dump($data);exit();

         $prefix = $data['prefix'];
         $number = $data['number'];

        
        $putsendmaite = putsendmaite::join('factura_companies', 'factura_orden.user_id', '=', 'factura_companies.user_id')
                    ->join('factura_clientes', 'factura_orden.order_receiver_nit', '=', DB::raw("CONCAT(factura_clientes.identification_number, '-', factura_clientes.dv)"))
                    ->where('factura_orden.order_prefix', $prefix )
                    ->where('factura_orden.order_id', $number)
                    ->orderBy('factura_orden.id')
                    ->select('order_id',
                             DB::raw('DATE(order_date) as fecha'),
                             DB::raw('TIME(order_date) as hora'),
                             'order_resolution',
                             'order_prefix',
                             'razon',
                             'factura_companies.address',
                             'factura_companies.phone',
                             'municipality_id',
                             DB::raw("CONCAT(order_prefix, '', order_id) as atacheddocument_name_prefix"),
                             'factura_companies.email',
                             'encabezado_fact',
                             'pie_fact',
                             'factura_companies.identification_number',
                             'factura_companies.dv',
                             'razon',
                             'factura_companies.phone',
                             'factura_companies.address',
                             'factura_companies.email',
                             'merchant_registration',
                             'type_document_identification_id',
                             'type_organization_id',
                             'type_liability_id',
                             'municipality_id',
                             'type_regime_id',
                             DB::raw('DATE(order_date) as fecha_fact'),
                             'order_total_after_tax',
                             'order_total_tax',
                             'order_tax_per',
                             'order_total_before_tax',
                             'order_receiver_nit',
                             'order_receiver_name',
                             'order_receiver_address',
                             'factura_clientes.phone AS phonecustomer',
                             'factura_clientes.email AS emailcustomer',
                             'payment_forms',
                             'payment_methods',
                             'note',
                             'plazoPago')
                    ->get();

                    $order_total_tax=0;
                    foreach ($putsendmaite as $maite) {
                        $order_total_tax=($maite->order_total_tax);
                    }

                    if($order_total_tax <> 0){

                        //CON IVA
                        foreach ($putsendmaite as $maite) {

                            /*
                            $detalleFactura = putsendmaite::table('factura_orden_producto')
                            ->where('order_prefix', $prefix )
                            ->where('order_id', $number)
                            ->get();
                            */
                            $detalleFacturas = detailmaite::where('order_prefix', $prefix )
                                                            ->where('order_id', $number)
                            ->get();

                            
                            foreach ($detalleFacturas as $detalleFactura) {

                                if ($detalleFactura->order_item_iva > 0){
                                    $tax_id = 1;
                                    $tax_totals = [array(
                                        "tax_id"=> $tax_id,
                                        "tax_amount"=> (($detalleFactura->order_item_price-$detalleFactura->order_item_desc)*$detalleFactura->order_item_quantity)*($detalleFactura->order_item_iva/100),
                                        "taxable_amount"=> ($detalleFactura->order_item_price-$detalleFactura->order_item_desc)*$detalleFactura->order_item_quantity,
                                        "percent"=> $detalleFactura->order_item_iva         
                                    )];
                                }else{
                                    $tax_id = 10;
                                    $tax_totals = array();
                                }

                                $descuento = [array(
                                                    "discount_id"=> 1,
                                                    "charge_indicator"=> false,
                                                    "allowance_charge_reason"=> "DESCUENTO GENERAL",
                                                    "amount"=> ($detalleFactura->order_item_desc*$detalleFactura->order_item_quantity),
                                                    "base_amount"=> ($detalleFactura->order_item_price-$detalleFactura->order_item_desc)*$detalleFactura->order_item_quantity
                                            )];


                                $detalle[] =array(
                                "unit_measure_id"=> 70,
                                "invoiced_quantity"=> $detalleFactura->order_item_quantity,
                                "line_extension_amount"=> ($detalleFactura->order_item_price-$detalleFactura->order_item_desc)*$detalleFactura->order_item_quantity,
                                "free_of_charge_indicator"=> false,
                                "allowance_charges"=>$descuento,
                                "tax_totals" => $tax_totals,
                                "description"=> $detalleFactura->item_name,
                                "notes"=> $detalleFactura->item_name,
                                "code"=> $detalleFactura->item_code,
                                "type_item_identification_id"=> 4,
                                "price_amount"=> ($detalleFactura->order_item_price-$detalleFactura->order_item_desc)+(($detalleFactura->order_item_price-$detalleFactura->order_item_desc)*($detalleFactura->order_item_iva/100)),
                                "base_quantity"=>  1
                                );
                            }


                            $cad = explode("-", $maite->order_receiver_nit);
                            $order_receiver_nit = $cad[0];
                            $order_receiver_nit_dv = $cad[1];

                            $cad = explode("--", $maite->order_receiver_name );
                            $order_receiver_name = $cad[1];

                           $payload= array('number' =>  $maite->order_id,
                                           'type_document_id' => 1,
                                           'date'=> $maite->fecha,
                                           'time' => $maite->hora,
                                           'resolution_number'=> $maite->order_resolution,
                                           'prefix'=> $maite->order_prefix,
                                           'notes'=> $maite->note,
                                           'disable_confirmation_text'=>true,
                                           'establishment_name'=> $maite->razon,
                                           'establishment_address'=> $maite->address,
                                           'establishment_phone'=> $maite->phone,
                                           'establishment_municipality'=> $maite->municipality_id,
                                           'atacheddocument_name_prefix'=> $maite->atacheddocument_name_prefix,
                                           'establishment_email'=> $maite->email,
                                           'sendmail'=> false,
                                           'sendmailtome'=> false,
                                           'seze'=> "2021-2017",
                                           'head_note'=> $maite->encabezado_fact,
                                           'foot_note'=> $maite->pie_fact,
                                           "customer"=> array(
                                                "identification_number"=> $order_receiver_nit,
                                                "dv"=> $order_receiver_nit_dv,
                                                "name"=> $order_receiver_name,
                                                "phone"=> $maite->phonecustomer,
                                                "address"=> $maite->order_receiver_address,
                                                "email"=> $maite->emailcustomer,
                                                "merchant_registration"=> $maite->merchant_registration,
                                                "type_document_identification_id"=> $maite->type_document_identification_id,
                                                "type_organization_id"=>  $maite->type_organization_id, //1,
                                                "type_liability_id"=> $maite->type_liability_id, //117,
                                                "municipality_id"=> $maite->municipality_id, //149, //
                                                "type_regime_id"=> $maite->type_regime_id //1,
                                            ),
                                            "payment_form"=> array(
                                                "payment_form_id"=> $maite->payment_forms,
                                                "payment_method_id"=> $maite->payment_methods,
                                                "payment_due_date"=> $maite->fecha_fact,
                                                "duration_measure"=> $maite->plazoPago
                                            ),
                                            //"allowance_charges"=> $descuento,
                                            "legal_monetary_totals"=> array(
                                                "line_extension_amount"=> $maite->order_total_before_tax,
                                                "tax_exclusive_amount"=> $maite->order_total_before_tax,
                                                "tax_inclusive_amount"=> $maite->order_total_after_tax,
                                                "payable_amount"=> $maite->order_total_after_tax
                                            ),
                                            "tax_totals"=>[array( 
                                                    "tax_id"=> "1",
                                                    "tax_amount"=> $maite->order_total_tax,
                                                    "percent"=> $maite->order_tax_per,
                                                    "taxable_amount"=> $maite->order_total_before_tax
                                            )],
                                            "invoice_lines"=>$detalle
                                       );
                        }
                    }else{

                        //SIN IVA
                        foreach ($putsendmaite as $maite) {

                            /*
                            $detalleFactura = putsendmaite::table('factura_orden_producto')
                            ->where('order_prefix', $prefix )
                            ->where('order_id', $number)
                            ->get();
                            */
                            $detalleFacturas = detailmaite::where('order_prefix', $prefix )
                                                            ->where('order_id', $number)
                            ->get();

                            foreach ($detalleFacturas as $detalleFactura) {

                                if ($detalleFactura->order_item_iva > 0){
                                    $tax_id = 1;
                                    $tax_totals = [array(
                                        "tax_id"=> $tax_id,
                                        "tax_amount"=> ($detalleFactura->order_item_price*$detalleFactura->order_item_quantity)*($detalleFactura->order_item_iva/100),
                                        "taxable_amount"=> $detalleFactura->order_item_price*$detalleFactura->order_item_quantity,
                                        "percent"=> $detalleFactura->order_item_iva         
                                    )];
                                }else{
                                    $tax_id = 10;
                                    $tax_totals = array();
                                }

                                $descuento[] = array(
                                                    "discount_id"=> 1,
                                                    "charge_indicator"=> false,
                                                    "allowance_charge_reason"=> "DESCUENTO GENERAL",
                                                    "amount"=> $detalleFactura->order_item_desc,
                                                    "base_amount"=> $detalleFactura->order_item_price-$detalleFactura->order_item_desc
                                            );


                                $detalle[] =array(
                                "unit_measure_id"=> 70,
                                "invoiced_quantity"=> $detalleFactura->order_item_quantity,
                                "line_extension_amount"=> ($detalleFactura->order_item_price-$detalleFactura->order_item_desc)*$detalleFactura->order_item_quantity,
                                "free_of_charge_indicator"=> false,
                                "allowance_charges"=>$descuento,
                                //"tax_totals" => $tax_totals,
                                "description"=> $detalleFactura->item_name,
                                "notes"=> $detalleFactura->item_name,
                                "code"=> $detalleFactura->item_code,
                                "type_item_identification_id"=> 4,
                                "price_amount"=> ($detalleFactura->order_item_price-$detalleFactura->order_item_desc)+(($detalleFactura->order_item_price-$detalleFactura->order_item_desc)*($detalleFactura->order_item_iva/100)),
                                "base_quantity"=>  1
                                );
                            }


                            $cad = explode("-", $maite->order_receiver_nit);
                            $order_receiver_nit = $cad[0];
                            $order_receiver_nit_dv = $cad[1];

                            $cad = explode("--", $maite->order_receiver_name );
                            $order_receiver_name = $cad[1];

                           $payload= array('number' =>  $maite->order_id,
                                           'type_document_id' => 1,
                                           'date'=> $maite->fecha,
                                           'time' => $maite->hora,
                                           'resolution_number'=> $maite->order_resolution,
                                           'prefix'=> $maite->order_prefix,
                                           'notes'=> $maite->note,
                                           'disable_confirmation_text'=>true,
                                           'establishment_name'=> $maite->razon,
                                           'establishment_address'=> $maite->address,
                                           'establishment_phone'=> $maite->phone,
                                           'establishment_municipality'=> $maite->municipality_id,
                                           'atacheddocument_name_prefix'=> $maite->atacheddocument_name_prefix,
                                           'establishment_email'=> $maite->email,
                                           'sendmail'=> false,
                                           'sendmailtome'=> false,
                                           'seze'=> "2021-2017",
                                           'head_note'=> $maite->encabezado_fact,
                                           'foot_note'=> $maite->pie_fact,
                                           "customer"=> array(
                                                "identification_number"=> $order_receiver_nit,
                                                "dv"=> $order_receiver_nit_dv,
                                                "name"=> $order_receiver_name,
                                                "phone"=> $maite->phonecustomer,
                                                "address"=> $maite->order_receiver_address,
                                                "email"=> $maite->emailcustomer,
                                                "merchant_registration"=> $maite->merchant_registration,
                                                "type_document_identification_id"=> $maite->type_document_identification_id,
                                                "type_organization_id"=>  $maite->type_organization_id, //1,
                                                "type_liability_id"=> $maite->type_liability_id, //117,
                                                "municipality_id"=> $maite->municipality_id, //149, //
                                                "type_regime_id"=> $maite->type_regime_id //1,
                                            ),
                                            "payment_form"=> array(
                                                "payment_form_id"=> $maite->payment_forms,
                                                "payment_method_id"=> $maite->payment_methods,
                                                "payment_due_date"=> $maite->fecha_fact,
                                                "duration_measure"=> $maite->plazoPago
                                            ),
                                            //"allowance_charges"=> $descuento,
                                            "legal_monetary_totals"=> array(
                                                "line_extension_amount"=> $maite->order_total_before_tax,
                                                "tax_exclusive_amount"=> 0,//$maite->order_total_before_tax,
                                                "tax_inclusive_amount"=> $maite->order_total_after_tax,
                                                "payable_amount"=> $maite->order_total_after_tax
                                            ),
                                            /*"tax_totals"=>[array( 
                                                    "tax_id"=> "1",
                                                    "tax_amount"=> $maite->order_total_tax,
                                                    "percent"=> $maite->order_tax_per,
                                                    "taxable_amount"=> $maite->order_total_before_tax
                                            )],*/
                                            "invoice_lines"=>$detalle
                                       );
                        }
                    }
                    

                    return $payload;
                    


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $data = $request->json()->all();

        $prefix = $data['prefix'];
        $number = $data['number'];
        $cufe = $data['cufe'];

        $tabla = putsendmaite::where('order_prefix', $prefix)
                   ->where('order_id', $number)
                   ->firstOrFail();

        $tabla->cufe = $cufe;
        $tabla->save();

        // Puedes retornar una respuesta o redireccionar a otra página
        return response()->json(['message' => 'Cufe Actualizado correctamente']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(putsendmaite $putsendmaite)
    {
        //
    }
}
