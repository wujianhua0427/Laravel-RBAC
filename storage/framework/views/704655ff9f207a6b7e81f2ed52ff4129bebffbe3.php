<?php $__env->startSection('column_url',url('group')); ?>
<?php $__env->startSection('column','用户组'); ?>
<?php $__env->startSection('title','角色授权'); ?>
<?php $__env->startSection('css'); ?>
    ##parent-placeholder-2f84417a9e73cead4d5c99e05daff2a534b30132##
    <link rel="stylesheet" href="<?php echo e(URL::asset('/back/css/uniform.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/back/css/select2.css')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-info-sign"></i>
                        </span>
                        <h5>授权角色</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post"  action="<?php echo e(url('group/storeAuthRole')); ?>"  name="basic_validate" id="basic_validate" novalidate="novalidate">
                            <?php echo csrf_field(); ?>
                            <div class="control-group">
                                <label class="control-label">
                                    <strong style="color: red">(<?php echo e($info->name); ?>)</strong>
                                    所属角色
                                </label>
                                <div class="controls">
                                    <select name="rids[]" multiple>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if( !empty(is_group_select_role($info->id,$value->id))): ?> selected <?php endif; ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo e($info->id); ?>" name="gid">
                            <div class="form-actions">
                                <input type="submit" value="Save" class="btn btn-success">
                                <button type="button" class="btn btn-danger btn-cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
    <script src="<?php echo e(URL::asset('/back/js/jquery.uniform.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/back/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/back/js/jquery.validate.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/back/js/matrix.form_validation.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Back.Common.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>