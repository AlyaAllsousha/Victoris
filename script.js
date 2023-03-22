"use strict";
$(document).ready(function(){
    const slider = $("#slider").owlCarousel({
        loop:true,
        margin:10,
        dots:true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
});
var enter_mode = document.getElementById('enter_mode');
var enter = document.getElementById('user_name');
enter.onclick =  function(e){
    e.preventDefault();
    enter_mode.classList.toggle('visible');
}

window.addEventListener('click', e =>{
if(!e.target.closest('.enter_mode') && !e.target.closest('.user_name') && enter_mode.classList.contains('visible')){
    enter_mode.classList.remove('visible');
    
}
}
)


