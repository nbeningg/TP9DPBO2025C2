<?php

include("KontrakPresenter.php");

class ProsesMahasiswa implements KontrakPresenter
{
	private $tabelmahasiswa;
	private $data = [];

	function __construct()
	{
		// Konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelmahasiswa = new TabelMahasiswa($db_host, $db_user, $db_password, $db_name); // instansi TabelMahasiswa
			$this->data = array(); // instansi list untuk data Mahasiswa
		} catch (Exception $e) {
			echo "[!] Error : " . $e->getMessage();
		}
	}

	function prosesDataMahasiswa()
	{
		try {
			// mengambil data di tabel Mahasiswa
			$this->tabelmahasiswa->open();
			$this->tabelmahasiswa->getMahasiswa();

			while ($row = $this->tabelmahasiswa->getResult()) {
				// ambil hasil query
				$mahasiswa = new Mahasiswa(); // instansiasi objek mahasiswa untuk setiap data mahasiswa
				$mahasiswa->setId($row['id']); // mengisi id
				$mahasiswa->setNim($row['nim']); // mengisi nim
				$mahasiswa->setNama($row['nama']); // mengisi nama
				$mahasiswa->setTempat($row['tempat']); // mengisi tempat
				$mahasiswa->setTl($row['tl']); // mengisi tl
				$mahasiswa->setGender($row['gender']); // mengisi gender
				$mahasiswa->setEmail($row['email']); // mengisi email
				$mahasiswa->setTelp($row['telp']); // mengisi telp

				$this->data[] = $mahasiswa; // tambahkan data mahasiswa ke dalam list
			}
			// Tutup koneksi
			$this->tabelmahasiswa->close();
		} catch (Exception $e) {
			echo "[!] Error : " . $e->getMessage();
		}
	}

	function addData($data)
	{
		try {
			$this->tabelmahasiswa->open();
			$result = $this->tabelmahasiswa->addMahasiswa($data);
			$this->tabelmahasiswa->close();
			return $result;
		} catch (Exception $e) {
			echo "[!] Error Add: " . $e->getMessage();
		}
	}

	function updateData($data)
	{
		try {
			$this->tabelmahasiswa->open();
			$result = $this->tabelmahasiswa->updateMahasiswa($data);
			$this->tabelmahasiswa->close();
			return $result;
		} catch (Exception $e) {
			echo "[!] Error Update: " . $e->getMessage();
		}
	}

	function deleteData($id)
	{
		try {
			$this->tabelmahasiswa->open();
			$result = $this->tabelmahasiswa->deleteMahasiswa($id);
			$this->tabelmahasiswa->close();
			return $result;
		} catch (Exception $e) {
			echo "[!] Error Delete: " . $e->getMessage();
		}
	}

	function getMahasiswaById($id)
	{
		try {
			$this->tabelmahasiswa->open();
			$row = $this->tabelmahasiswa->getMahasiswaById($id);
			$this->tabelmahasiswa->close();
			return $row;
		} catch (Exception $e) {
			echo "[!] Error Get Mahasiswa " . $e->getMessage();
		}
	}

	function getId($i)
	{
		// mengembalikan id mahasiswa dengan indeks ke i
		return $this->data[$i]->getId();
	}

	function getNim($i)
	{
		// mengembalikan nim mahasiswa dengan indeks ke i
		return $this->data[$i]->getNim();
	}

	function getNama($i)
	{
		// mengembalikan nama mahasiswa dengan indeks ke i
		return $this->data[$i]->getNama();
	}

	function getTempat($i)
	{
		// mengembalikan tempat mahasiswa dengan indeks ke i
		return $this->data[$i]->getTempat();
	}

	function getTl($i)
	{
		// mengembalikan tanggal lahir(TL) mahasiswa dengan indeks ke i
		return $this->data[$i]->getTl();
	}

	function getGender($i)
	{
		// mengembalikan gender mahasiswa dengan indeks ke i
		return $this->data[$i]->getGender();
	}

	function getEmail($i)
	{
		// mengembalikan email mahasiswa dengan indeks ke i
		return $this->data[$i]->getEmail();
	}

	function getTelp($i)
	{
		// mengembalikan telp mahasiswa dengan indeks ke i
		return $this->data[$i]->getTelp();
	}

	function getSize()
	{

		return sizeof($this->data);
	}
}