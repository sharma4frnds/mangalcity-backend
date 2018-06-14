<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Give Feedback on This Post</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
       {{ csrf_field() }}
        <h4>We use your feedback to help us learn when something's not right.</h4>
        post Number: {{$id}}
       <div class="radio">
          <label>
            <input type="radio" name="spam_tags"  value="option1" checked>Nudity
          </label>
       </div>

        <div class="radio">
          <label>
            <input type="radio" name="spam_tags" id="optionsRadios1" value="option1" >Violence
            
          </label>
       </div>

        <div class="radio">
          <label>
            <input type="radio" name="spam_tags" id="optionsRadios1" value="option1" >Harassment
           
          </label>
       </div>

        <div class="radio">
          <label>
            <input type="radio" name="spam_tags" id="optionsRadios1" value="option1" >Suicide or Self-Injury
          </label>
       </div>

        <div class="radio">
          <label>
            <input type="radio" name="spam_tags" id="optionsRadios1" value="option1" >False News
          </label>
       </div>

        <div class="radio">
          <label>
            <input type="radio" name="spam_tags" id="optionsRadios1" value="option1" >Spam
          </label>
       </div>
    
       <input type="hidden" name="post_id" value="{{$id}}">
        <button type="button" class="btn btn-primary">Send</button>
  </form>

  </div>
  <div class="modal-footer">
   
  </div>
