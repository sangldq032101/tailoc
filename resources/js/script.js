$(window).on('load resize', function () {
    const footerHeight = $('footer').outerHeight(true);
    $('body').css('padding-bottom', footerHeight + 'px');
    const headerHeight = $('header nav').outerHeight(true) + 16;
    $('main').css('padding-top', headerHeight + 'px');
});
$(window).on('load', function () {
    $('html').css('visibility', 'visible');
    $('a').attr('draggable', false);
    $('img').attr('draggable', false);
    $($('#topBtn')).on('click', function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });
    $(window).on('scroll', function () {
        scrollBtn = $('#topBtn');
        if (document.body.scrollTop > 1024 || document.documentElement.scrollTop > 1024) {
            scrollBtn.css('display', 'block');
        } else {
            scrollBtn.css('display', 'none');
        }
    })
    $('a').on('click', function (e) {
        targetHref = $(this).prop('href');
        currentHref = window.location.href;
        if (targetHref == currentHref) {
            e.preventDefault();
        }
    });
    // $("a").each(function () {
    //     if (!$(this).attr('no-data-pjax'))
    //         $(this).attr('data-pjax', 'true');
    // });
});
// if ($.support.pjax) {
//     $(document).pjax('[data-pjax] a, a[data-pjax]', '#body-container')
//     $.pjax.defaults.timeout = 0
// }
