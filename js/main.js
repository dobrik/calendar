/**
 * Created by Dobrik on 01.07.2016.
 */
$('.date_slot').click(function (e) {
    $('input#date').val(e.currentTarget.dataset.date);
})
$('#sendEvent').click(function () {
    var date = $('#date');
    var event = $('#event');
    var desc = $('#desc');
    var place = $('#place');
    if (event.val() != '' && desc.val() != '' && place.val() != '') {
        $.get('handler.php?date=' + date.val() + '&event=' + event.val() + '&desc=' + desc.val() + '&place=' + place.val(), function (e) {
            $('#event_result').html(e);
			Notification.requestPermission(function (permission) {
				if (permission === "granted") {
				var notification = new Notification(e);
				setTimeout(function(){
					notification.close();
				},5000);
				}
			});
            setTimeout(function () {
                $('#modal-result').modal('hide');
            }, 5000)
        });
        $('#date').val('');
        $('#event').val('');
        $('#desc').val('');
        $('#place').val('');
    }else{
        $('#event_result').html('Все поля надо заполнить!')
    }
})