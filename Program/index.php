<!-- Saya Nuansa Bening Aura Jelita dengan NIM 2301410 mengerjakan Tugas Praktikum 9 dalam 
mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak 
melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. -->


<?php

include("view/TampilMahasiswa.php");

$tp = new TampilMahasiswa();

if (isset($_POST['add'])) {
	$tp->tambahKeDB($_POST);
} elseif (isset($_POST['update'])) {
	$tp->editKeDB($_POST['id'], $_POST);
} elseif (!empty($_GET['id_hapus'])) {
	$tp->hapusKeDB($_GET['id_hapus']);
} elseif (!empty($_GET['id_edit'])) {
	$tp->tampilEdit($_GET['id_edit']);
} elseif (isset($_GET['add'])) {
	$tp->tampilTambah();
} else {
	$tp->tampil();
}