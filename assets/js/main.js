if (document.querySelector(".catalog-form")) {
    const filterCards = document.querySelectorAll(".filter-card");
    filterCards.forEach(el => {
        const buttonCard = el.querySelector(".filter-card__ico");
        buttonCard.addEventListener('click', () => {
            el.classList.toggle("active");
        })
    })
}
if (document.querySelector(".js-slider")) {
    const slider = document.querySelector(".js-slider");
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

if (document.querySelector(".js-popup")) {
    const mobilePopup = document.querySelector(".js-popup");
    const mobileMenu = document.querySelector(".js-mobile");
    if (!mobilePopup.classList.contains("js-auth")) {
        mobilePopup.addEventListener("click", (e) => {
            e.preventDefault();
            mobileMenu.classList.toggle("open");
            document.body.classList.toggle("body-hidden");

        })
    }
}

if (document.querySelector('.js-animation')) {
    $(".js-animation").click(function () {
        $('html, body').animate({
            scrollTop: $(".js-animation-target").offset().top
        }, 2000);
    });
}
if (document.querySelector('.js-append-review')) {
    $('.js-append-review').on('click', function (event) { //Trigger on form submit
        var postForm = { //Fetch form data
            'id_auto': $('.input-auto').val(),
            'id': $('.input-user').val(),
            'score_scope': $('.input-score').val(), //Store name fields value
            'review_positiv_text': $('.js-positiv-text').val(),
            'review_negative_text': $('.js-negativ-text').val(),
        };
        if (!($('.input-score').val() > 5 || $('.input-score').val() <= 0)) {
            if (!($('.js-positiv-text').val().length === 0) && !($('.js-negativ-text').val().length === 0)) {
                $.ajax({ //Process the form using $.ajax()
                    type: 'POST', //Method type
                    url: 'app/controllers/review-ajax.php', //Your form processing file URL
                    data: postForm, //Forms name
                    dataType: 'html',
                    success: function (data) {
                        $('.input-score').val(1);
                        $('.js-positiv-text').val("");
                        $('.js-negativ-text').val("");
                        const wrap = document.querySelector('.review-body');
                        wrap.insertAdjacentHTML('afterbegin', data);
                    }
                });
            }

        }
        event.preventDefault();
    });
}


if (document.querySelectorAll('.js-review-close').length > 0) {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('js-review-close')) {
            const parent = e.target.closest(".review-card");
            $.ajax({
                url: 'app/controllers/review-ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    'id_comment': parent.getAttribute("data-commentid"),
                },
                success: function (data) {
                    parent.remove();
                }
            });
        }
    });
}
if(document.querySelector('.js-cart')){
    const btn=document.querySelector('.js-cart');
    btn.addEventListener('click',()=>{
        const  cardId=btn.getAttribute("data-carid");
        $.ajax({
            url: 'app/controllers/cart/cart-ajax.php',
            type: 'post',
            dataType: 'json',
            data: {
                'id_auto':cardId,
            },
            success: function (data) {
                alert('Добавлено в корзину');
            }
        });
        btn.classList.add('button-disabled');
    })
}
if(document.querySelector('.js-remove-all')){
    const btn=document.querySelector('.js-remove-all');
    const parent=document.querySelectorAll('.basket-card__item');
    btn.addEventListener('click',()=>{
        $.ajax({
            url: 'app/controllers/cart/cart-ajax.php',
            type: 'post',
            dataType: 'json',
            data: {
                'remove_all':true,
            },
            success: function (data) {
                document.querySelector(".basket-price__total").textContent=`${data}₽`;
                removeAll();
            }
        });
    });

}
if(document.querySelectorAll('.js-order-cancel').length>0){
    const btn=document.querySelectorAll('.js-order-cancel');
    btn.forEach((el)=>{
        el.addEventListener('click',()=>{
            const parent=el.closest('.basket-card__item');

            $.ajax({
                url: 'app/controllers/order/order-ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    'id':parent.getAttribute('data-orderid'),
                    'order_cancel':true,
                },
                success: function (data) {
                   alert('Отменено');
                   el.classList.add('button-disabled');
                   el.classList.remove('js-order-cancel');
                   const status=parent.querySelector('.basket-cart__status-delivery');
                   status.textContent=`Отменено`;
                   status.classList.add('basket-cart__status-delivery-cancel');
                }
            });
        });
    })
    const parent=document.querySelectorAll('.basket-card__item');

}
if(document.querySelectorAll('.js-remove').length>0){
    const btn=document.querySelectorAll('.js-remove');

    btn.forEach((el)=>{
        el.addEventListener('click',()=>{
            const parent=el.closest('.basket-card__item');
            const  cardId=parent.getAttribute("data-cardid");
            console.log(cardId);
            $.ajax({
                url: 'app/controllers/cart/cart-ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    'id_remove':cardId,
                },
                success: function (data) {
                    alert('Удалено из корзины');
                    console.log(data);
                    document.querySelector(".basket-price__total").textContent=`${data}₽`;
                    parent.remove();

                        const parent1=document.querySelector('.js-cart-basket');
                        const basketItems=parent1.querySelectorAll('.basket-card__item');
                        let cartItems=[];
                        let count=document.querySelector('.basket-count');
                    basketItems.forEach((el)=>{
                            cartItems.push(el.getAttribute('data-cardid'));
                        })
                        if(cartItems.length>0){
                            count.textContent=`В корзине ${cartItems.length} товар`;
                            parent1.classList.remove('detail-body-hidden');
                        }else{
                            parent1.classList.add('detail-body-hidden');
                            count.textContent=`В корзине ${0} товаров`;
                        }
                }
            });
        })
    })
}
if(document.querySelector('.js-cart-form')){
    const btn=document.querySelector('.js-cart-form');
    const parent=document.querySelector('.js-cart-basket');
    const basketItems=parent.querySelectorAll('.input-basket-item');
    let cartItems=[];
    basketItems.forEach((el)=>{
        cartItems.push(el.getAttribute('data-basketitemid'));
    })
    btn.addEventListener('click',()=>{
        const form=document.querySelector('.js-cart-basket');

        console.log(cartItems);
        if(cartItems.length>0){
            console.log(1);
            parent.classList.remove('detail-body-hidden');
        }else{
            parent.classList.add('detail-body-hidden');
        }
    })
}

if(document.querySelector('.js-cart-basket')){
    const btn=document.querySelector('.js-cart-basket-button');
    btn.addEventListener('click',()=>{
        var postForm = { //Fetch form data
            'username': $('.input-username').val(),
            'telephone': $('.input-tel').val(),
            'address':$('.input-address').val(),
            'items':[],
            'id_user':$('.input-id-user-baket').val(),
        };
        const basketItems1=document.querySelectorAll('.basket-card__item');
        let cartItems=[];
        basketItems1.forEach((el)=>{
            postForm.items.push(el.getAttribute('data-cardid'));
        })
        $.ajax({ //Process the form using $.ajax()
            type: 'POST', //Method type
            url: 'app/controllers/order/order-ajax.php', //Your form processing file URL
            data: postForm, //Forms name
            dataType: 'html',
            success: function (data) {
                alert('Ожидайте доставки');
                removeAll();
            }
        });
    })
}
let catalogList=[];

function catalogFilter(){
    let form={
        brands_wrap:'.filter-card-brand',
        price_wrap:'.filter-card-pricevalue',
        year_wrap:'.filter-card-yearvalue'
    }
    let form_value={
        brands:[],
        price_wrap:{
            minValue:0,
            maxValue:0,
        },
        year_wrap:{
            minYear:0,
            maxYear:0,
        }

    }
    let brands=document.querySelectorAll(`${form.brands_wrap} .filter-card-checkbox`);
    let price_wrap=document.querySelectorAll(`${form.price_wrap} .input`);
    let year_wrap=document.querySelectorAll(`${form.year_wrap} .input`);
    brands.forEach((el)=>{
       const checkbox=el.querySelector('input')
        if(checkbox.checked){
            form_value.brands.push(`'${el.getAttribute('data-filterid')}'`);
        }
    })
    price_wrap.forEach((el)=>{
        let number = parseFloat(el.value);
        if(!isNaN(number)){
            if(el.classList.contains('input-first')){
                form_value.price_wrap.minValue=number;
            }else{
                form_value.price_wrap.maxValue=number;
            }
        }else{
            if(el.classList.contains('input-first')){
                form_value.price_wrap.minValue=parseFloat(el.getAttribute('min'));
            }else{
                form_value.price_wrap.maxValue=parseFloat(el.getAttribute('max'));
            }
        }
    })
    year_wrap.forEach((el)=>{
        let number = parseFloat(el.value);
        if(!isNaN(number)){
            if(el.classList.contains('input-first')){
                form_value.year_wrap.minYear=number;
            }else{
                form_value.year_wrap.maxYear=number;
            }
        }else{
            if(el.classList.contains('input-first')){
                form_value.year_wrap.minYear=parseFloat(el.getAttribute('min'));
            }else{
                form_value.year_wrap.maxYear=parseFloat(el.getAttribute('max'));
            }
        }
    })

    console.log(form_value);
    $.ajax({ //Process the form using $.ajax()
        type: 'GET', //Method type
        url: 'app/controllers/catalog/catalog-ajax.php', //Your form processing file URL
        data: form_value, //Forms name
        dataType: 'json',
        success: function (responce) {
            if (responce.code === 'success') {
                console.log(responce);
                let list = responce.data.filter((elem, index, self) => self.findIndex(
                    (t) => {return (t.id === elem.id )}) === index)
                console.log(list);
                let cards=document.querySelectorAll('.catalog-grid .catalog-grid__item');
                cards.forEach((el)=>{
                    el.remove();
                })
                if(list.length>6){
                    catalogList=list;
                    $("#goods-template").tmpl(list.slice(0,6)).appendTo(".catalog-grid");
                    catalogList=catalogList.slice(6,catalogList.length);
                    console.log('ddd');
                    console.log(catalogList);
                    $("#hidden-template").tmpl(catalogList).appendTo(".catalog-grid");
                }
            }
        }
    });

}
if(document.querySelector('.js-show-more-catalog')){
    let btn=document.querySelector('.js-show-more-catalog');
    btn.addEventListener('click',()=>{
        let hiddenCards=document.querySelectorAll('.catalog-grid--hidden');
        if(hiddenCards.length>0){
            for (let i=0;i<hiddenCards.length;i++){
                if(i<6){
                    hiddenCards[i].classList.remove('catalog-grid--hidden');
                }
            }
        }else{
            btn.classList.add('button-disabled');
        }
    })
}





if(document.querySelector('.button-filter')) {
    const filter = document.querySelector('.button-filter');
    filter.addEventListener('click', () => {
        catalogFilter();
    })
}
function removeAll(){
    const parent=document.querySelector('.js-cart-basket');
    let count=document.querySelector('.basket-count');
    parent.forEach((el)=>{
        el.remove();
    });
    parent.classList.add('detail-body-hidden');
    count.textContent=`В корзине ${0} товаров`;
}