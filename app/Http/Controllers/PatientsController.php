<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 19/05/19
 * Time: 12:59
 */

namespace App\Http\Controllers;


use App\Base\Controller;
use App\Helpers\CreateActionsButtonsHelper;
use App\Http\Requests\PatientRequest;
use App\Repositories\PatientsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class PatientsController extends Controller
{
    private $patientsRepo;

    public function __construct()
    {
        $this->patientsRepo = new PatientsRepository();
    }

    public function index()
    {
        return view('patients.index');
    }

    public function dataTable()
    {
        return DataTables::collection(
            $this->patientsRepo->all()
        )->addColumn('actions', function ($row) {
            return CreateActionsButtonsHelper::makeButtons($row->id, 'patients.edit');
        })->editColumn('appointments', function($row) {
            return '<a class="btn btn-success btn-xs"
                            title="Consultas"
                            href="' . route('appointments.list', ['type' => 'patient', 'id' => $row->id]) . '">
                            <i class="fa fa-edit"></i>
                        </a>';
        })->editColumn('birth_date', function ($row) {
            return Carbon::createFromFormat('Y-m-d', $row->birth_date)->format('d/m/Y');
        })->rawColumns(['actions', 'appointments'])
            ->toJson();
    }

    public function create(Request $request)
    {
        return view('patients.create');
    }

    public function store(PatientRequest $request)
    {
        $data = $request->only(
            [
                'name',
                'birth_date',
                'phone'
            ]
        );

        DB::beginTransaction();

        try {

            $this->patientsRepo->create($data);

            DB::commit();

            flash('Pacient cadastrado')->success();

        } catch (\Exception $e) {
            DB::rollBack();

            flash('Erro ao cadastrar paciente')->warning()->important();
        }

        return redirect()->route('patients.index');
    }

    public function edit(Request $request, $id)
    {
        $patient = $this->patientsRepo->findOrFail($id);

        return view('patients.edit', compact('patient'));
    }

    public function update(PatientRequest $request, $id)
    {
        $data = $request->only(
            'name',
            'birth_date',
            'phone'
        );

        DB::beginTransaction();

        try {

            $this->patientsRepo->update($id, $data);

            DB::commit();

            flash('Paciente atualizado')->success();

        } catch (\Exception $e) {
            DB::rollBack();

            flash('Erro ao atualizar paciente')->warning()->important();
        }

        return redirect()->route('patients.index');
    }

    public function delete(Request $request, $id)
    {
        $response = 'ok';

        DB::beginTransaction();

        try{
            $this->patientsRepo->delete($id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            $response = 'fail';
        }

        return response()->json($response);
    }
}