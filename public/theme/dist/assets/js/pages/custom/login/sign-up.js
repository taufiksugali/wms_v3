$(document).on('change', '#fullname', function () {
    var fullname = $("#fullname").val();
    // console.log(fullname);
    $('#get_fullname').html(fullname);
})

$(document).on('change', '#email', function () {
    var email = $("#email").val();
    $('#get_email').html(email);
})

$(document).on('change', '#signup_phone', function () {
    var phone = $("#signup_phone").val();
    $('#get_phone').html(phone);
})

$(document).on('change', '#company', function () {
    var phone = $("#company").val();
    $('#get_company').html(phone);
})