<?php

function rupiah($angka)
{

	return "Rp " . number_format($angka, 0, ',', '.');
}

function tanggal($tanggal)
{
	$bulan = [
		1 => 'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember',
	];

	$var = explode('-', $tanggal);

	return $var[2] . ' ' . $bulan[(int) $var[1]] . ' ' . $var[0];
}
