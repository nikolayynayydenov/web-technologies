$(function(){
    $('#inlineRadio1:checked').click();
    //$('input:radio[name=inlineRadio_student]:checked').click();
    $('#inlineRadio1').on('click', function(){
        //$('#if_student').css('display', 'block');
        $('#if_student').removeClass("d-none");
        $('#if_teacher').addClass('d-none');
    });
    $('#inlineRadio2:checked').click();
    //$('input:radio[name=inlineRadio_teacher]:checked').click();
    $('#inlineRadio2').on('click', function(){
        $('#if_student').addClass('d-none');
        $('#if_teacher').removeClass('d-none');
    });
});