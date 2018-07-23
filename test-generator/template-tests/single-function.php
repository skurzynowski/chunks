/**
 * @test
 *
 * @dataProvider functionNameProvider
 */
public function functionName( $data, $expected ) {
	$result = $this->test_object->functionName( $data );
	$this->assertEquals( $expected, $result );
}


public function functionNameProvider() {
	return [
		array( [], false ),
		array( new SimpleXMLElement( '<empty/>' ), false ),
		array( null, false ),
		array( 'fsdfasdfa', false ),
		array( ' ', false ),
		array( '', false ),
		//TODO add last cases
	];
}
