<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage category')) {
            $category = Category::orderBy('id', 'desc')->get();

            return view('category.index', compact('category'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create category')) {
            $validator = \Validator::make(
                $request->all(), [
                'name' => 'required'
            ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $category = new Category();
            $category->name = $request->name;
            $category->type = $request->type;
            $category->save();

            return redirect()->back()->with('success', __('Category successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        if (\Auth::user()->can('edit category')) {
            $category = Category::find($id);
            return view('category.edit', compact('category'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit category')) {
            $validator = \Validator::make(
                $request->all(), [
                'name' => 'required'
            ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $category = Category::find($id);
            $category->name = $request->name;
            $category->type = $request->type;
            $category->save();

            return redirect()->back()->with('success', __('Category successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('delete category')) {
            $category = Category::find($id);
            $category->delete();

            return redirect()->back()->with('success', 'Category successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
