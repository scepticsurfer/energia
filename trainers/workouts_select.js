
let trainerTimetable = function(event) {
    event.preventDefault();

    // deleting existing options if exist
    let selectTd = document.querySelectorAll('#timetable_row > tr');
    selectTd.forEach(function(selectTd) {
        selectTd.remove();
    });

    // fetching available options
    let url = 'get_workouts.php?date_from=' + document.querySelector('#date_from').value + '&date_to=' + document.querySelector('#date_to').value;
    fetch(url)
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        let trSelect = document.querySelector('#timetable_row');
        data.forEach(item => {
            // attaching options to select
            content = `<tr>
                       <td>${item.date}</td>
                       <td>${item.time}</td>
                       <td>${item.title}</td>
                       <td>${item.free_slots}</td>
                       <td>${item.participants}</td>
                       <td>${item.status}</td>
                       </tr>
            `;
            trSelect.innerHTML += content;
        });
    }).catch(function(err) {
        console.log(err);
    });
};

//document.addEventListener('DOMContentLoaded', populateTrainers);
document.querySelector('#show').addEventListener('click', trainerTimetable);
//document.querySelector('#title').addEventListener('change', populateTrainers);
