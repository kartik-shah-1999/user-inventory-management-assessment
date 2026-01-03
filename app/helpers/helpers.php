<?php

use App\UserRoleEnum;
    /*
     *  description: display a validation error message as a bootstrap alert.
     *  @param string
     *  @return void
     */
    if(!function_exists('validationMessage')){
        function validationMessage($str){
            echo "<div class='alert alert-danger tex-danger my-1'>$str</div>";
        }
    }

    /*
     *  description: get the form submission route based on the user guard.
     *  @param string $guard The guard or user type (e.g., 'admin', 'customer').
     *  @return string|null 
    */
    if(!function_exists('formRouteHandler')){
        $routeSubmissionHandler = null;
        function formRouteHandler($guard){
            if($guard === UserRoleEnum::ADMIN){
                switch(request()->url()){
                    case route('adminSignupForm'): $routeSubmissionHandler = route('adminSignup');
                    break; 
                    case route('adminLoginForm'): $routeSubmissionHandler = route('adminLogin');
                    break;
                }
            }else if($guard === UserRoleEnum::CUSTOMER){
                // switch(request()->url()){
                //     case route('adminSignupForm'): $routeSubmissionHandler = route('adminSignup');
                //     break; 
                //     case route('adminLoginForm'): $routeSubmissionHandler = route('adminLogin');
                //     break;
                // }
            }
            return $routeSubmissionHandler;
        }
    }
