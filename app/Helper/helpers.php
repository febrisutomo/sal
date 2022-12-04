<?php

function rupiah(int $angka): string
{

	return "Rp " . number_format($angka, 0, ',', '.');
}

function tanggal(string $tanggal, bool $cetak_hari = false): string
{
	$tanggal = date('Y-m-j', strtotime($tanggal));
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
			
	$bulan = array (1 =>   'Januari',
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
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	
	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl;
	}
	return $tgl;
}


function bulan(string $tanggal): string
{
	$bulan = array (1 =>   'Januari',
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
				'Desember'
			);
	$split 	  = explode('-', $tanggal);

	return $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function num_format($number){
	return number_format(num: $number, thousands_separator: ".");
}
