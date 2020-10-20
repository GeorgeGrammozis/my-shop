<?php
/**
 * User: Mole
 * Date: Nov/2/2016
 * Time: 16:47 PM
 
 * Database Class.
 * 
 * H Db Class κρατάει όλες τις ρουτίνες που χρειαζόμαστε για την
 * εποικινωνία μας με την βάση δεδωμένων.
 * Είναι σε μορφή public static γιατί δεν χρειάζεται να κάνουμε instant
 * την Class εφόσων καλούμε κάθε ρουτίνα ξεχωριστά. 
 *
 * 
 * @author George Grammozis <georgegrammozis@otenet.gr> 2016-01-04
 */ 
abstract class Db{

/* Class Properties -------------------------------------------------------------- */

/* counting affected rows from sql query. */
private static $affected_rows;

/* Holds the last inserted id after a insert query */
private static $last_id;



/* Class Methods ----------------------------------------------------------------- */

/**
 *Function name connection().
 *connecting to the server and mysql database. 
 *@return the PDO connection handle.
 */
private static function connection(){
	
	try {
		
		/* server credentials to connect to the server and the database. */
		$pdo = new PDO( DNS, USERNAME, PASSWORD );
		/* set the error mode to handle PDO Exceptions. */
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		/* emulates the prepare queries. */
		#$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} 
	
	/* throwing error if for some reason there is no server connection. */
	catch (PDOException $e) {
		/* the error message. */
		echo $e->getMessage();
	}

	/* returning the handle for using in our functions. */
	return $pdo;
}

/**
 *Function name query().
 *Abstract query function, preparing and binding data, for avoiding sql injections.
 *@param $query_string = query(" SELECT * FROM users WHERE username = ? and password = ? ", $data_array);
 *							 or query(" SELECT * FROM users WHERE id = ? ", array($id));
 *							 or query(" SELECT * FROM users "); without where clause.
 *@param $data_array =  values to bind to execute() function;
 *@return data as object array. 
 */
public static function query($query_string, $data_array = null){

	/* connecting to the server. */
	$pdo = self::connection();
	
	/* preparing the database query. */
	$query = $pdo->prepare($query_string);
	$query->setFetchMode(PDO::FETCH_OBJ);

	/* executing the query. */
	try {
		$query->execute($data_array);
	}

	/* throwing error if query for some reason is not executed. */ 
	catch (PDOException $e) {
		echo $e->getMessage();
		
	}

	/* creating an array with the returned objects. */
	$data = $query->fetchAll();

	/* counts the data array and returns the affected rows.*/
	self::$affected_rows = count($data);

	/* emptying the current recordset. */
	$query = null;

	/* closes the server connection. */
	$pdo 	 = null;

	/* returns the recordset as an object array. */
	/* accessing the data with an foreach loop. Retrive as $data->column_name. */
	return $data;
}		

/**
 *Function name insert().
 *Abstract insert function, preparing and bindig data, for awoiding sql injections.
 *@param $sql = insert(" INSERT INTO users (username,password) VALUES(?,?) ", $data_array);
 *							 		
 *@param $data_array =  values to bind with the execute() function;
 *@return true. 
 */
public static function insert($sql,$data_array = null){

	/* connecting to the server */
	$pdo = self::connection();

	/* preparing the database query. */
	$query = $pdo->prepare($sql);

	/* executing the query. */
	try {
		$query->execute($data_array);
	} 
	
	/* throwing an error if something goes wrong and returning false. */
	catch (PDOException $e) {
		
		// handling error code...
		
		echo $e->getMessage();
		return false;
	}
	
	/* counts the affected rows with the rowCount() function. */
	self::$affected_rows = $query->rowCount();

	self::$last_id = $pdo->lastInsertId();

	/* emptying the current recordset. */
	$query = null;
	
	/* closing the connection and setting the handler to nul. */
	$pdo 	 = null;

	/* returning true if everything ig going well. */
	return true;
}		

/**
 *Function name update().
 *Abstract update function, preparing and bindig data, for awoiding sql injections.
 *@param $sql = update(" UPDATE users SET username = ?, password = ? where id = ? ", $data_array);
 *							 		
 *@param $data_array =  values to bind with the execute() function;
 *@return true. 
 */
public static function update($sql,$data_array = null){

	/* server connection */
	$pdo = self::connection();

	/* preparing the database query */
	$query = $pdo->prepare($sql);

	try {
		/* executing the query */
			$query->execute($data_array);
	} 
	catch (PDOException $e) {
		
		// handling error code...
		
		echo $e->getMessage();
		return false;
	}
	
	/* counts the affected rows with the rowCount() function. */
	self::$affected_rows = $query->rowCount();

	self::$last_id = $pdo->lastInsertId();

	/* empty the result set */
	$query = null;

	/* closing the connection by destroying the object */
	$pdo = null;

	/* returning true if everything went good. */
	return true;
}

	/**
	 *Function name delete().
	 *Delete function, preparing and bindig data, for awoiding sql injections.
	 * @param $sql .. delete(" DELETE FROM users WHERE id = ? ", $id);
	 * @param null $data_array
	 * @return true .
	 * @internal param $id .. the rows id to delete, and bind by passing in the execute function().
	 */
public static function delete($sql,$data_array = null){

	/* connecting to the server */
	$pdo = self::connection();
	
	/* preparing the statement */	
	$query = $pdo->prepare($sql);

	try {
		/* executing the statement */
		$query->execute($data_array);
	} 
	catch (PDOException $e) {
		
		// handling error code...
		echo $e->getMessage();
		return false;
	}

	/* counts the affected rows with the rowCount() function. */
	self::$affected_rows = $query->rowCount();

	/* empty the result set */
	$query = null;

	/* closing the connection by destroying the object */
	$pdo = null;

	/* return true if all goes well. */
	return true;
}


/**
 * Geting the affected rows after a db select, insert, 
 * update, or delete query
 * @param none
 * @return int
 */
	public static function get_affected_rows(){
		return self::$affected_rows;
	}

/**
 * Getting the last id after an db:: insert, or update query
 * @param none
 * @return int
 */
	public static function get_last_id(){
		return self::$last_id;
	}

} /* End of Class Db */ ?>