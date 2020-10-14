<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.admin.system.role');
    }

    public function table(Request $request)
    {
        $form = [
            'search' => $request->form['search'] ?? null,
            'column' => $request->form['column'] ?? null,
        ];

        return datatables()
            ->eloquent(Role::query())
            ->filter(function ($q) use ($form) {
                $columns = [
                    1 => 'id',
                    2 => 'name',
                ];

                if (!is_null($form['search']) && isset($columns[$form['column']])) {
                    if (is_array($columns[$form['column']])) {
                        $q->whereHas($columns[$form['column']][0], function ($q) use ($form, $columns) {
                            if (strpos($columns[$form['column']][1], '?') != false) {
                                $q->whereRaw($columns[$form['column']][1], ['%' . $form['search'] . '%']);
                            } else {
                                $q->where($columns[$form['column']][1], 'LIKE', '%' . $form['search'] . '%');
                            }
                        });
                    } else {
                        if (strpos($columns[$form['column']], '?') != false) {
                            $q->whereRaw($columns[$form['column']], '%' . $form['search'] . '%');
                        } else {
                            $q->where($columns[$form['column']], 'LIKE', '%' . $form['search'] . '%');
                        }
                    }
                }
            })
            ->addColumn('btn', function ($role) {
                if ($role->name == 'Super Admin') {
                    return null;
                }

                return
                    '<button data-toggle="tooltip" title="View" type="button" class="btn btn-light btn-icon btn-view mr-2 border-dark" value="' . $role->id . '"><i class="ik ik-eye"></i></button>' .
                    '<button data-toggle="tooltip" title="Edit" type="button" class="btn btn-outline-primary btn-icon btn-edit mr-2" value="' . $role->id . '"><i class="ik ik-edit"></i></button>' .
                    '<button data-toggle="tooltip" title="Delete" type="button" class="btn btn-outline-danger btn-icon btn-delete" value="' . $role->id . '"><i class="ik ik-trash"></i></button>';
            })
            ->rawColumns(['btn'])
            ->toJson();
    }
}
