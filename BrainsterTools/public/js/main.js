$(document).ready(function (){



    $('#loginModal').on('show.bs.modal', function(){
        $('#registerModal').modal('hide');
    });
    //Register Modal hide/show
    $('#registerModal').on('show.bs.modal', function(){
        $('#loginModal').modal('hide');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function allCourses() {
        let slug = window.location.pathname
        $.post('/show', slug, function(data){

            data.forEach(element => {
                if('/' + element.slug == slug){
                    element.subcategories.forEach(sub => {
                        $('.listCourse').append(`
                            <div class="col-md-4">
                            <div class="logo w-100 rounded p-3 my-4">
                                <a class="d-flex align-items-center" href="/courses/${sub.slug}">
                                    <img width="50px" height="50px" src="${sub.logo}">
                                    <h6 class="ml-3">${sub.name}</h6>
                                </a>
                            </div>
                        </div>
                        `)
                    })
                }
                else if(slug == '/'){
                    element.subcategories.forEach(sub => {
                        $('.listCourse').append(`
                        <div class="col-md-4">
                            <div class="logo w-100 rounded p-3 my-4">
                                <a class="d-flex align-items-center" href="/courses/${sub.slug}">
                                    <img width="50px" height="50px" src="${sub.logo}">
                                    <h6 class="ml-3">${sub.name}</h6>
                                </a>
                            </div>
                        </div>
                        `)
                    })
                }
            });


        }


    )}

    allCourses();

    $('#search').on('keyup', function(e) {
        e.preventDefault();
        let search = $('#search').val();
        $.post('/search', {
                'search': search
            }, function(data) {
            console.log(data)
            $('.listCourse').empty();
            data.forEach(sub => {
                $('.listCourse').append(`
                <div class="col-md-4">
                    <div class="logo w-100 rounded p-3 my-4">
                        <a class="d-flex align-items-center" href="">
                            <img width="50px" height="50px" src="${sub.logo}">
                            <h6 class="ml-3">${sub.name}</h6>
                        </a>
                    </div>
                </div>
                `)
            });
        })
    })




    function dashboardCourses() {
        $.post('/dashboardShow', function(data) {
            // console.log(data);
            let classApproved;
            let status;
            let btnApprove;
            data.forEach(value => {
                console.log(value.status);
                if (value.status == 0) {
                    status = "Disapproved";
                    btnApprove = '<i class="fas fa-thumbs-up disaporve"></i>';
                    classApproved = '.unapproved-courses';
                } else if (value.status == 1) {
                    status = "Approved";
                    btnApprove = '<i class="fas fa-thumbs-down approve"></i>';
                    classApproved = '.approved-courses';
                }

                $(classApproved).append(`
                <tr>
                <td>${value.id}</td>
                <td><a href="${value.link}">${value.name}</a></td>
                <td>${value.type['type']}</td>
                <td>${value.level['level']}</td>
                <td>${value.medium['medium']}</td>
                <td>${value.language['language']}</td>
                <td>${value.user['name']}</td>
                <td>${status}</td>

                <td class="buttonsAdmin">
                <button data-id="${value.id}" class="btn ${status}">${btnApprove}</button>
                <button class="btn" data-id="${value.id}"><i class="fas fa-trash deleteButton"></i></button>

                </td>
                </tr>
                `)
            });
        })
    };



    dashboardCourses();

    $('body').on('click', '.Approved', function(e) {
        e.preventDefault();
        var course_id = $(this).attr('data-id');
        $('.approved-courses').empty();
        $('.unapproved-courses').empty();
        $.post('/approveCourse', {
            'id': course_id
        }, function(data) {
            dashboardCourses();
        })
    })

    $('body').on('click', '.Disapproved', function(e) {
        e.preventDefault();

        console.log('test')
        var course_id = $(this).attr('data-id');
        $('.approved-courses').empty();
        $('.unapproved-courses').empty();
        $.post('/disapproveCourse', {
            'id': course_id
        }, function(data) {
            dashboardCourses();
        })
    });








    $('body').on('click', '.deleteButton', function(e) {
        e.preventDefault();
        var course_id = $(this).attr('data-id');
        $('.approved-courses').empty();
        $('.unapproved-courses').empty();
        $.post('/destroyCourse', {
            'id': course_id
        }, function(data) {
            dashboardCourses();
        })
    });








    $('body').on('click', '.votes', function(e) {
        if(!AuthUser) {
            swal({
                type: 'error',
                title: 'Please log in to upvote this course!',
                showConfirmButton: true,
                })
            return
        }
        e.preventDefault();

        var elementTest = this;

        var voted = $(elementTest).attr('data-vote');
        var course_id = $(elementTest).attr('data-id');
        $(elementTest).find('.votes-number').empty();
        $.post('/vote/' + course_id, {
            'voted': voted,
            'course_id': course_id
        }, function(data) {
            console.log(data.votes);
            if ($(elementTest).attr('data-vote') == 'voted') {
                $(elementTest).attr('data-vote', 'notVoted')
                $(elementTest).removeClass('testClass')
            } else if ($(elementTest).attr('data-vote') == 'notVoted') {
                $(elementTest).attr('data-vote', 'voted')
                $(elementTest).addClass('testClass')

            }
            $(elementTest).find('.votes-number').text(data['votes']);

        })

})

$('.selectSubcategories').multiselect({
    nonSelectedText: 'Select Technology',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '434px',
    templates: {
        filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
        filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button”"<i class="fa fa-times-circle-o"></i></button></span>',
    }
});

$('.selectVersions').multiselect({
    nonSelectedText: 'Select Technology',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '434px',
    templates: {
        filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
        filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button”"<i class="fa fa-times-circle-o"></i></button></span>',
    }
});


$('.buttonSubmit').on('click', function() {
    if(!AuthUser) {
        swal({
            type: 'error',
            title: 'Please log in to submit a tutorial!',
            showConfirmButton: true,
            })
        return

    }
})



$('body').on('change', '.courseFilters', function(e){
    e.preventDefault();

    var getUrl = window.location.pathname;
    var replaceInUrl = getUrl.replace('/courses/', '');
    $('.coursesList').empty();

    var arrayFilter = {};
    $('.courseFilters:checked').each(function(i, e){
        var filterName = $(this).attr('name');
        var filterValue = $(this).attr('value');

        arrayFilter[filterName] = filterValue;

    })

    arrayFilter['slug'] = replaceInUrl;
    // console.log(arrayFilter);
    $.post('/filtersAll', arrayFilter, function(data){
        console.log(data);
        data.forEach(value => {
            var logged = "notVoted";
            value.user_votes.forEach(user => {
                if(AuthUser != false && user.pivot['user_id'] == AuthUser.id) {
                    logged = "voted";
                }
            })

            $('.coursesList').append(`
            <div class="borderCourse">
            <div class="col-md-2 buttonVote pt-5">
            <button class="votes ${logged}" data-vote="${logged}" data-id="${value.id}"><i class="fas fa-caret-up fa-2x"></i><span class="votes-number">${value.votes}</span></button>

            </div>
            <div class="col-md-10 divTwo pt-5">
            <h5><a class="linkCourses pt-1" href="${value.link}">${value.name}</a></h5>

              <div class="pt-2">
                <span class="badge badge-dark ml-2">${value.type['type']}</span>
                <span class="badge badge-dark ml-2">${value.level['level']}</span>
                <span class="badge badge-dark ml-2">${value.medium['medium']}</span>
                <span class="badge badge-dark ml-2">${value.language['language']}</span>
              </div>
              </div>
            </div>
            `)
        })

    })
})

$('.upvotes').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-subid');
    var sortParameter = $(this).attr('data-sort');
    $('.coursesList').empty();
    $.post("/sortByVotes", {
        'id': id,
        'sortParameter': sortParameter
    }).then(data => {
        console.log(data)
        ;
        data.forEach(value => {
            var logged = "notVoted";
            var voteClass = ""
            value.user_votes.forEach(user => {
                if(AuthUser != false && user.pivot['user_id'] == AuthUser.id) {
                    logged = "voted";
                    voteClass = "testClass"
                }
            })

            $('.coursesList').append(`
            <div class="borderCourse">
            <div class="col-md-2 buttonVote pt-5">
            <button class="votes ${voteClass}" data-vote="${logged}" data-id="${value.id}"><i class="fas fa-caret-up fa-2x"></i><span class="votes-number">${value.votes}</span></button>

            </div>
            <div class="col-md-10 divTwo pt-5">
            <h5><a class="linkCourses pt-1" href="${value.link}">${value.name}</a></h5>

              <div class="pt-2">
                <span class="badge badge-dark ml-2">${value.type['type']}</span>
                <span class="badge badge-dark ml-2">${value.level['level']}</span>
                <span class="badge badge-dark ml-2">${value.medium['medium']}</span>
                <span class="badge badge-dark ml-2">${value.language['language']}</span>
              </div>
              </div>
            </div>
            `)
        })
    })
})

$('.recent').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-subid');
    var sortParameter = $(this).attr('data-sort');
    $('.coursesList').empty();
    $.post("/sortByRecent", {
        'id': id,
        'sortParameter': sortParameter
    }).then(data => {
        console.log(data)
        ;
        data.forEach(value => {
            var logged = "notVoted";
            var voteClass = ""
            value.user_votes.forEach(user => {
                if(AuthUser != false && user.pivot['user_id'] == AuthUser.id) {
                    logged = "voted";
                    voteClass = "testClass"
                }
            })

            $('.coursesList').append(`
            <div class="borderCourse">
            <div class="col-md-2 buttonVote pt-5">
            <button class="votes ${voteClass}" data-vote="${logged}" data-id="${value.id}"><i class="fas fa-caret-up fa-2x"></i><span class="votes-number">${value.votes}</span></button>

            </div>
            <div class="col-md-10 divTwo pt-5">
            <h5><a class="linkCourses pt-1" href="${value.link}">${value.name}</a></h5>

              <div class="pt-2">
                <span class="badge badge-dark ml-2">${value.type['type']}</span>
                <span class="badge badge-dark ml-2">${value.level['level']}</span>
                <span class="badge badge-dark ml-2">${value.medium['medium']}</span>
                <span class="badge badge-dark ml-2">${value.language['language']}</span>
              </div>
              </div>
            </div>
            `)
        })
    })
})
});

