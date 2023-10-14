<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use App\Http\Resources\SymptomResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;

  /**
 * @OA\Schema(
 *     schema="Symptom",
 *     title="Symptom title",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="name", type="string"),
 *				@OA\Property(property="created_at", type="string", format="date-time"),
 *				@OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */

class SymptomController extends Controller
{
    /**
 *@OA\Get(
 *      path="/api/v1/symptom",
 *      security={{"api":{}}},
 *      operationId="symptom_index",
 *      summary="Get all Symptoms",
 *      description="Retrieve all Symptoms",
 *      tags={"Symptom API CRUD"},
 *      @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Symptom"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function index()
    {
        $symptomS = Symptom::all();
        return response()->json([
            'data' => SymptomResource::collection($symptomS),
        ]);
    }

    /**
 * @OA\Get(
 *      path="/api/v1/symptom/{id}",
 *      security={{"api":{}}},
 *      operationId="symptom_show",
 *      summary="Get a single Symptom by ID",
 *      description="Retrieve a single Symptom by its ID",
 *      tags={"Symptom API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Symptom to retrieve",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(response=200,description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/Symptom"),
 *     ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function show(string $id)
    {
        $symptom = Symptom::find($id);
        if(!$symptom){
            return response()->json([
                'message' => "Symptom not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new SymptomResource($symptom),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/symptom",
 *      security={{"api":{}}},
 *      operationId="symptom_store",
 *      summary="Create a new Symptom",
 *      description="Add a new Symptom",
 *      tags={"Symptom API CRUD"},
 *      @OA\RequestBody(required=true, description="Symptom save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"name"},
 *                  @OA\Property(property="name", type="string", example="")
 *              )
 *          )
 *      ),
 *       @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Symptom"),
 *      ),
 *       @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function store(Request $request)
    {
        $rules = array (
  'name' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $symptom = new Symptom();
        $symptom->name = $request->name;
        $symptom->save();
        return response()->json([
            'data' => new SymptomResource($symptom),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/symptom/{id}",
 *      security={{"api":{}}},
 *      operationId="symptom_update",
 *      summary="Update a Symptom by ID",
 *      description="Update a specific Symptom by its ID",
 *      tags={"Symptom API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Symptom to update",
 *          @OA\Schema(type="integer")
 *      ),
 *           @OA\RequestBody(required=true, description="Symptom save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"name"},
 *                  @OA\Property(property="name", type="string", example=""),
 *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
 *              )
 *          )
 *      ),
 *
 *     @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Symptom"),
 *      ),
 *     @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function update(Request $request, string $id)
    {
        $rules = array (
  'name' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $symptom = Symptom::find($id);
        if(!$symptom){
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $symptom->name = $request->name;
        return response()->json([
            'data' => new SymptomResource($symptom),
            'code' => 200
        ]);
    }

    /**
 * @OA\Delete(
 *      path="/api/v1/symptom/{id}",
 *      security={{"api":{}}},
 *      operationId="symptom_delete",
 *      summary="Delete a Symptom by ID",
 *      description="Remove a specific Symptom by its ID",
 *      tags={"Symptom API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Symptom to delete",
 *          @OA\Schema(type="integer")
 *      ),
 *          @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Symptom"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function destroy(string $id)
    {
        $symptom = Symptom::find($id);
        if(!$symptom){
            return response()->json([
                'message' => "Symptom not found",
                'code' => 404,
            ]);
        }
        $symptom->delete();
        return response()->json([
            'data' => new SymptomResource($symptom),
            'code' => 200
        ]);
    }
}
//TODO Create_disease_symptoms_table
