<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('throttle:500,1')->group(function () {

Route::get('gallary-list', '\App\Http\Controllers\Api\APIController@gallaryList')->name('gallary.list');

Route::get('gallary-data-list/{id}', '\App\Http\Controllers\Api\APIController@gallaryDataList')->name('gallary.data.list');

Route::get('gallary-video-list', '\App\Http\Controllers\Api\APIController@gallaryVideoList')->name('gallary.video.list');

Route::get('privacy-list', '\App\Http\Controllers\Api\APIController@privacyPolicyList')->name('privacy.policy.list');

Route::get('term-list', '\App\Http\Controllers\Api\APIController@termsList')->name('terms.list');

Route::get('disclaimer-list', '\App\Http\Controllers\Api\APIController@disclaimerList')->name('disclaimer.list');

Route::get('centers-list', '\App\Http\Controllers\Api\APIController@centersList')->name('centers.list');

Route::get('intro-list', '\App\Http\Controllers\Api\APIController@introList')->name('intro.list');

Route::get('directors-list', '\App\Http\Controllers\Api\APIController@boarOfDirectors')->name('directors.list');

Route::get('committes-list', '\App\Http\Controllers\Api\APIController@boarOfCOmmites')->name('committes.list');

Route::get('key-management-list', '\App\Http\Controllers\Api\APIController@keyManagement')->name('keymanagement.list');

Route::get('board-detail-list', '\App\Http\Controllers\Api\APIController@boardDetail')->name('board.detail.list');

Route::get('awards-list', '\App\Http\Controllers\Api\APIController@awardsData')->name('awards.list');

Route::get('awards-detail-list/{id}', '\App\Http\Controllers\Api\APIController@awardsDetail')->name('awards.detail.list');

Route::get('corporate-list', '\App\Http\Controllers\Api\APIController@corporateData')->name('corporate.list');

Route::get('investor-list', '\App\Http\Controllers\Api\APIController@investorData')->name('investor.list');

Route::get('release-list', '\App\Http\Controllers\Api\APIController@releaseCategory')->name('release.list');

Route::get('release-data-list/{id}', '\App\Http\Controllers\Api\APIController@releaseData')->name('release.data.list');

Route::get('report-data-list/{id}', '\App\Http\Controllers\Api\APIController@reportData')->name('report.data.list');

Route::get('csr-data-list', '\App\Http\Controllers\Api\APIController@csrData')->name('csr.data.list');

Route::get('job-list', '\App\Http\Controllers\Api\APIController@jobList')->name('job.list');

Route::get('job-data-list/{id}', '\App\Http\Controllers\Api\APIController@jobData')->name('job.data.list');

Route::post('enquiry-post', '\App\Http\Controllers\Api\APIController@enquiryForm')->name('enquiy.post');


Route::get('offer-list', '\App\Http\Controllers\Api\APIController@offersList')->name('offer.list');

Route::get('student-hear-list', '\App\Http\Controllers\Api\APIController@studentHearList')->name('student.hear.list');

Route::get('category-list', '\App\Http\Controllers\Api\APIController@categoryList')->name('category.list');

Route::get('category-details/{id}', '\App\Http\Controllers\Api\APIController@categoryDetail')->name('category.detail');

Route::get('demo-video-category', '\App\Http\Controllers\Api\APIController@demoVideoCategory')->name('demo.video.category');

Route::get('demo-video-detail/{id}', '\App\Http\Controllers\Api\APIController@demoVideoDetails')->name('demo.video.detail');

Route::get('topper-list', '\App\Http\Controllers\Api\APIController@topperList')->name('topper.list');

Route::get('our-achivement', '\App\Http\Controllers\Api\APIController@ourAchivementList')->name('our.achivement');

Route::get('category-boards-standards/{id}', '\App\Http\Controllers\Api\APIController@categoryBoardStandards')->name('category.baord.standards');

Route::get('city-list', '\App\Http\Controllers\Api\APIController@cityList')->name('city.list');

Route::get('area-data/{id}', '\App\Http\Controllers\Api\APIController@areaData')->name('area.data');
Route::post('center-search', '\App\Http\Controllers\Api\APIController@centerSearch')->name('center.search');

Route::post('users-query', '\App\Http\Controllers\Api\APIController@usersQuery')->name('users.query');
Route::get('media-list', '\App\Http\Controllers\Api\APIController@mediaList')->name('media.list');

Route::get('default-category-list', '\App\Http\Controllers\Api\APIController@defaultCourseDetails')->name('default.category.list');

Route::get('default-demo-list', '\App\Http\Controllers\Api\APIController@defaultDemoDetails')->name('default.demo.list');

Route::get('default-intro-list', '\App\Http\Controllers\Api\APIController@defaultIntroDetails')->name('default.intro.list');

Route::get('intro-data/{id}', '\App\Http\Controllers\Api\APIController@introData')->name('intro.data');

Route::get('meta-tag-list', '\App\Http\Controllers\Api\APIController@metaTags')->name('meta.tag.list');

Route::post('course-search', '\App\Http\Controllers\Api\APIController@categorySearch')->name('course.search');

Route::post('invester-search', '\App\Http\Controllers\Api\APIController@investerSearch')->name('invester.search');

Route::post('report-search', '\App\Http\Controllers\Api\APIController@reportSearch')->name('report.search');

Route::get('social-link', '\App\Http\Controllers\Api\APIController@socialLinkList')->name('social.link');
Route::get('contact-us', '\App\Http\Controllers\Api\APIController@contactUs')->name('contact.us');


Route::post('email-subscription', '\App\Http\Controllers\Api\APIController@emailSubscription')->name('email.subscription');
// });
