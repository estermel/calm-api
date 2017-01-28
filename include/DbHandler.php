<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . './DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function register($username, $password) {
        $stmt = $this->conn->prepare("INSERT INTO user (username, password) VALUES (?,?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
		return $tasks;
    }

    public function order($id_order, $username, $id_produk, $asrama, $no_kamar, $jus, $tanggal_booking, $jam_booking, $waktu_order, $status_order) {
        $stmt = $this->conn->prepare("INSERT INTO orderan (id_order, username, id_produk, asrama, no_kamar, jus, tanggal_booking, jam_booking, waktu_order, status_order) VALUES (?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,?)");
        $stmt->bind_param("isisssssss", $id_order, $username, $id_produk, $asrama, $no_kamar, $jus ,$tanggal_booking, $jam_booking, $waktu_order, $status_order);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }

    public function confirmOrder($status_order, $waktu_konfirmasi){
        $stmt = $this->conn->prepare("UPDATE orderan SET status_order = 'diterima' , waktu_konfirmasi = CURRENT_TIMESTAMP");
        $stmt->execute();
        $tasks=$stmt->get_result();
        $stmt->close();
        return $tasks;
    }

	public function getAkun() {
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }

    public function getProduk() {
        $stmt = $this->conn->prepare("SELECT * FROM produk");
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }
	
    public function getOrder() {
        $stmt = $this->conn->prepare("SELECT * FROM orderan INNER JOIN produk ON orderan.id_produk=produk.id_produk INNER JOIN user ON orderan.username=user.username");
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }

    public function getUserOrder($username) {
        $stmt = $this->conn->prepare("SELECT * FROM orderan WHERE username='$username' ORDER BY id_order ASC");
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }

    public function getUserOrderDiterima($username) {
        $stmt = $this->conn->prepare("SELECT * FROM orderan WHERE username='$username' AND status_order='diterima' ORDER BY id_order ASC");
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }

    public function getUserOrderMenunggu($username) {
        $stmt = $this->conn->prepare("SELECT * FROM orderan WHERE username='$username' AND status_order='menunggu' ORDER BY id_order ASC");
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }
}
?>