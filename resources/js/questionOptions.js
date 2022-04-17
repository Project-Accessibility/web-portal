window.addEventListener('load', () => {
    new OpenConfiguration();
    new SelectConfiguration();
});


class OpenConfiguration{
    openSwitch;
    openConfigurationBox;

    constructor() {
        this.openSwitch = document.getElementById('open');
        this.openConfigurationBox =
            document.getElementById('open-configuration');
        this.addListeners();
    }

    addListeners() {
        // Add switch listener
        this.openSwitch.addEventListener('change', () => {
            // Collapse list configuration box
            new bootstrap.Collapse(this.openConfigurationBox);
        });
    }
}

class SelectConfiguration {
    values;
    listSwitch;
    listConfigurationBox;
    addListItemButton;
    listAnswerInput;
    listDisplay;

    constructor() {
        this.values = [];
        this.listSwitch = document.getElementById('multipleChoice');
        this.listConfigurationBox =
            document.getElementById('list-configuration');
        this.addListItemButton = document.getElementById(
            'add-list-item-button'
        );
        this.listAnswerInput = document.getElementById('listInput');
        this.listDisplay = document.getElementById('list');
        this.addListeners();
        this.initList();
    }

    addListeners() {
        // Add switch listener
        this.listSwitch.addEventListener('change', () => {
            // Collapse list configuration box
            new bootstrap.Collapse(this.listConfigurationBox);
        });
        // Add list item listener
        this.addListItemButton.addEventListener('click', e => {
            e.preventDefault();
            if (
                this.listAnswerInput.value &&
                !this.values.includes(this.listAnswerInput.value)
            ) {
                this.values.push(this.listAnswerInput.value);
                this.addListItem(this.listAnswerInput.value);
            }
        });
    }

    initList() {
        if (window.values) {
            window.values.forEach(value => {
                this.values.push(value);
                this.addListItem(value);
            });
        }
    }

    addListItem(value) {
        const li = document.createElement('li');
        li.className =
            'list-group-item d-flex justify-content-between align-items-start';
        li.append(this.getHiddenInput(value));
        li.append(this.getNameDisplay(value));
        li.append(this.getRemoveButton(li, value));
        this.listDisplay.append(li);
    }

    getHiddenInput(value) {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'text';
        hiddenInput.value = value;
        hiddenInput.name = 'list[]';
        hiddenInput.hidden = true;
        return hiddenInput;
    }

    getNameDisplay(value) {
        const nameDisplay = document.createElement('div');
        nameDisplay.className = 'ms-2 me-auto';
        nameDisplay.textContent = value;
        return nameDisplay;
    }

    getRemoveButton(li, value) {
        const removeButton = document.createElement('a');
        removeButton.href = '';
        removeButton.className = 'deco-none me-1';
        removeButton.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">\n' +
            '  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" stroke="black" stroke-width="2"/>\n' +
            '</svg>';
        removeButton.addEventListener('click', e => {
            e.preventDefault();
            li.remove();
            const index = this.values.indexOf(value);
            if (index > -1) {
                this.values.splice(index, 1); // 2nd parameter means remove one item only
            }
        });
        return removeButton;
    }
}
