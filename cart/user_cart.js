

let userCart = function(event) {
    event.preventDefault();

    // deleting existing options if exist
    let selectLis = document.querySelectorAll('#user_cart > li');
    selectLis.forEach(function(selectLi) {
        selectLi.remove();
    });

    // fetching available options
    let url = 'get_users_products.php'
    fetch(url)
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        let liTr = document.querySelector('#user_cart');
        let amount_selector=document.querySelector('#amount');
        let sum_selector=document.querySelector('#sum');
        data.forEach(item => {               
            // attaching options to select
            content = `<li class="list-group-item d-flex justify-content-between lh-condensed">
                       <div>
                       <h6 class="my-0">${item.product}</h6>
                       <small class="text-muted">${item.description}</small>
                       </div>                    
                        <span class="text-muted">${item.price}</span>
                        <input type="number" style="width:50px; height: 20px" value="${item.quantity}"/>
                        <span class="text-muted">${item.sum_product}</span>
                        <a href="" class="btn btn-warning">Poista</a>
                        <a href="" class="btn btn-warning">Muuta</a>
                       </li>
                       
                       
            `;
            liTr.innerHTML += content;
         
        });
       amount_selector.innerHTML=data.reduce((amount) => amount + 1, 0);
       let sum=data.reduce((sum, data_p)=> sum + parseFloat(data_p.sum_product) ,0 )
       sum_selector.innerHTML=sum;
    }).catch(function(err) {
        console.log(err);
    });
};

document.addEventListener('DOMContentLoaded', userCart);
//document.querySelector('#find_available').addEventListener('click', workoutsAvailable);
//document.querySelector('#title').addEventListener('change', populateTrainers);
