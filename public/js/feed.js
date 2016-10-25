/*
 *      INFINITE SCROLL ON FEED
 */

$('.scroll').jscroll({
    autoTrigger: true,
    nextSelector: '.pagination li.active + li a',
    contentSelector: 'div.scroll',
    callback: function() {
        $('ul.pagination:visible:first').hide();
    }
});