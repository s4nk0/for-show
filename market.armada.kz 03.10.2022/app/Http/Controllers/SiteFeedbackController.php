<?php

namespace App\Http\Controllers;

use App\Http\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteFeedbackController extends Controller
{

    protected Service $service;

    /**
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //

        return view('pages.feedback.index');
    }

    public function sentFeedback(Request $request){

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['comment'] = $request->comment;


        return back()->with(['success'=>'Отзыв успешно отправлен']);
        $this->service->sendMail($data,'addSiteFeedback');
    }

}
