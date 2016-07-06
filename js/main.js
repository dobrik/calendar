/**
 * Created by Dobrik on 01.07.2016.
 */
var eventsReload = function(){
    $.ajax({
        url: 'handler.php',
        method: 'POST',
        data: {getEvent: true},
        success: function (e) {
            markDate(e);
        }
    })
};
$('.date_slot').click(function (e) {
    $('input#date').val(e.currentTarget.dataset.date);
})
$().ready(Notification.requestPermission(function (e) {
    //console.log(e);
}));
$().ready(eventsReload);
$('#sendEvent').click(function () {
    var date = $('#date');
    var event = $('#event');
    var desc = $('#desc');
    var place = $('#place');
    if (event.val() != '' && desc.val() != '' && place.val() != '') {
        $.ajax(
            {
                url: 'handler.php',
                method: 'POST',
                data: {
                    date: date.val(), event: event.val(), desc: desc.val(), place: place.val()
                },
                success: function (e) {
                    $('#event_result').html(e);
                    $('#debug').html(e);
                    eventsReload();
                    Notification.requestPermission(function (permission) {
                        if (permission === "granted") {
                            var notification = new Notification('Событие создано!', {
                                body: e,
                                icon: 'img/notification-flat.png'
                            });
                            setTimeout(function () {
                                notification.close();
                            }, 8000);
                        }
                    });
                    setTimeout(function () {
                        $('#modal-result').modal('hide');
                    }, 5000)
                }
            })
        ;

        $('#date').val('');
        $('#event').val('');
        $('#desc').val('');
        $('#place').val('');
    } else {
        $('#event_result').html('Все поля надо заполнить!')
    }
})
function markDate(date) {
    var jsondata = JSON.parse(date);
    var slot = $('.date_slot');
    for (var i = 0; i < slot.length; i++) {
        for (var y = 0; y < jsondata.length; y++) {
            var curDate = slot[i].getAttribute('data-date');
            if (curDate == jsondata[y].date) {
                slot[i].setAttribute('class', 'date_slot event_date');
            }

        }
    }
}