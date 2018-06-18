@extends('admin.master')


@section('content')
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tags {{isset($tags) ? 'Edit':'Create'}}</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />

                    @if (count($errors) > 0)
                       <div class="alert alert-danger">
                              <ul class='text'>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif

                     @if(isset($tags))
                      {!! Form::open(array('url' => 'admin/tags/'.$tags->id,'method' => 'PUT','class' => 'form-horizontal form-label-left', 'files' => true)) !!}
                      @else
                    {!! Form::open(array('url' => 'admin/tags','method' => 'POST','class' => 'form-horizontal form-label-left', 'files' => true)) !!}
                    @endif

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" value="{{ old('name',  isset($tags->name) ? $tags->name : null) }}">
                        </div>
                      </div>

             
                       <div class="form-group">
                        <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">
                        Status  <span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <select id="status" name="status" required="required" class="form-control col-md-7 col-xs-12" >
                           <option value="active" @if(isset($tags)) @if($tags->status=='active')  selected @endif @endif> Active </option>

                           <option value="inactive" @if(isset($tags)) @if($tags->status=='inactive')  selected @endif @endif>Inactive </option>
                          </select>
                        </div>
                      </div>

                    <div class="ln_solid"></div>

                      <div class="form-group">
                      <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">submit</button>
                        
                      </div>
                    </div>

                    {!! Form::close() !!}

                      @section('footerscript')
                      <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                      <script>tinymce.init({ selector:'#description' });</script>
                       @endsection
                  </div>
                </div>
              </div>
            </div>

          </div>
         </div>
@endsection
