<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Http\Resources\DiseaseResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Disease",
 *     title="Disease title",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="name", type="string"),
 *				@OA\Property(property="treatment", type="string"),
 *				@OA\Property(property="created_at", type="string", format="date-time"),
 *				@OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */

class DiseaseController extends Controller
{
    /**
     *@OA\Get(
     *      path="/api/v1/disease",
     *      security={{"api":{}}},
     *      operationId="disease_index",
     *      summary="Get all Diseases",
     *      description="Retrieve all Diseases",
     *      tags={"Disease API CRUD"},
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Disease"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function index()
    {
        $diseaseS = Disease::all();
        return response()->json([
            'data' => DiseaseResource::collection($diseaseS),
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/disease/{id}",
     *      security={{"api":{}}},
     *      operationId="disease_show",
     *      summary="Get a single Disease by ID",
     *      description="Retrieve a single Disease by its ID",
     *      tags={"Disease API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Disease to retrieve",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Disease"),
     *     ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function show(string $id)
    {
        $disease = Disease::find($id);
        if (!$disease) {
            return response()->json([
                'message' => "Disease not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new DiseaseResource($disease),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/disease",
     *      security={{"api":{}}},
     *      operationId="disease_store",
     *      summary="Create a new Disease",
     *      description="Add a new Disease",
     *      tags={"Disease API CRUD"},
     *      @OA\RequestBody(required=true, description="Disease save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"name", "treatment"},
     *                  @OA\Property(property="name", type="string", example=""),
     *					@OA\Property(property="treatment", type="string", example="")
     *              )
     *          )
     *      ),
     *       @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Disease"),
     *      ),
     *       @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'treatment' => 'required|string|max:255',
        );
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $disease = new Disease();
        $disease->name = $request->name;
        $disease->treatment = $request->treatment;
        $disease->save();
        return response()->json([
            'data' => new DiseaseResource($disease),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/disease/{id}",
     *      security={{"api":{}}},
     *      operationId="disease_update",
     *      summary="Update a Disease by ID",
     *      description="Update a specific Disease by its ID",
     *      tags={"Disease API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Disease to update",
     *          @OA\Schema(type="integer")
     *      ),
     *           @OA\RequestBody(required=true, description="Disease save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"name", "treatment"},
     *                  @OA\Property(property="name", type="string", example=""),
     *					@OA\Property(property="treatment", type="string", example=""),
     *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Disease"),
     *      ),
     *     @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function update(Request $request, string $id)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'treatment' => 'required|string|max:255',
        );
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $disease = Disease::find($id);
        if (!$disease) {
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $disease->name = $request->name;
        $disease->treatment = $request->treatment;
        return response()->json([
            'data' => new DiseaseResource($disease),
            'code' => 200
        ]);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/disease/{id}",
     *      security={{"api":{}}},
     *      operationId="disease_delete",
     *      summary="Delete a Disease by ID",
     *      description="Remove a specific Disease by its ID",
     *      tags={"Disease API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Disease to delete",
     *          @OA\Schema(type="integer")
     *      ),
     *          @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Disease"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function destroy(string $id)
    {
        $disease = Disease::find($id);
        if (!$disease) {
            return response()->json([
                'message' => "Disease not found",
                'code' => 404,
            ]);
        }
        $disease->delete();
        return response()->json([
            'data' => new DiseaseResource($disease),
            'code' => 200
        ]);
    }
}
