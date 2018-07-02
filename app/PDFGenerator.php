<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCPDF;
use Auth;
use Storage;
use \Carbon\Carbon;

class PDF extends TCPDF {
    //Page header
    public function Header() {
        $letterhead_url = Auth::user()->letterhead;
        if(!is_null($letterhead_url) ){
          $image_encoded = base64_encode(file_get_contents($letterhead_url));
          $imgdata = base64_decode($image_encoded);
          $this->Image('@'.$imgdata,10,10,30);
        }
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


class PDFGenerator extends Model
{
    public static function makePDF($document){
      $doc_name = $document->name.'.pdf';
      $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $pdf->SetCreator($_ENV['APP_NAME']);
      $pdf->SetAuthor($_ENV['APP_NAME']);
      $pdf->SetTitle($doc_name);

      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      $pdf->AddPage();
      $pdf->Ln(8);
      $pdf->WriteHTML($document->formatDocumentText());

      //output file to browser
      $pdf->Output($doc_name,'I');

      return $res;

    }
}
