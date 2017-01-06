/*
 --------------------------------------------------------------------
 view-connexion.js
 --------------------------------------------------------------------
 Creator : X.ROUILLY 10/02/2015
 --------------------------------------------------------------------
 (c) 2013. All Rights Reserved.  FCPE
 --------------------------------------------------------------------
 */

$(function() {
    $("[rel='tooltip']").tooltip();    
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );
        
    $("#username2").keypress(function(event) {
        saisieMDP(event);
    });
    
    $("#password2").keypress(function(event) {
        saisieMDP(event);
    });
    
    $("#btnLogin2").click(function() {
        $("#menu_HCnxLog").val($('#username2').val());
        $("#menu_HCnxPas").val(calcMD5($('#password2').val()));
        $('#menu_HCnxForm').submit();
    });
    
});