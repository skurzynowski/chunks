<?php
namespace  ot_flights\services;

class Appsaloon_Customtables {
	/**
	 * load table with data from csv
	 *
	 * @param mixed $table_name
	 * @param mixed $path_to_csv
	 */
	public static function load_table_with_csv()
	{
		//GET DIRECTORY OF CSV FILES
		$path_to_cities_csv =   OT_FLIGHTS_DIR . 'tables-csv/flight_cities.csv';
		$path_to_airports_csv = OT_FLIGHTS_DIR . 'tables-csv/airports.csv'; 

		//ESCAPE SLASHES
		$path_to_cities_csv = str_replace( '/', '\/', $path_to_cities_csv );
		$path_to_airports_csv = str_replace( '/', '\/', $path_to_airports_csv );

		//CHANGE USING SED PATH IN SQL COMMAND
		exec("sed -i -e \"s/.\+flight_cities.\+/'".$path_to_cities_csv."'/g\" /var/www/omnia/wp-content/plugins/ot-flights/tables-csv/import.sql");
		exec("sed -i -e \"s/.\+\/airports.\+/'".$path_to_airports_csv."'/g\" /var/www/omnia/wp-content/plugins/ot-flights/tables-csv/import.sql");

		exec("mysql -u'" . DB_USER . "' --password='" . DB_PASSWORD . "' '" . DB_NAME . "' < " . __DIR__ . "/../tables-csv/import.sql");
	}
	
	public static function create_airports_table() {
		global $wpdb;

		//TODO change airtports_test into airports
		$query = "CREATE TABLE " . $wpdb->prefix . "airports (
			IataCode VARCHAR(3) DEFAULT NULL,
			CountryName VARCHAR(20) DEFAULT NULL,
			CountryCode VARCHAR(5) DEFAULT NULL,
			City VARCHAR(20) DEFAULT NULL,
			AirportName VARCHAR(20) DEFAULT NULL,
			PRIMARY KEY (IataCode)
		)";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $query );
	}
	public static function create_cities_table() {
		global $wpdb;

		$query = "CREATE TABLE " . $wpdb->prefix . "cities (
			IataCode VARCHAR(3) DEFAULT NULL,
			Country VARCHAR(20) DEFAULT NULL,
			City VARCHAR(20) DEFAULT NULL,
			PRIMARY KEY (IataCode)
		)";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $query );
	}
}
