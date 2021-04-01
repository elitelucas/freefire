@extends('layouts.master-layouts')

@section('title')
Chat
@endsection
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


    <div class="total-content">
        <div class="text-center p-2" style="background-color: #0782C0">
            <h3 class="title-font title-color">
                WELCOME <span class="text-danger">&nbsp;{{Auth::user()->name}}</span>
            </h3>
        </div>
        <div id="main_chat_div" class="pl-3 pt-3" style="background:white;height:500px;overflow:auto">
              @foreach($chat as $item)
            <div class="p-2">
                <div class="w-100">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img width="50%" src="${item.avatar}">
                        </div>
                        <div class="col-6">
                            <div class="text-danger mb-3">
                                <strong>
                                    {{$item->name}}
                                </strong>
                            </div>
                            <div>
                                {{$item->chat_content}}
                            </div>

                        </div>
                        <div class="col-3"> {{$item->chat_created_date}}</div>
                    </div>
                </div>
                <hr class="accountbottmline mb-2">
            </div>
            @endforeach
        </div>
        <div>
            <div class="text-center title-color pt-1 pb-1">
                Message
            </div>
            <div class="form-group mt-2">
                <textarea class="form-control" name="chat_input" id="chat_input" placeholder="Type Here ..." required></textarea>
            </div>
            <div class="text-center mt-2">
                <button id="send_button" class="btn btn-info title-font" style="font-size:1.5rem" @if(!$chat_status) disabled @endif>SEND</button>
                <span class="text-white">(<a href="{{url('/chat/history')}}" class="title-color">Chat History</a>)</span>
            </div>
        </div>



    </div>




    @endsection

    @section('script')
    <!-- Plugin Js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/emojione.picker.js') }}"></script>


    <script>
        $("textarea").emojionePicker({
            type: "unicode"
        });
        $(document).ready(function() {
            setTimeout(function(){  $('.emojionepicker-picker').addClass('emoji-position'); }, 1000);
          
            $('#send_button').click(function() {
                var chat_val = $('#chat_input').val();
                $('#chat_input').val('');
                console.log(chat_val);
                var avatar='{{Auth::user()->avatar}}';
                var name='{{Auth::user()->name}}';
                 $('#main_chat_div').append(
                      `<div class="p-2">
                <div class="w-100">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img width="50%" src="${avatar}">
                        </div>
                        <div class="col-6">
                            <div class="text-danger mb-3">
                            <strong>
                            ${name}
                            </strong>
                            </div>
                            <div>
                            ${chat_val}
                            </div> 
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
                <hr class="accountbottmline mb-2">
            </div>`
                     );
              
                $.ajax({
                    url: '/chat/addChat',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        chat_val
                    },
                    success: function(data) {
                        var chat = JSON.parse(data);
                    var ss = '';
                    chat.slice().reverse().forEach(function(item) {
                        ss += `<div class="p-2">
                <div class="w-100">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img width="50%" src="${item.avatar}">
                        </div>
                        <div class="col-6">
                            <div class="text-danger mb-3">
                            <strong>
                            ${item.name}
                            </strong>
                            </div>
                            <div>
                            ${item.chat_content}
                            </div> 
                                                  
                        </div>
                        <div class="col-3"> ${item.chat_created_date}</div>
                    </div>
                </div>
                <hr class="accountbottmline mb-2">
            </div>`
                    });
                    $('#main_chat_div').html(ss);

                    }
                });
            })
        })

        function getChat() {
            $.ajax({
                url: '/chat/getChat',
                type: 'GET',
                success: function(data) {
                    var chat = JSON.parse(data);
                    var ss = '';
                    chat.slice().reverse().forEach(function(item) {
                        ss += `<div class="p-2">
                <div class="w-100">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img width="50%" src="${item.avatar}">
                        </div>
                        <div class="col-6">
                            <div class="text-danger mb-3">
                            <strong>
                            ${item.name}
                            </strong>
                            </div>
                            <div>
                            ${item.chat_content}
                            </div> 
                                                  
                        </div>
                        <div class="col-3"> ${item.chat_created_date}</div>
                    </div>
                </div>
                <hr class="accountbottmline mb-2">
            </div>`
                    });
                    $('#main_chat_div').html(ss);
                }
            });
        }
    </script>



    @endsection