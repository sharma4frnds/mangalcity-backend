<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Give Feedback on This Post</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">

    <div class="alert alert-danger" role="alert" id="errer_div" style="display: none"></div>

       {{ csrf_field() }}
        <h4>We use your feedback to help us learn when something's not right.</h4>
       
        @foreach($spam_tags as $tag)
       <div class="radio">
          <label><input type="radio" name="spam_tags" id="spam_tags"  value="{{$tag->id}}" checked>{{$tag->name}}
          </label>
       </div>
       @endforeach
       <input type="hidden" name="post_id" id="post_id" value="{{$id}}">

       <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="reportFeedback()">Send</button>  
       </div>

  </form>

  </div>
  <div class="modal-footer">
   
  </div>
