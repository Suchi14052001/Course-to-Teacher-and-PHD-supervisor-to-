<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<div class="panel-heading custom-header-panel">
                <h3 class="panel-title" style="text-align:center;">Add a new student </h3>
              </div><br>
<div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="name" style="font-size:14px;">Student name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="cid" id="cid" maxlength="70" placeholder="Enter student name"  style="text-align:left;">
                  </div>
                </div>
<div class="form-group">
                    <label for="country" class="col-sm-3 control-label" style="font-weight:bold;font-size:14px;">Degree</label>
                    <div class="col-sm-8">
                      <select id="degree" name="degree" required class="form-control">
                        <option value="" disabled="" selected="">Select the degree</option>
                        <option value="1">IMTech</option>
                        <option value="2">MCA</option>
                        <option value="3">MTech</option>
                        <option value="4">PHD</option>

                      </select>
                    </div>
                  </div>
<select class="selectpicker" multiple data-live-search="true">
  <option>Mustard</option>
  <option>Ketchup</option>
  <option>Relish</option>
</select>
<script>
$('select').selectpicker();
</script>