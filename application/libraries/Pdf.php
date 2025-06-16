<?php
require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }

    public function load_view($view, $data = [])
    {
        $CI = &get_instance();
        $html = $CI->load->view($view, $data, true);
        $this->loadHtml($html);
    }
}
