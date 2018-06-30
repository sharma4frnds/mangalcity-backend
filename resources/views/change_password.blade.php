@extends('layouts.master')
@section('title','Mangalcity')

@section('content')
      <section class="think-pnl post-pnl updates">
        <div class="container">
          <div class="row">
        
          @include('left_bar')

            <div class="col-md-8 col-sm-6 col-xs-12">
              <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">

            <h1>Change password</h1>
            <section>
              {!! Form::open(array('url' => 'user/change_password','method' => 'POST','class' => '','files' => true)) !!}

              @if(!$errors->passwordErrors->isEmpty())
              <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->passwordErrors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif

              @if(session()->has('passwordMessages'))
                <div class="alert alert-success">
                  {{ session()->get('passwordMessages') }}
                </div>
              @endif

                <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Old Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Old Password" name="old_password" required="">
                        </div>
                  </div>
                <div class="clearfix"></div>
                 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="New Password" name="password" required="">
                      </div>
                    </div>
                         
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required="">
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class=" upd btn btn-primary">Update</button>
                        </div>
                      </div>
              </form>
            </section>


          
       
                <!-- tab -->



                  
              </div>
              </div>
             
            <!-- post -->
          </div>
        </div>
        
      </section>

@endsection
@section('footer_script')

@endsection