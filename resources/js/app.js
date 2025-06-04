import './bootstrap';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Configure Toastr
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: 5000,
    extendedTimeOut: 1000,
};

window.toastr = toastr;

// Handle Laravel flash messages
if (window.laravelFlash) {
    Object.entries(window.laravelFlash).forEach(([type, message]) => {
        toastr[type](message);
    });
}
