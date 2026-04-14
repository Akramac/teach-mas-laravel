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
    .contact form{
        width:50%;
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

                <div class="h4" style="text-align: center">Edit Prodile </div>

                <hr />
                <div class="row">

                    <form method="post" action="{{url('loggedin/edit-profile')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" class="form-control" value="{{Auth::user()->id}}"  hidden/>

                        <div class="form-group col-md-12">
                            <label>Change your email</label>
                            <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}" />
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Change Name</label>
                            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" placeholder="Your name"  />
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Change profile photo</label>
                            <input type='file' name='image' class="form-control" size='20' />
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="login" value="Submit" class="btn btn-info" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<a style="float:right;" href="<?php /*echo base_url(); */?>register">Forgot password ?</a>-->
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
