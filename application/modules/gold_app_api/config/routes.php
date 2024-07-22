<?php
    $route['api/auth/login'] = "gold_app_api/authentication/get_token";
    $route['api/auth/card_login'] = "gold_app_api/authentication/get_token_with_card_login";
    $route['api/auth/register'] = "gold_app_api/register";
    $route['api/auth/register/checkUser'] = "gold_app_api/register/check_user_by_pid";
    $route['api/auth/register/getProvince'] = "gold_app_api/register/get_province";
    $route['api/auth/register/getDistrict'] = "gold_app_api/register/get_district";
    $route['api/auth/register/getSubDistrict'] = "gold_app_api/register/get_sub_district";
    $route['api/auth/forgot_password'] = "gold_app_api/register/forgot_password";
    $route['api/auth/change_password'] = "gold_app_api/register/change_password";

    $route['api/welfare'] = "gold_app_api/welfare";
    $route['api/welfare/history'] = "gold_app_api/welfare/history";
    $route['api/welfare/login'] = "gold_app_api/welfare/login";
    $route['api/welfare/claim'] = "gold_app_api/welfare/claim";
    $route['api/welfare/claim/:num'] = "gold_app_api/welfare/claim";
    $route['api/welfare/reset'] = "gold_app_api/welfare/reset";
    
    $route['api/profile/test'] = "gold_app_api/profile/test";

    $route['api/profile/personal_get'] = "gold_app_api/profile/personal";
    $route['api/profile/personal_update'] = "gold_app_api/profile/personal_update";

    $route['api/profile/health_get'] = "gold_app_api/health";
    $route['api/profile/health_update'] = "gold_app_api/health/update";

    $route['api/master/province_get'] = "gold_app_api/MasterAddress/provice";
    $route['api/master/amphur_get'] = "gold_app_api/MasterAddress/amphur";
    $route['api/master/tambon_get'] = "gold_app_api/MasterAddress/tambon";

    $route['api/auth/validate'] = "gold_app_api/register/validate";
    $route['api/auth/resetotp'] = "gold_app_api/register/reset_otp";

    // go to gold backend-cms
    $route['api/backendcms/gentoken'] = "authentication/get_token_with_go_to_gold_admin";
    $route['api/backendcms/getdata'] = "authentication/get_data_with_go_to_gold_admin";


?>