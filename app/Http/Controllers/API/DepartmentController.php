<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    // define middleware
    public function __construct()
    {
        $this->middleware('can:department-list', ['only' => ['index', 'search']]);
        $this->middleware('can:department-create', ['only' => ['create']]);
        $this->middleware('can:department-edit', ['only' => ['update']]);
        $this->middleware('can:department-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return DepartmentResource::collection(Department::latest()->paginate($request->perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:departments',
            'note' => 'nullable|string|max:255',
        ]);
        // save department
        $department =  Department::create([
            'name' => $request->name,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        // add activity log
        activity()
            ->causedBy(Auth::user())
            ->performedOn($department)
            ->withProperties([
                'name' => "",
                'code' => '[' . $request->name . ']',
                'event' => 'Create',
                'slug' => $department->slug,
                'routeName' => ''
            ])
            ->useLog('Employee Department Created')
            ->log('Employee Department Created');

        return $this->responseWithSuccess('Department added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $department = Department::where('slug', $slug)->first();

            return $department;
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $department = Department::where('slug', $slug)->first();
        // validate request
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:departments,name,' . $department->id,
            'note' => 'nullable|string|max:255',
        ]);

        try {
            // update department
            $department->update([
                'name' => $request->name,
                'note' => $request->note,
                'status' => $request->status,
            ]);

            // add activity log
            activity()
                ->causedBy(Auth::user())
                ->performedOn($department)
                ->withProperties([
                    'name' => "",
                    'code' => '[' . $request->name . ']',
                    'event' => 'Update',
                    'slug' => $department->slug,
                    'routeName' => ''
                ])
                ->useLog('Employee Department Updated')
                ->log('Employee Department Updated');

            return $this->responseWithSuccess('Department updated successfully');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $department = Department::where('slug', $slug)->first();

            // add activity log
            activity()
                ->causedBy(Auth::user())
                ->performedOn($department)
                ->withProperties([
                    'name' => "",
                    'code' => '[' . $department->name . ']',
                    'event' => 'Delete'
                ])
                ->useLog('Employee Department Deleted')
                ->log('Employee Department Deleted');

            $department->delete();

            return $this->responseWithSuccess('Department deleted successfully');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * search resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $term = $request->term;
        $filterType = $request->filterType;
        $query = Department::query();

        // Apply status filter first
        if ($filterType === 'active') {
            $query->where('status', 1);
        } elseif ($filterType === 'inactive') {
            $query->where('status', 0);
        }

        // Apply search term filter
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('note', 'LIKE', '%' . $term . '%');
            });
        }

        $results = $query->latest()->paginate($request->perPage);

        return DepartmentResource::collection($results);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allDepartments()
    {
        $assetTypes = Department::where('status', 1)->latest()->get();

        return DepartmentResource::collection($assetTypes);
    }
}
