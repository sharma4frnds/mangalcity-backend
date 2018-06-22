@extends('admin.master')
@section('content')
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>City List</h3>
              </div>

              <div class="title_right">
                <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                     <a href={{url('admin/addcity')}}> <button class="btn btn-primary" type="submit">Add City</button></a>
                    
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
                <th>Name</th>
                <td>District</td>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citys as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}} </td>
                <td>{{$row->district->name}} </td>
                <td>{{$row->created_at}}</td>
                <td>
                
                  <button class="btn btn-danger btn-xs" onclick="deleteItam({{$row->id}})">Delete</button>
              </td>
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
                <script type="text/javascript">
                   function deleteItam(id){
              if(confirm("Are you sure?"))
              {
                $.ajax({
                url:'daleteCity',
                type:'POST',
                beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                cache: false,
                async:false,
                data:{'id':id},
                success:function(data){
                 location.reload();
                }
                })
              }
            }
                </script>
                  @endsection
                  </div>
                </div>
              </div>
            </div>

          </div>
         </div>
@endsection
