// JavaScript Document: Vanilla

/* ===================================================================================================================== */

const textareaFields = document.querySelectorAll('textarea');
const textareaFieldsSavedValues = [];

/* ===================================================================================================================== */

window.onload = () => {
    for (const textareaField of textareaFields) {
        textareaFieldsSavedValues.push(textareaField.value.trim());
    }

    document.getElementById('SelectTableTop').value = document.URL.substring(document.URL.lastIndexOf('/') + 1).split('?')[0];
    document.getElementById('SelectTableBottom').value = document.URL.substring(document.URL.lastIndexOf('/') + 1).split('?')[0];
};

/* ===================================================================================================================== */

function del_confirm(id) {
    if (confirm('Delete record NewsID ' + id + '...?')) {
        window.location='TableNews.php?&start=18&ad=&sort=&s=&f=&mte_a=del&id=' + id
    }
}

/* ===================================================================================================================== */

function submitFormSearch() {
    const  textboxSearch = document.getElementById("TBSearch");

    if (textboxSearch.value.trim() == "") {
        alert("Nothing to Search. Please enter text into Search Field.");
        return false;
    }
}

/* ===================================================================================================================== */

function submitFormAddEdit() {
    const inputFields = document.querySelectorAll("input");

    let ok = 0;
    let hasChanged = false;

    for (const inputField of inputFields) {
        if (inputField.getAttribute('type') != "datetime-local") {
            if (inputField.getAttribute('value').trim() != inputField.value.trim()) {
                hasChanged = true;
                break;
            }
        }
    }

    for (const textareaField of textareaFields) {
        if (!textareaFieldsSavedValues.includes(textareaField.value.trim())) {
            hasChanged = true;
            break;
        }
    }

    for (f=1; f<=0; f++) {

        var elem = document.getElementById('id_' + f);

        if(elem.options) {
            if (elem.options[elem.selectedIndex].text!=null && elem.options[elem.selectedIndex].text!='') {
                ok++;
            }
        } else {
            if (elem.value!=null && elem.value!='') {
                ok++;
            }
        }
    }

    //	console.log(0 + ' ' + ok);

    if (ok == 0) {
        if (hasChanged) {
            return true;
        } else {
            alert("Nothing to Save. No changes were made.");
            return false;
        }
    } else {
        alert('Check the required (yellow) fields...');
        return false;
    }
}

/* ===================================================================================================================== */

function go2PageTop() {
    const page = document.getElementById("pageTop").value;
    window.location.href = page;
}

function go2PageBottom() {
    const page = document.getElementById("pageBottom").value;
    window.location.href = page;
}

/* ===================================================================================================================== */

function gotoSelectedTableTop() {
    const selectedTable = document.getElementById("SelectTableTop").value;
    window.location.href = selectedTable;
}

function gotoEditTableTop() {
    const selectedTable = document.getElementById("SelectTableTop").value;
    window.location.replace(document.URL.substr(0, document.URL.lastIndexOf('/')) + "?EditConfig=" + selectedTable);
}

function gotoSelectedTableBottom() {
    const selectedTable = document.getElementById("SelectTableBottom").value;
    window.location.href = selectedTable;
}

function gotoEditTableBottom() {
    const selectedTable = document.getElementById("SelectTableBottom").value;
    window.location.replace(document.URL.substr(0, document.URL.lastIndexOf('/')) + "?EditConfig=" + selectedTable);
}

/* ===================================================================================================================== */

function goBack() {
    window.history.back();
}

function goBackToIndex() {
    window.location.replace(document.URL.substr(0, document.URL.lastIndexOf('?')));
}

/* ===================================================================================================================== */



/* ===================================================================================================================== */
