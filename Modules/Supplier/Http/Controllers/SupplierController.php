<?php

namespace Modules\Supplier\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\ResponseRepository;
use Modules\Supplier\Entities\Supplier;
use Modules\Supplier\Repositories\SupplierRepository;

class SupplierController extends Controller
{

    public $supplierRepository;
    public $responseRepository;

    public function __construct(SupplierRepository $supplierRepository, ResponseRepository $responseRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->responseRepository = $responseRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('supplier::index');
        return 'farid';
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('supplier::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    /**
     * @OA\POST(
     *     path="/api/v1/supplier/store",
     *     tags={"Supplier"},
     *     summary="Create New Supplier",
     *     description="Create New Cusotmer",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="business_id", type="integer"),
     *             @OA\Property(property="supplier_business_name", type="string"),
     *              @OA\Property(property="bin", type="string"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="tax_number", type="string"),
     *              @OA\Property(property="state", type="string"),
     *              @OA\Property(property="country", type="string"),
     *              @OA\Property(property="landmark", type="string"),
     *              @OA\Property(property="mobile", type="string"),
     *              @OA\Property(property="landline", type="string"),
     *              @OA\Property(property="alternate_number", type="string"),
     *              @OA\Property(property="pay_term_number", type="integer"),
     *              @OA\Property(property="pay_term_type", type="string"),
     *          )
     *      ),
     *     operationId="store",
     *      @OA\Response( response=200, description="Create New Supplier" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(Request $request)
    {
        try {
            $supplier = $this->supplierRepository->store($request);
            return $this->responseRepository->ResponseSuccess($supplier, 'Supplier created successfully');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    /**
     * @OA\GET(
     *     path="/api/v1/supplier/show",
     *     tags={"Supplier"},
     *     summary="Get Supplier",
     *     description="Get Supplier",
     *     security={{"bearer": {}}},
     *     operationId="show",
     *      @OA\Response( response=200, description="Get Supplier" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show(Request $request, $id)
    {
        try {
            $user = $request->user();
            return $this->responseRepository->ResponseSuccess($user, 'Supplier  Details');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, trans('common.something_wrong'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('supplier::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    /**
     * @OA\PUT(
     *     path="/api/v1/supplier/update",
     *     tags={"Supplier"},
     *     summary="Update Supplier",
     *     description="Update Supplier",
     *     security={{"bearer": {}}},
     *     @OA\Parameter( name="intCusID", description="intCusID, eg; 1", required=true, in="query", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="business_id", type="integer"),
     *             @OA\Property(property="supplier_business_name", type="string"),
     *              @OA\Property(property="bin", type="string"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="tax_number", type="string"),
     *              @OA\Property(property="state", type="string"),
     *              @OA\Property(property="country", type="string"),
     *              @OA\Property(property="landmark", type="string"),
     *              @OA\Property(property="mobile", type="string"),
     *              @OA\Property(property="landline", type="string"),
     *              @OA\Property(property="alternate_number", type="string"),
     *              @OA\Property(property="pay_term_number", type="integer"),
     *              @OA\Property(property="pay_term_type", type="string"),
     *          )
     *      ),
     *     operationId="updateMasterAccount",
     *      @OA\Response( response=200, description="Update New Supplier" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $request->user();
            $supplier = $this->supplierRepository->update($request, $user->id);
            return $this->responseRepository->ResponseSuccess($supplier, 'Supplier has been updated successfully');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, trans('common.something_wrong'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    /**
     * @OA\DELETE(
     *     path="/api/v1/supplier/destroy",
     *     tags={"Supplier"},
     *     summary="Delete Supplier",
     *     description="Delete Account",
     *     security={{"bearer": {}}},
     *     operationId="deleteSupplierAccount",
     *      @OA\Response( response=200, description="Deleted Supplier Account" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy(Request $request)
    {
        try {
            $user = $request->user();
            $supplier = $this->supplierRepository->delete($user->id);
            if (is_null($supplier)) {
                return $this->responseRepository->ResponseError(null, 'Supplier Not found', Response::HTTP_NOT_FOUND);
            }
            return $this->responseRepository->ResponseSuccess($supplier, 'Supplier deleted successfully');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}