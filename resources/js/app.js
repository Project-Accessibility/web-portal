require('./bootstrap');

window.onload = () => {
    var elements = document.getElementsByClassName('clickable-row');

    Array.from(elements).forEach(function (element) {
        element.addEventListener('click', function (clickedElement) {
            window.location.href = element.dataset.href;
        });
    });

    document.querySelectorAll('span[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('show.bs.tab', function (event) {
            let query = event.target.dataset.bsTarget.substring(1)
            let currentUrl = window.location.href

            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });

            let tabQuery = params.tab

            let nextUrl;
            if(currentUrl.indexOf('?tab=') > -1) {
                nextUrl = currentUrl.replace('?tab=' + tabQuery, '?tab=' + query)
            } else {
                console.log('not included yet')
                nextUrl = currentUrl + '?tab=' + query
            }

            window.history.pushState('', '', nextUrl);
        })
    });
};
