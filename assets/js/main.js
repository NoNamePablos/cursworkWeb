if(document.querySelector(".catalog-form")){
    const filterCards=document.querySelectorAll(".filter-card");
    filterCards.forEach(el=>{
        const buttonCard=el.querySelector(".filter-card__ico");
        buttonCard.addEventListener('click',()=>{
            el.classList.toggle("active");
        })
    })
}