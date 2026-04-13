@include('partials.header')
<!-- Compiled and minified CSS -->
<link rel="stylesheet" media="all" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css" />
<style>
    @import url("{{asset('assets/css/materialize.css')}}");
    @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css);
    @import url('https://fonts.googleapis.com/css?family=Roboto');

    nav .logo img {
        width: 140px !important;
        height: 70px !important;
    }
</style>


<div class="page-loader"></div>

<div class="wrapper">

    <!-- ======================== Navigation ======================== -->

@include('partials/menu')

<!-- ========================  Tabsy wrapper ======================== -->

    <!-- ========================  Icons slider ======================== -->


    <!-- ========================  Block banner category ======================== -->
    <section class="contact section-register">
        <div class="container">
            <br />
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <br />

            <div class="panel panel-default">
                <div class="panel-heading">Register as {{request('user')}}</div>
                <div class="panel-body">
                    <form method="post" action="{{route('registerData')}}">
                        @csrf
                        <div class="form-group" hidden>
                            <label>Type</label>
                            <input type="text" id="type" name="user_type" class="form-control" value="{{request('user')}}"  />
                        </div>

                        <div class="form-group">
                            <label for="user_name">Enter Your Name</label>
                            <input type="text" name="name" class="form-control" autocomplete="off" required/>
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group">
                            <label>Enter Your Valid Email Address</label>
                            <input type="email" name="email" class="form-control"  autocomplete="off"/>
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group">
                            <label>Enter Password</label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password" required />
                            <span class="text-danger" style="color:red;"></span>
                        </div>
                        <div class="form-group">
                            <button  type="submit" name="register"  class="btn btn-info"> Register</button>
                            <a href="{{route('login')}}"><span class="text-danger" style="color:green;float:right;">Already have account?  Login !</span></a>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>


    @include('partials/footer')
    <div>
    </div>
</div> <!--/wrapper-->
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    $(document).ready(function(){

    })
</script>

</html>
