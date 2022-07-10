<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <style>
        .contain {
            padding: 0 15px;
        }
        .log {
            padding: 20px;
        }
        .logout {
            float: right;
        }
        .head {
            background: gray;
            margin-bottom: 30px;
        }
        h2{
            padding: 30px 0;
        }
        .form {
            border-left: 1px solid;
        }
    </style>
</head>
<body>
    <div class="contain">
        <div class="row head">
            <div class="col-md-12 log">
                <div class="logout">
                    <form action="<?= base_url('auth/logout');?>" method="post">
                        <div class="form-group">
                        <button class="form-control btn btn-sm btn-primary" type="submit" name="logout">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h2>Vehicle List</h2>
                <table class="table table-striped table-bordered" id="sortTable">
                    <thead>
                        <tr>
                            <th>Sr. Number</th>
                            <th>Vehicle Name</th>
                            <th>Vehicle Type</th>
                            <th>Year Of Manufacturer</th>
                            <th>Date Of Purchase</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 form">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h2>Add Vehicle</h2>
                        <form id="vehicalForm">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Vehicle Name</label>
                              <input type="text" class="form-control" name="vName" id="vName" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Vehicle Type</label>
                              <select name="vType" id="vType" class="form-control">
                                <option value="">Select</option>
                                <option value="car">Car</option>
                                <option value="bike">Bike</option>
                                <option value="bus">Bus</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Year Of Manufacture</label>
                              <input type="text" class="form-control" name="yom" id="yom">
                            </div>
                            <div class="form-group">
                                <label for="exampleCheck1">Date Of Purchase</label>
                              <input type="date" class="form-control" id="dop" name="dop">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--  model  -->

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Vehicle Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="vehicalFormUpdate">
            <div class="form-group">
              <label for="exampleInputEmail1">Vehicle Name</label>
              <input type="text" class="form-control" name="vName" id="uName" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Vehicle Type</label>
              <select name="vType" id="uType" class="form-control">
                <option value="">Select</option>
                <option value="car">Car</option>
                <option value="bike">Bike</option>
                <option value="bus">Bus</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Year Of Manufacture</label>
              <input type="text" class="form-control" name="yom" id="uyom">
            </div>
            <div class="form-group">
                <label for="exampleCheck1">Date Of Purchase</label>
              <input type="date" class="form-control" id="udop" name="dop">
            </div>
            <input type="hidden" name='vehicle_id' id="vehicle_id">
            <button tdata-dismiss="modal" ype="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/home.js') ?>" defer></script>
</body>
</html>