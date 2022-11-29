<?php


namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutVideo;
use App\Models\Achievments;
use App\Models\Award;
use App\Models\BoardOfDirector;
use App\Models\Center;
use App\Models\City;
use App\Models\ClassCategory;
use App\Models\Committee;
use App\Models\ContactAddress;
use App\Models\ContactPost;
use App\Models\CorpGovernance;
use App\Models\CourseDetail;
use App\Models\CourseType;
use App\Models\CSR;
use App\Models\DemoVideo;
use App\Models\Disclaimer;
use App\Models\Enquiry;
use App\Models\Gallary;
use App\Models\GalleryCategory;
use App\Models\InvestorPresentation;
use App\Models\Job;
use App\Models\KeyManagement;
use App\Models\Media;
use App\Models\PressRelease;
use App\Models\PrivacyPolicy;
use App\Models\ReleaseCategory;
use App\Models\Report;
use App\Models\StudentHear;
use App\Models\Team;
use App\Models\Term;
use App\Models\Topper;
use App\Models\UserCount;
use App\Models\UsersQuery;
use App\Models\UserTestimonial;
use App\Models\VideoGallery;
use App\Models\WeOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

    public function gallaryList()
    {
        try {
            $gallaryLists = GalleryCategory::join('gallary', 'gallery_type.id', '=', 'gallary.category_id')->select('gallery_type.id as id', 'gallery_type.name as name', 'gallary.image as image', DB::raw('count(gallary.category_id) as total'))->groupBy('id')->get();
            $response = ['success' => true, 'message' => 'Gallary get successfully', 'data' => $gallaryLists];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function gallaryDataList($id)
    {
        try {
            $gallaryDataLists = Gallary::where('category_id', $id)->with('category')->get();
            $response = ['success' => true, 'message' => 'Gallary get successfully', 'data' => $gallaryDataLists];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function gallaryVideoList()
    {
        try {
            $videos = VideoGallery::all();
            $response = ['success' => true, 'message' => 'Videos get successfully', 'data' => $videos];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function csrData()
    {
        try {
            $csrs = CSR::all();
            $response = ['success' => true, 'message' => 'CSR get successfully', 'data' => $csrs];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function jobList()
    {
        try {
            $jobs = Job::all();
            $response = ['success' => true, 'message' => 'Jobs get successfully', 'data' => $jobs];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function jobData($id)
    {
        try {
            $jobs = Job::find($id);
            $response = ['success' => true, 'message' => 'Jobs get successfully', 'data' => $jobs];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function privacyPolicyList()
    {
        try {
            $privacyPolicy = PrivacyPolicy::first();
            $response = ['success' => true, 'message' => 'Privacy Policy get successfully', 'data' => $privacyPolicy];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function termsList()
    {
        try {
            $term = Term::first();
            $response = ['success' => true, 'message' => 'Tems & Conditions get successfully', 'data' => $term];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function disclaimerList()
    {
        try {
            $disclaimer = Disclaimer::first();
            $response = ['success' => true, 'message' => 'Disclaimer get successfully', 'data' => $disclaimer];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function centersList()
    {
        try {
            $centers = Center::with(['state', 'city'])->get();
            $response = ['success' => true, 'message' => 'Centers get successfully', 'data' => $centers];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }


    public function introList()
    {
        try {
            $aboutUs = AboutUs::all();
            $response = ['success' => true, 'message' => 'AboutUs get successfully', 'data' => $aboutUs];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function boarOfDirectors()
    {
        try {
            $directors = BoardOfDirector::all();
            $response = ['success' => true, 'message' => 'Directors get successfully', 'data' => $directors];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function boarOfCOmmites()
    {
        try {
            $commites = Committee::all();
            $response = ['success' => true, 'message' => 'Borad of commitee get successfully', 'data' => $commites];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function keyManagement()
    {
        try {
            $keys = KeyManagement::all();
            $response = ['success' => true, 'message' => 'Key Management get successfully', 'data' => $keys];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function awardsData()
    {
        try {
            $awards = Award::all();
            $response = ['success' => true, 'message' => 'Awards get successfully', 'data' => $awards];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function corporateData()
    {
        try {
            $corpGOvernance = CorpGovernance::all();
            $response = ['success' => true, 'message' => 'Corporate Governance get successfully', 'data' => $corpGOvernance];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function investorData()
    {
        try {
            $investor = InvestorPresentation::all();
            $response = ['success' => true, 'message' => 'Investor get successfully', 'data' => $investor];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function releaseCategory()
    {
        try {
            $categories = ReleaseCategory::all();
            $response = ['success' => true, 'message' => 'Release category get successfully', 'data' => $categories];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function releaseData($id)
    {
        try {
            $releaseData = PressRelease::where('release_category_id', $id)->get();
            $response = ['success' => true, 'message' => 'Release data get successfully', 'data' => $releaseData];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function reportData($id)
    {
        try {
            $reports = Report::where('report_category_id', $id)->get();
            $response = ['success' => true, 'message' => 'Report data get successfully', 'data' => $reports];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function awardsDetail($id)
    {
        try {
            $award = Award::find($id);
            $response = ['success' => true, 'message' => 'Award get successfully', 'data' => $award];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function defaultCourseDetails()
    {
        try {
            $defaultCourse = [];
            $categoryID = CourseType::first();
            if ($categoryID) {
                $defaultCourse = CourseDetail::where('course_id', $categoryID->id)->get();
            }
            $response = ['success' => true, 'message' => 'Default successfully', 'data' => $defaultCourse];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function defaultDemoDetails()
    {
        try {
            $defaultDemo = [];
            $demoID = DemoVideo::first();
            if ($demoID) {
                $defaultDemo = DemoVideo::where('class_id', $demoID->class_id)->get();
            }
            $response = ['success' => true, 'message' => 'Default demo successfully', 'data' => $defaultDemo];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function enquiryForm(Request $request)
    {
        try {

            $rules = [
                'name' => 'required',
                'mobile' => 'required',
                'email' => 'required',
                'category' => 'required',
                'board' => 'required',
                'standard' => 'required',
                'city' => 'required',
                'demo_time' => 'required',
            ];
            $requestData = $request->all();
            $validator = Validator::make($requestData, $rules);
            if ($validator->fails()) {

                $response = ['success' => false, 'message' => $validator->errors()->all()];
            } else {
                $contactForm = Enquiry::create($requestData);

                $response = ['success' => true, 'message' => 'Booking successfully Done'];
            }
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function emailSubscription(Request $request)
    {
        try {

            $rules = [
                'email' => 'required'
            ];
            $requestData = $request->all();
            $validator = Validator::make($requestData, $rules);
            if ($validator->fails()) {

                $response = ['success' => false, 'message' => $validator->errors()->all()];
            } else {
                $email = $request->email;
                if ($email) {
                    $email = $request->email;
                    // Mail::send('admin.email.contactus', ['data' => $requestData], function ($message) use ($email) {
                    //     $message->from($email);
                    //     $message->to($email);
                    //     $message->subject('Contact Us');
                    // });

                    // $details = [
                    //     'title' => 'Mail from ItSolutionStuff.com',
                    //     'body' => 'This is for testing email using smtp'
                    // ];

                    // Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));
                }
                $response = ['success' => true, 'message' => 'Email sent successfully'];
            }
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function categoryList()
    {
        try {
            $categories = CourseType::all();
            $response = ['success' => true, 'message' => 'Category get successfully', 'data' => $categories];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function categoryDetail($id)
    {
        try {
            $categoryDetails = CourseDetail::where('course_id', $id)->get();
            $response = ['success' => true, 'message' => 'Category Details get successfully', 'data' => $categoryDetails];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function demoVideoCategory()
    {
        try {
            $demoVideos = DemoVideo::with('classCategory')->groupBy('class_id')->distinct()->get();
            $response = ['success' => true, 'message' => 'Demo video get successfully', 'data' => $demoVideos];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function demoVideoDetails($id)
    {
        try {
            $demoVideos = DemoVideo::where('class_id', $id)->get();
            $response = ['success' => true, 'message' => 'Demo video detail get successfully', 'data' => $demoVideos];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function topperList()
    {
        try {
            $toppers = Topper::all();
            $response = ['success' => true, 'message' => 'Topper detail get successfully', 'data' => $toppers];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function ourAchivementList()
    {
        try {
            $achivements = Achievments::first();
            $response = ['success' => true, 'message' => 'Achivements get successfully', 'data' => $achivements];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }


    public function categoryBoardStandards($id)
    {
        try {
            $boardsStandards = ClassCategory::where('course_id', $id)->get();
            $response = ['success' => true, 'message' => 'Boards and Standards get successfully', 'data' => $boardsStandards];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function cityList()
    {
        try {
            $cities = City::all();
            $response = ['success' => true, 'message' => 'Cities get successfully', 'data' => $cities];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function areaData($id)
    {
        try {
            $areas = Center::where('city_id', $id)->get();
            $response = ['success' => true, 'message' => 'Areas get successfully', 'data' => $areas];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function centerSearch(Request $request)
    {
        // \DB::enableQueryLog();
        $centers = Center::with(['state', 'city']);
        if (isset($request->city) && $request->city) {
            $centers->where('city_id', $request->city);
        }
        if (isset($request->area) && $request->area) {
            $centers->Orwhere('address', 'like', '%' . $request->area . '%');
            $centers->Orwhere('address1', 'like', '%' . $request->area . '%');
        }
        $centerData = $centers->get();
        // dd(\DB::getQueryLog());
        $response = ['success' => true, 'message' => 'Center get successfully', 'data' => $centerData];
        return Response::json($response, 200);
    }

    public function categorySearch(Request $request)
    {
        // \DB::enableQueryLog();
        $centers = CourseDetail::with('courseType');
        if (isset($request->search) && $request->search) {
            $centers->where('title', 'like', '%' .  $request->search . '%');
            $centers->Orwhere('description', 'like', '%' . $request->search . '%');
            $centers->Orwhere('tag_name', 'like', '%' . $request->search . '%');
        }
        $centerData = $centers->get();
        // dd(\DB::getQueryLog());
        $response = ['success' => true, 'message' => 'Course get successfully', 'data' => $centerData];
        return Response::json($response, 200);
    }

    public function usersQuery(Request $request)
    {
        try {
            $query = UsersQuery::create($request->all());
            $response = ['success' => true, 'message' => 'Query submitted  successfully '];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function mediaList()
    {
        try {
            $media = Media::all();
            $response = ['success' => true, 'message' => 'Media get successfully', 'data' => $media];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function offersList()
    {
        try {
            $offers = WeOffer::all();
            $response = ['success' => true, 'message' => 'Offer get successfully', 'data' => $offers];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function studentHearList()
    {
        try {
            $hears = StudentHear::all();
            $response = ['success' => true, 'message' => 'Student hears get successfully', 'data' => $hears];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    public function investerSearch(Request $request)
    {
        try {
            $investorPre = InvestorPresentation::select('file_name', 'quarter_name', 'quarter_code');
            if (isset($request->year) && $request->year) {
                $investorPre->where('invest_year', $request->year);
            }
            $investorPresentation = $investorPre->get();
            $response = ['success' => true, 'message' => 'Investor presentation search get successfully', 'data' => $investorPresentation];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }


    public function reportSearch(Request $request)
    {
        try {
            $reports = Report::select('file_name', 'quarter_name', 'quarter_code');
            if (isset($request->year) && $request->year) {
                $reports->where('report_year', $request->year);
            }
            if (isset($request->reportId) && $request->reportId) {
                $reports->where('report_category_id', $request->reportId);
            }
            $reportData = $reports->get();
            $response = ['success' => true, 'message' => 'Reports search get successfully', 'data' => $reportData];
            return Response::json($response, 200);
        } catch (Exception $e) {

            return Response::json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }
}
