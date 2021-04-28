@extends('layouts.master')

@section('content')
   <div class="row">
       <div class="col-12">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between bg-transparent">
                  <h4>Add Student</h4>
               </div>
               <div class="card-body">
                   <form id="student_form">
                       <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                       <div class="row">
                        <div class="form-group col-lg-6 col-sm-10 col-md-10">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                        </div>
                       </div>
                      <div class="row">
                        <div class="form-group col-lg-6 col-sm-10 col-md-10">
                           <label for="last_name">Last Name</label>
                           <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                       </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-6 col-sm-10 col-md-10">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                       </div>
                       <div class="row">
                        <div class="form-group col-lg-6 col-sm-10 col-md-10">
                            <label for="email">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                         </div>
                        </div>
                        <button class="btn btn-primary" id="save_btn">Save</button>
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
     $('#save_btn').on('click', function (event) {
        event.preventDefault();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        if (first_name == '' || last_name == '' || email == '' || phone == '') {
            swal({
                title: 'Fields validation',
                text: 'Please enter in all the fields',
                icon: 'warning',
                buttons: 'Ok'
            });
        } else {
            $.ajax({
                url: "{{route('students.store')}}",
                type: 'POST',
                data: $('#student_form').serialize(),
                dataType: 'json',
                success: function (response) {
                    swal({
                       title: 'Information',
                       text: response.status,
                       icon: response.icon,
                       buttons: 'Ok'
                    });
                    $('#student_form').trigger('reset');
                }
            });
        }
    });
 </script>

@endsection
