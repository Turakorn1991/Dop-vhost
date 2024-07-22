<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/14/12 AD
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */

//

require_once 'PHPExcel.php';

class export_excel
{
    protected $irow = 1;
    protected $icol = 1;
    private $fname;

    private $objPHPExcel;
    private $styleThinBlackBorderOutline;
    public function openFile($file)
    {
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $this->objPHPExcel = $objReader->load($file); // Empty Sheet
    }
    public function setRow($int)
    {
        $this->irow = $int;
    }
    public function export_excel()
    {

        $this->objPHPExcel = new PHPExcel();
        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->init();
    }

    public function setSheetName($name = "")
    {
        if ($name) {
            $this->objPHPExcel->getActiveSheet()->setTitle($name);
        }
    }

    public function setRepeatHeaderTable($start = 1, $end = 0)
    {
        if ($end) {
            $this->objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, $end);
        }
    }

    public function setSheetIndex($index)
    {
        $this->objPHPExcel->setActiveSheetIndex($index);
    }

    public function addSheetIndex($index)
    {
        try {
            $this->objPHPExcel->setActiveSheetIndex($index);
        } catch (Exception $e) {
            $this->objPHPExcel->createSheet();
            $this->objPHPExcel->setActiveSheetIndex($index);
        }
        $this->init();
    }
    public function init()
    {
        $this->irow = 1;
        $this->icol = 1;
        $this->styleThinBlackBorderOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );
    }
    public function writedataOnly($text, $border = false)
    {
        $this->objPHPExcel->getActiveSheet()->getRowDimension($this->irow)->setRowHeight(18);
        $col = $this->getIntToChar($this->icol);
        $cell = $col . $this->irow;
        $fontsize = 14;
        if (strlen($text) == '13' && is_numeric($text)) {
            $this->objPHPExcel->getActiveSheet()->setCellValueExplicit($cell, $text, PHPExcel_Cell_DataType::TYPE_STRING);
        } else {
            $this->objPHPExcel->getActiveSheet()->setCellValue($cell, $text);
        }

        $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell")->getFont()->setName('TH SarabunPSK')->setSize($fontsize);
        if ($border) {
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell")->applyFromArray($this->styleThinBlackBorderOutline);
        }
    }
    public function writedataOnlyWithSmallFont($text, $border = false)
    {
        $this->objPHPExcel->getActiveSheet()->getRowDimension($this->irow)->setRowHeight(18);
        $col = $this->getIntToChar($this->icol);
        $cell = $col . $this->irow;
        $fontsize = 10;
        if (strlen($text) == '13' && is_numeric($text)) {
            $this->objPHPExcel->getActiveSheet()->setCellValueExplicit($cell, $text, PHPExcel_Cell_DataType::TYPE_STRING);
        } else {
            $this->objPHPExcel->getActiveSheet()->setCellValue($cell, $text);
        }

        $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell")->getFont()->setName('Calibri')->setSize($fontsize);
        if ($border) {
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell")->applyFromArray($this->styleThinBlackBorderOutline);
        }
    }
    public function writedata($text, $type, $prop, $border = false)
    {
        $this->objPHPExcel->getActiveSheet()->getRowDimension($this->irow)->setRowHeight(25);
        $col = $this->getIntToChar($this->icol);

        $cell = $col . $this->irow;
        $cell2 = $cell;
        if (@$prop['TYPE'] == "NUMBER") {
            $text = ($text) ? (float) str_replace(",", '', $text) : "";
        }
        if (!$text && @$prop['LINE']) {
            $text = " ";
        }
        $this->objPHPExcel->getActiveSheet()->setCellValue($cell, $text);
        $fontsize = 16;
        if (@$prop['FSIZE']) {
            $fontsize = (int) $prop['FSIZE'];
        }
        $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFont()->setName('TH SarabunPSK')->setSize($fontsize);
        //  $this->objPHPExcel->getActiveSheet()->getColumnDimension($this->getIntToChar($this->icol))->setAutoSize(true);
        if (@$prop['ROWSPAN'] > 0 || @$prop['COLSPAN'] > 0) {
            $last_row = (@$prop['ROWSPAN'] > 0) ? $prop['ROWSPAN'] + $this->irow - 1 : $this->irow;
            $last_col = (@$prop['COLSPAN'] > 0) ? $prop['COLSPAN'] + $this->icol - 1 : $this->icol;
            $cell2 = $this->getIntToChar($last_col) . $last_row;
            $this->objPHPExcel->getActiveSheet()->mergeCells("$cell:$cell2");
        }
        if (@$prop['INDENT']) {
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setIndent($prop['INDENT']);
        }

        if (@$prop['WIDTH']) {
            if (is_bool($prop['WIDTH'])) {
                $this->objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize($prop['WIDTH']);
            } else if (is_int($prop['WIDTH'])) {
                $this->objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth((int) $prop['WIDTH']);
            } else {
                $this->objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth((int) $prop['WIDTH']);
            }

        }

        if ($border) {
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->applyFromArray($this->styleThinBlackBorderOutline);
        }

        $lines = preg_split("/\r\n?|\n/", $text);
        if (count($lines) > 1) {
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setWrapText(true);
        }

        if (@$prop['LINE']) {

            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setPath(ROOTPATH . 'assets/dist/images/arrow_line_sm.png');
            $objDrawing->setCoordinates("$cell");
            $objDrawing->setResizeProportional(false);
            $objDrawing->setHeight(3);
            $objDrawing->setOffsetY(5);
            $objDrawing->setOffsetX(5);
            $objDrawing->setWorksheet($this->objPHPExcel->getActiveSheet());

        }
        if (@$prop['BGCOLOR']) {
            $this->objPHPExcel->getActiveSheet()
                ->getStyle("$cell:$cell2")
                ->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => str_replace('#', '', $prop['BGCOLOR'])),
                        ),
                    )
                );
        }

        if (@$prop['TYPE'] == "NUMBER") {

            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getNumberFormat()->setFormatCode('#,##0.00');
        }

        $this->objPHPExcel->getActiveSheet()->getColumnDimension($this->getIntToChar($this->icol))->setAutoSize(true);

        if ($type == "TH") { // header
            $style_format_V = PHPExcel_Style_Alignment::VERTICAL_CENTER;
            $style_format_H = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
            if (@$prop['ALIGN'] == "CENTER") {
                $style_format_H = PHPExcel_Style_Alignment::VERTICAL_CENTER;
            } elseif (@$prop['ALIGN'] == "LEFT") {
                $style_format_H = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
            } elseif (@$prop['ALIGN'] == "RIGHT") {
                $style_format_H = PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
            }
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setHorizontal($style_format_H);
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setVertical($style_format_V);
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFont()->setBold(true);
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFill()->getStartColor()->setARGB('F2F2F2');

        } else {
            $style_format_V = PHPExcel_Style_Alignment::VERTICAL_CENTER;
            $style_format_H = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
            if (@$prop['ALIGN'] == "CENTER") {
                $style_format_H = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
            } elseif (@$prop['ALIGN'] == "LEFT") {
                $style_format_H = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
            } elseif (@$prop['ALIGN'] == "RIGHT") {

                $style_format_H = PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
            }
            if (@$prop['BOLD'] == "TRUE") {

                $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getFont()->setBold(true);
            }

            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setHorizontal($style_format_H);
            $this->objPHPExcel->getActiveSheet()->getStyle("$cell:$cell2")->getAlignment()->setVertical($style_format_V);
        }

    }

    public function export($xlsname = '', $path = "", $download = '', $type = 'excel', $setting = array())
    {
        $this->fname = $xlsname;
        if (@$setting['watermark']) {
            $this->objPHPExcel->Watermark = $setting['watermark'];
        }

        if (@$setting['orientation']) {
            if ($setting['orientation'] == "P") {
                $this->objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
            } else {
                $this->objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            }
        }
        $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F Page &P / &N &G&');
        $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setEvenFooter('&R&F Page &P / &N &G&');

        $ext = ".xlsx";
        if ($type == "pdf" || $type == "all") {
            $ext = ".pdf";
            $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
            $rendererLibrary = 'mPDF';
            $rendererLibraryPath = dirname(__FILE__) . '/libraries/PDF/' . $rendererLibrary;
            if (!PHPExcel_Settings::setPdfRenderer(
                $rendererName,
                $rendererLibraryPath
            )
            ) {
                die(
                    'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                    '<br />' .
                    'at the top of this script as appropriate for your directory structure'
                );

            }
        }
        if (@$setting['noneFileRnd']) {
            $rndsname = $path . $this->fname;
        } else {
            $rndsname = $path . $this->fname . "_" . $this->GenFilename(10, date('ymd'));
        }

        if ($type == "all") {
            $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'PDF');
            if (@$setting['multiSheet']) {
                $objWriter->writeAllSheets();
            }
            $objWriter2 = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');

        } elseif ($type == "pdf") {
            $rndsname = $rndsname . $ext;
            $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'PDF');
            if (@$setting['multiSheet']) {
                $objWriter->writeAllSheets();
            }
        } else {
            $rndsname = $rndsname . $ext;
            $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        }
        ob_end_clean();
        if ($download == "D") {
            if ($type == "pdf") {
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment;filename="' . $this->fname . '.pdf"');
                header('Cache-Control: max-age=0');

                header('Date: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0
                header('Set-Cookie: fileDownload=true; path=/');
            } else {
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $this->fname . '.xlsx"');
                header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
                header('Date: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0
                header('Set-Cookie: fileDownload=true; path=/');
            }
            $objWriter->save('php://output');
        } else {
            if ($type == "all") {
                $objWriter->save($rndsname . ".pdf");
                $objWriter2->save($rndsname . ".xlsx");
                return array('pdf' => $rndsname . ".pdf", 'excel' => $rndsname . ".xlsx");
            } else {
                $objWriter->save($rndsname);
                return $rndsname;
            }
        }
    }

    private function GenFilename($length = 5, $prename = "")
    {
        $template = "1234567890abcdefghijklmnopqrstuvwxyz";
        settype($length, "integer");
        settype($rndstring, "string");
        settype($a, "integer");
        settype($b, "integer");

        for ($a = 0; $a <= $length; $a++) {
            $b = mt_rand(0, strlen($template) - 1);
            $rndstring .= $template[$b];
        }
        return $prename . $rndstring;
    }

    private function using_ie()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $ub = false;
        if (preg_match('/MSIE/i', $u_agent)) {
            $ub = true;
        }
        return $ub;
    }

    protected function getIntToChar($num)
    {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return $this->getIntToChar($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }
}
