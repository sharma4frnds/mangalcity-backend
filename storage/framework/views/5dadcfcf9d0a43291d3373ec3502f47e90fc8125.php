<?php $__env->startSection('content'); ?>
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>feedback</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                   <h2><?php echo e($post->user->first_name); ?> <?php echo e($post->user->last_name); ?><small> <?php echo Helper::dateFormate($post->created_at);; ?></small></h2>
                  <div class="x_content">
                   
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      
                      <div class="form-group">

                       <p><?php echo e($post->message); ?></p>
                      </div>

                        <div class="form-group">
                          <?php if($post->type=='image'): ?>
                          <div class="post-img">
                             <?php echo e(Html::image('public/images/post/post_image/'.$post->value,'img',array('class'=>'img-responsive'))); ?>  
                          </div>
                          <?php endif; ?>

                        <?php if($post->type=='video'): ?>
                          <div class="post-video">
                           <video width="100%" height="315" controls><source src="public/images/post/post_video/<?php echo e($post->value); ?>" type="video/mp4"></video>   
                          </div>  
                        <?php endif; ?>

                         </div>

                      </div>

              <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>feedback users(<?php echo e($state->name); ?>, <?php echo e($district->name); ?>, <?php echo e($city->name); ?>) </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    <?php $__currentLoopData = $feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <a><span><span> <?php echo e($row->user->first_name); ?> <?php echo e($row->user->last_name); ?></span><span class="time"><?php echo Helper::dateFormate($row->created_at);; ?></span></span>
                        <span class="message">
                         <?php echo e($row->tag->name); ?>

                        </span>
                      </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
             
                  </ul>
                </div>
              </div>
            </div>

               

  
                   
                      <div class="ln_solid"></div>
                      
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
         </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>