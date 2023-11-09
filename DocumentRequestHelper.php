<?php

function getStatusClass($status) {
    switch ($status) {
        case 'Pending':
            return 'status-pending';
        case 'Approved':
            return 'status-approved';
        case 'Declined':
            return 'status-declined';
        case 'Completed':
            return 'status-completed';
        default:
            return '';
    }
}
