<?php $__currentLoopData = $city_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($city_post->comment[0])): ?>
<?php $cmnt_cout=0; $tcomment= count($city_post->comment); ?>

<?php $__currentLoopData = $city_post->comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if($cmnt->parent_id==0): ?>
<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv<?php echo e($cmnt->id); ?>">
<div class="col-md-11 cmnt-pnl-ped">
<div class="pro1">
    <?php if($city_post->user->id==Auth::user()->id): ?>
    <?php echo e(Html::image('public/images/user/'.$cmnt->user->image,'img',array('class'=>'img-responsive'))); ?>

    <?php else: ?>
    <a href="<?php echo e(url('profile/'.$cmnt->user->url)); ?>"><?php echo e(Html::image('public/images/user/'.$cmnt->user->image,'img',array('class'=>'img-responsive'))); ?></a>
    <?php endif; ?>
</div> 
 <div class="cmnt-box">
 <span class="pro-name"><b><?php echo e($cmnt->user->first_name.' '.$cmnt->user->last_name); ?>:</b> <?php echo e($cmnt->message); ?></span>
<span class="post-time">
   <i class="fa fa-clock-o" aria-hidden="true"></i> 
    <?php echo Helper::dateFormate($cmnt->created_at);; ?> <span class="rpl<?php echo e($cmnt->id); ?>"><a onclick="showReplydiv(<?php echo e($cmnt->id); ?>)">Reply</a></span>
</span> 
</div>
</div>
<?php if($cmnt->user_id==Auth::user()->id): ?>
<div class="dropdown">
 <i data-toggle="dropdown" class="fa dropdown-toggle fa-angle-down"></i>
 <ul class="dropdown-menu side-fix">
   <li><a onclick="deleteComment(<?php echo e($city_post->id); ?>,<?php echo e($cmnt->id); ?>)">Delete</a></li>
 </ul>
</div>
<?php endif; ?>
<?php $replies=count($cmnt->replies); ?>
<?php if($replies>0): ?>
<div class="rply">
<div id="comment_section_reply<?php echo e($cmnt->id); ?>">    
<?php $__currentLoopData = $cmnt->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $replie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv<?php echo e($replie->id); ?>">
<div class="col-md-11 cmnt-pnl-ped" >
<div class="pro1">
    <?php if($replie->user->id==Auth::user()->id): ?>
    <?php echo e(Html::image('public/images/user/'.$replie->user->image,'img',array('class'=>'img-responsive'))); ?>

    <?php else: ?>
    <a href="<?php echo e(url('profile/'.$replie->user->url)); ?>"><?php echo e(Html::image('public/images/user/'.$replie->user->image,'img',array('class'=>'img-responsive'))); ?></a>
    <?php endif; ?>
</div> 
 <div class="cmnt-box">
 <span class="pro-name"><b><?php echo e($replie->user->first_name.' '.$replie->user->last_name); ?>:</b>  : <?php echo e($replie->message); ?></span>
 <span class="post-time">
   <i class="fa fa-clock-o" aria-hidden="true"></i> 
    <?php echo Helper::dateFormate($replie->created_at);; ?>

</span> 
</div>
</div>
 <?php if($replie->user->id==Auth::user()->id): ?>
    <div class="dropdown">
     <i data-toggle="dropdown" class="fa dropdown-toggle fa-angle-down"></i>
     <ul class="dropdown-menu side-fix">
       <li><a onclick="deleteComment(<?php echo e($city_post->id); ?>,<?php echo e($replie->id); ?>)">Delete</a></li>
     </ul>
    </div>
<?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
    <div class="col-md-12 cmnt-pnl-ped ped-2" id="rply<?php echo e($cmnt->id); ?>" style="display:none">
        <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?> </div>  
     <div class="cmnt-box">
        <textarea rows="1" cols="90" name="comment" form="usrform" id="comment-form_reply<?php echo e($cmnt->id); ?>" placeholder="write a reply..."> </textarea>
        <input type="hidden" name="cmnt_post_id"  value="<?php echo e($city_post->id); ?>">
        <input type="hidden" name="cmnt_comment_id" value="<?php echo e($cmnt->id); ?>">
    </div>
    </div>
 </div>
<?php else: ?>
<!-- if no reply -->
 <div class="rply" id="rply<?php echo e($cmnt->id); ?>" style="display:none">
    <div id="comment_section_reply<?php echo e($cmnt->id); ?>"> </div>
    <div class="col-md-12 cmnt-pnl-ped ped-2">
        <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?> </div>  
     <div class="cmnt-box">
        <textarea rows="1" cols="90" name="comment" form="usrform" id="comment-form_reply<?php echo e($cmnt->id); ?>" placeholder="write a reply..."> </textarea>    
         <input type="hidden" name="cmnt_post_id"  value="<?php echo e($city_post->id); ?>">
        <input type="hidden" name="cmnt_comment_id" value="<?php echo e($cmnt->id); ?>">
    </div>
    </div>
 </div>
<?php endif; ?>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>