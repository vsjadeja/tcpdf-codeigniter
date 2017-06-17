<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

/**
 * Pdf library for CI using TCPDF.
 *
 * @author Virendra Jadeja
 */
class Pdf extends TCPDF {

    protected $_ci;

    /**
     * Pdf class constructor
     * 
     * @param $orientation (string) page orientation. Possible values are (case insensitive):<ul><li>P or Portrait (default)</li><li>L or Landscape</li><li>'' (empty string) for automatic orientation</li></ul>
     * @param $unit (string) User measure unit. Possible values are:<ul><li>pt: point</li><li>mm: millimeter (default)</li><li>cm: centimeter</li><li>in: inch</li></ul><br />A point equals 1/72 of inch, that is to say about 0.35 mm (an inch being 2.54 cm). This is a very common unit in typography; font sizes are expressed in that unit.
     * @param $format (mixed) The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
     * @param $unicode (boolean) TRUE means that the input text is unicode (default = true)
     * @param $encoding (string) Charset encoding (used only when converting back html entities); default is UTF-8.
     * @param $diskcache (boolean) DEPRECATED FEATURE
     * @param $pdfa (boolean) If TRUE set the document to PDF/A mode.
     */
    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false) {
        parent::__construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false);
        $this->_ci = & get_instance();

        log_message('debug', 'Pdf Class Initialized');

        $this->_ci->load->config('pdf');

        if ($this->_ci->config->item('creator')):
            $this->SetCreator($this->_ci->config->item('creator'));
        endif;

        if ($this->_ci->config->item('author')):
            $this->SetAuthor($this->_ci->config->item('author'));
        endif;

        if ($this->_ci->config->item('title')):
            $this->SetTitle($this->_ci->config->item('title'));
        endif;

        if ($this->_ci->config->item('subject')):
            $this->SetSubject($this->_ci->config->item('subject'));
        endif;

        if ($this->_ci->config->item('keywords')):
            $this->SetKeywords($this->_ci->config->item('keywords'));
        endif;
    }

    /**
     * Overriding header of PDF
     */
    public function Header() {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }

    /**
     * Overriding footer of PDF
     */
    public function Footer() {
        
    }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
