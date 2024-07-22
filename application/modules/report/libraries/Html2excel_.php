<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:30
 */
require_once(__DIR__ .'/vendor/autoload.php');
use Ticketpark\HtmlPhpExcel\HtmlPhpExcel;
class Html2excel
{
    protected $htmlPhpExcel=null;
    protected $html;
    protected $path;

    const MODE_DOWNLOAD = 0;
    const MODE_EMBEDDED = 1;
    const MODE_SAVE = 2;
    public function __construct()
    {

    }
    public function setPath($path)
    {
        $this->path=$path;
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

    /**
     * @param mixed $html
     */
    public function setHtml($html)
    {
        $this->html=$html;
        $this->htmlPhpExcel=new HtmlPhpExcel($this->html);
        $this->htmlPhpExcel->utf8DecodeValues();
    }
    public function output($mode,$filename="",$option=array())
    {
        switch ($mode) {
            case self::MODE_DOWNLOAD:
                if($filename) {
                    $this->path = $filename;
                }
                return $this->htmlPhpExcel->process()->output($this->path);
                break;
            case self::MODE_EMBEDDED:
                return  $this->htmlPhpExcel->process()->getExcelObject();
                break;
            case self::MODE_SAVE:
                if($filename){
                    $this->path=$filename;
                }

                return $this->htmlPhpExcel->process()->save($this->path);
                break;
        }
    }


}