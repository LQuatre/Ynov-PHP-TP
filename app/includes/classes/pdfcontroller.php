<?php

namespace class;

use FPDF;

require('/app/fpdf/fpdf.php');


class FPDFController extends FPDF
{
    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }

    // Method to add a title to the PDF
    public function addTitle($title)
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, $title, 0, 1, 'C');
        $this->Ln(10); // Add a line break
    }

    // Method to add a simple header
    public function addHeader($text)
    {
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, $text, 0, 1, 'L');
        $this->Ln(5);
    }

    // Method to add a footer
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Method to add content to the PDF
    public function addContent($content)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $content);
        $this->Ln(5);
    }

    public function generatePdf($cv, $member) {
        $pdf = new FPDF();
        $pdf->AddPage();

// Set title
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'Curriculum Vitae', 0, 1, 'C');
        $pdf->Ln(5);

// Add Name Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Personal Information', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, 'Firstname: ' . $member->get('firstname'), 0, 1);
        $pdf->Cell(0, 8, 'Lastname: ' . $member->get('lastname'), 0, 1);
        $pdf->Cell(0, 8, 'Email: ' . $cv['email'], 0, 1);
        $pdf->Cell(0, 8, 'Phone: ' . $cv['phone'], 0, 1);
        $pdf->Cell(0, 8, 'Address: ' . $cv['address'], 0, 1);
        $pdf->Ln(5);

// Add Education Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Education', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, $cv['education']);
        $pdf->Ln(5);

// Add Experience Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Professional Experience', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, $cv['experience']);
        $pdf->Ln(5);

// Add Skills Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Skills', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, $cv['skills']);
        $pdf->Ln(5);

// Output the PDF
        $pdf->Output('D', 'cv_' . $cv['id'] . '.pdf');
    }
}