<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VaccineCenter;
use App\Notifications\VaccineReminderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function registration()
    {

        $data['vaccine_centers'] = VaccineCenter::select('id', 'name', 'address', 'capacity')->where('status', 'active')->get();
        return view('frontend.registration.create', $data);
    }

    public function registrationProcess(Request $request)
    {
        // check valid data from request
        $request->validate([
            'name'   => ['required', 'string', 'min:1', 'max:48'],
            'email'  => ['required', 'string', 'min:1', 'max:80', 'unique:users,email'],
            'phone'  => ['required', 'string', 'min:1', 'max:20', 'unique:users,phone'],
            'nid'    => ['required', 'string', 'min:10','max:16', 'unique:users,nid'],
            'dob'    => ['nullable', 'date',],
            'gender' => ['nullable', 'string', 'min:1', 'max:6'],
            'vaccine_center' => ['required', 'min:1'],
            ], [
                'name.required' => 'Name required',
                'email.required' => 'Email required',
                'phone.required' => 'Phone required',
                'nid.required' => 'Nid required',
                'dob.date' => 'Valid Date required',
            ]);

        $vaccineCenterDetails = VaccineCenter::find($request->input('vaccine_center'));
//        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        $scheduledDate = $vaccineCenterDetails->users()
            ->where('scheduled_date', '>=', $tomorrow)
            ->groupBy('scheduled_date')
            ->havingRaw('count(*) < ?', [$vaccineCenterDetails->capacity])
            ->pluck('scheduled_date')
            ->first() ?? $tomorrow;

        // Check if the calculated date is on a weekend (Friday or Saturday)
        while ($scheduledDate->isFriday() || $scheduledDate->isSaturday()) {
            $scheduledDate->addDay();
        }

        // Assign the valid weekday date
        $user = User::create([
            'name' => $request->input('name'),
            'nid' => $request->input('nid'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'vaccine_center_id' => $request->input('vaccine_center'),
            'scheduled_date' => $scheduledDate,
            ]);

//        $user->notify(new VaccineReminderNotification($user, $user->scheduled_date, $user->vaccineCenter->name));


        return redirect()->back()->with('success', 'Successfully registered for Covid Vaccine, we will inform via your email a day before, or you may check from <a href="' . route('search') . '">This link</a>.');

    }

    public function search()
    {
        return view('frontend.search.search');
    }

    public function searchProcess(Request $request)
    {
        // check valid data from request
        $request->validate(
            [
            'nid' => ['required', 'string', 'min:10', 'max:16'],
            ],
            ['nid.required' => 'NID required',]);

        $user = User::where('nid', $request->nid)->first();

        // If not registered
        if (!$user) {
            $data['status'] = 'Not registered';
            $data['link']   = route('registration');
            return view('frontend.search.search',$data);
        }

        // If the user is registered but not scheduled yet
        if (!$user->scheduled_date) {
            $data['status']      = 'Not scheduled';
            $data['name']        = ucwords($user->name);
            $data['center_name'] = ucwords($user->vaccineCenter->name). ', '.ucwords($user->vaccineCenter->address);
            return view('frontend.search.search',$data);
        }

        // If vaccinated
        if ($user->vaccinated == 1) {
            $data['status']      = 'Vaccinated';
            $data['name']        = ucwords($user->name);
            $data['date']        = $user->scheduled_date->format('d F Y');
            $data['center_name'] = ucwords($user->vaccineCenter->name). ', '.ucwords($user->vaccineCenter->address);

            return view('frontend.search.search',$data);
        }

        // If the current date is greater than or equal to the scheduled date, and the user isn't vaccinated
        if (date('Y-m-d') >= $user->scheduled_date && !$user->vaccinated) {
            // Mark the user as vaccinated
            $user->update(['vaccinated' => true]);

            $data['status']      = 'Vaccinated';
            $data['name']        = ucwords($user->name);
            $data['date']        = $user->scheduled_date->format('d F Y');
            $data['center_name'] = ucwords($user->vaccineCenter->name). ', '.ucwords($user->vaccineCenter->address);

            return view('frontend.search.search',$data);
        }



        // If the user is scheduled but not vaccinated yet
        $data['status']      = 'Scheduled';
        $data['name']        = ucwords($user->name);
        $data['date']        = $user->scheduled_date->format('d F Y');
        $data['center_name'] = ucwords($user->vaccineCenter->name). ', '.ucwords($user->vaccineCenter->address);

        return view('frontend.search.search',$data);

    }
}
