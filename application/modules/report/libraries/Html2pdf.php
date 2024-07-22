<?php

/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/17/2017 AD
 * Time: 11:23
 */
require __DIR__ . '/vendor/autoload.php';
use Knp\Snappy\Pdf;

class Html2pdf
{
    private $snappy;
    private $_html;
    private $_path;
    private $_filename;
    const MODE_DOWNLOAD = 0;
    const MODE_EMBEDDED = 1;
    const MODE_SAVE = 2;
    const MODE_OPEN = 3;
    public function __construct()
    {
        // $this->snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
        // $this->snappy = new Pdf('C:/wkhtmltopdf/wkhtmltopdf.exe');
        $this->snappy = new Pdf(PATH_LIB_WKHTMLTOPDF); //include from config.php 
        
        $this->snappy->setOption('margin-top',0);
        $this->snappy->setOption('margin-right',0);
        $this->snappy->setOption('margin-bottom',0);
        $this->snappy->setOption('margin-left',0);
    }
    public function setOption($key,$option){
        $this->snappy->setOption($key,$option);
    }
    public function setPath($path)
    {
        if (realpath($path) === false) {
            throw new Exception("Path must be absolute");
        }
        $this->_path = realpath($path) . DIRECTORY_SEPARATOR;
        return $this;
    }



    public function getPath()
    {
        return $this->_path;
    }

    protected function _createFile()
    {
        do {
            $this->_filename = $this->getPath() . mt_rand() . '.pdf';
        } while (file_exists($this->_filename));

        return $this->_filename;
    }

    public function setHtml($html)
    {
        $this->_html = $html;
    }

    public function output($mode,$filename="",$option=array())
    {
        switch ($mode) {
            case self::MODE_DOWNLOAD:
                if (!headers_sent()) {
                    $result= $this->snappy->getOutputFromHtml($this->_html,$option);
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="'.$filename.'"');
                    header("Content-Length: " . strlen($result));
                    echo $result;
                    exit();
                } else {
                    throw new Exception("Headers already sent");
                }
                break;
            case self::MODE_EMBEDDED:
                if (!headers_sent()) {
                    $result= $this->snappy->getOutputFromHtml($this->_html,$option);
                    header("Content-type: application/pdf");
                    header("Cache-control: public, must-revalidate, max-age=0");
                    header("Pragme: public");
                    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
                    header("Last-Modified: " . gmdate('D, d m Y H:i:s') . " GMT");
                    header("Content-Length: " . strlen($result));
                    header('Content-Disposition: inline; filename="' . basename($filename) .'";');
                   echo  $result;
                    exit();
                } else {
                    throw new Exception("Headers already sent");
                }
                break;
            case self::MODE_SAVE:
                $fullpath = $this->_path . $filename;
                $this->snappy->generateFromHtml($this->_html, $fullpath);

                return $fullpath;
                break;
            case self::MODE_OPEN:
                $result=file_get_contents($this->_path . $filename);

                header("Content-type: application/pdf");
                header("Cache-control: public, must-revalidate, max-age=0");
                header("Pragme: public");
                header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
                header("Last-Modified: " . gmdate('D, d m Y H:i:s') . " GMT");
                header("Content-Length: " . strlen($result));
                header('Content-Disposition: inline; filename="' . basename($filename) .'";');
                echo  $result;
                break;
        }

    }
    public function getFilePath()
    {
        return $this->_filename;
    }
}