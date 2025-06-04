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
