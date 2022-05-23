import Swal from 'sweetalert2';

window.deleteConfirm = function (formId, removeText = '') {
    Swal.fire({
        title: 'Weet u zeker dat u dit wilt verwijderen?',
        html: `${removeText}`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Annuleren',
        confirmButtonText: 'Verwijder',
        confirmButtonColor: '#9b1100',
        cancelButtonColor: '#626264',
        iconColor: '#9b1100',
        showClass: {
            icon: '',
        },
        hideClass: {
            icon: '',
        },
    }).then(result => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
};
