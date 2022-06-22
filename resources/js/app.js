require('./bootstrap');
require('./deletePopup');
require('../../node_modules/bootstrap-select/dist/js/bootstrap-select.min');
window.onload = () => {
    // If there is on the initial page load a tab query given, the PHP code will handle this.
    if (window.location.href.indexOf('?tab=') === -1) {
        createActiveBreadCrumb();
    }

    const elements = document.getElementsByClassName('clickable-row');

    Array.from(elements).forEach(function (element) {
        element.addEventListener('click', function (clickedElement) {
            window.location.href = element.dataset.href;
        });
    });

    document.querySelectorAll('span[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('show.bs.tab', function (event) {
            let query = event.target.dataset.bsTarget.substring(1);
            let currentUrl = window.location.href;

            let tabQuery = getTabQuery();

            createActiveBreadCrumb(query);

            let nextUrl;
            if (currentUrl.indexOf('?tab=') > -1) {
                nextUrl = currentUrl.replace(
                    '?tab=' + tabQuery,
                    '?tab=' + query
                );
            } else {
                nextUrl = currentUrl + '?tab=' + query;
            }

            window.history.replaceState('', '', nextUrl);
        });
    });
};

function getTabQuery() {
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    return params.tab;
}

function createActiveBreadCrumb(query) {
    let breadcrumbs = document.getElementById('breadcrumbs');
    if (breadcrumbs) {
        // If there is no given query because of the initial page load.
        if (!query) {
            let activeTab = document.querySelector(
                'span#link-Details.nav-link.active'
            );

            if (!activeTab) {
                return;
            }

            query = activeTab.innerText;
        }

        let tabQuery = getTabQuery();

        let currentUrl = window.location.href;
        let lastBreadcrumb = breadcrumbs.lastElementChild;
        let fullClassList = lastBreadcrumb.classList;

        // If there is a query given in the url, there is already a tab breadcrumb.
        if (tabQuery) {
            breadcrumbs.removeChild(lastBreadcrumb);
        } else {
            lastBreadcrumb.classList.remove('active');

            let link = document.createElement('a');
            link.setAttribute('href', currentUrl.split('?')[0]);
            link.innerText = lastBreadcrumb.innerText;
            lastBreadcrumb.innerText = null;
            lastBreadcrumb.appendChild(link);
        }

        let newBreadcrumb = document.createElement('li');
        newBreadcrumb.classList = fullClassList;
        newBreadcrumb.innerText = capitalizeFirstLetter(query);

        breadcrumbs.appendChild(newBreadcrumb);
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
}
