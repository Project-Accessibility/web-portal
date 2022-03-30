require('./bootstrap');

window.onload = () => {
    var elements = document.getElementsByClassName('clickable-row');

    Array.from(elements).forEach(function (element) {
        element.addEventListener('click', function (clickedElement) {
            window.location.href = element.dataset.href;
        });
    });
};
