@extends('layouts.master')

@section('content')
   <div class="row">
       <div class="col-12">
        <div class="card mt-2">
            <div class="card-header bg-transparent">
                  <h4>Send Mail</h4>
               </div>
               <div class="card-body">
                <form>
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
                        <button class="btn btn-primary" id="update_btn">Send</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>

                </form>
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
 @parent
@endsection


