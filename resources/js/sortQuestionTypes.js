window.addEventListener('load', () => {
    new Sortable();
});

class Sortable {
    root;
    draggables;
    dragEnter = null;

    constructor() {
        this.root = document.querySelector('[drag-root]');
        this.draggables = this.root.querySelectorAll('[drag-item]');
        this.addListeners();
    }

    addListeners() {
        this.draggables.forEach(item => {
            this.enableDragItem(item);
        });
    }

    enableDragItem(item) {
        item.setAttribute('draggable', true);
        item.ondrag = this.handleDrag;
        item.ondragend = this.handleDrop;
    }

    handleDrag(item) {
        const selectedItem = item.target,
            list = selectedItem.parentNode,
            x = event.clientX,
            y = event.clientY;

        selectedItem.classList.add('drag-sort-active');
        let swapItem =
            document.elementFromPoint(x, y) === null
                ? selectedItem
                : document.elementFromPoint(x, y);

        if (list === swapItem.parentNode) {
            swapItem =
                swapItem !== selectedItem.nextSibling
                    ? swapItem
                    : swapItem.nextSibling;
            list.insertBefore(selectedItem, swapItem);
        }
    }

    handleDrop(item) {
        item.target.classList.remove('drag-sort-active');
    }
}
