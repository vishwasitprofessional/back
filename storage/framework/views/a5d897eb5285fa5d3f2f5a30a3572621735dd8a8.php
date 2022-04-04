
<?php $__env->startSection('content'); ?>

<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title">
                    <h2>Login or Create an Account</h2>
                </div>
            </div>
            <!--col-xs-12-->
        </div>
        <!--row-->
    </div>
    <!--container-->
</div>


<!-- BEGIN Main Container -->

<div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">

    <div class="main">
        <div class="account-login container">
            <!--page-title-->

            <!-- Validation Errors -->

            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <!-- <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr"> -->
                <fieldset class="col2-set">
                    <div class="col-1 new-users">
                        <strong>Registered Customers/Merchants</strong>
                        <div class="content">

                            <p>By creating an account with our store, you will be able to move through the checkout process
                                faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <div class="buttons-set">
                                <a href="<?php echo e(route('login')); ?>" title="Already have an Account" class="button create-account" style="background-color: #88be4c;"><span><b>Customer Login</b></span></a>
                                <a href="<?php echo e(route('vendor-register')); ?>" title="Already have an Account" class="button create-account" style="background-color: #88be4c;"><span><b>Merchant Register</b></span></a>
                                <!-- <button type="button" title="Create an Account" class="button create-account"
                      onClick=""><span><span>Create an Account</span></span></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-2 registered-users">
                        <strong>New Customers</strong>
                        <div class="content">

                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-validation-errors','data' => ['class' => 'mb-4','errors' => $errors]]); ?>
<?php $component->withName('auth-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4','errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            <p>If you have an account with us, please log in.</p>
                            <ul class="form-list">

                                <li>
                                    <label for="name">Name<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="text" class="input-text required-entry validate-name" title="Name" name="name" :value="old('name')" required autofocus>
                                    </div>
                                </li>

                                <li>
                                    <label for="contact">Phone Number<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="text" class="input-text required-entry validate-contact" title="Phone Number" name="contact" :value="old('contact')" required autofocus>
                                    </div>
                                </li>

                                <li>
                                    <label for="email">Email Address<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="email" class="input-text required-entry validate-email" title="Email Address" name="email" :value="old('email')" required>
                                    </div>
                                </li>

                                <li>
                                    <label for="pass">Password<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="password" class="input-text required-entry validate-password" title="Password" name="password" required autocomplete="new-password">
                                    </div>
                                </li>

                                <li>
                                    <label for="pass">Confirm Password<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="password" class="input-text required-entry validate-password" title="Confirm Password" name="password_confirmation" required>
                                    </div>
                                </li>

                                <div class="block mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="<?php echo e(route('login')); ?>">
                                        <?php echo e(__('Already registered?')); ?>

                                    </a>
                                </div>
                            </ul>


                            <div class="buttons-set">

                                <button type="submit" class="button login" title="Login" name="send" id="send2" style="background-color: #88be4c;"><span><?php echo e(__('Register')); ?></span></button>

                            </div>
                            <!--buttons-set-->
                        </div>
                        <!--content-->
                    </div>
                    <!--col-2 registered-users-->
                </fieldset>
                <!--col2-set-->
            </form>

        </div>
        <!--account-login-->

    </div>
    <!--main-container-->

</div>
<!--col1-layout-->

<div class="our-features-box wow bounceInUp animated animated">
    <div class="container">
        <ul>
            <li>
                <div class="feature-box free-shipping">
                    <div class="icon-truck"></div>
                    <div class="content">We Deliver Across The Globe</div>
                </div>
            </li>
            <li>
                <div class="feature-box need-help">
                    <div class="icon-support"></div>
                    <div class="content">Contact Us +91-9642392222</div>
                </div>
            </li>
            <li>
                <div class="feature-box money-back">
                    <div class="icon-money"></div>
                    <div class="content">Money Back Guarantee</div>
                </div>
            </li>
            <li class="last">
                <div class="feature-box return-policy">
                    <div class="icon-return"></div>
                    <div class="content">Premium Quality Assurance</div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- For version 1,2,3,4,6 -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/shreshta/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>