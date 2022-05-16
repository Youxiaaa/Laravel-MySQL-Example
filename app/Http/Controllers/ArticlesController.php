<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticlesController extends Controller
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
            'first_title',
            'first_content',
            'image_url',
            'article_tag',
            'second_title',
            'second_content',
            'clent',
            'status'
        ];
        $articlesM = new Articles();
        $articlesData = $articlesM->SELECT($select)
                                  ->GET();
        return response([
            'success' => true,
            'message' => '取得Article成功',
            'article' => collect($articlesData)
        ],200);
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
        $articlesM = new Articles();
        $articlesM->first_title = $form['first_title'];
        $articlesM->first_content = $form['first_content'];
        $articlesM->image_url = $form['image_url'];
        $articlesM->article_tag = $form['article_tag'];
        $articlesM->second_title = $form['second_title'];
        $articlesM->second_content = $form['second_content'];
        $articlesM->clent = $form['clent'];
        $articlesM->status = $form['status'];
        $articlesM->created_at = now();
        $articlesM->updated_at = now();
        $articlesM->save();

        return response([
            'success' => true,
            'message' => '新增Article成功'
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
        $articlesM = new Articles();
        if (empty($articlesM->WHERE('id', $id)
                            ->FIRST()))
        {
            return response([
                'success' => false,
                'message' => '資料修改失敗'
            ], 400);
        } else {
            $changeItem = $articlesM->WHERE('id', $id)
                                    ->FIRST();
            $changeItem->first_title = $form['first_title'];
            $changeItem->first_content = $form['first_content'];
            $changeItem->image_url = $form['image_url'];
            $changeItem->article_tag = $form['article_tag'];
            $changeItem->second_title = $form['second_title'];
            $changeItem->second_content = $form['second_content'];
            $changeItem->clent = $form['clent'];
            $changeItem->status = $form['status'];
            $changeItem->updated_at = now();
            $changeItem->save();

            return response([
            'success' => true,
            'message' => '修改資料成功'
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
        $articlesM = new Articles();
        if (empty($articlesM->WHERE('id', $id)
                            ->FIRST()))
        {
            return response([
                'success' => false,
                'message' => '資料刪除失敗'
            ], 400);
        } else {
            $articlesM->WHERE('id', $id)
                      ->DELETE();
            return response([
                'success' => true,
                'message' => '資料刪除成功'
            ], 200);
        }
    }
}
