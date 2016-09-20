//Makes generator
$(function () {
    $.getJSON('./public/js/renter.json',
    function (result) {
        var options = $("#loueur");
        $.each(result.renters.renter, function (idx, val) {
            options.append($('<option />', { value: idx, text: val.rsociale }));
        });
    });
});
