<?php

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		// Konstruktor
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
		$data = null;

		// Semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
			<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
			<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
			<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
			<td>
				<a href='index.php?id_edit=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-warning btn-sm'>Edit</a>
				<a href='index.php?id_hapus=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
			</td>
			</tr>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Menambahkan tombol tambah
		$addButton = "<a href='index.php?add' class='btn btn-success mb-3'>Tambah Mahasiswa</a>";
		$this->tpl->replace("DATA_BUTTON", $addButton);
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function tampilTambah()
	{
		$this->tpl = new Template("templates/form.html");
		$this->tpl->replace("DATA_FORM_TITLE", "Tambah Mahasiswa");
		$this->tpl->replace("DATA_ID", "");
		$this->tpl->replace("DATA_NIM", "");
		$this->tpl->replace("DATA_NAMA", "");
		$this->tpl->replace("DATA_TEMPAT", "");
		$this->tpl->replace("DATA_TL", "");
		$this->tpl->replace("DATA_GENDER_L", "");
		$this->tpl->replace("DATA_GENDER_P", "");
		$this->tpl->replace("DATA_EMAIL", "");
		$this->tpl->replace("DATA_TELP", "");
		$this->tpl->replace("DATA_BUTTON_NAME", "add");
		$this->tpl->replace("DATA_BUTTON_VALUE", "add");
		$this->tpl->replace("DATA_BUTTON_LABEL", "Tambah");
		$this->tpl->write();
	}

	function tampilEdit($id)
	{
		$data = $this->prosesmahasiswa->getMahasiswaById($id);
		$this->tpl = new Template("templates/form.html");
		$this->tpl->replace("DATA_FORM_TITLE", "Edit Mahasiswa");
		$this->tpl->replace("DATA_ID", $data['id']);
		$this->tpl->replace("DATA_NIM", $data['nim']);
		$this->tpl->replace("DATA_NAMA", $data['nama']);
		$this->tpl->replace("DATA_TEMPAT", $data['tempat']);
		$this->tpl->replace("DATA_TL", $data['tl']);
		$this->tpl->replace("DATA_GENDER_L", $data['gender'] == 'Laki-laki' ? 'checked' : '');
		$this->tpl->replace("DATA_GENDER_P", $data['gender'] == 'Perempuan' ? 'checked' : '');
		$this->tpl->replace("DATA_EMAIL", $data['email']);
		$this->tpl->replace("DATA_TELP", $data['telp']);
		$this->tpl->replace("DATA_BUTTON_NAME", "update");
		$this->tpl->replace("DATA_BUTTON_VALUE", "update");
		$this->tpl->replace("DATA_BUTTON_LABEL", "Update");
		$this->tpl->write();
	}

	function tambahKeDB($data)
	{
		$result = $this->prosesmahasiswa->addData($data);
		if ($result) {
			header("Location: index.php");
		} else {
			echo "Gagal menambah data.";
		}
	}

	function editKeDB($id, $data)
	{
		$data['id'] = $id; // Tambahkan ID ke data
		$result = $this->prosesmahasiswa->updateData($data);
		if ($result) {
			header("Location: index.php");
		} else {
			echo "Gagal memperbarui data.";
		}
	}

	function hapusKeDB($id)
	{
		$result = $this->prosesmahasiswa->deleteData($id);
		if ($result) {
			header("Location: index.php");
		} else {
			echo "Gagal menghapus data.";
		}
	}
}