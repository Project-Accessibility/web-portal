window.addEventListener('load', () => {
    const values = [];
    const listSwitch = document.getElementById('multipleChoice');
    const listConfigurationBox = document.getElementById('list-configuration')
    listSwitch.addEventListener('change', () => {
        new bootstrap.Collapse(listConfigurationBox);
    })
    const addListItemButton = document.getElementById('add-list-item-button');
    const listInput = document.getElementById('listInput');
    addListItemButton.addEventListener('click', (e)=>{
        e.preventDefault();
        if(listInput.value && !values.includes(listInput.value)){
            values.push(listInput.value);
            addListItem(listInput.value);
        }
    })
    const list = document.getElementById('list');

    function addListItem(value) {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-start';
        // Make hidden input
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'text';
        hiddenInput.value = value;
        hiddenInput.name = 'list[]';
        hiddenInput.hidden = true;
        // Make name display
        const nameDisplay = document.createElement('div');
        nameDisplay.className = 'ms-2 me-auto';
        nameDisplay.textContent = value;
        // Make remove button
        const removeButton = document.createElement('a');
        removeButton.href='';
        removeButton.className = 'deco-none me-1';
        removeButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">\n' +
            '  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" stroke="black" stroke-width="2"/>\n' +
            '</svg>';
        removeButton.addEventListener('click', (e)=> {
            e.preventDefault();
            li.remove();
            const index = values.indexOf(value);
            if (index > -1) {
                values.splice(index, 1); // 2nd parameter means remove one item only
            }
        })
        li.append(hiddenInput);
        li.append(nameDisplay);
        li.append(removeButton);
        list.append(li);
    }
})
