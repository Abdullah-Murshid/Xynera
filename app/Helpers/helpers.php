<?php

if (!function_exists('notify')) {
    /**
     * Flash a notification message to the session.
     *
     * @param string $message
     * @param string $type success|error|info|warning
     * @return void
     */
    function notify($message, $type = 'success'): void
    {
        session()->flash('notify', [
            'message' => $message,
            'type'    => $type,
        ]);
    }
}
