<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    private $product;

    public function __construct(product $product){
        // Laravel 의 IOC(Inversion of Control)
        $this->product = $product;
    }

    //제품 목록
    public function index(){
        // products 의 데이터를 최신순으로 페이징을 해서 가져옴.
        $products = $this->product->latest()->paginate(10);
        // produce/index.blade 에 $products 를 보내준다.
        return view('products.index', compact('products')); //
    }

    //제품 생성
    public function create(){
            return view('products.create');
        }

    //유효성 검사
    public function store(StoreProductRequest $request)
        {
            $validated = $request->validated();
            $this->product->create($validated);
            return redirect()->route('products.index');
        }

   // 상세 페이지
    public function show(Product $product){
    // show 에 경우는 해당 페이지의 모델 값이 파라미터로 넘어온다.
        return view('products.show', compact('product'));
    }

    //수정 페이지
    public function edit(Product $product){
            return view('products.edit', compact('product'));
        }

    //업데이트 기능
    public function update(Request $request, Product $product){
        $request = $request->validate([ //수정할 때 유효성 검사를 진행
            'name' => 'required',
            'content' => 'required'
        ]);
        // $product는 수정할 모델 값이므로 바로 업데이트 해줘야 함.
        $product->update($request);
        return redirect()->route('products.index', $product);
    }

    //삭제 기능
    public function destroy(Product $product){
           $product->delete();
           return redirect()->route('products.index');
       }
}
