<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAudit;
use App\Models\UnitAudit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UnitAudit $unitAudit)
    {

//        $standart = DB::table('standarts')
//            ->select(DB::raw('DATE_FORMAT(created_at,"%Y") as created_at, id, user_id, type, name'))
//            ->get();

        $unitAudit = UnitAudit::all();

        // $results = DB::select( 
        //     DB::raw("   SELECT
        //                     * 
        //                 FROM
        //                     unit_audits u
        //                 LEFT JOIN (
        //                     SELECT name,id as iduser 
        //                     FROM
        //                         users 
        //                     ) us ON us.iduser = u.ketua_tim"
        //             ) 
        // );

        return view('admin.dashboardUnitAudit', array("unitAudit" => $unitAudit));
    }

    public function pageTambahUnit()
    {
        $periodeAudit = PeriodeAudit::all();
        $ketua = User::whereHas(
            'roles', function($q){
                $q->where('role', 'ketua');
            }
        )->get();
        // print_r($students);die;

        
        return view('admin.tambahUnit', array("periodeAudit" => $periodeAudit, "selectKetua" => $ketua));
    }


    public function tambahUnit(Request $request)
    {
        // print_r("asd");die;
        $request->validate([
            'id_periode_audit' => 'required',
            // 'id_standar_ruang_lingkup' => 'required',
            'nama_unit' => 'required',
            'tanggal_audit' => 'required',
            'ketua_tim' => 'required',
            'nip_ketua_tim' => 'required',
        ]); 

        // print_r($request['ketua_tim']);die;
        DB::table('users')
            ->where('id', $request['ketua_tim'])
            ->update(['nip' => $request['nip_ketua_tim']]);

        // print_r('asda');die;
        $max = UnitAudit::max('id');
        $id = $max +1;
        
        // $unit = new UnitAudit;
        $unit = UnitAudit::Create([
            'id_periode_audit' => $request['id_periode_audit'],
            // 'id_standar_ruang_lingkup' => $request['id_standar_ruang_lingkup'],
            'nama_unit' => $request['nama_unit'],
            'tanggal_audit' => $request['tanggal_audit'],
            'ketua_tim' => $request['ketua_tim'],
            'nip_ketua_tim' => $request['nip_ketua_tim'],
            'id_auditor'    => null
        ]);
        // $unit->id    = $id;
        // $unit->periodeAudit             = $request->input('periodeAudit');
        // $unit->id_standar_ruang_lingkup = $request->input('id_standar_ruang_lingkup');
        // $unit->nama_unit                = $request->input('nama_unit');
        // $unit->tanggal_audit            = $request->input('tanggal_audit');
        // $unit->ketua_tim                = $request->input('ketua_tim');
        // $unit->nip_ketua_tim            = $request->input('nip_ketua_tim');
        // $unit->save();
        // return redirect()->back();

        if(!is_null($unit)) {
            return redirect()->route('daftarUnit')->with("success", "Berhasil Tambah");
        }
        else {
            return back()->with("error", "Proses Gagal");
        }

    }

    public function destroy($id)
    {   
        // print_r($id);die;
        $periode = UnitAudit::findOrFail($id);
        $periode->delete();


        
        return redirect()->back()->with('success','Berhasil Menghapus data');
    }
}