<?php

// Kelas yang berisikan tabel dari mahasiswa
class TabelMahasiswa extends DB
{
	function getMahasiswa()
	{
		// Query mysql select data mahasiswa
		$query = "SELECT * FROM mahasiswa";
		
		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function getMahasiswaById($id)
	{
		// Query mysql select data mahasiswa berdasarkan id
		$query = "SELECT * FROM mahasiswa WHERE id = '$id'";
		
		// Mengeksekusi query
		$this->execute($query);
		return $this->getResult();
	}
	
	function addMahasiswa($data)
	{
		// Query mysql insert atau add data mahasiswa
		$nim = $data['nim'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$tl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$telp = $data['telp'];
		
		$query = "INSERT INTO mahasiswa (nim, nama, tempat, tl, gender, email, telp) 
				VALUES ('$nim', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";
		
		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function updateMahasiswa($data)
	{
		// Query mysql update atau edit data mahasiswa
		$id = $data['id'];
		$nim = $data['nim'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$tl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$telp = $data['telp'];
		
		$query = "UPDATE mahasiswa 
				SET nim = '$nim', 
					nama = '$nama', 
					tempat = '$tempat', 
					tl = '$tl', 
					gender = '$gender', 
					email = '$email', 
					telp = '$telp' 
				WHERE id = '$id'";
		
		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function deleteMahasiswa($id)
	{
		// Query mysql delete data mahasiswa
		$query = "DELETE FROM mahasiswa WHERE id = '$id'";
		
		// Mengeksekusi query
		return $this->execute($query);
	}
}