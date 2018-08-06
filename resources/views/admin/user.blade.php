@extends('admin.master')


@section('content')
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User List</h3>
              </div>

              <div class="title_right">
                <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                   
                    
                  </div>
                </div>
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

        
        <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th></th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                 <th>Mobile</th>
                <th>created_at</th>
                <th>Action</th>
      
            </tr>
        </thead>
        <tbody>
            @foreach($users as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->first_name}} </td>
                 <td>{{$row->last_name}} </td>
                <td>{{$row->email}}</td>
                <td>{{$row->mobile}} </td>
                <td>{{$row->created_at}}</td>
                
                <td><a  class="btn btn-primary btn-xs" href="{{ url("admin/users/$row->id") }}">View</a> 
                {!! Form::open(array('url' => "admin/users/".$row->id,'method' => 'delete')) !!}
                      {!!Form::submit('delete!' , array(' class'  => 'btn btn-danger btn-xs','name'=>'delete' )); !!}  
                    {!! Form::close() !!} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
              @section('footerscript')
                                <!-- js -->
              <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
              <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
              <!-- js -->
              <!-- css -->
              <link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet">
              <!-- css -->
                
              <script type="text/javascript" class="init"> 
              $(document).ready(function() {
                $('#example').DataTable( {
                  
                  initComplete: function () {
                    this.api().columns().every( function () {
                      var column = this;
                      var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                          );
               
                          column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                        } );
               
                      column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                      } );
                    } );
                  }
                } );
                
              } );
               
              </script>
                <script>
                $(document).ready(function() {
                oTable=$('#example').DataTable();

                var oTable = $('#example').dataTable();

                // Sort immediately with columns 0 and 1
                oTable.fnSort( [ [0,'desc'] ] );

                });
                </script>
                  @endsection
                  </div>
                </div>
              </div>
            </div>

          </div>
         </div>
@endsection
