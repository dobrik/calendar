/**
 * Created by Dobrik on 01.07.2016.
 */
$('.date_slot').click(function (e) {
    $('input#date').val(e.currentTarget.dataset.date);
})
$('#sendEvent').click(function () {
    var date = $('#date').val();
    var event = $('#event').val();
    var desc = $('#desc').val();
    var place = $('#place').val();
    $.get('handler.php?date='+date+'&event='+event+'&desc='+desc+'&place='+place, function(e){
        $('#event_result').html(e);
        setTimeout(function(){
            $('#modal-result').modal('hide');
        },5000)
    });
})