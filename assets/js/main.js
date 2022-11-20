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

        // event.preventDefault(); //Prevent the default submit
    });
}


if (document.querySelectorAll('.js-review-close').length > 0) {

    const close = document.querySelectorAll('.js-review-close');
    close.forEach((el) => {
        el.addEventListener('click', () => {
            const parent = el.closest(".review-card");
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
        })
    })


    // $('.js-append-review').on('click', function (event) { //Trigger on form submit
    //     var postForm = { //Fetch form data
    //         'id_auto': $('.input-auto').val(),
    //         'id': $('.input-user').val(),
    //         'score_scope': $('.input-score').val(), //Store name fields value
    //         'review_positiv_text': $('.js-positiv-text').val(),
    //         'review_negative_text': $('.js-negativ-text').val(),
    //     };
    //     if (!($('.input-score').val() > 5 || $('.input-score').val() <= 0)) {
    //         if (!($('.js-positiv-text').val().length === 0) && !($('.js-negativ-text').val().length === 0)) {
    //             $.ajax({ //Process the form using $.ajax()
    //                 type: 'POST', //Method type
    //                 url: 'app/controllers/review-ajax.php', //Your form processing file URL
    //                 data: postForm, //Forms name
    //                 dataType: 'html',
    //                 success: function (data) {
    //                     $('.input-score').val(1);
    //                     $('.js-positiv-text').val("");
    //                     $('.js-negativ-text').val("");
    //                     const wrap = document.querySelector('.review-body');
    //                     wrap.insertAdjacentHTML('afterbegin', data);
    //                 }
    //             });
    //         }
    //
    //     }
    //     event.preventDefault();
    //
    //     // event.preventDefault(); //Prevent the default submit
    // });
}