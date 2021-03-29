
let changeTables = function (event) {
    var element = event.target;
    // console.log(element.tagName);
    if (element.tagName === 'A' &&  element.parentElement.tagName == 'LI' ) {
       
        event.preventDefault();
        let quantity = element.parentElement.children[2].value
        let product_name = element.parentElement.children[0].children[0].innerHTML
        let product_price = element.parentElement.children[1].innerHTML
        let sum_product_before=element.parentElement.children[3].innerHTML
        let sum_before=document.getElementById('sum').innerHTML
        let button_name=element.innerHTML
        Swal.fire({
            title: '',
            text: "Haluatko varmasti tehdä muutokssia?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Kyllä!'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = 'cancel_change_cart.php?quantity=' + quantity+ '&product_name='+product_name+ '&product_price='+product_price+ '&button_name='+button_name 
                fetch(url)
                    .then(function (response) {
                        return response.json();
                    }).then(function (data) {
                        if (data.result == "true"){
                          if(data.button=="delete"){
                            element.parentElement.remove(); 
                            document.getElementById('sum').innerHTML=parseFloat(sum_before)-parseFloat(sum_product_before)
                            document.getElementById('amount').innerHTML=parseFloat(document.getElementById('amount').innerHTML)-1
                          }
                          if (data.button=="update"){
                              let sum_product=quantity*product_price
                              element.parentElement.children[3].innerHTML=sum_product
                              document.getElementById('sum').innerHTML=parseFloat(sum_before)-parseFloat(sum_product_before)+parseFloat(sum_product)
                          }
                           
                            Swal.fire({
                                title: '',
                                text: 'Muutoksia tehtiin.',
                                icon: 'success',
                                confirmButtonText: 'sulkea'
                            })
                        } else{Swal.fire({
                            title: 'Anteeksi! Virhe tapahtui.',
                            text: 'Yritä myöhemmin uudelleen.',
                            icon: 'error',
                            confirmButtonText: 'sulkea'
                          })



                        }

                    })



            }
        });



/*        
        let url = 'cancel_change_cart.php?quantity=' + quantity+ '&product_name='+product_name+ '&button_name='+button_name
                fetch(url)
                    .then(function (response) {
                        return response.json();
                    }).then(function (data) {
                        if (data == "true"){
                            element.parentElement.parentElement.remove();
                            Swal.fire({
                                title: '',
                                text: 'Muutoksia tehtiin.',
                                icon: 'success',
                                confirmButtonText: 'sulkea'
                            })
                        } else{Swal.fire({
                            title: 'Anteeksi! Virhe tapahtui.',
                            text: 'Yritä myöhemmin uudelleen.',
                            icon: 'error',
                            confirmButtonText: 'sulkea'
                          })

                        }

                    })
*/
            } 
    }


        //document.addEventListener('DOMContentLoaded', populateTrainers);
        document.addEventListener('click', changeTables);
//document.querySelector('#title').addEventListener('change', populateTrainers);
