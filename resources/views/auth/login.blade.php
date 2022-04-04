@extends('layouts.front')
@section('content')

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

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr"> -->
                <fieldset class="col2-set">
                    <div class="col-1 new-users">
                        <strong>New Customers/Merchants</strong>
                        <div class="content">

                            <p>By creating an account with our store, you will be able to move through the checkout process
                                faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <div class="buttons-set">
                                <a href="{{ route('register') }}" title="Create an Account" class="button create-account" style="background-color: #88be4c;"><span><b>Register</b></span></a>
                                <!-- <button type="button" title="Create an Account" class="button create-account"
                      onClick=""><span><span>Create an Account</span></span></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-2 registered-users">
                        <strong>Registered Customers/Merchants</strong>
                        <div class="content">

                            <p>If you have an account with us, please log in.</p>
                            <ul class="form-list">
                                <li>
                                    <label for="email">Email Address<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="email" class="input-text required-entry validate-email" title="Email Address" name="email" :value="old('email')" required autofocus>
                                    </div>
                                </li>

                                <li>
                                    <label for="pass">Password<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="password" class="input-text required-entry validate-password" title="Password" name="password" required autocomplete="current-password">
                                    </div>
                                </li>

                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                            </ul>


                            <div class="buttons-set">

                                <button type="submit" class="button login" title="Login" name="send" id="send2" style="background-color: #88be4c;"><span>{{ __('Log in') }}</span></button>

                                @if (Route::has('password.request'))
                                <a class="forgot-word" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif
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
@endsection