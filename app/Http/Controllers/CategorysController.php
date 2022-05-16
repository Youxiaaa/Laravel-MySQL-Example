<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorys;

class CategorysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $select = [
            'id',
            'category_name',
            'category_link'
        ];
        $categorysM = new Categorys();
        $categoryData = $categorysM->SELECT($select)
                                   ->GET();

        return response([
            'success' => true,
            'message' => '取得category成功',
            'category' => collect($categoryData)
        ], 200);
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
        $form = $request->all();
        $categorysM = new Categorys();
        $categorysM->category_name = $form['category_name'];
        $categorysM->category_link = $form['category_link'];
        $categorysM->created_at = now();
        $categorysM->updated_at = now();
        $categorysM->save();

        return response([
            'success' => true,
            'message' => '新增資料成功'
        ], 201);
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
        $form = $request->all();
        $categorysM = new Categorys();

        if (empty($categorysM->WHERE('id', $id)
                             ->FIRST()))
        {
            return response([
                'success' => false,
                'message' => '資料修改失敗'
            ], 400);
        } else {
            $changeItem = $categorysM->WHERE('id', $id)
                                     ->FIRST();
            $changeItem->category_name = $form['category_name'];
            $changeItem->category_link = $form['category_link'];
            $changeItem->updated_at = now();
            $changeItem->save();

            return response([
                'success' => true,
                'message' => '資料修改成功'
            ], 200);
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
        $categorysM = new Categorys();

        if (empty($categorysM->WHERE('id', $id)
                             ->FIRST()))
        {
            return response([
                'success' => false,
                'message' => '資料刪除失敗'
            ], 400);
        } else {
            $categorysM->WHERE('id', $id)
                       ->DELETE();
            return response([
                'success' => true,
                'message' => '資料刪除成功'
            ], 200);
        }
    }
}
