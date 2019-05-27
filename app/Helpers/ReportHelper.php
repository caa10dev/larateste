<?php

namespace App\Helpers;

class ReportHelper
{

	public static function type_conditions(){
		$types = array(
			'0'=>'Selecione...',
            'ORDER'=>'ORDENAR',
            '='=>'IGUAL A',
            '!='=>'DIFERNTE DE',
            '>'=>'MAIOR',
            '>='=>'MAIOR OU IGUAL',
            '<'=>'MENOR',
            '<='=>'MENOR OU IGUAL',
            'LIKE'=>'CONTEM'
        );
        return $types;
	}

	public static function selectColsModel($colsModel){
		$selectModel='<select class="form-control">';
		$selectsItens =[];
		foreach($colsModel as $model=>$cols){
			foreach($cols as $col=>$param){
				$indent = $model.'-'.$col; 
				if( isset($param['optionsSelect']) ){
					$selectsItens[ $indent ] = $param['optionsSelect'];
				}
				 $selectModel .= '<option value="'.$model.$col.'" alt="'.$indent.'">'.$param['alias'].'</option>';
			}
			
		}
		$selectModel .= '</select>';

		return $esp=['fields'=>$selectModel, 'opcoes'=>$selectsItens];
	}


}