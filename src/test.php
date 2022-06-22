<!DOCTYPE html>
<html>
<head>
<link href="http://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>

</head>
<body>

<select class="chosen chosen-select" multiple="" data-placeholder="Choose a Country" style="width:200px">
    <option value="America">America</option>
     <option value="Amsterdam">Amsterdam</option>
      <option value="Australia">Australia</option>
    <option value="Dallas">Dallas</option>
    <option value="GHI">hij</option>
</select>
<script>
$(".chosen-select").chosen();

$(".chosen-select-deselect").chosen({
  allow_single_deselect: true
});
/*$('.chosen-choices input').autocomplete({
  source: function(request, response) {
    $.ajax({

      url: "/someURL/" + request.term + "/",
      dataType: "json",
      beforeSend: function() {
        $('ul.chosen-results').empty();
      },
      success: function(data) {
        alert("Success!");
        response($.map(data, function(item) {

          $('ul.chosen-results').append('<li class="active-result">' + item.name + '</li>');
        }));
      }
    });
  }
});*/
</script>
</body>

</html>