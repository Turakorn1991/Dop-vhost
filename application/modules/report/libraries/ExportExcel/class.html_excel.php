<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/14/12 AD
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */

require_once "class.export_excel.php";

class html_excel extends export_excel
{
    public $html = '';
    public $UTF8 = 1;
    public $qote = "'";
    public $rowstart = 1;
    public $throw = 0;
    public $throw_start = 1;

    public function setData2Template($template, $data, $border, $start = 7)
    {
        self::openFile($template);
        self::addSheetIndex(0);
        $this->icol = 0;
        foreach ($data['res']['headers'] as $index => $header) {
            $this->irow = $index + 1;
            self::writedataOnly($header, false);
        }

        $this->irow = $start;
        foreach ($data['res']['rows'] as $row_id => $row) {
            foreach ($row as $col_id => $col) {
                $this->icol = $col_id;
                self::writedataOnly($col, $border);
            }
            $this->irow++;
        }
    }
    public function setData2TemplateWithSmallFont($template, $data, $border, $start)
    {
        self::openFile($template);
        self::addSheetIndex(0);
        $this->icol = 0;
        foreach ($data['res']['headers'] as $index => $header) {
            $this->irow = $index + 1;
            self::writedataOnlyWithSmallFont($header);
        }

        $this->irow = $start;
        foreach ($data['res']['rows'] as $row_id => $row) {
            foreach ($row as $col_id => $col) {
                $this->icol = $col_id;
                self::writedataOnlyWithSmallFont($col);
            }
            $this->irow++;
        }

    }

    public function addSheetIndex($index)
    {
        parent::addSheetIndex($index);
        $this->rowstart = 1;
    }

    public function loadhtml()
    {
        $table = array();
        $tr = array();
        $td = array();
        $array_tag = array('TH' => 'th', 'TD' => 'td');
        $in = 0;
        $this->throw = 0;
        $this->throw_start = 1;
        $irow = 1;

        if (preg_match_all('/<thead>(.*?)<\/thead>/ism', $this->html, $thead)) {

            if (preg_match_all('/<tr([^>]*)>(.*?)<\/tr>/ism', $thead[0][0], $tr)) {
                $this->throw = count($tr[0]);
            }
        }

        if (preg_match_all('/<tr([^>]*)>(.*?)<\/tr>/ism', $this->html, $tr)) {
            foreach ($tr[0] as $in_tr => $data_tr) { //tr
                $row_his = 0;
                $icol = 0;

                //===========================
                foreach ($array_tag as $tagid => $tag) {
                    $th = array();
                    if (preg_match_all('/<' . $tag . '([^>]*)>(.*?)<\/' . $tag . '>/ism', $data_tr, $th)) {
                        $col = 0;
                        $col_his = 0;

                        foreach ($th[0] as $in_th => $data_th) { //td
                            $col++;
                            if ($irow > 1) {
                                while (isset($table[$in][$irow][$col])) {
                                    $col++;
                                }
                            }
                            $result = array();
                            $prop = $this->getproperty($th[1][$in_th]);
                            $result['row'] = $irow;
                            $result['col'] = $col;
                            $result['type'] = "$tagid";
                            $result['text'] = $this->removetag($th[2][$in_th]);
                            $result['property'] = $prop;
                            $col_his = @(int) $prop['COLSPAN'];
                            $table[$in][$irow][$col] = $result;
                            if (isset($prop['ROWSPAN']) && isset($prop['COLSPAN'])) {
                                for ($i = 0; $i < (int) $prop['ROWSPAN']; $i++) {
                                    for ($j = 0; $j < (int) $prop['COLSPAN']; $j++) {
                                        //$xcol=($j%$prop['COLSPAN']);
                                        if (!is_array($table[$in][$irow + $i][$col + $j])) {
                                            $table[$in][$irow + $i][$col + $j] = $result['text'];
                                        }
                                    }
                                }
                            } else {
                                if (@(int) $prop['ROWSPAN'] > 0) {
                                    for ($i = 1; $i < (int) $prop['ROWSPAN']; $i++) {
                                        if (!isset($table[$in][$irow + $i][$col])) {
                                            $table[$in][$irow + $i][$col] = $result['text'];
                                        }

                                    }
                                }

                                if (@(int) $prop['COLSPAN'] > 0) {
                                    for ($j = 1; $j < (int) $prop['COLSPAN']; $j++) {
                                        if (!isset($table[$in][$irow][$col + $j])) {
                                            $table[$in][$irow][$col + $j] = $result['text'];
                                        }
                                    }
                                }

                            }

                            $col = ($col_his > 0) ? ($col_his) + $col - 1 : $col;
                        }
                    }

                } //tag

                $irow++;

            }
        }
        return $table;
    }

    private function removetag($content)
    {
        $content = ltrim($content);
        $content = preg_replace('#<br\s*/?>#', "\r\n", $content);
        $content = preg_replace('/<[^>]*>/', '', $content);
        $content = str_replace('&nbsp;', ' ', $content);
        if ($content != "") {
            if (substr($content, 0, 1) == "0") {
                $content = " " . $content;
            }

        }
        return $content;
    }

    public function getproperty($result)
    {
        $mm = array();
        $pro = array();
        $result = strtoupper($result);

        if ($this->qote == "'") {
            if (preg_match_all("/BOLD=[\'](.*?)[\']/ism", $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['BOLD'] = $val;
                }
            }
            if (preg_match_all("/BORDER=[\'](.*?)[\']/ism", $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['BORDER'] = $val;

                }
            }
            if (preg_match_all("/ALIGN=[\'](.*?)[\']/ism", $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['ALIGN'] = $val;

                }
            }
            if (preg_match_all("/COLSPAN=[\'](.*?)[\']/ism", $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['COLSPAN'] = $val;

                }
            }
            if (preg_match_all("/ROWSPAN=[\'](.*?)[\']/ism", $result, $mm)) { //ROWSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['ROWSPAN'] = $val;

                }
            }
            if (preg_match_all("/EXCEL-WIDTH=[\'](.*?)[\']/ism", $result, $mm)) { //ROWSPAN

                foreach ($mm[1] as $in => $val) { //td
                    $pro['WIDTH'] = $val;

                }
            }
            if (preg_match_all("/EXCEL-INDENT=[\'](.*?)[\']/ism", $result, $mm)) { //ROWSPAN

                foreach ($mm[1] as $in => $val) { //td
                    $pro['INDENT'] = $val;

                }
            }
            if (preg_match_all("/EXCEL-LINE=[\'](.*?)[\']/ism", $result, $mm)) { //ROWSPAN

                foreach ($mm[1] as $in => $val) { //td
                    $pro['LINE'] = $val;

                }
            }
            if (preg_match_all("/BGCOLOR=[\'](.*?)[\']/ism", $result, $mm)) { //ROWSPAN

                foreach ($mm[1] as $in => $val) { //td
                    $pro['BGCOLOR'] = $val;

                }
            }
            if (preg_match_all("/EXCEL-FSIZE=[\'](.*?)[\']/ism", $result, $mm)) { //ROWSPAN

                foreach ($mm[1] as $in => $val) { //td
                    $pro['FSIZE'] = $val;

                }
            }
            if (preg_match_all("/TYPE=[\'](.*?)[\']/ism", $result, $mm)) { //ROWSPAN

                foreach ($mm[1] as $in => $val) { //td
                    $pro['TYPE'] = $val;

                }
            }
        } else {
            if (preg_match_all('/BOLD=[\"](.*?)[\"]/ism', $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['BOLD'] = $val;

                }
            }
            if (preg_match_all('/BORDER=[\"](.*?)[\"]/ism', $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['BORDER'] = $val;

                }
            }
            if (preg_match_all('/ALIGN=[\"](.*?)[\"]/ism', $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['ALIGN'] = $val;

                }
            }
            if (preg_match_all('/COLSPAN=[\"](.*?)[\"]/ism', $result, $mm)) { //COLSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['COLSPAN'] = $val;

                }
            }
            if (preg_match_all('/ROWSPAN=[\"](.*?)[\"]/ism', $result, $mm)) { //ROWSPAN
                foreach ($mm[1] as $in => $val) { //td
                    $pro['ROWSPAN'] = $val;

                }
            }
            if (preg_match_all('/EXCEL-WIDTH=[\"](.*?)[\"]/ism', $result, $mm)) { //WIDTH

                foreach ($mm[1] as $in => $val) { //td
                    $pro['WIDTH'] = $val;

                }
            }
            if (preg_match_all('/EXCEL-INDENT=[\"](.*?)[\"]/ism', $result, $mm)) { //WIDTH

                foreach ($mm[1] as $in => $val) { //td
                    $pro['INDENT'] = $val;

                }
            }
            if (preg_match_all('/EXCEL-LINE=[\"](.*?)[\"]/ism', $result, $mm)) { //WIDTH

                foreach ($mm[1] as $in => $val) { //td
                    $pro['LINE'] = $val;

                }
            }
            if (preg_match_all('/BGCOLOR=[\"](.*?)[\"]/ism', $result, $mm)) { //WIDTH

                foreach ($mm[1] as $in => $val) { //td
                    $pro['BGCOLOR'] = $val;

                }
            }
            if (preg_match_all('/EXCEL-FSIZE=[\"](.*?)[\"]/ism', $result, $mm)) { //WIDTH

                foreach ($mm[1] as $in => $val) { //td
                    $pro['FSIZE'] = $val;

                }
            }
            if (preg_match_all('/TYPE=[\"](.*?)[\"]/ism', $result, $mm)) { //WIDTH

                foreach ($mm[1] as $in => $val) { //td
                    $pro['TYPE'] = $val;

                }
            }
        }

        return $pro;
    }

    public function setcaption($caption)
    {
        $this->caption = $caption;
    }

    public function addData($data, $border = false)
    {
        foreach ($data as $tblid => $table) {
            foreach ($table as $rowid => $row) {
                foreach ($row as $colid => $col) {
                    if (is_array($col)) {
                        $this->icol = $col['col'];
                        $this->irow = $this->rowstart;
                        if ($col['text'] && is_string($col['text'])) {
                            //$col['text']=  $col['text'];
                        }
                        $_border = $border;
                        if (@$col['property']['BORDER']) {
                            $_border = (strtolower($col['property']['BORDER']) == 'false') ? false : true;
                        }
                        self::writedata($col['text'], $col['type'], $col['property'], $_border);
                    }
                }
                $this->rowstart++;
            }

        }
        self::setRepeatHeaderTable($this->throw_start, $this->throw);
    }

    public function Output($filename, $path = "", $action = "", $type = "excel", $setting = array())
    {
        return self::export($filename, $path, $action, $type, $setting);
    }
}
