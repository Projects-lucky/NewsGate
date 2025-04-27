document.addEventListener("DOMContentLoaded", () => {

    const toggleSwitch = document.getElementById("dark-mode-toggle");
    const svgIcon = document.getElementById("dark-mode-svg");

     // Toggle dark mode on checkbox change
    toggleSwitch.addEventListener("click", () => {
       document.body.classList.toggle("dark");
       toggleSwitch.classList.toggle("svg-color");
    });

    
    const hamburgerButtonDefault = document.querySelector("#hmbgr-svg"); // for default dropdown
    const hamburgerButtonResponsive = document.querySelector("#res-dev-hmbgr-svg"); // for responsive devices
    const sidenav = document.querySelector(".side-nav-cnt"); // for default
    const sidenavResponsive = document.querySelector(".smartphone-sidebar"); // for default

    let sideNavList = document.querySelectorAll(".side-navs-main-categories-lst");
    const postContainer = document.querySelector("#posts-container");
    hamburgerButtonDefault.addEventListener("click", () => {
        hamburgerButtonDefault.classList.toggle("svg-color");
        sidenav.classList.toggle("side-nav-active");
    })

    hamburgerButtonResponsive.addEventListener("click", () => {
        hamburgerButtonResponsive.classList.toggle("svg-color");
        sidenavResponsive.classList.toggle("smart-nav-active");
    })

    sidenavResponsive.addEventListener("mouseleave", () => {
        hamburgerButtonResponsive.classList.remove("svg-color");
        sidenavResponsive.classList.remove("smart-nav-active");
    })
    
    sideNavList.forEach((listItem) => {  // arrow function syntax
    listItem.addEventListener("mouseover", () => {
        postContainer.classList.add("postContainer-active");
        });
    });

    // search bar open button
    const searchOpenButton = document.querySelector("#search-icn");
    const searchInput = document.querySelector(".search-form");
    
    searchOpenButton.addEventListener("click", () => {
        searchOpenButton.classList.toggle("svg-color");
        searchInput.classList.toggle("search-active");
    });

    searchInput.addEventListener("mouseleave", () => {
        searchOpenButton.classList.remove("svg-color");
        searchInput.classList.remove("search-active");
    });



    // sticky navigation
    let header = document.getElementById("my-Header");
    let x = header.offsetTop;
    window.onscroll = function() {myFunction()};
    function myFunction() {
    if (window.scrollY > x) {
        header.classList.add("stick_header");
    }
    else {
        header.classList.remove("stick_header");
    }
}
   

    // for top navigation headers
    document.getElementById('tnc-profile-svg').addEventListener('click', ()=>{
        document.querySelector('.tnc-profile-info').classList.toggle('tncshow');
    });

    
})