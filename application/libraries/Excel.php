<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Compatibility shim: controllers use $this->excel as a spreadsheet object.
// Previously extended PHPExcel; now extends PhpSpreadsheet\Spreadsheet loaded via Composer.
class Excel extends \PhpOffice\PhpSpreadsheet\Spreadsheet
{
    public function __construct()
    {
        parent::__construct();
    }
}
