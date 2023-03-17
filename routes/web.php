<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', '\App\Http\Controllers\Auth\LoginController@redirectRoute');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin.showlogin');
    Route::post('/login', '\App\Http\Controllers\Auth\LoginController@doLogin')->name('admin.login');


    Route::get('/dashboard', '\App\Http\Controllers\Admin\DashboardController@dashboard')->name('admin.dashboard');

    // course route

    Route::get('course-list', '\App\Http\Controllers\Admin\CourseTypeController@index')->name('admin.courselist');
    Route::post('add-course', '\App\Http\Controllers\Admin\CourseTypeController@addCourse')->name('admin.add.course');
    Route::post('update-course', '\App\Http\Controllers\Admin\CourseTypeController@updateCourse')->name('admin.update.course');
    Route::get('delete-course/{id}', '\App\Http\Controllers\Admin\CourseTypeController@deleteCourse')->name('delete.course');

    // course details route

    Route::get('course-detail', '\App\Http\Controllers\Admin\CourseDetailController@index')->name('admin.coursedetail');
    Route::post('add-course_detail', '\App\Http\Controllers\Admin\CourseDetailController@addCourseDetail')->name('admin.add.coursedetail');
    Route::post('update-course_detail', '\App\Http\Controllers\Admin\CourseDetailController@updateCourseDetail')->name('admin.update.coursedetail');
    Route::get('delete-course_detail/{id}', '\App\Http\Controllers\Admin\CourseDetailController@deleteCourseDetail')->name('delete.coursedetail');

    // classCategory route

    Route::get('class-list', '\App\Http\Controllers\Admin\ClassCategoryController@index')->name('admin.classCategory');
    Route::post('add-class', '\App\Http\Controllers\Admin\ClassCategoryController@addClass')->name('admin.add.classCategory');
    Route::post('update-class', '\App\Http\Controllers\Admin\ClassCategoryController@updateClass')->name('admin.update.classCategory');
    Route::get('delete-class/{id}', '\App\Http\Controllers\Admin\ClassCategoryController@deleteClass')->name('delete.classCategory');

    // demo video route
    Route::get('/demo-video', '\App\Http\Controllers\Admin\DemoVideoController@index')->name('admin.demoVideo');
    Route::post('/add/demo-video', '\App\Http\Controllers\Admin\DemoVideoController@addDemoVideo')->name('admin.add.demoVideo');
    Route::post('/edit/demo-video', '\App\Http\Controllers\Admin\DemoVideoController@updateDemoVideo')->name('admin.edit.demoVideo');
    Route::get('delete-demo-video/{id}', '\App\Http\Controllers\Admin\DemoVideoController@deleteDemoVideo')->name('admin.delete.demoVideo');

    // subject route

    Route::get('subject-list', '\App\Http\Controllers\Admin\SubjectController@index')->name('admin.subjects');
    Route::post('add-subject', '\App\Http\Controllers\Admin\SubjectController@addSubject')->name('admin.add.subject');
    Route::post('update-subject', '\App\Http\Controllers\Admin\SubjectController@updateSubject')->name('admin.update.subject');
    Route::get('delete-subject/{id}', '\App\Http\Controllers\Admin\SubjectController@deleteSubject')->name('delete.subject');
    Route::post('course-standard', '\App\Http\Controllers\Admin\SubjectController@courseStandard')->name('course.standard');
    Route::post('standard-board', '\App\Http\Controllers\Admin\SubjectController@standardBoard')->name('standard.board');
    // State route

    Route::get('state-list', '\App\Http\Controllers\Admin\StateController@index')->name('admin.states');
    Route::post('add-state', '\App\Http\Controllers\Admin\StateController@addState')->name('admin.add.state');
    Route::post('update-state', '\App\Http\Controllers\Admin\StateController@updateState')->name('admin.update.state');
    Route::get('status-change/{id}', '\App\Http\Controllers\Admin\StateController@deleteState')->name('admin.state.delete');

    // City route

    Route::get('city-list', '\App\Http\Controllers\Admin\CityController@index')->name('admin.cities');
    Route::post('add-city', '\App\Http\Controllers\Admin\CityController@addCity')->name('admin.add.city');
    Route::post('update-city', '\App\Http\Controllers\Admin\CityController@updateCity')->name('admin.update.city');
    Route::get('delete-city/{id}', '\App\Http\Controllers\Admin\CityController@deleteCity')->name('delete.city');

    // center route
    Route::get('center-list', '\App\Http\Controllers\Admin\CenterController@index')->name('admin.centers');
    Route::post('add-center', '\App\Http\Controllers\Admin\CenterController@addCenters')->name('admin.add.center');
    Route::post('update-center', '\App\Http\Controllers\Admin\CenterController@updateCenters')->name('admin.update.center');
    Route::get('delete-center/{id}', '\App\Http\Controllers\Admin\CenterController@deleteCenter')->name('delete.center');

    Route::post('state-city', '\App\Http\Controllers\Admin\CenterController@stateCity')->name('state.city');

    // about list route

    Route::get('about-list', '\App\Http\Controllers\Admin\AboutUsController@index')->name('admin.about');
    Route::post('add-about', '\App\Http\Controllers\Admin\AboutUsController@addAbouts')->name('admin.add.about');
    Route::post('update-about', '\App\Http\Controllers\Admin\AboutUsController@updateAbouts')->name('admin.update.about');
    Route::get('delete-about/{id}', '\App\Http\Controllers\Admin\AboutUsController@deleteAbouts')->name('delete.about');

    // achievment list route

    Route::get('achievment-list', '\App\Http\Controllers\Admin\AchievmentsController@index')->name('admin.achievment');
    Route::post('add-achievment', '\App\Http\Controllers\Admin\AchievmentsController@addAchievment')->name('admin.add.achievment');
    Route::post('update-achievment', '\App\Http\Controllers\Admin\AchievmentsController@updateAchievment')->name('admin.update.achievement');

    // topper list route

    Route::get('topper-list', '\App\Http\Controllers\Admin\TopperController@index')->name('admin.topper');
    Route::post('add-topper', '\App\Http\Controllers\Admin\TopperController@addToppers')->name('admin.add.topper');
    Route::post('update-topper', '\App\Http\Controllers\Admin\TopperController@updateTopper')->name('admin.update.topper');
    Route::get('delete-topper/{id}', '\App\Http\Controllers\Admin\TopperController@deleteToppers')->name('delete.topper');

    // management route

    Route::get('boardOfDirector-list', '\App\Http\Controllers\Admin\BoardOfDirectorController@index')->name('admin.boardOfDirectors');
    Route::post('add-boardOfDirector', '\App\Http\Controllers\Admin\BoardOfDirectorController@addMember')->name('admin.add.boardOfDirectors');
    Route::post('update-boardOfDirector', '\App\Http\Controllers\Admin\BoardOfDirectorController@updateMember')->name('admin.update.boardOfDirectors');
    Route::get('delete-boardOfDirector/{id}', '\App\Http\Controllers\Admin\BoardOfDirectorController@deleteMember')->name('delete.boardOfDirectors');

    Route::get('boardDetail-list', '\App\Http\Controllers\Admin\BoardDetailsController@index')->name('admin.boardDetail');
    Route::post('add-boardDetail', '\App\Http\Controllers\Admin\BoardDetailsController@addKeyMember')->name('admin.add.boardDetail');
    Route::post('update-boardDetail', '\App\Http\Controllers\Admin\BoardDetailsController@updateKeyMember')->name('admin.update.boardDetail');
    Route::get('delete-boardDetail/{id}', '\App\Http\Controllers\Admin\BoardDetailsController@deleteKeyMember')->name('delete.boardDetail');


    Route::get('keyManagement-list', '\App\Http\Controllers\Admin\KeyManagementController@index')->name('admin.keyManagement');
    Route::post('add-keyManagement', '\App\Http\Controllers\Admin\KeyManagementController@addKeyMember')->name('admin.add.keyManagement');
    Route::post('update-keyManagement', '\App\Http\Controllers\Admin\KeyManagementController@updateKeyMember')->name('admin.update.keyManagement');
    Route::get('delete-keyManagement/{id}', '\App\Http\Controllers\Admin\KeyManagementController@deleteKeyMember')->name('delete.keyManagement');

    Route::get('boardCommittee-list', '\App\Http\Controllers\Admin\CommitteeController@index')->name('admin.boardCommittee');
    Route::post('add-boardCommittee', '\App\Http\Controllers\Admin\CommitteeController@addMember')->name('admin.add.boardCommittee');
    Route::post('update-boardCommittee', '\App\Http\Controllers\Admin\CommitteeController@updateMember')->name('admin.update.boardCommittee');
    Route::get('delete-boardCommittee/{id}', '\App\Http\Controllers\Admin\CommitteeController@deleteMember')->name('delete.boardCommittee');

    Route::get('committee-list', '\App\Http\Controllers\Admin\CommitteeController@index')->name('admin.committee');
    Route::post('add-committee', '\App\Http\Controllers\Admin\CommitteeController@addCommittee')->name('admin.add.committee');
    Route::post('update-committee', '\App\Http\Controllers\Admin\CommitteeController@updateCommittee')->name('admin.update.committee');
    Route::get('delete-state/{id}', '\App\Http\Controllers\Admin\CommitteeController@deleteCommittee')->name('delete.committee');

    Route::get('awards', '\App\Http\Controllers\Admin\AwardController@index')->name('admin.award');
    Route::post('add-awards', '\App\Http\Controllers\Admin\AwardController@addAward')->name('admin.add.award');
    Route::post('update-awards', '\App\Http\Controllers\Admin\AwardController@updateAward')->name('admin.update.award');
    Route::get('delete-awards/{id}', '\App\Http\Controllers\Admin\AwardController@deleteAward')->name('delete.award');

    Route::get('corp-governance-list', '\App\Http\Controllers\Admin\CorpGovernanceController@index')->name('admin.corp-governance');
    Route::post('add-corp-governance', '\App\Http\Controllers\Admin\CorpGovernanceController@addCorpGovernance')->name('admin.add.corp-governance');
    Route::post('update-corp-governance', '\App\Http\Controllers\Admin\CorpGovernanceController@updateCorpGovernance')->name('admin.update.corp-governance');
    Route::get('delete-corp-governance/{id}', '\App\Http\Controllers\Admin\CorpGovernanceController@deleteCorpGovernance')->name('delete.corp-governance');

    Route::get('investor-presentation-list', '\App\Http\Controllers\Admin\InvestorPresentationController@index')->name('admin.investor-presentation');
    Route::post('add-investor-presentation', '\App\Http\Controllers\Admin\InvestorPresentationController@addInvestor')->name('admin.add.investor-presentation');
    Route::post('update-investor-presentation', '\App\Http\Controllers\Admin\InvestorPresentationController@updateInvestor')->name('admin.update.investor-presentation');
    Route::get('delete-investor-presentation/{id}', '\App\Http\Controllers\Admin\InvestorPresentationController@deleteInvestor')->name('delete.investor-presentation');

    Route::get('press-release', '\App\Http\Controllers\Admin\PressController@index')->name('admin.press-release');
    Route::post('add-press-release', '\App\Http\Controllers\Admin\PressController@addRelease')->name('admin.add.press-release');
    Route::post('update-press-release', '\App\Http\Controllers\Admin\PressController@updateRelease')->name('admin.update.press-release');
    Route::get('delete-press-release/{id}', '\App\Http\Controllers\Admin\PressController@deleteRelease')->name('delete.press-release');

    Route::get('postal', '\App\Http\Controllers\Admin\PressController@index')->name('admin.press-release');
    Route::post('add-press-release', '\App\Http\Controllers\Admin\PressController@addCommittee')->name('admin.add.press-release');
    Route::post('update-press-release', '\App\Http\Controllers\Admin\PressController@updateCommittee')->name('admin.update.press-release');
    Route::get('delete-press-release/{id}', '\App\Http\Controllers\Admin\PressController@deleteCommittee')->name('delete.press-release');

    Route::get('postal-ballot', '\App\Http\Controllers\Admin\PostalBallotController@index')->name('admin.postal-ballot');
    Route::post('add-postal-ballot', '\App\Http\Controllers\Admin\PostalBallotController@addBallot')->name('admin.add.postal-ballot');
    Route::post('update-postal-ballot', '\App\Http\Controllers\Admin\PostalBallotController@updateBallot')->name('admin.update.postal-ballot');
    Route::get('delete-postal-ballot/{id}', '\App\Http\Controllers\Admin\PostalBallotController@deleteBallot')->name('delete.postal-ballot');

    Route::get('statutory', '\App\Http\Controllers\Admin\StatutoryCommunicationController@index')->name('admin.statutory');
    Route::post('add-statutory', '\App\Http\Controllers\Admin\StatutoryCommunicationController@addStatutory')->name('admin.add.statutory');
    Route::post('update-statutory', '\App\Http\Controllers\Admin\StatutoryCommunicationController@updateStatutory')->name('admin.update.statutory');
    Route::get('delete-statutory/{id}', '\App\Http\Controllers\Admin\StatutoryCommunicationController@deleteStatutory')->name('delete.statutory');

    Route::get('shareholding', '\App\Http\Controllers\Admin\ShareholdingController@index')->name('admin.shareholding');
    Route::post('add-shareholding', '\App\Http\Controllers\Admin\ShareholdingController@addShareholding')->name('admin.add.shareholding');
    Route::post('update-shareholding', '\App\Http\Controllers\Admin\ShareholdingController@updateShareholding')->name('admin.update.shareholding');
    Route::get('delete-shareholding/{id}', '\App\Http\Controllers\Admin\ShareholdingController@deleteShareholding')->name('delete.shareholding');

    Route::get('reports', '\App\Http\Controllers\Admin\ReportsController@index')->name('admin.reports');
    Route::post('add-reports', '\App\Http\Controllers\Admin\ReportsController@addreports')->name('admin.add.reports');
    Route::post('update-reports', '\App\Http\Controllers\Admin\ReportsController@updatereports')->name('admin.update.reports');
    Route::get('delete-reports/{id}', '\App\Http\Controllers\Admin\ReportsController@deletereports')->name('delete.reports');

    Route::get('media', '\App\Http\Controllers\Admin\MediaController@index')->name('admin.media');
    Route::post('add-media', '\App\Http\Controllers\Admin\MediaController@addmedia')->name('admin.add.media');
    Route::post('update-media', '\App\Http\Controllers\Admin\MediaController@updatemedia')->name('admin.update.media');
    Route::get('delete-media/{id}', '\App\Http\Controllers\Admin\MediaController@deletemedia')->name('delete.media');

    // Media Route
    Route::get('media', '\App\Http\Controllers\Admin\MediaController@index')->name('admin.media');
    Route::post('add-media', '\App\Http\Controllers\Admin\MediaController@addMedia')->name('admin.add.media');
    Route::post('update-media', '\App\Http\Controllers\Admin\MediaController@updateMedia')->name('admin.update.media');
    Route::get('delete-media/{id}', '\App\Http\Controllers\Admin\MediaController@deleteMedia')->name('delete.media');

    // Gallary Category route
    Route::get('/gallery-category', '\App\Http\Controllers\Admin\HomeController@galleryCategory')->name('admin.gallery.category');
    Route::post('/add/gallery-category', '\App\Http\Controllers\Admin\HomeController@addGalleryCategory')->name('admin.add.gallery.category');
    Route::post('/edit/gallery-category', '\App\Http\Controllers\Admin\HomeController@editGalleryCategory')->name('admin.edit.gallery.category');
    Route::get('/delete/gallery-category/{id}', '\App\Http\Controllers\Admin\HomeController@deleteGalleryCategory')->name('admin.delete.gallery.category');


    // Gallary route
    Route::get('/gallary', '\App\Http\Controllers\Admin\HomeController@gallary')->name('admin.gallary');
    Route::post('/add/gallary', '\App\Http\Controllers\Admin\HomeController@addGallary')->name('admin.add.gallary');
    Route::post('/edit/gallary', '\App\Http\Controllers\Admin\HomeController@editGallary')->name('admin.edit.gallary');
    Route::get('/delete/gallary/{id}', '\App\Http\Controllers\Admin\HomeController@deleteGallary')->name('admin.delete.gallary');

    // privacy route
    Route::get('/privacy_policy', '\App\Http\Controllers\Admin\LegalController@privacyPolicy')->name('admin.privacy_policy');
    Route::post('/add/policy', '\App\Http\Controllers\Admin\LegalController@addPolicy')->name('admin.add.policy');
    Route::post('/edit/policy', '\App\Http\Controllers\Admin\LegalController@editPolicy')->name('admin.edit.policy');

    // terms route
    Route::get('/terms', '\App\Http\Controllers\Admin\LegalController@term')->name('admin.terms');
    Route::post('/add/terms', '\App\Http\Controllers\Admin\LegalController@addTerm')->name('admin.add.terms');
    Route::post('/edit/terms', '\App\Http\Controllers\Admin\LegalController@editTerm')->name('admin.edit.terms');

    // Jobs route
    Route::get('/jobs', 'App\Http\Controllers\Admin\HomeController@jobs')->name('admin.jobs');
    Route::post('/add/job', 'App\Http\Controllers\Admin\HomeController@addJobs')->name('admin.add.job');
    Route::post('/edit/job', '\App\Http\Controllers\Admin\HomeController@editJobs')->name('admin.edit.job');
    Route::get('delete-job/{id}', '\App\Http\Controllers\Admin\HomeController@deleteJobs')->name('delete.job');


    // social media route
    Route::get('/social-media', 'App\Http\Controllers\Admin\SocialMediaController@socialMedia')->name('admin.socail.media');
    Route::post('/add/social-media', 'App\Http\Controllers\Admin\SocialMediaController@addSocialMedia')->name('admin.add.socail.media');
    Route::post('/edit/social-media', '\App\Http\Controllers\Admin\SocialMediaController@editSocialMedia')->name('admin.edit.socail.media');
    Route::get('delete-social-media/{id}', '\App\Http\Controllers\Admin\SocialMediaController@deleteSocialMedia')->name('delete.socail.media');


    // career video route
    Route::get('/gallery-video', '\App\Http\Controllers\Admin\HomeController@galleryVideo')->name('admin.gallery.video');
    Route::post('/add/gallery-video', '\App\Http\Controllers\Admin\HomeController@addGalleryVideo')->name('admin.add.gallery.video');
    Route::post('/edit/gallery-video', '\App\Http\Controllers\Admin\HomeController@editGalleryVideo')->name('admin.edit.gallery.video');
    Route::get('delete-gallery-video/{id}', '\App\Http\Controllers\Admin\HomeController@deleteGalleryVideo')->name('delete.gallery.video');

    // Disclaimer route
    Route::get('/disclaimer', 'App\Http\Controllers\Admin\LegalController@disclaimer')->name('admin.disclaimer');
    Route::post('/add/disclaimer', 'App\Http\Controllers\Admin\LegalController@addDisclaimer')->name('admin.add.disclaimer');
    Route::post('/edit/disclaimer', '\App\Http\Controllers\Admin\LegalController@editDisclaimer')->name('admin.edit.disclaimer');
    Route::get('delete-disclaimer/{id}', '\App\Http\Controllers\Admin\LegalController@deleteDisclaimer')->name('delete.disclaimer');

    // CSR route
    Route::get('/csr', 'App\Http\Controllers\Admin\CSRController@csr')->name('admin.csr');
    Route::post('/add/csr', 'App\Http\Controllers\Admin\CSRController@addCsr')->name('admin.add.csr');
    Route::post('/edit/csr', '\App\Http\Controllers\Admin\CSRController@editCsr')->name('admin.edit.csr');
    Route::get('delete-csr/{id}', '\App\Http\Controllers\Admin\CSRController@deleteCsr')->name('delete.csr');

    // Investor route

    // Corp Governance
    Route::get('/corp-governance', 'App\Http\Controllers\Admin\InvestorRelationsController@corpGovernance')->name('admin.corp.governance');
    Route::post('/add/corp-governance', 'App\Http\Controllers\Admin\InvestorRelationsController@addCorpGovernance')->name('admin.add.corp.governance');
    Route::post('/edit/corp-governance', '\App\Http\Controllers\Admin\InvestorRelationsController@editCorpGovernance')->name('admin.edit.corp.governance');
    Route::get('delete-corp-governance/{id}', '\App\Http\Controllers\Admin\InvestorRelationsController@deleteCorpGovernance')->name('delete.corp.governance');

    // Invester presentations
    Route::get('/invester-presentation', 'App\Http\Controllers\Admin\InvestorRelationsController@investerPresentation')->name('admin.invester.presentation');
    Route::post('/add/invester-presentation', 'App\Http\Controllers\Admin\InvestorRelationsController@addInvesterPresentation')->name('admin.add.invester.presentation');
    Route::post('/edit/invester-presentation', '\App\Http\Controllers\Admin\InvestorRelationsController@editInvesterPresentation')->name('admin.edit.invester.presentation');
    Route::get('delete-invester-presentation/{id}', '\App\Http\Controllers\Admin\InvestorRelationsController@deleteInvesterPresentation')->name('delete.invester.presentation');



    //  Release Category
    Route::get('/release-category', 'App\Http\Controllers\Admin\InvestorRelationsController@releaseCategory')->name('admin.release.category');
    Route::post('/add/release-category', 'App\Http\Controllers\Admin\InvestorRelationsController@addReleaseCategory')->name('admin.add.release.category');
    Route::post('/edit/release-category', '\App\Http\Controllers\Admin\InvestorRelationsController@editReleaseCategory')->name('admin.edit.release.category');
    Route::get('delete-release-category/{id}', '\App\Http\Controllers\Admin\InvestorRelationsController@deleteReleaseCategory')->name('delete.release.category');

    //  Report Category
    Route::get('/report-category', 'App\Http\Controllers\Admin\ReportController@reportCategory')->name('admin.report.category');
    Route::post('/add/report-category', 'App\Http\Controllers\Admin\ReportController@addReportCategory')->name('admin.add.report.category');
    Route::post('/edit/report-category', '\App\Http\Controllers\Admin\c@editReportCategory')->name('admin.edit.report.category');
    Route::get('delete-report-category/{id}', '\App\Http\Controllers\Admin\ReportController@deleteReportCategory')->name('delete.report.category');


    // Press Release
    Route::get('/press-release', 'App\Http\Controllers\Admin\InvestorRelationsController@pressReleases')->name('admin.press.release');
    Route::post('/add/press-release', 'App\Http\Controllers\Admin\InvestorRelationsController@addPressReleases')->name('admin.add.press.release');
    Route::post('/edit/press-release', '\App\Http\Controllers\Admin\InvestorRelationsController@editPressReleases')->name('admin.edit.press.release');
    Route::get('delete-press-release/{id}', '\App\Http\Controllers\Admin\InvestorRelationsController@deletePressReleases')->name('delete.press.release');

    // Reports
    Route::get('/reports', 'App\Http\Controllers\Admin\ReportController@reports')->name('admin.report');
    Route::post('/add/reports', 'App\Http\Controllers\Admin\ReportController@addReports')->name('admin.add.report');
    Route::post('/edit/reports', '\App\Http\Controllers\Admin\ReportController@editReports')->name('admin.edit.report');
    Route::get('delete-reports/{id}', '\App\Http\Controllers\Admin\ReportController@deleteReports')->name('delete.report');

    // contact route
    Route::get('/contact', '\App\Http\Controllers\Admin\ContactUsController@index')->name('admin.contacts');
    Route::post('/add/contact', '\App\Http\Controllers\Admin\ContactUsController@addContact')->name('admin.add.contact');
    Route::post('/edit/contact', '\App\Http\Controllers\Admin\ContactUsController@updateContact')->name('admin.update.contact');

    // we offer route
    Route::get('/we-offer', '\App\Http\Controllers\Admin\WeOfferController@weOffer')->name('admin.we.offer');
    Route::post('/add/we-offer', '\App\Http\Controllers\Admin\WeOfferController@addOffer')->name('admin.add.offer');
    Route::post('/edit/we-offer', '\App\Http\Controllers\Admin\WeOfferController@editOffer')->name('admin.update.offer');
    Route::get('delete-we-offer/{id}', '\App\Http\Controllers\Admin\WeOfferController@deleteOffer')->name('delete.offer');

    // student hear route
    Route::get('/student-hear', '\App\Http\Controllers\Admin\WeOfferController@studentHear')->name('admin.student.hear');
    Route::post('/add/student-hear', '\App\Http\Controllers\Admin\WeOfferController@addStudenHears')->name('admin.add.student.hear');
    Route::post('/edit/student-hear', '\App\Http\Controllers\Admin\WeOfferController@editStudentHear')->name('admin.update.student.hear');
    Route::get('delete-student-hear/{id}', '\App\Http\Controllers\Admin\WeOfferController@deleteStudentHear')->name('delete.student.hear');

    // meta tags route
    Route::get('/meta-tags', '\App\Http\Controllers\Admin\MetaTagsController@metaTags')->name('admin.meta.tag');
    Route::post('/add/meta-tags', '\App\Http\Controllers\Admin\MetaTagsController@addMetaTags')->name('admin.add.meta.tag');
    Route::post('/edit/meta-tags', '\App\Http\Controllers\Admin\MetaTagsController@editMetaTags')->name('admin.update.meta.tag');
    Route::get('delete-meta-tags/{id}', '\App\Http\Controllers\Admin\MetaTagsController@deleteMetaTags')->name('delete.meta.tag');


    // Enquiry List
    Route::get('/enquiry', '\App\Http\Controllers\Admin\MetaTagsController@enquiry')->name('admin.enquiry');
    Route::post('/edit/enquiry', '\App\Http\Controllers\Admin\MetaTagsController@editEnquiry')->name('admin.update.enquiry');
    Route::get('delete-enquiry/{id}', '\App\Http\Controllers\Admin\MetaTagsController@deleteEnquiry')->name('delete.enquiry');


    // theme change api

    Route::post('/check-unique-city', 'App\Http\Controllers\Admin\HomeController@checkUniqueCity')->name('admin.check.city');

    Route::post('/check-unique-state', 'App\Http\Controllers\Admin\HomeController@checkUnique')->name('admin.check.state');

    Route::post('/theme-change', 'App\Http\Controllers\Admin\HomeController@themeChange')->name('admin.theme.change');

    Route::get('logout', '\App\Http\Controllers\Admin\DashboardController@logout')->name('logout');
});
