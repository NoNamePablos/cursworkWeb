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