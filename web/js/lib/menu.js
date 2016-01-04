var url = window.location.pathname,
    urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
$('#main-menu a').each(function () {
    if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
        $(this).addClass('active-menu');
        $(this).parent().find('a').removeClass('active-menu');
    }
});

$('.top-menu a').each(function () {
    if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
        $(this).parent().addClass('active');
        $(this).parent().find('li').removeClass('active');
    }
});