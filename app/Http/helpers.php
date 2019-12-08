<?php
if(!function_exists('status_laporan_surat_tugas')){
	function status_laporan_surat_tugas($value=NULL){
		$display = "-";
		switch ($value) {
			case '1':
				$display = 'Approved by Kasubag TU';
				break;
			case '2':
				$display = 'Approved by Inspektur';
				break;
			case '3':
				$display = 'Approved by TU SES';
				break;
			case '4':
				$display = 'Completed';
				break;
			default:
				$display = "-";
				break;
		}
		return $display;
	}
}