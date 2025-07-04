<?php
require_once dirname(__FILE__) . '/tcpdf.php';

class Pdf extends TCPDF {
    public function __construct() {
        parent::__construct();
    }

    // Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo.png';
        if(file_exists($image_file)) {
            $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Laporan Aktivitas', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
} 