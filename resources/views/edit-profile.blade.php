@extends('layouts.master-layouts')

@section('title')
Edit Profile
@endsection
{!! NoCaptcha::renderJs() !!}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />

@section('body')

<body class="index-background" data-layout="horizontal">
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    @endsection
    @section('content')


    <div class="total-content mb-5">
        <div class="text-center">
            <h3 class="title-font title-color">EDIT PROFILE</h3>
        </div>
        <hr class="accountbottmline mb-2">
        <div>
             @if(Session::get('no_captcha'))
            <span class="error">
                <strong>{{ Session::get('no_captcha') }}</strong>
            </span>
            @endif
        </div>
        @if ($errors->any())
        <label for="email" class="error">{{ $errors->first('email') }}</label><br>
        <label for="old_password" class="error">{{ $errors->first('old_password') }}</label><br>
        <label for="new_password" class="error">{{ $errors->first('new_password') }}</label>
        @endif


        <div>
            <form action="{{ url('/edit-profile/edit') }}" method="post">
                {{csrf_field()}}

                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Username
                    </div>
                    <div>
                        <input class="form-control" type="text" id="username" name="username" value="{{Auth::user()->name}}" readonly required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        PlayerID(In Game ID)
                    </div>
                    <div>
                        <input class="form-control" type="text" id="ig_id" name="ig_id" value="{{Auth::user()->ig_id}}" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        In Game Nickname(IGN)
                    </div>
                    <div>
                        <input class="form-control" type="text" id="ign" name="ign" value="{{Auth::user()->ign}}" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Phone
                    </div>
                    <div>
                        <input class="form-control" type="text" id="phone_number" name="phone_number" value="{{Auth::user()->phone_number}}" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Your Email address
                    </div>
                    <div>
                        <input class="form-control" type="email" id="email" name="email" value="{{Auth::user()->email}}" readonly required>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Old Password
                    </div>
                    <div>
                        <input class="form-control" type="password" id="old_password" name="old_password" required>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color" required>
                        New Password
                    </div>
                    <div>
                        <input class="form-control" type="password" id="new_password" name="new_password" placeholder="new password">
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        Verify Password
                    </div>
                    <div>
                        <input class="form-control" type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm password">
                    </div>
                </div>
                  <div class="form-group mb-2">
                    <div class="mb-2">
                        <img id="srcImg" class="w-50" src="{{Auth::user()->avatar}}" />
                        <input type="text" name="base_image" id="base_image" value="{{Auth::user()->avatar}}" hidden>
                    </div>
                    <div>
                        <input name="image" id="avatar" type="file">
                    </div>
                </div>
             
                <div class="form-group mb-2">
                    <div class="mb-1 title-font title-color">
                        How did you find us?
                    </div>
                    <div>
                        <input class="form-control" type="text" id="find_us" name="find_us" value="{{Auth::user()->find_us}}" placeholder="demo">
                    </div>

                </div>
                
                <div class="text-center mb-2 title-color">
                    {!! app('captcha')->display() !!}
                </div>

                <div class="form-group mb-2 text-center">
                    <button type="submit" class="btn btn-success waves-effect waves-light title-font mt-2" style="font-size:2rem">Update</button>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>





    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>

    <script>
        $("body").on("change", "#avatar", function(e) {
            console.log('ddd');
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $('#modal').modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $('#modal').on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#srcImg').attr('src', base64data);
                    $('#base_image').val(base64data);
                    $('#modal').modal('hide');
                }
            });
        })
    </script>
    @endsection