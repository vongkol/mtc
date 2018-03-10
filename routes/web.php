<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin',"HomeController@index");
Auth::routes();
// category
Route::get('/category', "CategoryController@index");
Route::get('/category/create', "CategoryController@create");
Route::get('/category/edit/{id}', "CategoryController@edit");
Route::get('/category/delete/{id}', "CategoryController@delete");
Route::post('/category/save', "CategoryController@save");
Route::post('/category/update', "CategoryController@update");
Route::get('/home', 'HomeController@index')->name('home');
// front page route
Route::get('/', "FrontController@index");
Route::get('/category/{id}', "FrontController@category");
Route::get('/job-type/{id}', "FrontController@by_job_type");
Route::get('/job/list', "FrontController@job_list");
Route::get('/job/search', "FrontController@search");
Route::get('/job/{id}', "FrontController@detail");

//employee email
Route::get('/employee-email', 'EmployeeEmailController@index');

//employer email
Route::get('/employer-email', 'EmployerEmailController@index');

// back job list
Route::get('/joblist', "JobListController@index");
Route::get('/joblist/delete/{id}', "JobListController@delete");
Route::get('/joblist/detail/{id}',"JobListController@detail");

// back cv list
Route::get('/cvlist', "CvListController@index");
Route::get("/cvlist/create", "CvListController@create");
Route::get('/cvlist/delete/{id}', "CvListController@delete");
Route::get('/cvlist/detail/{id}',"CvListController@detail");
Route::post("/cvlist/save_cv", "CvListController@save");
Route::get("/cvlist/editphoto/{id}", "CvListController@edit_photo");
Route::post("/cvlist/uploadphoto", "CvListController@upload_photo");
Route::get("/cvlist/attach/{id}", "CvListController@attach");
Route::post("/cvlist/uploadfile", "CvListController@upload_file");
Route::get("/cvlist/deletefile/{id}", "CvListController@delete_file");
Route::get("/cvlist/edit/{id}", "CvListController@edit_cv");
Route::post("/cvlist/update_cv", "CvListController@update_cv");
// Route::get('/provider/login', "JobProviderController@login");
//job provider
Route::get('/employer', "EmployerController@index");
Route::get('/employer/login', "EmployerController@login");
Route::get('/employer/register', "EmployerController@register");
Route::post('/employer/save', "EmployerController@save");
Route::post('/employer/dologin', "EmployerController@do_login");
Route::get('/employer/logout', "EmployerController@logout");
Route::get('/employer/edit/profile', "EmployerController@edit");
Route::post('/employer/update', "EmployerController@update");
Route::get('/employer/reset-password', "EmployerController@reset_password");
Route::post('/employer/save-password', "EmployerController@save_password");
Route::get('/employer/subscription', "EmployerController@subscription");
Route::get('/employer/company', "EmployerController@company");
Route::get('/employer/create_company', "EmployerController@create_company");
Route::post('/employer/save_company', "EmployerController@save_company");
Route::get('/employer/edit_company/{id}', "EmployerController@edit_company");
Route::post('/employer/update_company', "EmployerController@update_company");
Route::post('/employer/unsubscribe', "EmployerController@unsubscribe");
Route::post('/employer/subscribe', "EmployerController@subscribe");
Route::get('/employer/job', "EmployerController@job");
Route::get('/employer/job/create', "EmployerController@create_job");
Route::get('/employer/job/edit/{id}', "EmployerController@edit_job");
Route::get('/employer/job/delete/{id}', "EmployerController@delete_job");
Route::get('/employer/job/detail/{id}', "EmployerController@job_detail");
Route::get('/employer/job/reach', "EmployerController@reach");
Route::post('/employer/job/save', "EmployerController@save_job");
Route::post('/employer/job/update', "EmployerController@update_job");
Route::get('/employer/job/pending', "EmployerController@pending");
Route::get('/employer/job/nosub', "EmployerController@nosub");
Route::get('/employer/job/nocom', "EmployerController@nocom");
Route::get('/employer/search/cv', "EmployerController@search_cv");
Route::get('/employer/showcv/{id}', "EmployerController@show_cv");
Route::get('/employer/make/favorite/{id}', "EmployerController@favorite");
Route::get('/employer/favorite', "EmployerController@get_favorite");
Route::post('/favorite/delete', "EmployerController@delete_favorite");
Route::get("/employer/downloadcv/{id}", "DownloadCvController@download_cv");
Route::get('/employer/forgot', "ForgetPasswordController@index1");
Route::post('/employer/forgot/recovery', "ForgetPasswordController@reset_password1");
Route::get('/service/reset1/{id}', "ForgetPasswordController@new_password1");
Route::post('/service/update1', "ForgetPasswordController@update_password1");
//job seeker
Route::get('/seeker/login', "SeekerController@login");
Route::get('/seeker/logout', "EmployeeController@logout");
Route::get('/seeker/register', "SeekerController@register");
Route::post('/seeker/save', "EmployeeController@register");
Route::post('/seeker/dologin', "EmployeeController@login");
Route::get('/seeker', "SeekerController@index");
Route::get('/seeker/edit/profile', "SeekerController@edit");
Route::post('/seeker/update', "SeekerController@update");
Route::get('/seeker/cv', "SeekerController@cv");
Route::get('/seeker/create/cv', "SeekerController@create_cv");
Route::post('/seeker/save_cv', "SeekerController@save_cv");
Route::get('/seeker/edit_cv/{id}', "SeekerController@edit_cv");
Route::post('/seeker/update_cv', "SeekerController@update_cv");
Route::get('/seeker/reset-password', "SeekerController@reset_password");
Route::post('/seeker/save-password', "SeekerController@save_password");
Route::get('/seeker/print_cv/{id}', "SeekerController@print_cv");
Route::get('/seeker/document', "DocumentController@index");
Route::get('/seeker/document/delete/{id}', "DocumentController@delete");
Route::get('/seeker/document/create', "DocumentController@create");
Route::post('/seeker/document/save', "DocumentController@save");
Route::get('/seeker/forgot', "ForgetPasswordController@index");
Route::get('/service/reset/{id}', "ForgetPasswordController@new_password");
Route::post('/seeker/forgot/recovery', "ForgetPasswordController@reset_password");
Route::post('/service/update', "ForgetPasswordController@update_password");
Route::get("/seeker/qrcode/{id}", function(){
    return "Under Construction!";
});

// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");
Route::get('/user/branch/{id}', "UserController@branch");
Route::post('/user/branch/save', "UserController@add_branch");
Route::get('/user/branch/delete/{id}', "UserController@delete_branch");
// role
Route::get('/role', "RoleController@index");
Route::get('/role/create', "RoleController@create");
Route::post('/role/save', "RoleController@save");
Route::get('/role/delete/{id}', "RoleController@delete");
Route::get('/role/edit/{id}', "RoleController@edit");
Route::post('/role/update', "RoleController@update");
Route::get('/role/permission/{id}', "PermissionController@index");
Route::post('/rolepermission/save', "PermissionController@save");


// partner
Route::get('/partner', "PartnerController@index");
Route::get('/partner/create', "PartnerController@create");
Route::get('/partner/edit/{id}', "PartnerController@edit");
Route::get('/partner/delete/{id}', "PartnerController@delete");
Route::post('/partner/save', "PartnerController@save");
Route::post('/partner/update', "PartnerController@update");
// job type
Route::get('/job_type', "JobTypeController@index");
Route::get('/job_type/create', "JobTypeController@create");
Route::get('/job_type/edit/{id}', "JobTypeController@edit");
Route::get('/job_type/delete/{id}', "JobTypeController@delete");
Route::post('/job_type/save', "JobTypeController@save");
Route::post('/job_type/update', "JobTypeController@update");
// locations
Route::get('/location', "LocationController@index");
Route::get('/location/create', "LocationController@create");
Route::get('/location/edit/{id}', "LocationController@edit");
Route::get('/location/delete/{id}', "LocationController@delete");
Route::post('/location/save', "LocationController@save");
Route::post('/location/update', "LocationController@update");
// Employee
Route::get('/employee', "EmployeeController@index");
Route::get('/employee/create', "EmployeeController@create");
Route::get('/employee/edit/{id}', "EmployeeController@edit");
Route::get('/employee/delete/{id}', "EmployeeController@delete");
Route::post('/employee/save', "EmployeeController@save");
Route::post('/employee/update', "EmployeeController@update");
// Header top contact
Route::get('/header_top_contact', "HeaderTopContactController@index");
Route::get('/header_top_contact/create', "HeaderTopContactController@create");
Route::get('/header_top_contact/edit/{id}', "HeaderTopContactController@edit");
Route::post('/header_top_contact/save', "HeaderTopContactController@save");
Route::post('/header_top_contact/update', "HeaderTopContactController@update");
// Logo
Route::get('/logo', "LogoController@index");
Route::get('/logo/create', "LogoController@create");
Route::post('/logo/save', "LogoController@save");
Route::get('/logo/edit/{id}', "LogoController@edit");
Route::post('/logo/update', "LogoController@update");
// Slide 
Route::get('/slide', "SlideController@index");
Route::get('/slide/create', "SlideController@create");
Route::post('/slide/save', "SlideController@save");
Route::get('/slide/edit/{id}', "SlideController@edit");
Route::post('/slide/update', "SlideController@update");
Route::get('/slide/delete/{id}', "SlideController@delete");
// Social
Route::get('/social', "SocialController@index");
Route::get('/social/create', "SocialController@create");
Route::post('/social/save', "SocialController@save");
Route::get('/social/delete/{id}', "SocialController@delete");
Route::get('/social/edit/{id}', "SocialController@edit");
Route::post('/social/update', "SocialController@update");
// training course
Route::get('/training-course', "TrainingCourseController@index");
Route::get('/training-course/create', "TrainingCourseController@create");
Route::post('/training-course/save', "TrainingCourseController@save");
Route::get('/training-course/delete/{id}', "TrainingCourseController@delete");
Route::get('/training-course/edit/{id}', "TrainingCourseController@edit");
Route::post('/training-course/update', "TrainingCourseController@update");
// video training 
Route::get('/video-training', "VideoTrainingController@index");
Route::get('/video-training/create', "VideoTrainingController@create");
Route::post('/video-training/save', "VideoTrainingController@save");
Route::get('/video-training/delete/{id}', "VideoTrainingController@delete");
Route::get('/video-training/edit/{id}', "VideoTrainingController@edit");
Route::post('/video-training/update', "VideoTrainingController@update");
// Page
Route::get('/page', "PageController@index");
Route::get('/page/create', "PageController@create");
Route::post('/page/save', "PageController@save");
Route::get('/page/delete/{id}', "PageController@delete");
Route::get('/page/edit/{id}', "PageController@edit");
Route::post('/page/update', "PageController@update");
Route::get('/page/view/{id}', "PageController@view");
// package type
Route::get('/package_type', "PackageTypeController@index");
Route::get('/package_type/create', "PackageTypeController@create");
Route::get('/package_type/edit/{id}', "PackageTypeController@edit");
Route::get('/package_type/delete/{id}', "PackageTypeController@delete");
Route::post('/package_type/save', "PackageTypeController@save");
Route::post('/package_type/update', "PackageTypeController@update");
// Package
Route::get('/package', "PackageController@index");
Route::get('/package/create', "PackageController@create");
Route::get('/package/edit/{id}', "PackageController@edit");
Route::get('/package/delete/{id}', "PackageController@delete");
Route::post('/package/save', "PackageController@save");
Route::post('/package/update', "PackageController@update");
// subscription
Route::get('/subscription', "SubscriptionController@index");
Route::get('/subscription/expire', "SubscriptionController@expire");
Route::get('/subscription/create', "SubscriptionController@create");
Route::get('/subscription/delete/{id}', "SubscriptionController@delete");
Route::get('/subscription/edit/{id}', "SubscriptionController@edit");
Route::get('/subscription/detail/{id}', "SubscriptionController@detail");
Route::post('/subscription/save', "SubscriptionController@save");
Route::post('/subscription/update', "SubscriptionController@update");
Route::post('/subscription/approve', "SubscriptionController@approve");

// job provider
Route::get('/provider', "JobProviderController@index");
Route::get('/provider/create', "JobProviderController@create");
Route::get('/provider/edit/{id}', "JobProviderController@edit");
Route::get('/provider/delete/{id}', "JobProviderController@delete");
Route::post('/provider/save', "JobProviderController@save");
Route::post('/provider/update', "JobProviderController@update");
// company
Route::get('/com', "CompanyController@index");
Route::get('/com/create', "CompanyController@create");
Route::get('/com/edit/{id}', "CompanyController@edit");
Route::get('/com/delete/{id}', "CompanyController@delete");
Route::post('/com/save', "CompanyController@save");
Route::post('/com/update', "CompanyController@update");
// email
Route::get('/mail', "MailController@index");
Route::get('/mail/create', "MailController@create");
Route::post('/mail/send', "MailController@send");
Route::get("/mail/get/{id}", "MailController@get_email");
Route::get("/mail/delete/{id}", "MailController@delete");
// front pages
Route::get('/page/{id}', "FrontPageController@index");
// success candiate
Route::get('/success-candidate', "SuccessCandidateController@index");
Route::get('/success-candidate/create', "SuccessCandidateController@create");
Route::post('/success-candidate/save', "SuccessCandidateController@save");
Route::get('/success-candidate/edit/{id}', "SuccessCandidateController@edit");
Route::get("/success-candidate/delete/{id}", "SuccessCandidateController@delete");
Route::post('/success-candidate/update', "SuccessCandidateController@update");

// test
Route::get('/language/{id}', "LangController@index");