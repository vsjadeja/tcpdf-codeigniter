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

    function __construct() {
        parent::__construct();
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
