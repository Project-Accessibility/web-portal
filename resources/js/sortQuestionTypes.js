window.addEventListener('load', () => {
    new Sortable();
});

class Sortable {
    root;
    sortables;
    dragEnter = null;

    constructor() {
        this.root = document.querySelector('[sort-root]');
        this.sortables = this.root.querySelectorAll('[sort-item]');
        this.addListeners();
    }

    addListeners() {
        this.sortables.forEach(sortable => {
            sortable.querySelector('[up-button]').addEventListener('click',(e) => {
                e.preventDefault();

                this.sortUp(sortable);
            });
            sortable.querySelector('[down-button]').addEventListener('click',(e) => {
                e.preventDefault();
                this.sortDown(sortable);
            });
        });
    }

    sortUp(sortable){

    }

    sortDown(sortable){
        console.log(sortable);
    }
}
