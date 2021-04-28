@extends('layouts.master')

@section('content')
   <div class="row">
       <div class="col-12">
           <div class="card mt-2">
               <div class="card-header">
                  <h4>Archived list</h4>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                    <table id="students" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{$student->id}}</td>
                                <td>{{$student->first_name}}</td>
                                <td>{{$student->last_name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td>
                                    <div class="d-flex">
                                         <a href="javascript:void(0)" onclick="restoreStudent({{$student->id}})" class="btn btn-info">Restore</a>
                                         <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                         <a href="javascript:void(0)" class="btn btn-danger ml-2" onclick="deleteStudent({{$student->id}})">DELETE</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                   </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
 @parent
 <script>
  $('#students').DataTable();
  function restoreStudent(id){
      if (confirm('Are you sure you want to restore this record?')){
        $.ajax({
           url: '/students/'+id+'/restore',
           type: 'POST',
           data: {
                  _token:$('#_token').val(),
           },
           dataType: 'json',
           success: function (response) {
                swal({
                      title: 'Information',
                      text: response.status,
                      icon: response.icon,
                      buttons: 'Ok'
                }).then(function(){
                    window.location.reload();
                })
           }
       });
      }
  }

  function deleteStudent(id){
    if (confirm('Are you sure you want to permanently delete this record?')){
        $.ajax({
           url: '/students/'+id+'/delete',
           type: 'DELETE',
           data: {
                  _token:$('#_token').val(),
           },
           dataType: 'json',
           success: function (response) {
                swal({
                      title: 'Information',
                      text: response.status,
                      icon: response.icon,
                      buttons: 'Ok'
                }).then(function(){
                    window.location.reload();
                })
           }
       });
    }
  }
 </script>
@endsection
