@extends('layouts.master')

@section('content')
   <div class="row">
       <div class="col-12">
        <div class="card mt-2">
            <div class="card-header bg-transparent">
                  <h4>Send Mail</h4>
               </div>
               <div class="card-body">
                <form id="mail">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <div class="row">
                       <div class="form-group col-lg-6 col-sm-10 col-md-10">
                           <label for="first_name">Subject</label>
                           <input type="text" class="form-control" name="subject" id="subject">
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-lg-6 col-sm-10 col-md-10">
                           <label for="last_name">Message</label>
                           <textarea name="message" id="message" cols="30" rows="4" class="form-control"></textarea>
                       </div>
                    </div>
                        <button class="btn btn-primary" id="send_btn">Send</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                </form>
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
 @parent
 <script>
      $('#send_btn').on('click', function (event) {
         event.preventDefault();
         var subject = $('#subject').val();
         var message = $('#message').val();
         if (subject == '' || message == ''){
            swal({
               title: 'Fields validation',
               text: 'Please enter in all the fields',
               icon: 'warning',
               buttons: 'Ok'
            });
         } else {
            $.ajax({
              url: '{{ route('mails.send') }}',
              type: 'POST',
              data: $('#mail').serialize(),
              dataType: 'json',
              success: function (response){
                swal({
                   title: 'Message',
                   text: response.status,
                   icon: 'success',
                   buttons: 'Ok'
                   });
              },
              error: function (response){
                swal({
                   title: 'Message',
                   text: 'Connection could not be established',
                   icon: 'error',
                   buttons: 'Ok'
                   });
              }
            })
         }
      })
 </script>
@endsection


