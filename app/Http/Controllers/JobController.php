<?php

namespace App\Http\Controllers;

use App\Job;
use App\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index()
    {
        ##show a list of all recent jobs published within last 7 days
        $date = Carbon::today()->subDays(7);
        $jobs = Job::where('published_at', '>=', $date)
            ->orderBy('published_at', 'desc')
            ->get();

        ## Getting all jobs order by published date
     
        return view('index', array(
        	"jobs" => $jobs
        ));
    }
    ##Get all companies 
    public function create()
    {
    	$companies = Company::all();

        return view('create', array(
        	"companies" => $companies
        ));
    }
    ## Validate form and save data
    public function save(Request $request)
    {

    	$rules = [
    		'title' => 'required|min:1|max:50',
    		'company_id' => 'required',
    		'description' => 'required',
    		'location' => 'required'

    	];
    	$request->validate($rules);

    	$job = Job::create($request->toArray());

		return redirect('/');
    }
}
