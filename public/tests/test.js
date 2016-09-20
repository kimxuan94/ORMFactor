$(document).ready(function () {
  $('#get-data').click(function () {
    var showData = $('#show-data');

    //Get all vehicles models
      $.getJSON('http://api.edmunds.com/api/vehicle/v2/makes?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc', function (data) {
      // console.log(data);

      var itema = data.makes.map(function (item) {
        return item.name;
      });

      showData.text('Constructeurs trouvée: ');


      if (itema.length) {
        var content = itema.join('</option><option>');
        var list = $('<select class="form-control" /><br>').html(content);
        showData.append(list);
      }
    });
    // showData.text('Choisissez votre marque');
    // showData.text('Choisissez votre marque');
  });
});

$(document).ready(function () {
  $('#get-model').click(function () {
    var showData = $('#show-model');

    //Get all vehicles models
    $.getJSON('https://api.edmunds.com/api/vehicle/v2/%7Bbmw%7D/models?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc', function (data) {
      console.log(data);

      showData.text('Choisissez votre modele BMW: ');

      var itemb = data.models.map(function (item) {
        return item.name;
      });

      if (itemb.length) {
        var content = '<option>' + itemb.join('</option><option>') + '</option>';
        var list = $('<select /><br>').html(content);
        showData.append(list);
      }
    });
    // showData.text('Choisissez votre marque');
    // showData.text('Choisissez votre marque');
  });
});

$(document).ready(function () {
  $('#get-model-bmw').click(function () {
    var showData = $('#show-model-bmw');

    //Get all vehicles models
    $.getJSON('https://api.edmunds.com/api/vehicle/v2/%7Bbmw%7D/models?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc', function (data) {
      console.log(data);

      showData.text('Choisissez votre modele BMW: ');

      var itemb = data.models.map(function (item) {
        return item.name;
      });

      if (itemb.length) {
        var content = '<option>' + itemb.join('</option><option>') + '</option>';
        var list = $('<select /><br>').html(content);
        showData.append(list);
      }
    });
  });
});

$(document).ready(function () {
  $('#get-model-audi').click(function () {
    var showData = $('#show-model-audi');

    //Get all vehicles models
    $.getJSON('https://api.edmunds.com/api/vehicle/v2/%7Baudi%7D/models?fmt=json&api_key=r8xsuf2vtd8a8nvxt7jaw2dc', function (data) {
      console.log(data);

      showData.text('Choisissez votre modèle Audi: ');

      var itemc = data.models.map(function (item) {
        return item.name;
      });

      if (itemc.length) {
        var content = '<option>' + itemc.join('</option><option>') + '</option>';
        var list = $('<select /><br>').html(content);
        showData.append(list);
      }
    });
    // showData.text('Choisissez votre marque');
    // showData.text('Choisissez votre marque');
  });
});
