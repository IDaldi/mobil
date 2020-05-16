<?php
class Pembelian{
  
  private $conn;
  private $table_name = "213_pembelian";
  
  public $id;
  public $id_mekanik;
  public $id_sparepart;
  public $qty;
  public $harga_jasa;
  public $tgl_beli;



  
  public function __construct($db){
    $this->conn = $db;
  }
  
  
 function insert(){
		
		
		$query = "insert into ".$this->table_name." values('',?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_mekanik);
		$stmt->bindParam(2, $this->id_sparepart);
		$stmt->bindParam(3, $this->qty);
		$stmt->bindParam(4, $this->harga_jasa);
		$stmt->bindParam(5, $this->tgl_beli);
		$stmt->bindParam(6, $this->NoPolisi);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	
	function readAll(){

		$query = "SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart ORDER BY id_pembelian DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function readmen(){

		$query = "select 213_pembelian.id_mekanik, count(*) from 213_pembelian inner join 213_mekanik on 213_pembelian.id_mekanik = 213_mekanik.id_mekanik group by 213_pembelian.id_mekanik";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	

	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_mekanik = :nama_mekanik 

				WHERE
					id_mekanik = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nama_mekanik', $this->nama_mekanik);
		$stmt->bindParam(':id', $this->id);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pembelian = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	function countAll(){

		$query = "SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	function hapusell($ax){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pembelian in $ax";
		
		$stmt = $this->conn->prepare($query);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>