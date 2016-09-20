//Makes generator
$(function () {
    $.getJSON('http://api.edmunds.com/api/vehicle/v2/makes?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc',
    function (result) {
        var options = $("#makes");
        $.each(result.makes, function (idx, val) {
            options.append($('<option />', { value: idx, text: val.name }));
        });
    });
});

//BMW generator
$(function () {
    $.getJSON('https://api.edmunds.com/api/vehicle/v2/%7Bbmw%7D/models?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc',
    function (result) {
        var options = $("#bmw");
        $.each(result.models, function (idx, val) {
            options.append($('<option />', { value: idx, text: val.name }));
        });
    });
});

//Audi generator
$(function () {
    $.getJSON('https://api.edmunds.com/api/vehicle/v2/%7Baudi%7D/models?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc',
    function (result) {
        var options = $("#audi");
        $.each(result.models, function (idx, val) {
            options.append($('<option />', { value: idx, text: val.name }));
        });
    });
});
