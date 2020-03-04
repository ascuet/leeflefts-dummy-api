<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Team;
use Image;

class TeamController extends Controller
{
    public function getAll() {
        $teams = Team::all();
        return response()->json(
            [
                'results' => $teams, 
                'error' => count($teams)>0 ? false : true,
                'message' => count($teams) > 0 ? 'Data Retrieved' : 'No Team Found'
            ]
        );
    }

    public function store(Request $request) {
        $obj = new Team();
        $obj->name = $request->name;
        $obj->gender = $request->gender;
        $obj->age = $request->age;
        $obj->url = $request->url;
        $obj->description = $request->description;
        $obj->age = $request->age;

        $profile_image  = $request->get('profile_image');

        $filename = time().'.jpg';

        $path = base_path() . "/resources/uploads/team/" . $filename;
        if($obj->save()) {
            $image = Image::make($profile_image)->resize(480,"", function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 90);
        }
    }
}
 