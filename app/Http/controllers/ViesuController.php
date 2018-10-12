<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Viesi;
use DB;

class ViesuController extends Controller
{
	public function index(){
		$viesi = Viesi::all();

		
		return $viesi;
	}
	public function store(Request $request){




		$lietotaja_vards = $request->input('lietotaja_vards');
		$epasts = $request->input('epasts');
		$vietne = $request->input('vietne');
		$teksts = $request->input('teksts');
		$ip = $request->input('ip');
		$parluks = $request->input('browser');
       
		

		DB::table('ierakstudati')->insertGetId(
			['lietotaja_vards' => $lietotaja_vards,
			'e-pasts' => $epasts,
			'vietne' => $vietne,
			'teksts' => $teksts,
			'IP' => $ip,
			'parluks' => $parluks]
			);
		
	}
}
