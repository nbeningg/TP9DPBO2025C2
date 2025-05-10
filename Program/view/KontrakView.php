<?php

interface KontrakView
{
	public function tampil();
	public function tampilTambah();
	public function tampilEdit($id);
	public function tambahKeDB($data);
	public function editKeDB($id, $data);
	public function hapusKeDB($id);
}