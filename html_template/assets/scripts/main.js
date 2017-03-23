(function() {

    //Select the hamburger icon and store it into the hamburger variable.
    let hamburger = document.querySelector('#hamburger');

    //When the hamburger icon is clicked, open the navbar.
    hamburger.addEventListener('click', function(){
        let body = document.querySelector("body");    
        body.classList.toggle("is-open"); 
    })
})();