<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 02/07/19
 * Time: 16:38
 */

namespace App\Http\Controllers;

use App\Base\Controller;
use App\Helpers\CreateActionsButtonsHelper;
use App\Repositories\UsersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    private $_usersRepo;

    /**
     * UserController __construct
     */
    public function __construct()
    {
        $this->_usersRepo = new UsersRepository();
    }

    /**
     * Index
     *
     * @return View
     */
    public function index()
    {
        $users = $this->_usersRepo->count();

        if ($users < 1) {
            flash('Nenhum usuário cadastrado')->warning();
        }

        return view('users.index');
    }

    /**
     * Datatable creation
     *
     * @return DataTables
     */
    public function dataTable()
    {

        return DataTables::of(
            $this->_usersRepo->all()
        )->addColumn(
            'actions',
            function ($row) {
                return CreateActionsButtonsHelper::makeButtons(
                    $row->id,
                    'users.edit'
                );
            }
        )->editColumn(
            'created_at',
            function ($row) {
                return date_format($row->created_at, 'd/m/Y H:i');
            }
        )->rawColumns(['actions'])
        ->toJson();
    }

    /**
     * User create
     *
     * @param Request $request Incoming request
     *
     * @return View
     */
    public function create(Request $request)
    {
        return view('users.create');
    }

    /**
     * User store
     *
     * @param Request $request Incoming request
     *
     * @return View
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'string', 'confirmed']
            ]
        );

        DB::beginTransaction();

        try {
            $this->_usersRepo->create($data);

            DB::commit();

            flash('Usuário criado')->success();

        } catch (\Exception $e) {
            flash('Usuário não pode ser criado')->warning()->important();

            DB::rollBack();
        }

        return redirect()->route('users.index');
    }

    /**
     * User edit
     *
     * @param Request $request Incoming request
     * @param int     $id      User id
     *
     * @return View
     */
    public function edit(Request $request, int $id)
    {
        $user = $this->_usersRepo->find($id);

        return view(
            'users.edit',
            compact('user')
        );
    }

    /**
     * User update
     *
     * @param Request $request Incoming request
     * @param int     $id      User id
     *
     * @return View
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate(
            [
                'name' => ['filled', 'string'],
                'email' => ['filled'],
                'password' => ['filled', 'string', 'confirmed']
            ]
        );

        DB::beginTransaction();

        try {

            $this->_usersRepo->update($id, $data);

            DB::commit();

            flash('Usuário atualizado');

        } catch (\Exception $e) {
            DB::rollBack();

            flash('Não foi possível atualizar o usuário');
        }

        return redirect()->route('users.index');
    }

    /**
     * User delete
     *
     * @param int $id User id
     *
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $response = null;

        DB::beginTransaction();

        try {
            $this->_usersRepo->delete($id);

            DB::commit();

            $response = 'ok';
        } catch (\Exception $e) {
            DB::rollBack();

            $response = 'fail';
        }

        return response()->json($response);
    }
}
