/*
 *      NAVIGATION BAR
 */

$(window).on('scroll', function () {
    if ($(this).scrollTop() > 75) {
        $('#nav-header').addClass('slim');
    } else {
        $('#nav-header').removeClass('slim');
    }
});


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
        })
        .fail(function () {
            console.log('fail');
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
}

$('.role-list').change(function (event)
{
    var that = $(this);
    var userId = event.target.dataset.userid,
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

            setTimeout(hideAdminPopup.bind(popupSuccess), 1000);
        })
        .fail(function () {
            that.prop('disabled', false);
            popupFail.addClass('show');

            setTimeout(hideAdminPopup.bind(popupFail), 1000);
        });
});



/*
 *      ADMIN FUNCTIONS
 */

$('#ban-button').click(function (e) {
    var that = $(this);
    var userId   = e.target.dataset.userid,
        isBanned = e.target.dataset.isbanned;

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
        })
        .fail(function () {
            console.log('fail');
        });
});