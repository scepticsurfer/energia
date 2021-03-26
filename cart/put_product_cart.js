
let changeTables = function (event) {
    var element = event.target;
    if (element.tagName === 'A') {
        if (element.parentElement.tagName !== 'DIV') {
            return;
        }
        event.preventDefault();
        
        let product_name = element.parentElement.parentElement.children[0].children[0].innerHTML
        let url = 'cart/product_to_cart.php?product_name=' + product_name;
        fetch(url)
            .then(function (response) {
                return response.json();
            }).then(function (data) {
                if (data == "true") {
                    Swal.fire({
                        title: '',
                        text: 'Tuote lisätiin ostoskoriin.',
                        icon: 'success',
                        confirmButtonText: 'sulkea'
                    })
                } else {                 
                    
                        Swal.fire({
                            title: 'Anteeksi! Virhe tapahtui.',
                            text: 'Yritä myöhemmin uudelleen.',
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
