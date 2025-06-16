<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Struk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User/Transaksi_model');
	}

	public function cetak_pdf($id_transaksi)
	{
		$transaksi = $this->Transaksi_model->get_transaksi($id_transaksi);
		$detail = $this->Transaksi_model->get_detail($id_transaksi);
		$user = $this->db->get_where('akun', ['id_akun' => $transaksi->id_user])->row();

		// Load view ke dalam variabel HTML
		$html = $this->load->view('user/struk_pdf', [
			'transaksi' => $transaksi,
			'detail' => $detail,
			'user' => $user
		], TRUE);

		// Setup Dompdf
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$options->set('isRemoteEnabled', true);

		$dompdf = new Dompdf($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A5', 'portrait');
		$dompdf->render();

		// Output sebagai PDF download
		$dompdf->stream("struk_transaksi_{$id_transaksi}.pdf", ["Attachment" => true]);
	}
}
