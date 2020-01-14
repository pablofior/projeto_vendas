<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/05/19
 * Time: 15:13
 */

namespace App\Http\Controllers;


use App\Base\Controller;
use App\Helpers\CreateActionsButtonsHelper;
use App\Http\Requests\DoctorRequest;
use App\Repositories\DoctorsRepository;
use App\Repositories\StatesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DoctorsController extends Controller
{
    private $doctorsRepo;

    public function __construct()
    {
        $this->doctorsRepo = new DoctorsRepository();
    }

    public function index()
    {
        return view('doctors.index');
    }

    public function dataTable()
    {
        return DataTables::collection(
            $this->doctorsRepo->all()
        )->addColumn('actions', function ($row) {
            return CreateActionsButtonsHelper::makeButtons($row->id, 'doctors.edit');
        })->editColumn('appointments', function($row) {
            return '<a class="btn btn-success btn-xs"
                            title="Consultas"
                            href="' . route('appointments.list', ['type' => 'doctor', 'id' => $row->id]) . '">
                            <i class="fa fa-edit"></i>
                        </a>';
        })->rawColumns(['actions', 'appointments'])
        ->toJson();
    }

    public function create(Request $request)
    {
        return view('doctors.create');
    }

    public function store(DoctorRequest $request)
    {
        $data = $request->only(
            [
                'name',
                'specialty',
                'crm',
            ]
        );

        if($this->doctorsRepo->findBy('crm', $data['crm'])->exists())
        {
            flash('CRM já cadastrado')->warning()->important();
        } else {
            DB::beginTransaction();

            try {

                $this->doctorsRepo->create($data);

                DB::commit();

                flash('Médico cadastrado')->success();

            } catch (\Exception $e) {
                DB::rollBack();

                flash('Erro ao cadastrar médico')->warning()->important();
            }
        }

        return redirect()->route('doctors.index');
    }

    public function edit(Request $request, $id)
    {
        $doctor = $this->doctorsRepo->findOrFail($id);

        return view('doctors.edit', compact('doctor'));
    }

    public function update(DoctorRequest $request, $id)
    {
        $data = $request->only(
            'name',
            'specialty',
            'crm'
        );

        DB::beginTransaction();

        try {

            $this->doctorsRepo->update($id, $data);

            DB::commit();

            flash('Médico atualizado')->success();

        } catch (\Exception $e) {
            DB::rollBack();

            flash('Erro ao atualizar médico')->warning()->important();
        }

        return redirect()->route('doctors.index');
    }

    public function delete(Request $request, $id)
    {
        $response = 'ok';

        DB::beginTransaction();

        try{
            $this->doctorsRepo->delete($id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            $response = 'fail';
        }

        return response()->json($response);
    }
}