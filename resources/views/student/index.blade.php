@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between bg-transparent">
               <h4>All Students</h4>
               <a href="{{ route('students.trashed') }}" class="btn btn-primary ml-2"> <i class="fa fa-list"></i> Archived Students</a>
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
                                <td class="d-flex">
                                   <a href="{{ route('students.edit', ['id'=>$student->id]) }}" class="btn btn-info">EDIT</a>
                                   <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                   <a href="javascript:void(0)" class="btn btn-danger ml-2" onclick="archiveStudent({{$student->id}})">ARCHIVE</a>
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
    function archiveStudent(id){
        swal({
          title: "Are you sure you want to archive this record?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url: 'students/'+id,
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
       });
    }
 </script>
@endsection
