<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;

class BannersController extends Controller
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
            'image_url',
            'banner_title',
            'banner_content',
            'copyright_content'
        ];
        $bannersM = new Banners();
        $bannersData = $bannersM->SELECT($select)
                                ->GET();
        return response([
            'success' => true,
            'message' => '取得Banner成功',
            'banners' => collect($bannersData)
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
        $bannersM = new Banners();

        $bannersM->image_url = $form['image_url'];
        $bannersM->banner_title = $form['banner_title'];
        $bannersM->banner_content = $form['banner_content'];
        $bannersM->copyright_content = $form['copyright_content'];
        $bannersM->created_at = now();
        $bannersM->updated_at = now();
        $bannersM->save();

        return response([
            'success' => true,
            'message' => '新增 banner 成功'
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
        $bannersM = new Banners();

        $changeItem = $bannersM->WHERE('id', $id)
                               ->FIRST();
        $changeItem->image_url = $form['image_url'];
        $changeItem->banner_title = $form['banner_title'];
        $changeItem->banner_content = $form['banner_content'];
        $changeItem->copyright_content = $form['copyright_content'];
        $changeItem->updated_at = now();
        $changeItem->save();

        return response([
            'success' => true,
            'message' => '修改資料成功'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bannersM = new Banners();

        if (empty($bannersM->WHERE('id', $id)
                      ->FIRST()))
        {
            return response([
                'success' => false,
                'message' => '刪除資料失敗'
            ], 400);
        } else {
            $bannersM->WHERE('id', $id)
            ->DELETE();

            return response([
                'success' => true,
                'message' => '刪除資料成功'
            ], 200);
        }
    }
}
