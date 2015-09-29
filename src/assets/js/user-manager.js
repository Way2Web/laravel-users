$(document).ready(function() {

    $('input[name="password_confirmation"]').keypress(function() {
        $password = $('input[name="password"]').val();
        $confirmed = $(this).val();
        $message = [];
        $message["success"] = "Passwords are the same";
        $message["error"]   = "Passwords do not match";
        if($password.length > 10 && $confirmed.length > 10) {   
            if($password == $confirmed) {
                $('.check-password').removeClass('error').addClass('success').text($message['success']);
            } else {
                $('.check-password').removeClass('success').addClass('error').text($message["error"]);
            }
        }
    });

});