<link rel="stylesheet" href="{{asset('user_assets/css/bootstrap.min.css')}}">
<script src="{{asset('user_assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('user_assets/js/jquery-3.3.1.min.js')}}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions">
                    <a href="{{url('/')}}" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Home </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>
