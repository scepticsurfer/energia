
let workoutsAvailableble = function(event) {
    event.preventDefault();

    // deleting existing options if exist
    let selectTd = document.querySelectorAll('#workouts_available > tr');
    selectTd.forEach(function(selectTd) {
        selectTd.remove();
    });

    // fetching available options
    let url = 'get_available_workouts.php?date_from=' + document.querySelector('#date_from').value + '&date_to=' 
                                                      + document.querySelector('#date_to').value+ '&workout='
                                                      + document.querySelector('#title').value+ '&trainer='
                                                      + document.querySelector('#trainer').value
                                                      ;
    fetch(url)
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        let trSelect = document.querySelector('#workouts_available');
        data.forEach(item => {               
            // attaching options to select
            content = `<tr>
                       <td>${item.date}</td>
                       <td>${item.time}</td>
                       <td>${item.title}</td>
                       <td>${item.trainer}</td>
                       <td>${item.free_slots}</td>
                       <td><a id="reserv" href="#">Reserv</a></td>
                       
                       </tr>
            `;
            trSelect.innerHTML += content;
        });
    }).catch(function(err) {
        console.log(err);
    });
};

//document.addEventListener('DOMContentLoaded', populateTrainers);
document.querySelector('#find_available').addEventListener('click', workoutsAvailableble);
//document.querySelector('#title').addEventListener('change', populateTrainers);
