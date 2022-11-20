if(document.querySelector(".catalog-form")){
    const filterCards=document.querySelectorAll(".filter-card");
    filterCards.forEach(el=>{
        const buttonCard=el.querySelector(".filter-card__ico");
        buttonCard.addEventListener('click',()=>{
            el.classList.toggle("active");
        })
    })
}
if(document.querySelector(".js-slider")){
    const slider=document.querySelector(".js-slider");
    var swiper = new Swiper(slider, {
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}

if(document.querySelector(".js-popup")){
    const mobilePopup=document.querySelector(".js-popup");
    const mobileMenu=document.querySelector(".js-mobile");
    if(!mobilePopup.classList.contains("js-auth")){
        mobilePopup.addEventListener("click",(e)=>{
            e.preventDefault();
            mobileMenu.classList.toggle("open");
            document.body.classList.toggle("body-hidden");
    
        })
    }
}

if(document.querySelector('.js-animation')){
    $(".js-animation").click(function (){
        $('html, body').animate({
            scrollTop: $(".js-animation-target").offset().top
        }, 2000);
    });
}
