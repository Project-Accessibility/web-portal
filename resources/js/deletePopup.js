import Swal from 'sweetalert2';

window.deleteConfirm = function (formId, removeText = '') {
    Swal.fire({
        title: 'Weet u zeker dat u dit wilt verwijderen?',
        html: `${removeText}`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Annuleren',
        confirmButtonText: 'Verwijder',
        confirmButtonColor: '#e3342f',
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
