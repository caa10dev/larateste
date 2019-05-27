<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class CustomHelper
{
    public static function domainCustomer(){
        return  \Request::server('SERVER_NAME', 'UNKNOWN');
    }

    public static function ufs(){ 
        $estados = array(
            "AC" => "Acre",
            "AL" => "Alagoas",
            "AM" => "Amazonas",
            "AP" => "Amapá",
            "BA" => "Bahia",
            "CE" => "Ceará",
            "DF" => "Distrito Federal",
            "ES" => "Espírito Santo",
            "GO" => "Goiás",
            "MA" => "Maranhão",
            "MT" => "Mato Grosso",
            "MS" => "Mato Grosso do Sul",
            "MG" => "Minas Gerais",
            "PA" => "Pará",
            "PB" => "Paraíba",
            "PR" => "Paraná",
            "PE" => "Pernambuco",
            "PI" => "Piauí",
            "RJ" => "Rio de Janeiro",
            "RN" => "Rio Grande do Norte",
            "RO" => "Rondônia",
            "RS" => "Rio Grande do Sul",
            "RR" => "Roraima",
            "SC" => "Santa Catarina",
            "SE" => "Sergipe",
            "SP" => "São Paulo",
            "TO" => "Tocantins"
        );
        return $estados; 
    }

    public static function genero(){
       $genero = array(
            0=>'Feminino',
            1=>'Masculino'
        );
        return $genero; 
    }

    public static function options_select_number($quantidade, $initial=1, $selected=null, $default=null)
    {
        $selects = array();
        if($default != null){
            $selects['options'][0]= $default;
        }
        if($selected != null){
            $selects['selected']= $selected;
        }
        for($i=$initial; $i <= $quantidade; $i++){
            $selects['options'][$i] = $i;
        }
        return $selects;
    }

    // tratamento de Datas -------------------------------------------------
    public static function invertDateDB($date, $separador="/", $hours=null) {
        $dt = substr($date,0 , 10);
        $hours = substr($date, 11, 16);
        $horas = '';
        if($hours !=null || $hours !=''){
            $horas = ' '.$hours;
        }
        if (count(explode($separador,$dt)) > 1) {
            return implode("-",array_reverse(explode($separador,$dt))).$horas;
        }
    }

    public static function invertDateBR($date) {
        $date = substr($date,0 , 10);
        $dt = self::convertSeparator($date);
        return $dt;
    }

    public static function invertDateTimeBR($datetime,  $separador="/") {
        $date = substr($datetime,0 , 10);
        $hrs = substr($datetime,11 , 5);  
        return implode($separador,array_reverse(explode('-',$date))).' '.$hrs; 
    }

    public static function invertDateString($date, $hour=0, $year=0, $template=0) {       
        $hours = substr($date,11 , 16);
        $dt = substr($date,0 , 10);
        $data = self::convertSeparator($dt);
        if($template == 0 ){ }
        if($template == 1 ){ $resp = dateTemplate1($date, $hour, $yeah,ar); }
        if($template == 2 ){ }
        return $resp;
    }

    public static function monthsString($m) {
        switch ($m) {
            case "01":    $months = __('common.months.01');   break;
            case "02":    $months = __('common.months.02');   break;
            case "03":    $months = __('common.months.03');   break;
            case "04":    $months = __('common.months.04');   break;
            case "05":    $months = __('common.months.05');   break;
            case "06":    $months = __('common.months.06');   break;
            case "07":    $months = __('common.months.07');   break;
            case "08":    $months = __('common.months.08');   break;
            case "09":    $months = __('common.months.09');   break;
            case "10":    $months = __('common.months.10');   break;
            case "11":    $months = __('common.months.11');   break;
            case "12":    $months = __('common.months.12');   break; 
         }  
         return $months;        
    }

    public static function monthsAbbreviatedString($m) {
        switch ($m) {
            case "01":    $months = __('common.months.abbreviated.01');   break;
            case "02":    $months = __('common.months.abbreviated.02');   break;
            case "03":    $months = __('common.months.abbreviated.03');   break;
            case "04":    $months = __('common.months.abbreviated.04');   break;
            case "05":    $months = __('common.months.abbreviated.05');   break;
            case "06":    $months = __('common.months.abbreviated.06');   break;
            case "07":    $months = __('common.months.abbreviated.07');   break;
            case "08":    $months = __('common.months.abbreviated.08');   break;
            case "09":    $months = __('common.months.abbreviated.09');   break;
            case "10":    $months = __('common.months.abbreviated.10');   break;
            case "11":    $months = __('common.months.abbreviated.11');   break;
            case "12":    $months = __('common.months.abbreviated.12');   break; 
         }  
         return $months;        
    }

    public static function convertSeparator($date) {
        if (count(explode("/",$date)) > 1) {
            return implode("-",array_reverse(explode("/",$date)));
        } else if(count(explode("-",$date)) > 1) {
            return implode("/",array_reverse(explode("-",$date)));
        }
    }

    public static function getTimeStamps($data){
        $timestamp = strtotime($data);
        $resp = round($timestamp * 1000);
        return $resp;
    }

    /**
     * Metodo para verificar se um CEP é válido
     *
     * @param  string $cep
     * @return boolean
     */
    public static function isCep($cep) {
        $valid = true;
        $cep = self::unmask($cep);

        if(!ctype_digit($cep))
            return false;
        
        if (strlen($cep) != 8) {
            $valid = false;
        }

        return $valid;
    }

    public static function unmask($texto) {
        return preg_replace('/[\-\|\(\)\/\.\: ]/', '', $texto);
    }

    public static function moeda($valor = 0,  $decimal = 2)
    {

        if (!is_numeric($valor) || !is_int($decimal)){ 
            $val = '';
        }else{
            $val = number_format($valor, $decimal, ',', '.');
        }
        return $val;
    }

     /**
     * Retira formatação de valor monetário
     *
     * @param  string $string Valor monetário formatado
     * @param  string $simbolo Simbolo monetário
     * @return float
     */
    public static function unmoeda($string = "", $simbolo = 'R$')
    {
        $string = str_replace('.', '', str_replace($simbolo, '', $string));

        $string = trim($string,chr(0xC2).chr(0xA0));

        return floatval(str_replace(',', '.', $string));
    }
    
    public static function formataTelefone($number)
    {
        $number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
        return $number;
    }

    public static function formataCep($cep)
    {
        $cep=substr($cep,0,5)." - ".substr($cep,-3);
        return $cep;
    }

    public static function upload_doc($docs, $paciente_id, $inicio=null, $origem=null, $type=null){        
        $inicio = !is_null($inicio) ? $inicio . '_' : '';
        $origem = !is_null($origem) ? $origem . '_' : '';
        $inicio = !is_null($type) ? self::tiposDocumentos()[$type] . '_' . $inicio : '';
        $novo_nome = $inicio.$origem.date('Ymd_His').'_'.$docs->getClientOriginalName();
        $pasta = '/documentos_pacientes/'.$paciente_id;
        if( $docs->storeAs($pasta, $novo_nome, 'public') ){
            return array('nome'=>$novo_nome, 'link'=> 'storage/'.$pasta.'/'.$novo_nome);
        }else{
            return false;
        }          
    }
    public static function pathFiles($person_id, $type)
    {
        $path = [
            'logo_legal_person' => 'images/legal_person/logo/',
            'image_natural_person' => 'images/natural_person/',
            'exams' => 'documents/exams/',
            'images' => 'images/',
            'documents' => 'documents/',
        ];
        $domain = \App::storagePath();
        return $person_id.'/'.$path[$type];
    }
    public static function uploadStorageDoc($docs, $namedoc, $path)
    {
        $nameClient = str_replace( '/', '', \App::storagePath() );
        $renamedoc = CustomHelper::noAccents($namedoc).'.'.$docs->extension();
        $storage_setting = 0;
        
        if(config('app.local_dev') == 'local'){ // upload local | app.local_dev = env.APP_ENV
            
            //$path = storage_path().$path; 
            if( $docs->storeAs($nameClient.'/'.$path, $renamedoc, 'public_link') ){ 
                $result = array('name'=>$renamedoc, 'link'=> config('app.url_storage_local').'/'.$nameClient.'/'.$path.$renamedoc); 
            }else{
                $result =  false;
            }
        } else { // drives of upload in production(online)
            
            if($storage_setting['storageType'] == 0 ){ // upload ftp miller system / storage.millererp.com
                if( $docs->storeAs($nameClient.'/'.$path, $renamedoc, 'ftp') ){
                    $result =  array('name'=>$renamedoc, 'link'=> config('app.url_storage_production').'/'.$nameClient.'/'.$path.$renamedoc);
                }else{
                    $result =  false;
                }
            }

            if($storage_setting['storageType'] == 1 ){ // upload ftp customer
                if( $docs->storeAs($nameClient.'/'.$path, $renamedoc, 'ftp') ){
                    $result =  array('name'=>$renamedoc, 'link'=> $storage_setting['storagePath'].'/'.$nameClient.'/'.$path.$renamedoc);
                }else{
                    $result =  false;
                }
            }

            if($storage_setting['storageType'] == 2){ // upload por ftp
                if( $docs->storeAs($path, $renamedoc, 's3') ){
                    $result =   array('nome'=>$renamedoc, 'link'=> $storage_setting['storagePath'].'/'.$path.'/'.$renamedoc);
                }else{
                    $result =  false;
                }
            }           
        }
        return $result;
    }

    public function setUploadArchives(){
       $dircustomer =  substr(DB::getDatabaseName(), 3);
    }

    public static function verifica_valores_nulos($array_form, $valor_zero=nul){
        $save = 0;
        foreach($array_form as $campo=>$valor){
            if($valor_zero == null){
                if($valor != null || $valor != ''){ $save = 1; }   
            }else{
                if($valor != null || $valor != '' || $valor != 0){ $save = 1; } 
            } 
        }
        return $save;

    }

    public static function formatDecimal($decimal)
    {
       return $decimalDB = str_replace(',','.',str_replace('.', '', $decimal));
    }
    
    public static function noAccents($text)
    {
        $text = preg_replace("/[^\w\s]/", "", iconv("UTF-8", "ASCII//TRANSLIT", $text));
        $text = str_replace(" ", "-", $text);
        $text = strtolower($text);  
        return $text;     
    }

    public static function json_created_by(){
        $ultimo_registro = ['date'=>date('d-m-Y H:i:s'), 'user_id' => Auth()->user()->id];
        return json_encode($ultimo_registro);
    }

    public static function json_updated_by($info_update){

        $info =  json_decode($info_update, true);
        $info[] = ['date'=>date('d-m-Y H:i:s'), 'user_id' => Auth()->user()->id];
        $newinfo = json_encode($info);
        return $newinfo;
    }

    public static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public static function dateValid($date)
    {
        $data = explode("/",$date);
        $d = $data[0];
        $m = $data[1];
        $y = $data[2];
        $res = checkdate($m,$d,$y);
        if ($res == 1){
           return true;
        } else {
           return false;
        }
    }

    public static function timeSequenceMin($initial, $end)
    {
        for($dt=6.0; $dt <= 20; $dt=($dt+0.5)){
            $float = $dt; 
            $float = (string)$float; 
            if(strripos($float, '.')){  
                if(strlen($dt) == 1 ){
                    $sub = number_format($sub,2,'.','.');
                    $hr[$sub] = $sub;
                }
                if(strlen($dt) == 2 ){
                    $sub = number_format($sub,2,'.','.');
                    $hr[$sub] = $sub;
                }
                if(strlen($dt) == 3 ||  strlen($dt) == 4){
                    $sub = ($dt-0.2);
                    $sub = (string)number_format($sub,2,'.','.');
                    $hr[$sub] = $sub;
                }
            }else{
                $ind=number_format($dt,2,'.','.');
                $hr[$ind] = $ind; 
            }
            
        }
        return $hr;
    }

    public static function timeSequence($initial, $end)
    {
        for($dt=6.0; $dt <= 20; $dt++){
            $hr[$dt] = $dt; 
        }
        return $hr;
    }

    /*Primeiro e Último nome*/
    public static function firstLastName($name)
    {
        $name_explode = explode(' ', $name);
        $name_first_last = $name_explode[0] . end($name_explode);
        return $name_first_last;
    }
}
