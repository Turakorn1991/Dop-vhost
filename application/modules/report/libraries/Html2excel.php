<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:30
 */
require_once __DIR__ . '/ExportExcel/class.html_excel.php';

class Html2excel
{
    protected $htmlPhpExcel = null;
    protected $html;
    protected $path;

    const MODE_DOWNLOAD = 0;
    const MODE_EMBEDDED = 1;
    const MODE_SAVE = 2;
    public function __construct()
    {
        $this->htmlPhpExcel = new html_excel();
        $this->htmlPhpExcel->UTF8 = 'UTF-8';

    }
    public function setPath($path)
    {
        $this->path = $path;
    }
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    public function setData2Template($template, $data, $border, $start = 7)
    {
        $this->htmlPhpExcel->setData2Template($template, $data, $border, $start);
    }
    public function setData2TemplateWithSmallFont($template, $data, $border, $start)
    {
        $this->htmlPhpExcel->setData2TemplateWithSmallFont($template, $data, $border, $start);
    }
    /**
     * @param mixed $html
     */
    public function setHtml($data, $setting = array())
    {

        foreach ($data as $index => $val) {
            $this->htmlPhpExcel->html = $val['html'];
            $html = $this->htmlPhpExcel->loadhtml();

            if (@$setting['throw']) {
                $this->htmlPhpExcel->throw = $setting['throw'];
            }
            if (@$setting['throw_start']) {
                $this->htmlPhpExcel->throw_start = $setting['throw_start'];
            }
            $this->htmlPhpExcel->addData($html, $val['border'], $val['auto']);
            unset($html);
        }
        unset($data);
    }
    public function output($mode, $filename = "report", $option = array())
    {

        return $this->htmlPhpExcel->Output($filename, $this->path, 'D', 'excel', $option);
        switch ($mode) {
            case self::MODE_DOWNLOAD:
                if ($filename) {
                    $this->path = $filename;
                }
                return $this->htmlPhpExcel->Output($this->file, ROOTPATH . $this->path, '', 'excel', $option);
                break;
            case self::MODE_EMBEDDED:
                return $this->htmlPhpExcel->process()->getExcelObject();
                break;
            case self::MODE_SAVE:
                if ($filename) {
                    $this->path = $filename;
                }

                return $this->htmlPhpExcel->process()->save($this->path);
                break;
        }
    }

}
