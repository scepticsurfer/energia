
let changeTables = function (event) {
    var element = event.target;
    // console.log(element.tagName);
    if (element.tagName === 'A') {
        event.preventDefault();
        let date = element.parentElement.parentElement.children[0].innerHTML
        let time = element.parentElement.parentElement.children[1].innerHTML
        let title = element.parentElement.parentElement.children[2].innerHTML
        let trainer = element.parentElement.parentElement.children[3].innerHTML
        let url = 'reserv_change_tables.php?date=' + date + '&time=' + time + '&title=' + title + '&trainer=' + trainer;
        fetch(url)
            .then(function (response) {
                return response.json();
            }).then(function (data) {
                if (data=="true"){
                    //alert("Paikka varattu. Tervetuloa harjoiteluun.")
                    Swal.fire({
                        title: '',
                        text: 'Paikka varattu. Tervetuloa harjoiteluun!',
                        icon: 'success',
                        confirmButtonText: 'sulkea'
                      })
                }


                else{Swal.fire({
                    title: '',
                    text: 'Sinulla on jo harjoitelu tänä aikana',
                    icon: 'error',
                    confirmButtonText: 'sulkea'
                  })
                }   
            }).catch(function (err) {
                console.log(err);
            });


    }
};

//document.addEventListener('DOMContentLoaded', populateTrainers);
document.addEventListener('click', changeTables);
//document.querySelector('#title').addEventListener('change', populateTrainers);
