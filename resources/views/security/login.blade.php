@include('partials.header')
<!-- Compiled and minified CSS -->
<head>
</head>
<link rel="stylesheet" media="all" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/toastr.min.css')}}">

<style>
    @import url("{{asset('assets/css/materialize.css')}}");
    @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css);
    @import url('https://fonts.googleapis.com/css?family=Roboto');

    nav .logo img {
        width: 140px !important;
        height: 70px !important;
    }

    .contact .row{
        justify-content: center;
    }
</style>


<div class="page-loader"></div>

<div class="wrapper">

    <!-- ======================== Navigation ======================== -->

@include('partials/menu')


<!-- ========================  Tabsy wrapper ======================== -->

    <!-- ========================  Icons slider ======================== -->


    <!-- ========================  Block banner category ======================== -->
    <section class="contact section-register" style="background-color: white;">
        <div class="container card  " style="margin-left: 20%;margin-top:5%;">

            <div class="login-block login-block-signup">

                <div class="h4" style="text-align: center">Login </div>

                <hr />
                <div class="row" >
                    <form method="post" action="{{url('login/validation')}}">
                        @csrf
                        <div class="form-group col-md-12">
                            <label>Enter your email</label>
                            <input type="email" name="email" class="form-control" value="" />
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Enter Password</label>
                            <input type="password" name="password" class="form-control" value="" />
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="login" value="Login" class="btn btn-info" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="float:right;" href="register">Forgot password ?</a>
                        </div>
                    </form>

                </div>
            </div> <!--/signup-->

        </div>

    </section>





    @include('partials/footer')

    <div>
    </div>
</div> <!--/wrapper-->
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script>
    $(document).ready(function(){
    })
</script>

</html>
