<!-- ================== Footer  ================== -->
<!--Widget Whatsapp-->
<!--Widget Whatsapp end-->
<footer>

    <!--footer links-->
    <div class="footer-links">
        <div class="row">
            <div class="col-sm-4 col-md-2">
            </div>
            <div class="col-sm-4 col-md-2">
            </div>
            <div class="col-sm-4 col-md-2">
                <h5></h5>
            </div>
            <div class="col-sm-4 col-md-2">
            </div>
            <div class="col-sm-12 col-md-12">
                <h5>Sign up for our newsletter</h5>
                <p><i>Add your email address to sign up for our monthly emails and to receive promotional offers.</i></p>
                <div class="form-group form-newsletter">
                    <input class="form-control" type="text" name="email" value="" placeholder="Email address" />
                    <input type="submit" class="btn btn-main btn-sm" value="Subscribe" />
                </div>
            </div>
        </div>
    </div>

<!--footer social-->

    <div class="footer-social">
        <div class="row">

            <div class="col-md-6  links">
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!--JS files-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.bootstrap.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/js/jquery.owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/jquery.ion.rangeSlider.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>


<!-- <script src="https://cdn.tiny.cloud/1/fgubiqw56r03ri5kika6lt60fbuy2wgf930m75v87kyx7uvj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="https://cdn.tiny.cloud/1/fzxfo2kr8mflwqf6eh4lpq001t14sd64r4varfm7i0451r9n/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

<script>
    // Function to show toast messages
    function showToast(message, type) {
        const toastClass= type === 'success' ? 'green' : 'red' ;
        const toastHTML = `
                <div class="toast ${toastClass}  white-text show" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" style="margin-bottom: 10px;">
                    <div class="toast-header">
                        <strong class="mr-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;
        $('.toast').addClass('show')
        $('#toast-container').append(toastHTML)
        $('.toast').last().toast('show')
    }


    // Show success or error messages from session
    @if(session('success'))
    showToast("{{ session('success') }}", 'success');
    @elseif(session('error'))
    showToast("{{ session('error') }}", 'error');
    @endif

</script>
</body>
