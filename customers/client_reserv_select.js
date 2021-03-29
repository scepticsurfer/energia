let rezervWorkouts = function(event) {
    event.preventDefault();

    // deleting existing options if exist
    let selectWr = document.querySelectorAll('#reserv_row > tr');
    selectWr.forEach(function(selectWr) {
        selectWr.remove();
    });

    // fetching available options
    let url = 'get_client_workouts.php?date_from=' + document.querySelector('#date_from').value + '&date_to=' + document.querySelector('#date_to').value;
    fetch(url)
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        let trSelect = document.querySelector('#reserv_row');
        data.forEach(item => {
            // attaching options to select
            content = `<tr>
                       <td>${item.date}</td>
                       <td>${item.time}</td>
                       <td>${item.title}</td>
                       <td>${item.trainer}</td>
                       <td><a href="" class="btn btn-danger">Peruuta</a>                       
                       </td>
                       </tr>
                       
            `;
            trSelect.innerHTML += content;
            console.log(content);  
        });
    }).catch(function(err) {
        console.log(err);
    });
};

//document.addEventListener('DOMContentLoaded', rezervWorkouts);
document.querySelector('#client_select').addEventListener('click', rezervWorkouts);
//document.querySelector('#title').addEventListener('change', populateTrainers);