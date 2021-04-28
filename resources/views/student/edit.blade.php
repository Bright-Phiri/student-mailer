@extends('layouts.master')

@section('content')
   <div class="row">
       <div class="col-12">
        <div class="card mt-2">
            <div class="card-header bg-transparent">
                  <h4>Edit Student</h4>
               </div>
               <div class="card-body">
                   <form id="student_form">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id" value="{{$student->id}}">
                    <div class="row">
                       <div class="form-group col-lg-6 col-sm-10 col-md-10">
                           <label for="first_name">First Name</label>
                           <input type="text" class="form-control" name="first_name" id="first_name" value="{{$student->first_name}}" placeholder="First Name">
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-lg-6 col-sm-10 col-md-10">
                           <label for="last_name">First Name</label>
                           <input type="text" class="form-control" name="last_name" id="last_name" value="{{$student->last_name}}" placeholder="Last Name">
                       </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-10 col-md-10">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{$student->email}}" placeholder="Email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-10 col-md-10">
                            <label for="email">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{$student->phone}}" placeholder="Phone">
                        </div>
                    </div>
                        <button class="btn btn-primary" id="update_btn">Update</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
                   </form>
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
 @parent
 <script>
    $('#update_btn').on('click', function (event) {
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
           if (confirm('Are you sure you want to update this record?')){
            $.ajax({
               url: '{{ route('students.update') }}',
               type: 'PUT',
               data: $('#student_form').serialize(),
               dataType: 'json',
               success: function (response) {
                   swal({
                      title: 'Information',
                      text: response.status,
                      icon: response.icon,
                      buttons: 'Ok'
                   }).then(function(){
                    $('#student_form').trigger('reset');
                    window.location.href = '{{route('students.index')}}';
                   })
               }
           });
           }
       }
   });
</script>
@endsection


