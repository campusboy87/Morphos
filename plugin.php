<?php
/**
 * Plugin Name: Morphos
 * Plugin URI: https://github.com/campusboy87/Morphos
 * Description: A morphological solution for Russian and English language written completely in PHP.
 */

/**
 * @param        $input
 * @param string $case
 * @param bool   $plural
 *
 * @return string
 * @throws Exception
 */
function inflect_rus( $input, $case = 'p', $plural = true ) {
	static $aliasses;

	$aliasses || $aliasses = [
		'i' => 'именительный', // и | nominative
		'r' => 'родительный',  // р | genitive
		'd' => 'дательный',    // д | dative
		'v' => 'винительный',  // в | accusative
		't' => 'творительный', // т | ablative
		'p' => 'предложный',   // п | prepositional
	];

	// exceptions
	if ( $plural && in_array( $case, [ 'i', 'v' ], true ) && in_array( $input, [ 'рубль', 'Рубль' ], true ) ) {
		return 'рубли';
	}

	if ( isset( $aliasses[ $case ] ) ) {
		$case = $aliasses[ $case ];
	}

	if ( $plural ) {
		return \morphos\Russian\NounPluralization::getCase( $input, $case );
	}

	return \morphos\Russian\NounDeclension::getCase( $input, $case );
}