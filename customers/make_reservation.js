
let changeTables = function(event) {
    var element = event.target;
    // console.log(element.tagName);
    if(element.tagName === 'A') {
        event.preventDefault();
        alert(element.parentElement);
    }
};

//document.addEventListener('DOMContentLoaded', populateTrainers);
document.addEventListener('click', changeTables);
//document.querySelector('#title').addEventListener('change', populateTrainers);
