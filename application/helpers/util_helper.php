<?php
defined('BASEPATH') or exit('No direct script access allowed.');

if (!function_exists("genunqid")) {
    function genunqid($slug, $id, $date=NULL)
    {
        $data = array(
            "0" => "ENQ",
            "1" => "QTN",
            "2" => "POR",
            "3" => "POI",
        );
        $formated_date = date("Y");
        $financial_year = get_financial_year($formated_date);
        return $data[$slug] . $financial_year . "-" . $id;
    }
}
if (!function_exists("get_financial_year")) {
    function get_financial_year($year)
    {
        $financial_year = "";
        if (date('m') >= 3) {
            $current_year = date('y') + 1;
            $financial_year = $year . "" . $current_year;
        } else {
            $pre_year = date('Y') - 1;
            $financial_year = $pre_year . "" . substr($year, -2);
        }
        return $financial_year;
    }
}
