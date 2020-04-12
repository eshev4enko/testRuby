$(function() {

//     let popupBlock;
//
//     $(document)
//         .on('click', '.todo-list-inner-box .input-list-data button' , function() {
//             let $result   = $(this).closest('.todo-list-inner-box').find('.input-list-data input'),
//                 $list     = $(this).closest('.todo-list-inner-box').find('.list-sections');
//             console.log($($result).val());
//             if ($($result).val() !== '') {
//                 $list.append(
//                     '<li class="list-add-data">' +
//                     '<div class="list-check-wrap">'+
//                     '<input type="checkbox" class="list-check">' +
//                     '</div>'+
//                     '<input type="text" value="'+$($result).val()+'" class="list-check-txt" readonly>'+
//                     '<div class="change-data-checker">' +
//                     '<div class="change-data-checker-inner">' +
//                     '<i class="fa fa-caret-up" aria-hidden="true"></i>' +
//                     '<i class="fa fa-caret-down" aria-hidden="true"></i></div>'+
//                     '<div class="change-data-checker-inner">' +
//                     '<i class="fa fa-pencil" aria-hidden="true"></i></div>'+
//                     '<div class="change-data-checker-inner">' +
//                     '<i class="fa fa-trash" aria-hidden="true"></i></div>'+
//                     '</div>'+
//                     '</li>'
//                 );
//             }
//             $result.value = '';
//             $($result).val('');
//         })
//         .on('click', '.change-data-checker-inner .fa-pencil', function() {
//             $(this)
//                 .closest('.list-add-data')
//                 .find('.list-check-txt')
//                 .removeAttr('readonly')
//                 .toggleClass('redact');
//
//             if ($(this).closest('.list-add-data').find('.list-check-txt').hasClass('redact')) {
//                 $(this)
//                     .closest('.list-add-data')
//                     .find('.list-check-txt')
//                     .attr('readonly', false);
//             } else {
//                 $(this)
//                     .closest('.list-add-data')
//                     .find('.list-check-txt')
//                     .attr('readonly', true);
//             }
//         })
//         .on('click', '.change-data-checker-inner .fa-trash', function() {
//             $(this)
//                 .closest('.list-add-data').remove();
//         })
//         .on('click', '.change-data-checker .fa-caret-down', function () {
//             let $parent = $(this).closest('.list-add-data');
//             $parent.insertAfter($parent.next());
//         })
//         .on('click', '.change-data-checker .fa-caret-up', function () {
//             let $parent = $(this).closest('.list-add-data');
//             $parent.insertBefore($parent.prev());
//         })
//         .on('click', '.header-list-edit .fa-pencil', function () {
//             $(this)
//                 .closest('.header-title')
//                 .find('.list-title')
//                 .removeAttr('readonly')
//                 .attr('placeholder', '')
//                 .val('')
//                 .focus();
//         })
//         .on('click', '.header-list-edit .fa-trash', function () {
//             $(this)
//                 .closest('.todo-list-inner-box')
//                 .remove();
//         })
//         .on('change', '.list-check', function() {
//             let $that = this;
//             if(this.checked) {
//                 $($that)
//                    .closest('.list-add-data')
//                    .find('.list-check-txt')
//                    .addClass('done')
//                    .removeClass('redact')
//                    .attr('readonly', true);
//             } else {
//                 $($that)
//                     .closest('.list-add-data')
//                     .find('.list-check-txt')
//                     .removeClass('done')
//                     .addClass('redact')
//                     .attr('readonly', false);
//             }
//         })
//         .on('mouseenter', '.list-add-data', function() {
//            $(this).find('.change-data-checker').show();
//         })
//         .on('mouseleave', '.list-add-data', function() {
//             $(this).find('.change-data-checker').hide();
//         })
//         .on('click', '.add-todo-list', function () {
//             $(".todo-list-inner-box.clean-add-list").clone()
//                 .addClass("new-todo-list")
//                 .appendTo(".container");
//
//             $('.new-todo-list')
//                 .find('.list-title')
//                 .removeAttr('readonly')
//                 .attr('placeholder', '')
//                 .val('')
//                 .focus();
//         })
//         .on('click', '.popup-btn', function() {
//             popupBlock = $('#'+$(this).data('popup'));
//             popupBlock
//                 .addClass('active')
//                 .find('.fade-out').click(function() {
//                     popupBlock.css('opacity','0').find('.popup-content').css('margin-top','350px');
//                     setTimeout(function(){
//                         $('.popup-authorization').removeClass('active');
//                         popupBlock.css('opacity','').find('.popup-content').css('margin-top','');
//                     }, 600);
//             });
//         })
//         .on('click', '.ok-popup', function() {
//             let
//                 validateLogin    = $(this)
//                     .closest('.user-authorization-form')
//                     .find('input[type="text"]')
//                     .val(),
//                 validatePassword = $(this)
//                     .closest('.user-authorization-form')
//                     .find('input[type="password"]')
//                     .val()
//                     .length;
//
//             if (validateLogin == '') {
//                 if($('.empty-login-error').length <= 0) {
//                     $(this)
//                         .closest('.user-authorization-form')
//                         .find('input[type="text"]')
//                         .addClass('empty-value')
//                         .parent()
//                         .append('<span class="empty-login-error">Enter login!</span>');
//                 }
//                 $(this)
//                     .closest('.user-authorization-form')
//                     .find('input[type="text"]')
//                     .focus(function() {
//                         $('.empty-login-error').remove();
//                         $(this)
//                             .closest('.user-authorization-form')
//                             .find('input')
//                             .removeClass('empty-value');
//                 });
//
//             } else if (validatePassword < 6) {
//                 if($('.empty-login-error').length <= 0) {
//                     $(this)
//                         .closest('.user-authorization-form')
//                         .find('input[type="password"]')
//                         .addClass('empty-value')
//                         .val('')
//                         .parent()
//                         .append('<span class="empty-login-error">Password must be longer than 6 characters!</span>');
//                 }
//                 $(this)
//                     .closest('.user-authorization-form')
//                     .find('input[type="password"]')
//                     .focus(function() {
//                         $('.empty-login-error').remove();
//                         $(this)
//                             .closest('.user-authorization-form')
//                             .find('input')
//                             .removeClass('empty-value');
//                     });
//             } else {
//                let addLoginUser     = $(this)
//                     .closest('.user-authorization-form')
//                     .find('input[type="text"]')
//                     .val(),
//                    resultDataLogin  = $('.user-authorization-login'),
//                    awayUser         = $('.away-user');
//
//                     $('.popup-authorization')
//                         .removeClass('active');
//                     popupBlock
//                         .css('opacity','')
//                         .find('.popup-content')
//                         .css('margin-top','');
//
//                 resultDataLogin.html(addLoginUser);
//                 awayUser.addClass('active');
//                 $('.popup-btn').hide();
//             }
//         })
//         .on('click', '.away-user', function() {
//             $(this)
//                 .removeClass('active')
//                 .closest('.login-wrap')
//                 .find('.user-authorization-login')
//                 .empty();
//
//             $('.popup-btn').show();
//
//             $('.user-authorization-form')
//                 .find('input')
//                 .val('');
//
//         });
});