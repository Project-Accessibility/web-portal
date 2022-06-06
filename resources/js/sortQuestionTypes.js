window.addEventListener('load', () => {
    new Sortable();
});

class Sortable {
    root;
    sortables;

    constructor() {
        this.root = document.querySelector('[sort-root]');
        this.sortables = this.root.querySelectorAll('[sort-item]');
        this.addListeners();
    }

    addListeners() {
        this.sortables.forEach(sortable => {
            sortable
                .querySelector('[up-button]')
                .addEventListener('click', e => {
                    e.preventDefault();

                    this.sortUp(sortable);
                });
            sortable
                .querySelector('[down-button]')
                .addEventListener('click', e => {
                    e.preventDefault();
                    this.sortDown(sortable);
                });
        });
    }

    sortUp(sortable) {
        const index = parseInt(sortable.getAttribute('sort-item'));
        if (index > 0) {
            const swapSortable = this.sortables[index - 1];
            swapSortable.setAttribute('sort-item', index);
            sortable.setAttribute('sort-item', index - 1);
            swapSortable.before(sortable);
            this.configureSortableIcons(index - 1, sortable);
            this.configureSortableIcons(index, swapSortable);
            this.sortables = this.root.querySelectorAll('[sort-item]');
        }
    }

    sortDown(sortable) {
        const index = parseInt(sortable.getAttribute('sort-item'));
        if (index < this.sortables.length - 1) {
            const swapSortable = this.sortables[index + 1];
            swapSortable.setAttribute('sort-item', index);
            sortable.setAttribute('sort-item', index + 1);
            swapSortable.after(sortable);
            this.configureSortableIcons(index + 1, sortable);
            this.configureSortableIcons(index, swapSortable);
            this.sortables = this.root.querySelectorAll('[sort-item]');
        }
    }

    configureSortableIcons(index, sortable) {
        const upButton = sortable.querySelector('[up-button]');
        const downButton = sortable.querySelector('[down-button]');
        upButton.hidden = index === 0;
        downButton.hidden = index === this.sortables.length - 1;
    }
}
