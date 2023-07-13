<?php

namespace App\Http\Controllers;

use App\Models\DataPendahuluan;
use App\Models\Grade;
use App\Models\GradeStoring;
use App\Models\Question;
use App\Models\Response;
use App\Models\Standart;
use App\Models\User;
use App\Models\StandarRuangLingkup;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $filter = Carbon::now()->format('Y');

        // $uid = \Auth::id();
        // $standart = Standart::with(['responses' => function($q) use($uid) {
        //     // Query the name field in status table
        //     $q->where('user_id', '=', $uid)->whereYear('created_at','=', Carbon::now()->format('Y'));
        // }])
        // ->whereYear('created_at', date('Y'))->get();

        // $i = Carbon::now();

        // $check = DataPendahuluan::whereYear('created_at', '<=', $i)
        //     ->whereYear('updated_at', '<=', $i)
        //     ->where('user_id','=', $uid)
        //     ->get();


        $result = DB::select(
            DB::raw(
                "   SELECT
                        sr.id,
                        ua.nama_unit,
                        sr.ruang_lingkup,
                        f.standar_ruang_lingkup_id as id_standard,
                        sr.parameter_ruang_lingkup
                    FROM
                        standar_ruang_lingkups sr 
                        LEFT JOIN unit_audits ua ON sr.unit = ua.id
                        LEFT JOIN feedbacks f ON sr.unit = f.standar_ruang_lingkup_id
                    "
            )
        );
        // print_r($result);die;
        

        return view('auditee.dashboard', array("table" => $result));
    }

    public function loadpenilaian(Request $request){


        $data = $request->validate([
            'id'      => 'required',
        ]);

        $result = DB::select(
            DB::raw(
                "SELECT * FROM evaluasi WHERE standar_ruang_lingkup_id = ".$data['id']
            )
        );

        return response()->json($result);
    }

    public function savefeedback(Request $request){
        $data = $request->validate([
            'standar_ruang_lingkup_id'    => 'required',
            'komentar'                    => 'required',
            'tindak_lanjut'               => 'required',
            'tanggal_kesanggupan'         => 'required'
        ]);

        // print_r($data);die;

        $feedback = Feedback::create($data);
        // print_r($data);die;

        return redirect()->route('auditee.dashboard')->with('success', 'Berhasil tambah data');

        // return
    }

    public function loadfeedback(Request $request){


        $data = $request->validate([
            'id'      => 'required',
        ]);

        $result = DB::select(
            DB::raw(
                "SELECT * FROM feedbacks WHERE standar_ruang_lingkup_id = ".$data['id']
            )
        );

        return response()->json($result);
    }

    public function profile()
    {
        return view('auditee.profile.profile');
    }

    public function feedbackTemuan()
    {
        return view('auditee.feedback.feedbackTemuan');
    }

    public function feedbackTindakLanjut()
    {
        return view('auditee.feedback.tindakLanjut');
    }

    public function grade()
    {
        $filter = Carbon::now()->format('Y');
        $uid = \Auth::id();
        $standart = Standart::with(['responses' => function($q) use($uid) {
            // Query the name field in status table
            $q->where('user_id', '=', $uid)->whereYear('created_at','=', Carbon::now()->format('Y'));
        }])
            ->whereYear('created_at', date('Y'))->get();

        $i = Carbon::now();

        $check = DataPendahuluan::whereYear('created_at', '<=', $i)->get();

        return view('auditee.grade.grade',compact('standart','check', 'filter'));
    }

    public function filterGrade(Request $request)
    {
        $filter=$request['filter'];

        $uid = \Auth::id();

        $standart = Standart::with(['responses' => function($q) use($uid, $filter) {
            // Query the name field in status table
            $q->where('user_id', '=', $uid)->whereYear('created_at','=', $filter);
        }])
            ->whereYear('created_at', date('Y'))->get();

        $i = Carbon::now();
        $check = DataPendahuluan::whereYear('created_at', '<=', $i)->get();

//        dd($standart);

        return view('auditee.grade.grade',compact('standart', 'filter', 'check'));
    }

    public function auditeeGrade($id, $year)
    {

        $uid = \Auth::id();

        $gradeAuditee = GradeStoring::where('standart_id', '=', $id)
            ->whereYear('created_at','=', $year)
            ->where('type', '=', 'Auditee')
            ->where('auditee_id', '=', $uid)
            ->pluck('grade');

        $gradeAuditor = GradeStoring::where('standart_id', '=', $id)
            ->whereYear('created_at','=', $year)
            ->where('type', '=', 'Auditor')
            ->where('auditee_id', '=', $uid)
            ->pluck('grade');

        $dataAuditee = Response::where('standart_id', '=', $id )
            ->whereYear('created_at','=', $year)
            ->where('user_id', '=', $uid)
            ->get();

        $dataAuditor = Grade::where('standart_id', '=', $id )
            ->whereYear('created_at','=', $year)
            ->where('user_id', '=', $uid)
            ->get();

        $auditAuditor = \DB::table('grades')
            ->join('users', 'grades.auditor_id', '=' , 'users.id')
            ->where('grades.standart_id', '=', $id )
            ->whereYear('grades.created_at','=', $year)
            ->where('grades.user_id', '=', $uid)
            ->select('users.name','grades.description')
            ->groupBy('grades.auditor_id')
            ->get();

        $standartsAuditee = Standart::where('id', '=', $id)->get();
        $standartsAuditor = Standart::where('id', '=', $id)->get();

        return view('auditee.grade.gradeAuditee', compact('gradeAuditee','gradeAuditor','dataAuditee','dataAuditor','standartsAuditee','standartsAuditor','auditAuditor'));
    }


    public function filter(Request $request)
    {
        $filter=$request['filter'];

        $uid = \Auth::id();

        $standart = Standart::with(['responses' => function($q) use($uid,$filter) {
            // Query the name field in status table
            $q->where('user_id', '=', $uid)->whereYear('created_at','=', $filter);
        }])->get();

        $check = DataPendahuluan::whereYear('created_at','=', Carbon::now()->format('Y'))
            ->where('user_id','=', $uid)
            ->get();

//        dd($filter);

        return view('auditee.dashboard', compact('standart', 'check', 'filter'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
        ]);

        $data['prodi'] = ucwords($data['prodi']) ;
        $data['updated_at'] = Carbon::now() ;

//        dd($data);

        $update = \DB::table('users')
            ->where('id', '=',$id)
            ->update($data);

//        dd($update);

        if(!is_null($update)) {
            return redirect()->route('auditee.profile')->with('success', 'Berhasil tambah data');
        }
        else {
            return back()->with("error", "Proses Gagal");
        }

    }

    public function insert_dataPendahuluan(Request $request, $id)
    {
        $data = $request->validate([
            'kepala_prodi' => 'regex:/^[a-zA-Z ]+$/|required',
            'name' => 'regex:/^[a-zA-Z ]+$/|required',
            'dosen_aktif' => 'integer|required',
            'mahasiswa_aktif' => 'integer|required',
            'total_penelitian' => 'integer|required',
            'total_pengabdian' => 'integer|required',
            'jumlah_kerjasama' => 'integer|required',
        ]);

        $data['user_id'] = Auth()->id() ;
        $data['kepala_prodi'] = ucwords($request['kepala_prodi']) ;
        $data['name'] = ucwords($request['name']) ;
        $data['created_at'] = Carbon::now() ;

//        dd($data);

        $status = DataPendahuluan::create($data);

        if(!is_null($status)) {
            return redirect()->route('auditee.dashboard')->with('success', 'Berhasil tambah data');
        }
        else {
            return back()->with("error", "Proses Gagal");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
