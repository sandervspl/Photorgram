$('#search-btn').on('click', function () {
    $('#searchbar').toggleClass('show');
    $('#searchbar-clear').toggleClass('show');
    $('#searchbar-input').focus();
});

$('#searchbar-clear').on('click', function () {
    $('#searchbar').removeClass('show');
    $('#searchbar-clear').removeClass('show');
});