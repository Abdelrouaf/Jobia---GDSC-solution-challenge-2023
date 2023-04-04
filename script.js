var navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
}

var dropdown_items = document.querySelectorAll('.job-filter form .dropdown-container .dropdown .lists .items')

dropdown_items.forEach(items =>{
    items.onclick = () =>{
        items_parent = items.parentElement.parentElement;
        let output = items_parent.querySelector('.output')
        output.value = items.innerText;
    }
})

var drop_down = document.querySelectorAll('.profile .box-container form .form-group .dropdown .lists .items')

drop_down.forEach(items =>{
    items.onclick = () =>{
        items_parent = items.parentElement.parentElement;
        let output = items_parent.querySelector('.output')
        output.value = items.innerText;
    }
})


