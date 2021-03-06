<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Sub Modal Demo</title>
  
  <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.js'></script>
  <script type='text/javascript' src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='<?php echo JS; ?>bootstrap.submodal.js'></script>
  
  <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>all.css">

  <style type="text/css">
    /* Demo Styles */
    .demo-modal form .btn-mini{
        margin: 4px 0;
    }
    .demo-modal form p, .control-label{
        font-size: 12px;
        color: #888;
    }
    .center{
        text-align: center;
    }
    .sub-modal form{
        margin: 0;
    }
  </style>

</head>
<body>
  <!-- Button to trigger modal -->
  <a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

  <!-- Modal -->
  <div id="myModal" class="modal hide fade demo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Your Account</h3>
    </div>
    <div class="modal-body">
        
        <!-- Sub-Modal -->
        <div id="mySubModal" class="modal sub-modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-body">
                <p class="center">Are you sure you want to close your account?<br />You won't be able to undo this.</p>
                <hr />
                <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Confirm Your Password: </label>
                        <div class="controls">
                            <input type="text">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="submodal" aria-hidden="true">Cancel</button>
                <button class="btn btn-danger" data-dismiss="submodal">Close Account</button>
            </div>
        </div>
        
        <form class="form-horizontal">
          <div class="control-group">
            <label class="control-label" for="inputEmail">Your Account</label>
            <div class="controls">
              <a href="#mySubModal" role="button" class="btn btn-mini" data-toggle="submodal">Close my account…</a>
              <p>By closing your account, you will lose access to your financial data and your keys will be expired. This action is irreversible.</p>
            </div>
          </div>
            <hr />
          <div class="control-group">
            <label class="control-label" for="inputEmail">Your Account</label>
            <div class="controls">
              <a href="#mySubModal" role="button" class="btn btn-mini" data-toggle="submodal">Close my account…</a>
              <p>By closing your account, you will lose access to your financial data and your keys will be expired. This action is irreversible.</p>
            </div>
          </div>
        </form>
        
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal">Done</button>
    </div>
</div>
  
</body>
</html>
