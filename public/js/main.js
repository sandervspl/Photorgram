/*
 *      PAGE LOAD
 */

var wrap = $('#wrap'),
    header = $('header');

// disable scrolling
wrap.css({
    'overflow': 'hidden',
    'height': '100%'
});

// Wait for window load
$(window).on('load', function() {
    setTimeout(function () {
        // enable scrolling
        wrap.css({
            'overflow': 'visible',
            'height': '100%'
        });

        // remove load overlay
        $('.se-pre-con').fadeOut('slow');
    }, 250);
});


/*
 *      PAGE SCROLL
 */

var g_scrollPos = 0, g_clickedScrollTop;

$(window).on('scroll', function () {
    if ($(this).scrollTop() > 75) {
        $('#nav-header').addClass('slim');
    } else {
        $('#nav-header').removeClass('slim');
    }

    var scrollTop = $('#scroll-to-top');
    if ($(this).scrollTop() > 300) {
        scrollTop.fadeIn(300);

        if (g_clickedScrollTop) {
            g_scrollPos = 0;
            g_clickedScrollTop = false;
            scrollTop.removeClass('down');
        }
    } else if ( ! scrollTop.hasClass('down')) {
        if (g_scrollPos == 0) {
            scrollTop.fadeOut(300);
            g_scrollPos = 0;
        }
    }
});


/*
 *      SCROLL TO BUTTON
 */

$('#scroll-to-top').click(function () {
    if ($(this).hasClass('down')) {
        scrollDown($(this));
    } else {
        scrollUp($(this));
    }
});

function scrollUp(el) {
    g_scrollPos = $(window).scrollTop();
    el.addClass('down');

    $('html, body').animate({
        scrollTop: 0
    }, 500);

    setTimeout(function () {
        g_clickedScrollTop = true;
    }, 500);
}

function scrollDown(el) {
    $('html, body').animate({
        scrollTop: g_scrollPos
    }, 500);

    el.removeClass('down');
}



/*
 *     RATING BAR
 */

function rate(e, that) {
    var btn = e.target;
    var imageId = btn.parentNode.dataset['imageid'],
        ratingId = btn.dataset['ratingid'],
        userRated = btn.parentNode.dataset['userrated'];

    var none  = 0,
        liked = 1,
        disliked = 2;

    var likeCount = that.siblings('.image-like-count'),
        dislikeCount = that.siblings('.image-dislike-count'),
        likes = parseInt(likeCount.text()),
        dislikes = parseInt(dislikeCount.text());

    var likeBtn = that.siblings('.like-btn'),
        dislikeBtn = that.siblings('.dislike-btn');

    var ratingBar = $('#rating-bar-' + imageId);

    // send info to @RatingController@rate
    $.post({
        url: rateUrl,
        data: {
            image_id: imageId,
            rating_id: ratingId,
            user_rated: userRated,
            _token: token
        }
    })
        .done(function () {
            if (that.hasClass('like-btn')) {
                if (that.hasClass('user-liked')) {
                    that.removeClass('user-liked');

                    btn.parentNode.dataset.userrated = none;

                    likes -= 1;
                    likeCount.text(likes + ' likes');
                } else {
                    if (dislikeBtn.hasClass('user-disliked')) {
                        // remove disliked styling from dislike button
                        dislikeBtn.removeClass('user-disliked').removeClass('rated');

                        // count one off
                        dislikes -= 1;
                        dislikeCount.text(dislikes + ' dislikes');
                    }

                    // add liked styling to like button
                    that.addClass('user-liked');

                    // set new user data
                    btn.parentNode.dataset.userrated = liked;

                    // update rating numbers
                    likes += 1;
                    likeCount.text(likes + ' likes');
                }
            } else {
                if (that.hasClass('user-disliked')) {
                    that.removeClass('user-disliked');
                    btn.parentNode.dataset.userrated = none;

                    dislikes -= 1;
                    dislikeCount.text(dislikes + ' dislikes');
                } else {
                    if (likeBtn.hasClass('user-liked')) {
                        likeBtn.removeClass('user-liked').removeClass('rated');

                        likes -= 1;
                        likeCount.text(likes + ' likes');
                    }
                    that.addClass('user-disliked');
                    btn.parentNode.dataset.userrated = disliked;

                    dislikes += 1;
                    dislikeCount.text(dislikes + ' dislikes');
                }
            }

            // rated animation
            that.toggleClass('rated');

            // set width of rating bar
            var width = ((likes + dislikes) > 0) ? (likes / (likes + dislikes)) * 100 : 0;
            ratingBar.css('width', width + '%');
        })
        .fail(function () {
            console.log('fail');
        });
}

$('.row.info-2').find('.image-info-buttons').find('.button').click(function (event) {
    rate(event, $(this));
});

$('.image-info-section').find('.image-info-buttons').find('.button').click(function (event) {
    rate(event, $(this));
});


/*
 *      PROFILE FOLLOW
 */

function follow(e, that) {
    var followId = e.target.dataset['followid'];

    // show load spinner
    $('.load-spinner.follow').removeClass('hidden');

    // lower button opacity
    $('.button.follow-btn').addClass('dim');

    $.post({
        url: followingsUrl,
        data: {
            follow_id: followId,
            _token: token
        }
    })
        .done(function () {
            that.toggleClass('following');

            var str = (~that.text().indexOf('Following')) ? '+ Follow' : 'Following';
            that.text(str);

            // update following count
            var count = 0;
            var followersCount = $('#followers-count');

            if (str === 'Following') {
                count = parseInt(followersCount.text()) + 1;
            } else {
                count = parseInt(followersCount.text()) - 1;
            }
            followersCount.text(count);

            // change url of POST request
            followingsUrl = (~followingsUrl.indexOf('unfollow')) ? followUrl : unfollowUrl;

            // hide load spinner
            $('.load-spinner.follow').addClass('hidden');
            // remove lower button opacity
            $('.button.follow-btn').removeClass('dim');
        })
        .fail(function () {
            // hide load spinner
            $('.load-spinner.follow').addClass('hidden');
            // remove lower button opacity
            $('.button.follow-btn').removeClass('dim');
        });
}

$('.follow-btn').click(function (event) {
    follow(event, $(this));
});


/*
 *    SEARCH BAR
 */

$('.search-btn').click(function () {
    showSearchBar();
});

$('#searchbar-clear').click(function () {
    hideSearchBar();
});

$('#nav-user-dropdown').click(function () {
    hideSearchBar();
});

$('.container').click(function () {
    hideSearchBar();
});

function showSearchBar() {
    $('#searchbar').toggleClass('show');
    $('#searchbar-clear').toggleClass('show');
    $('#searchbar-input').focus();
}

function hideSearchBar() {
    $('#searchbar').removeClass('show');
    $('#searchbar-clear').removeClass('show');
}



/*
 *      ADMIN PAGES
 */

var popupSuccess = $('.popup.success'),
    popupFail = $('.popup.fail');

function showRoleWait(el) {
    el.prop('disabled', true);
}

function hideAdminPopup() {
    $('.popup').each(function () {
        $(this).removeClass('show');
    });

    $('#overlay').hide();
}

$('.role-list').change(function ()
{
    var that = $(this);
    var userId = $(this).attr('data-userid'),
        roleId = $(this).val();

    // wait animation
    showRoleWait($(this));

    // post data to controller
    $.post({
        url: updateRoleUrl,
        data: {
            user_id: userId,
            role_id: roleId,
            _token: token
        }
    })
        .done(function () {
            that.prop('disabled', false);
            popupSuccess.addClass('show');
            $('#overlay').show();

            setTimeout(hideAdminPopup.bind(popupSuccess), 1000);
        })
        .fail(function () {
            that.prop('disabled', false);
            popupFail.addClass('show');
            $('#overlay').show();

            setTimeout(hideAdminPopup.bind(popupFail), 1000);
        });
});



/*
 *      ADMIN FUNCTIONS
 */

$('#ban-button').click(function (e) {
    var that = $(this);
    var userId   = $(this).attr('data-userid'),
        isBanned = $(this).attr('data-isbanned');

    // show load spinner
    $('.load-spinner.ban').removeClass('hidden');

    // lower button opacity
    $('#ban-button').addClass('dim');

    // post data to controller
    $.post({
        url: banUrl,
        data: {
            user_id: userId,
            is_banned: isBanned,
            _token: token
        }
    })
        .done(function () {
            e.target.dataset.isbanned = (isBanned == 0) ? 1 : 0;

            var str = (isBanned == 0) ? "Unban User" : "Ban User";
            that.text(str);

            if (e.target.dataset.isbanned == 1) {
                that.toggleClass('btn-unban').toggleClass('btn-ban');
            } else {
                that.toggleClass('btn-ban').toggleClass('btn-unban');
            }

            // hide load spinner
            $('.load-spinner.ban').addClass('hidden');
            // remove lower button opacity
            $('#ban-button').removeClass('dim');
            // toggle user-name color
            $('#profile-user-name').toggleClass('banned');
        })
        .fail(function () {
            // hide load spinner
            $('.load-spinner.ban').addClass('hidden');
            // remove lower button opacity
            $('#ban-button').removeClass('dim');

            console.log('fail');
        });
});


$('.onoff.ban').click(function (e) {
    if ($(this).hasClass('dim'))
        return;

    var that = $(this);
    var userId   = $(this).attr('data-userid'),
        isBanned = $(this).attr('data-isbanned');

    // move inner circle to the other side
    // and change background color
    $(this).toggleClass('is-transitioned');

    // show load spinner
    $(this).find('.load-spinner.onoff-button').removeClass('hidden');

    // lower button opacity
    $(this).addClass('dim');

    // post data to controller
    $.post({
        url: banUrl,
        data: {
            user_id: userId,
            is_banned: isBanned,
            _token: token
        }
    })
        .done(function () {
            e.target.dataset.isbanned = (isBanned == 0) ? 1 : 0;

            // hide load spinner
            that.find('.load-spinner.onoff-button').addClass('hidden');
            // remove lower button opacity
            that.removeClass('dim');
        })
        .fail(function () {
            // move it back if it failed
            that.toggleClass('is-transitioned');

            // hide load spinner
            that.find('.load-spinner.onoff-button').addClass('hidden');
            // remove lower button opacity
            that.removeClass('dim');
        });
});