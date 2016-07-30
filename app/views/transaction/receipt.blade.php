<?php
	$pdf = PDF::loadView('pdf.invoice', $data);
	return $pdf->download('invoice.pdf');
?>