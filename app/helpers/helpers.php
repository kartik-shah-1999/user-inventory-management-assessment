<?php
    if(!function_exists('validationMessage')){
        function validationMessage($str){
            echo "<div class='alert alert-danger tex-danger my-1'>$str</div>";
        }
    }

    if(!function_exists('formHandler')){
        function formHandler($guard){
            if($guard === 'admin'){
                return route('adminSignup');
            }else if($guard === 'customer'){
                // return route();
            }
        }
    }