<?php
if (!function_exists('toastr')) {
    function toastr(string $message, string $type = 'success'): void
    {
        session()->flash('toastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

if (!function_exists('_date')) {
    function _date($date, $format = null, $dateonly = false)
    {
        $site_date_f = 'd M Y';
        $site_time_f = 'h:iA';

        $setting_format = ($dateonly == true) ? $site_date_f : $site_date_f ;

        $_format = (empty($format)) ? $setting_format : $format;
        $result = (!empty($date)) ? $date : now();

        return !empty($date) ? date($_format, strtotime($result)) : null;
    }
}
