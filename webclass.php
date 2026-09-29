<?php
$host="$_SERVER[HTTP_HOST]";
$hs="../" . basename(__DIR__); 

// $filename = 'koneksi.txt';
// $setting = file(__DIR__.'/'.$filename);

// $xhost 	= trim($setting[0]);
// $xuser 	= trim($setting[1]);
// $xpwd 	= trim($setting[2]);
// $xdb 	= trim($setting[3]);

//echo $xhost."-".$xuser."-".$xpwd."-".$xdb;

$head1="<font size='+1'>RSUD GAMBIRAN KOTA KEDIRI</font>";
date_default_timezone_set("Asia/Jakarta"); 
 /*
 * File Name: class.crud.php
 * Date: August 17, 2015
 * Author: Alfian Syahroni
 * email : lowshint@gmail.com
 * referensi:
 * Facebook : https://www.facebook.com/sourcecodeonline
 * http://php.net/manual/en/class.pdo.php
 * http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Why_use_PDO.3F
 * 
 */
class kelas extends PDO{
    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
	
    private $result; 	
    
    public function __construct()
	{ 
        $this->engine	= 'mysql'; 
        $this->host	  	= '103.76.120.211'; 
		$this->database = 'retail_new_pratama'; 
		$this->user 	= 'retail_new_pratama'; 
        $this->pass 	= 'TMxjRWAT7hCLZMSD';
		$dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
        parent::__construct( $dns, $this->user, $this->pass ); 
    }
	/*
    * Insert values into the table
    */
	
	public function beginTransaction(){
		
		parent::beginTransaction();
		
		}
	
	public function commit(){
		
		parent::commit();
		}
	
	public function rollback(){
		
		parent::rollBack();
		}
	
	public function insert($table,$rows=null)
	{
		$command = 'INSERT INTO '.$table;
		$row = null; $value=null;
		foreach ($rows as $key => $nilainya)
		{
		  $row	.=",".$key;
		  $value 	.=", :".$key;
		}
		
		$command .="(".substr($row,1).")";
		$command .="VALUES(".substr($value,1).")";
		//echo "$table";print_r($rows);
		//echo"$command<br><br>";
	   
		$stmt =  parent::prepare($command);
		$stmt->execute($rows);
		$rowcount = $stmt->rowCount();
		//$rowcount = parent::lastInsertId();
		return $rowcount;
	}
	
	public function insertNotExist($table,$rows=null,$where=null)
	{
		
		$command = 'INSERT INTO '.$table;
		$row = null; $value=null;
		foreach ($rows as $key => $nilainya)
		{
		  $row	.=",".$key;
		  $value 	.=", :".$key;
		}
		
		$command .="(".substr($row,1).")";
		$command .="VALUES(".substr($value,1).")";
		//echo"$command<br><br>";
	   
		$stmt =  parent::prepare($command);
		$stmt->execute($rows);
		$rowcount = $stmt->rowCount();
		//$rowcount = parent::lastInsertId();
		return $rowcount;
	}
	
	//Insert Data and Return Last Insert ID
	public function insertID($table,$rows=null)
	{
		$command = 'INSERT INTO '.$table;
		$row = null; $value=null;
		foreach ($rows as $key => $nilainya)
		{
		  $row	.=",".$key;
		  $value 	.=", :".$key;
		}
		
		$command .="(".substr($row,1).")";
		$command .="VALUES(".substr($value,1).")";
		 // echo"$command";
	   
		$stmt =  parent::prepare($command);
		$stmt->execute($rows);
		//$rowcount = $stmt->rowCount();
		$rowcount = parent::lastInsertId();
		return $rowcount;
	}
	public function idurut($table,$field){
		$max=$this->select($table,"max($field)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		return $id;
	}
	public function cekppn($tgl,$per){
		
		if(strtotime($tgl)<strtotime($per)){
			$vp=10;
		}else{
			$vp=11;
		}

		return $vp;
	}
	public function nourut($field, $table, $param, $kdunit, $tgl){
		$lenght = strlen($param);
		$mul=8;
		if($lenght==2){
			$mul=$mul-1;	
			$cab=4;	
		//PU/01/201605/0001
		}elseif($lenght==3){
			$mul=$mul;
			$cab=5;	
		//PUO/01/201605/0001
		}
		
		$thn = date("Y",strtotime($tgl));
		$bln = date("m",strtotime($tgl));
		if($param=="TB"){
		$query = $this->select($table,"$field AS maxID","SUBSTR($field,1,$lenght)='$param' AND month(tgl)='$bln' and year(tgl)='$thn' and SUBSTR($field,$cab,2)='$kdunit' ORDER BY SUBSTR($field,$mul,12) desc limit 1");
		//echo "select $field AS maxID from $table where SUBSTR($field,1,$lenght)='$param' AND month(tgl)='$bln' and year(tgl)='$thn' and SUBSTR($field,$cab,2)='$kdunit' ORDER BY SUBSTR($field,$mul,12) desc limit 1";
		} else {
			$query = $this->select($table,"$field AS maxID","SUBSTR($field,1,$lenght)='$param' AND SUBSTR($field,$cab,2)='$kdunit' ORDER BY SUBSTR($field,$mul,12) desc limit 1");
			}
		//$query = $this->select($table,"$field AS maxID","SUBSTR($field,1,$lenght)='$param' and substr($field,12,2)='$bln' and substr($field,8,4)='$thn' and substr($field,5,2)='$kdunit' ORDER BY SUBSTR($field,15,4) desc limit 1");
		foreach($query as $data){}
		$idMaxj = $data['maxID'];
		
		$temp=explode("/",$idMaxj);
		
		$noUrutj = intval($temp[3]);
		$noBlnj =  substr($temp[2], 4, 2);
		
		if($noBlnj<> $bln)
		{
			$noUrutj=1;
		} else {
			$noUrutj++;
		}
		$id=$param."/".$kdunit."/".$thn."".$bln."/".sprintf("%04s", $noUrutj);
		return $id;
	}
	public function nourut2($field, $table, $param, $kdunit, $tgl){
		$lenght = strlen($param);
		$mul=8;
		if($lenght==2){
			$mul=$mul-1;	
			$cab=4;	
		//PU/01/201605/0001
		}elseif($lenght==3){
			$mul=$mul;
			$cab=5;	
		//PUO/01/201605/0001
		}
		
		$thn = date("Y",strtotime($tgl));
		$bln = date("m",strtotime($tgl));
		$tgl = date("d",strtotime($tgl));		
		if($param=="TB"){
		$query = $this->select($table,"$field AS maxID","SUBSTR($field,1,$lenght)='$param' AND month(tgl)='$bln' and year(tgl)='$thn' and SUBSTR($field,$cab,2)='$kdunit' ORDER BY SUBSTR($field,$mul,12) desc limit 1");
		//echo "select $field AS maxID from $table where SUBSTR($field,1,$lenght)='$param' AND month(tgl)='$bln' and year(tgl)='$thn' and SUBSTR($field,$cab,2)='$kdunit' ORDER BY SUBSTR($field,$mul,12) desc limit 1";
		} else {
			$query = $this->select($table,"$field AS maxID","SUBSTR($field,1,$lenght)='$param' AND SUBSTR($field,$cab,2)='$kdunit' ORDER BY SUBSTR($field,$mul,12) desc limit 1");
			}
		//$query = $this->select($table,"$field AS maxID","SUBSTR($field,1,$lenght)='$param' and substr($field,12,2)='$bln' and substr($field,8,4)='$thn' and substr($field,5,2)='$kdunit' ORDER BY SUBSTR($field,15,4) desc limit 1");
		foreach($query as $data){}
		$idMaxj = $data['maxID'];
		
		$temp=explode("/",$idMaxj);
		
		$noUrutj = intval($temp[3]);
		$noBlnj =  substr($temp[2], 4, 2);
		
		if($noBlnj<> $bln)
		{
			$noUrutj=1;
		} else {
			$noUrutj++;
		}
		$id=$param."/".$kdunit."/".$thn."".$bln."".$tgl."/".sprintf("%04s", $noUrutj);
		return $id;
	}	

	/*
    * Delete records from the database.
    */
	public function delete($tabel,$where=null)
	{
		$command = 'DELETE FROM '.$tabel;
		
		$list = Array(); $parameter = null;
		foreach ($where as $key => $value) 
		{
		  $list[] = "$key = :$key";
		  $parameter .= ', ":'.$key.'":"'.$value.'"';
		} 
		$command .= ' WHERE '.implode(' AND ',$list);
	   	// echo"$command";
		$json = "{".substr($parameter,1)."}";
		$param = json_decode($json,true);
				
		$query = parent::prepare($command); 
		$query->execute($param);
		$rowcount = $query->rowCount();
        return $rowcount;
	}
   /*
    * Uddate Record
    */
	public function update($tabel, $fild = null ,$where = null)
	{
		 $update = 'UPDATE '.$tabel.' SET ';
		 $set=null; $value=null;
		 foreach($fild as $key => $values)
		 {
			 $set .= ', '.$key. ' = :'.$key;
			 $value .= ', ":'.$key.'":"'.$values.'"';
		 }
		 $update .= substr(trim($set),1);
		 $json = '{'.substr($value,1).'}';
		 $param = json_decode($json,true);
		 
		 if($where != null)
		 {
		    $update .= ' WHERE '.$where;
		 }
		 //echo"$update<br>";
		 try
			{
			 $query = parent::prepare($update);
			 $query->execute($param);
			 //echo"test<br>";
			}
				catch(Exception $e)
			{
				echo($e->getMessage()); echo"test";
			}
		 $rowcount = $query->rowCount();
         return $rowcount;
    }
   /*
    * Selects information from the database.
    */
	public function select($table, $rows, $where = null, $order = null, $limit= null)
	{
	    $command = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $command .= ' WHERE '.$where;
        if($order != null)
            $command .= ' ORDER BY '.$order;            
        if($limit != null)
            $command .= ' LIMIT '.$limit;
	//echo"$command<br><br>";
		$query = parent::prepare($command);
		$query->execute();
		
		$posts = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC))
		{
			 $posts[] = $row;
		}
		//return $this->result = json_encode(array('post'=>$posts));
		//return $query->fetch(PDO::FETCH_ASSOC);
 		
        return $posts;	
 	}
	
	
	public function selectcount($tabel,$rows,$where)
	{	
		$q=$this->select($tabel,$rows,$where);
        //return count($q);
		return $q;
 	}
		
	
	public function newIDKM($jenis)
	{

		 $thn = date("Y");
		 $bln = date("m");
		 $tgl = date("d");
		 		
		 if($jenis=='1'){
			 	//Rawat Jalan
				$tabel = "rj";
				$idfield="no_rj";
				$pref="IRJ.";
				$id="id_rj";
				$rows  = "ifnull($idfield,0) as maxID";
				$where = "month(antrian)='$bln' and year(antrian)='$thn' and $id=(select $id as maxID from $tabel WHERE month(antrian)='$bln' and year(antrian)='$thn' ORDER BY $id DESC limit 0,1)";	
		 }
		 if($jenis=='2'){
			 	//Rawat resep
				$tabel = "resep";
				$idfield="no_resep";
				$pref="IRN.";
				$id="id";
				$rows  = "ifnull($idfield,0) as maxID";
				$where = "month(tgl)='$bln' and year(tgl)='$thn' and $id=(select $id as maxID from $tabel WHERE month(tgl)='$bln' and year(tgl)='$thn' ORDER BY $id DESC limit 0,1)";	
		 }
		 if($jenis=='3'){
			 	//Rawat Inap
				$tabel = "konsultasi";
				$idfield="no_konsul";
				$pref="KSL.";
				$id="id_konsul";
				$rows  = "ifnull($idfield,0) as maxID";
				$where = "month(tgl)='$bln' and year(tgl)='$thn' and $id=(select $id as maxID from $tabel WHERE month(tgl)='$bln' and year(tgl)='$thn' ORDER BY $id DESC limit 0,1)";	
		 }
		 if($jenis=='4'){
			 	//Rawat Inap
				$tabel = "td_bayar";
				$idfield="no_bayar";
				$pref="BYR.";
				$id="id";
				$rows  = "ifnull($idfield,0) as maxID";
				$where = "month(tgl)='$bln' and year(tgl)='$thn' and $id=(select $id as maxID from $tabel WHERE month(tgl)='$bln' and year(tgl)='$thn' ORDER BY $id DESC limit 0,1)";	
		 }
		 	 	
			 
		
		$dt=$this->select($tabel,$rows,$where);
		//echo"<br> check select $rows from $tabel Where $where<br>";
		foreach($dt as $value){
			$idMax=$value['maxID'];
		}
		
		$noUrut = (int) substr($idMax, 12, 13);
		$noBln = (int) substr($idMax, 5, 2);

		if($idMax=='0' or empty($idMax))
		{

			$noUrut=1;
		} else {
		
			$noUrut++;
		}
				
		$newID = "$pref". $thn ."". sprintf("%02s",$bln).sprintf("%02s",$tgl)."". sprintf("%06s", $noUrut);	 
		
		return $newID;	 
    }
	
	public function paramjur($kdparam,$layanan,$cabang){
		
		$table="parameter_jurnal";
		$rows="*";
		$where="kd_param='$kdparam' AND LAYANAN='$layanan' AND cabang='$cabang'";
		
		return $this->select($table,$rows,$where);
		
	}
	
	/*
    * Returns the result set
    */
	public function getResult()
	{
        return $this->result;
    }
	
	
	static function data_output ( $columns, $data )
	{
		$out = array();

		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
			$row = array();

			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
				$column = $columns[$j];
				// Is there a formatter?
				if ( isset( $column['formatter'] ) ) {
					$row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
				}
				else {
					$row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];
				}
			}

			$out[] = $row;
		}

		return $out;
	}

	static function db ( $conn )
	{
		if ( is_array( $conn ) ) {
			return self::sql_connect( $conn );
		}

		return $conn;
	}

	static function limit ( $request, $columns )
	{
		$limit = '';

		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
		}

		return $limit;
	}

	public function bulanh($bulan)
	{
		
		switch($bulan){
			case 1;
			$rom = "Januari";
			break;
			case 2;
			$rom = "Februari";
			break;
			case 3;
			$rom = "Maret";
			break;
			case 4;
			$rom = "April";
			break;
			case 5;
			$rom = "Mei";
			break;
			case 6;
			$rom = "Juni";
			break;
			case 7;
			$rom = "Juli";
			break;
			case 8;
			$rom = "Agustus";
			break;
			case 9;
			$rom = "September";
			break;
			case 10;
			$rom = "Oktober";
			break;
			case 11;
			$rom = "November";
			break;
			case 12;
			$rom = "Desember";
			break;
		}
			
		return $rom;
	}
	
	static function order ( $request, $columns )
	{
		$order = '';

		if ( isset($request['order']) && count($request['order']) ) {
			$orderBy = array();
			$dtColumns = self::pluck( $columns, 'dt' );

			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
				// Convert the column index into the column data property
				$columnIdx = intval($request['order'][$i]['column']);
				$requestColumn = $request['columns'][$columnIdx];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $request['order'][$i]['dir'] === 'asc' ?
						'ASC' :
						'DESC';

					$orderBy[] = '`'.$column['db'].'` '.$dir;
				}
			}

			$order = 'ORDER BY '.implode(', ', $orderBy);
		}

		//echo $order;

		return $order;
	}
	
	static function filter2 ( $where )
	{
		
		
	}

	static function filter ( $request, $columns, &$bindings )
	{
		$globalSearch = array();
		$columnSearch = array();
		$dtColumns = self::pluck( $columns, 'dt' );

		if ( isset($request['search']) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];

			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( $requestColumn['searchable'] == 'true' ) {
					$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
					// $globalSearch[] = "`".$column['db']."` LIKE ".$binding;
					$globalSearch[] = "CONVERT(`".$column['db']."` USING utf8) LIKE ".$binding;
				}
			}
		}
// echo "disni";
		// Individual column filtering
		if ( isset( $request['columns'] ) ) {
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				$str = $requestColumn['search']['value'];

				if ( $requestColumn['searchable'] == 'true' &&
				 $str != '' ) {
					$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
					// $columnSearch[] = "`".$column['db']."` LIKE ".$binding;
					$columnSearch[] = "CONVERT(`".$column['db']."` USING utf8) LIKE ".$binding;
				}
			}
		}

		// Combine the filters into a single string
		$where = '';

		if ( count( $globalSearch ) ) {
			$where = '('.implode(' OR ', $globalSearch).')';
		}

		if ( count( $columnSearch ) ) {
			$where = $where === '' ?
				implode(' AND ', $columnSearch) :
				$where .' AND '. implode(' AND ', $columnSearch);
		}

		if ( $where !== '' ) {
			$where = 'WHERE '.$where;
		}
// echo $where;
		return $where;
	}

	static function simple ( $request, $conn, $table, $primaryKey, $columns, $where2, $jenis, $limit2 )
	{
		$bindings = array();
		$db = self::db( $conn );
		// Build the SQL query string from the request
		$limit = self::limit( $request, $columns );
		$order = self::order( $request, $columns );
		$where = self::filter( $request, $columns, $bindings );
		if($where==''){
			if($jenis=='view'){
				$limit=$limit;
			}elseif($jenis=='input'){
				//$limit='limit 1,100';
				$limit=$limit2;
			}
			if($where2!=''){
			$where2='where '.$where2;} 
		}else{
			$limit=$limit;
			if($where2!=''){
			$where2='and '.$where2;} else{$where2="";}
		}
		// Main query to actually get the data
		$data = self::sql_exec( $db, $bindings,
			"SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", self::pluck($columns, 'db'))."`
			 FROM $table
			 $where
			 $where2
			 $order
			 $limit"
		);
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db,
			"SELECT FOUND_ROWS()"
		);
		$recordsFiltered = $resFilterLength[0][0];

		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT(`{$primaryKey}`)
			 FROM   `$table`"
		);
		$recordsTotal = $resTotalLength[0][0];


		/*
		 * Output
		 */
		return array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data )
		);
	}


	static function complex ( $request, $conn, $table, $primaryKey, $columns, $whereResult=null, $whereAll=null )
	{
		$bindings = array();
		$db = self::db( $conn );
		$localWhereResult = array();
		$localWhereAll = array();
		$whereAllSql = '';

		// Build the SQL query string from the request
		$limit = self::limit( $request, $columns );
		$order = self::order( $request, $columns );
		$where = self::filter( $request, $columns, $bindings );

		$whereResult = self::_flatten( $whereResult );
		$whereAll = self::_flatten( $whereAll );

		if ( $whereResult ) {
			$where = $where ?
				$where .' AND '.$whereResult :
				'WHERE '.$whereResult;
		}

		if ( $whereAll ) {
			$where = $where ?
				$where .' AND '.$whereAll :
				'WHERE '.$whereAll;

			$whereAllSql = 'WHERE '.$whereAll;
		}

		// Main query to actually get the data
		$data = self::sql_exec( $db, $bindings,
			"SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", self::pluck($columns, 'db'))."`
			 FROM `$table`
			 $where
			 $order
			 $limit"
		);

		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db,
			"SELECT FOUND_ROWS()"
		);
		$recordsFiltered = $resFilterLength[0][0];

		// Total data set length
		$resTotalLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT(`{$primaryKey}`)
			 FROM   `$table` ".
			$whereAllSql
		);
		$recordsTotal = $resTotalLength[0][0];

		/* 
		 * Output
		 */
		return array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data )
		);
	}
	static function sql_connect ( $sql_details )
	{
		try {
			$db = @new PDO(
				'mysql:host=103.76.120.211;dbname=retail_new_pratama',
				'retail_new_pratama','TMxjRWAT7hCLZMSD',
				array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )
			);
		}
		catch (PDOException $e) {
			self::fatal(
				"An error occurred while connecting to the database. ".
				"The error reported by the server was: ".$e->getMessage()
			);
		}

		return $db;
	}


	/**
	 * Execute an SQL query on the database
	 *
	 * @param  resource $db  Database handler
	 * @param  array    $bindings Array of PDO binding values from bind() to be
	 *   used for safely escaping strings. Note that this can be given as the
	 *   SQL query string if no bindings are required.
	 * @param  string   $sql SQL query to execute.
	 * @return array         Result from the query (all rows)
	 */
	static function sql_exec ( $db, $bindings, $sql=null )
	{
		// Argument shifting
		if ( $sql === null ) {
			$sql = $bindings;
		}

		$stmt = $db->prepare( $sql );
		//echo $sql;

		// Bind parameters
		if ( is_array( $bindings ) ) {
			for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
				$binding = $bindings[$i];
				$stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
			}
		}

		// Execute
		try {
			$stmt->execute();
		}
		catch (PDOException $e) {
			self::fatal( "An SQL error occurred: ".$e->getMessage() );
		}

		// Return all
		return $stmt->fetchAll( PDO::FETCH_BOTH );
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Internal methods
	 */

	/**
	 * Throw a fatal error.
	 *
	 * This writes out an error message in a JSON string which DataTables will
	 * see and show to the user in the browser.
	 *
	 * @param  string $msg Message to send to the client
	 */
	static function fatal ( $msg )
	{
		echo json_encode( array( 
			"error" => $msg
		) );

		exit(0);
	}

	/**
	 * Create a PDO binding key which can be used for escaping variables safely
	 * when executing a query with sql_exec()
	 *
	 * @param  array &$a    Array of bindings
	 * @param  *      $val  Value to bind
	 * @param  int    $type PDO field type
	 * @return string       Bound key to be used in the SQL where this parameter
	 *   would be used.
	 */
	static function bind ( &$a, $val, $type )
	{
		$key = ':binding_'.count( $a );

		$a[] = array(
			'key' => $key,
			'val' => $val,
			'type' => $type
		);

		return $key;
	}


	/**
	 * Pull a particular property from each assoc. array in a numeric array, 
	 * returning and array of the property values from each item.
	 *
	 *  @param  array  $a    Array to get data from
	 *  @param  string $prop Property to read
	 *  @return array        Array of property values
	 */
	static function pluck ( $a, $prop )
	{
		$out = array();

		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
			$out[] = $a[$i][$prop];
		}

		return $out;
	}

	static function _flatten ( $a, $join = ' AND ' )
	{
		if ( ! $a ) {
			return '';
		}
		else if ( $a && is_array($a) ) {
			return implode( $join, $a );
		}
		return $a;
	}
	public function cek_mutasi($kode_brg,$unit){
			$sql=$this->select("tx_mutasi","IFNULL(akhir,0)as akhir","id_barang='$kode_brg' AND id_gudang='$unit' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($sql as $mutasi){}
			return $mutasi;
			
	}
	public function cek_mutasi_riject($kode_brg,$unit){
			$sql=$this->select("tx_mutasi_reject","IFNULL(akhir,0)as akhir","id_barang='$kode_brg' AND id_gudang='$unit' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($sql as $mutasi){}
			return $mutasi;
			
	}
	public function aktif_price($tgl,$id){
		$acti=$this->select("m_pricelist","id_price","id_supp='$id' and due_date<='$tgl' and status='1' group by due_date order by due_date desc limit 0,1");
		foreach($acti as $actival){}
		return $actival;
	}
	function jumlah_hari($bulan = 0, $tahun = '') { 
			if ($bulan < 1 OR $bulan > 12) { 
			return 0; 
			} 
			if ( ! is_numeric($tahun) OR strlen($tahun) != 4) { 
			$tahun = date('Y'); 
			} 
			if ($bulan == 2) { 
			if ($tahun % 400 == 0 OR ($tahun % 4 == 0 AND $tahun % 100 != 0)) { 
			return 29; 
			} 
			} 
			$jumlah_hari = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
			return $jumlah_hari[$bulan - 1]; 
	} 
	function ses_cab($cab){
		 if($cab==0 || $cab==99){
			$caba=" ";
		 }else{
			$caba=" and id_cabang='$cab'";
		 }
		 return $caba;
			
	}
	function cetak($jab,$cab){
		$cek=$this->select("m_pegawai","nama_pegawai","id_jabatan='$jab' and id_cabang='$cab' and id_aktif='1'");
		foreach($cek as $dtbm){}
		$jum=count($cek);
		
		if($jum>0){
			$nama=$dtbm['nama_pegawai'];
		}else{
			$nama="";
			}
		
				 return $nama;
			
	}
			
	public function masuk_mutasi($id,$kd_brg,$idgud,$qty,$hpp,$user,$jen){
					
					$mutasi2=$this->select("tx_mutasi","*","id_barang='$kd_brg' and id_gudang='$idgud' order by id_mutasi desc limit 0,1");
					foreach($mutasi2 as $mutasi){}
					if($mutasi[id_mutasi]==''){
						$awal=0; 
						$masuk=$qty;
						$keluar=0;
						$akhir=$qty;
					}else{
						$awal=$mutasi[akhir];
						$masuk=$qty;
						$keluar=0;
						$akhir=$awal+$masuk-$keluar;
					}
					$tgl=date("Y-m-d H:i:s");
					$data = array( 		
							'no_ref' => $id,
							'id_barang' => $kd_brg,
							'awal' => $awal,
							'masuk' => $masuk,
							'keluar' => $keluar,
							'akhir' => $akhir,
							'hpp' => $hpp,
							'tgl_mutasi' => $tgl,
							'jenis_mutasi' => $jen,
							'id_user' => $user,
							'id_gudang' => $idgud

					);
					$exec= $this->insert("tx_mutasi", $data);
					//$sql="insert into mutasi$periode(no_ref,kd_brg,awal,masuk,keluar,akhir,tgl_mutasi,jenis_mutasi,id_user,id_gudang,hpp)
					//values('$id','$kd_brg','$awal','$masuk','$keluar','$akhir',NOW(),'0','$user','$idgud','$hpp')";
					//mysql_query($sql);
					//return $sql;
		}
		public function masuk_mutasi_r($id,$kd_brg,$idgud,$qty,$hpp,$user,$jen){
					$mutasi2=$this->select("tx_mutasi_reject","*","id_barang='$kd_brg' and id_gudang='$idgud' order by id_mutasi desc limit 0,1");
					foreach($mutasi2 as $mutasi){}
					if($mutasi[id_mutasi]==''){
						$awal=0; 
						$masuk=$qty;
						$keluar=0;
						$akhir=$qty;
					}else{
						$awal=$mutasi[akhir];
						$masuk=$qty;
						$keluar=0;
						$akhir=$awal+$masuk-$keluar;
					}
					$tgl=	date("Y-m-d H:i:s");		
					$data = array( 		
							'no_ref' => $id,
							'id_barang' => $kd_brg,
							'awal' => $awal,
							'masuk' => $masuk,
							'keluar' => $keluar,
							'akhir' => $akhir,
							'hpp' => $hpp,
							'tgl_mutasi' => $tgl,
							'jenis_mutasi' => $jen,
							'id_user' => $user,
							'id_gudang' => $idgud

					);
					$exec= $this->insert("tx_mutasi_reject", $data);
					//$sql="insert into mutasi$periode(no_ref,kd_brg,awal,masuk,keluar,akhir,tgl_mutasi,jenis_mutasi,id_user,id_gudang,hpp)
					//values('$id','$kd_brg','$awal','$masuk','$keluar','$akhir',NOW(),'0','$user','$idgud','$hpp')";
					//mysql_query($sql);
					//return $sql;
		}
		
		function keyED($txt,$encrypt_key) { 
			$encrypt_key = md5($encrypt_key); 
			$ctr=0; 
			$tmp = ""; 
			for ($i=0;$i<strlen($txt);$i++) { 
			if ($ctr==strlen($encrypt_key)) $ctr=0; 
			$tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1); 
			$ctr++; 
			} 
			return $tmp; 
		} 
		//die("A";
		
		public function encrypt($txt,$key) { 
			srand((double)microtime()*1000000); 
			$encrypt_key = md5(rand(0,32000)); 
			$ctr=0; 
			$tmp = ""; 
			for ($i=0;$i<strlen($txt);$i++) { 
			if ($ctr==strlen($encrypt_key)) $ctr=0; 
			$tmp.= substr($encrypt_key,$ctr,1) . 
			(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1)); 
			$ctr++; 
			} 
			return $this->keyED($tmp,$key); 
		} 
		//die("A";
		
		public function decrypt($txt,$key) { 
			$txt = $this->keyED($txt,$key); 
			$tmp = ""; 
			for ($i=0;$i<strlen($txt);$i++) { 
			$md5 = substr($txt,$i,1); 
			$i++; 
			$tmp.= (substr($txt,$i,1) ^ $md5); 
			} 
			return $tmp; 
		} 
		//die("B";
		
		public function enkrip($text) {
			$key1="";
			$key2="";
			$key3="";
			$e = base64_encode($this->keyED($this->encrypt($this->keyED($text,$key1),$key2),$key3));
			//$e = base64_encode($text);
			return $e;
			}
			//die("C";
			
		public function dekrip($text) {
			$key1="";
			$key2="";
			$key3="";
			$d = $this->keyED($this->decrypt($this->keyED(base64_decode($text),$key3),$key2),$key1);
			//$d = base64_decode($text);
			return $d;
		}
		
		public function minus($nominal){
		
			if($nominal<0){
				$k="(".number_format(abs($nominal)).")";
				} else {$k=number_format($nominal);}
			return $k;
		}	
		public function checksaldo($bulan,$tahun,$cabang,$akun){
			
			if($bulan==1){
			$awalk="kredit";
			$awald="debet";
			$mutd="D1";
			$mutk="K1";
			}else{
				for($i=1;$i<$bulan;$i++){
					$ad.="D".$i."+";
					$ak.="K".$i."+";
					}
				$awald="(ifnull(debet,0)+".substr($ad,0,-1).")";
				$awalk="(ifnull(kredit,0)+".substr($ak,0,-1).")";
				$mutd="D".$i;
				$mutk="K".$i;
				}
		$accch=explode("-",$akun);		
		$tbl="ak_acc a JOIN ak_acc_group d ON a.type=d.id_group LEFT JOIN ak_closing_dtl c ON a.account = c.ACC_CODE
									 AND c.TAHUN='". ($tahun-1) ."' 
									 LEFT JOIN ak_acc_saldo b ON a.account = b.ACC_CODE 
									 AND b.TAHUN='$tahun'
								where a.post_flag<>'0' AND a.account='".trim($accch[0]," ")."' AND 	
								b.CABANG='$cabang' OR c.ID_CABANG='$cabang'";
								
		$f="a.description as desk, 
			   sum($awald) as DAWAL, 
			   sum($awalk) as KAWAL, 
			   sum($mutd) as mutd, 
			   sum($mutk) as mutk,
			   `status`
			   ";						
		//echo"select $f from $tbl <br><br>";
		$sa=$this->select($tbl,$f);
		foreach($sa as $sa1){
			
			if($sa1[status]=="D"){
				$awal=$sa1[DAWAL]-$sa1[KAWAL];
				$mut=$sa1[mutd]-$sa1[mutk];
				$akhir=$awal+$mut;
				$t="D";
			} else {
				$awal=$sa1[KAWAL]-$sa1[DAWAL];
				$mut=$sa1[mutk]-$sa1[mutd];
				$akhir=$awal+$mut;
				$t="K";
			}
		}
		
		return $akhir;	
		}

		public function jenistrans($j){
			switch($j){
				case 1;
				$dt="CC";
				break;
				case 2;
				$dt="DC";
				break;
				case 3;
				$dt="CH";
				break;
				case 5;
				$dt="MT";
				break;
				case 6;
				$dt="RF";
				break;
				case 7;
				$dt="VP";
				break;
			}
			return $dt;
			
		}
	
	public function tutupbuku($cabang,$tgl){
				$tgl=date("Y-m-d",strtotime($tgl));
				$exp=explode("-",$tgl);
				$bul=$exp[1];
				$tah=$exp[0];
				$dt=count($this->select("m_tutup_buku","*","id_cabang='$cabang' and bulan='$bul' and tahun='$tah'"));
				//echo "$tgl select * from m_tutup_buku where id_cabang='$cabang' and bulan='$bul' and tahun='$tah'";
				return $dt;
		}

	Public function getUserIP()
	{
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];

	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }
	    
	    if($ip=="::1"){
	    	$ip="127.0.0.1";
	    }

	    return $ip;
	}
	
}

?>