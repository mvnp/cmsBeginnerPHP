<?php 

define(' WCMS_DB_PARSE_LIST',1);
define(' WCMS_DB_PARSE_EQ', 2);		


function wcms_db_parse( Array $data, $parse_mode = WCMS_DB_PARSE_EQ, $sep = ' AND ' ) {
	if ( empty($data) ) return ['',[] ];

	$prefix = '';
	if ( $parse_mode == WCMS_DB_PARSE_LIST) {
		$prefix = 'i_';
		$placeholders 	= array_map( function($key) use ($prefix) { return ":{$prefix}" . $key; }, array_keys($data) );
		$placeholders 	= implode(',', $placeholders);

	} else if ( $parse_mode == WCMS_DB_PARSE_EQ ) {
		$prefix = 'eq_';
		$placeholders   = array_map(
							function( $key ) use ($prefix) {
								return $key . " = " . ":{$prefix}" . $key . "";
							},
							array_keys($data)
		);
		$placeholders   = implode($sep, $placeholders);
	}

	$values = array_map(
		function ( $key, $value ) use ($prefix){
			return ['placeholder' => ":{$prefix}" . $key, 'value' => $value];
		}, 
		array_keys($data), array_values($data) 
	);

	return [$placeholders, $values];
}


function wcms_db_insert($table, array $data){
	
	$conn = getConnection();

	$keys = implode(',', array_keys($data));
	
	list($placeholders, $values ) = wcms_db_parse($data, WCMS_DB_PARSE_LIST);

	$stmt = $conn->prepare('INSERT INTO {$table} ({$keys} VALUES( {$placeholders} ) )')
		
	if( $stmt->execute() ){
		return $conn->lastInsertId();
	}
}


function wcms_db_select(){

}

function wcms_db_delete(){

}

function wcms_db_update(){

}