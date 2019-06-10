<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Map_Log extends CI_Log
{
    /**
     * No. of days until the files are deleted
     **/
    private $logs_files_for =2;
    function __construct()
    {
        
        log_message('debug', 'Log_Maintenance : class loaded');
        parent::__construct();
        $this->CI = &get_instance();
        // check whether the config is a numeric number before assigning
        if ($this->CI->config->item('logs_files_for')!=NULL)
            $this->logs_files_for = (int)(is_numeric($this->CI->config->item('logs_files_for')) ? $this->CI->config->item('logs_files_for') : 15);
        // delete the old log files
        $this->delete_logs();
       
    }
    /**
     * Delete log files older than 
     **/
    function delete_logs()
    {
        $dir = ($this->CI->config->item('log_path') != '') ? $this->CI->config->item('log_path') : APPPATH . 'logs/';
        // this can be:
        // $dir = ($this->CI->config->item('log_path') ?: APPPATH.'logs/');
        // ternary shorthand if operator (for PHP >= 5.3 only)
        log_message('debug', 'Log_Maintenance : log dir: ' . $dir);
        if (!is_dir($dir) or !is_really_writable($dir)) {
            return false;
        }
        $deleted = 0;
        $kept = 0;
        $files = glob($dir . 'log*.php'); // all files in the directory that starts with 'log' and ends with '.php'
        foreach ($files as $file) { // loop over all matched files
            // check how old they are
            if (filemtime($file) < strtotime('-' . ($this->logs_files_for - 1) . ' days')) {
                unlink($file);
                $deleted++;
            } else {
                $kept++;
            }
        }
        $total = $deleted + $kept;
        if ($deleted > 0) {
            log_message('info', $total . ' log files: ' . $deleted . ' deleted, ' . $kept . ' kept.');
        }
        $a = array('total' => $total, 'deleted' => $deleted, 'kept' => $kept);
        return $a;
    }
}
