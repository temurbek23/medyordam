<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Http\Resources\ProfessionResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Schema(
 *     schema="Profession",
 *     title="Profession title",
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

class ProfessionController extends Controller
{
    /**
     *@OA\Get(
     *      path="/api/v1/profession",
     *      security={{"api":{}}},
     *      operationId="profession_index",
     *      summary="Get all Professions",
     *      description="Retrieve all Professions",
     *      tags={"Profession API CRUD"},
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Profession"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function index()
    {
        $professionS = Profession::all();
        return response()->json([
            'data' => ProfessionResource::collection($professionS),
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/profession/{id}",
     *      security={{"api":{}}},
     *      operationId="profession_show",
     *      summary="Get a single Profession by ID",
     *      description="Retrieve a single Profession by its ID",
     *      tags={"Profession API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Profession to retrieve",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Profession"),
     *     ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function show(string $id)
    {
        $profession = Profession::find($id);
        if (!$profession) {
            return response()->json([
                'message' => "Profession not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new ProfessionResource($profession),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/profession",
     *      security={{"api":{}}},
     *      operationId="profession_store",
     *      summary="Create a new Profession",
     *      description="Add a new Profession",
     *      tags={"Profession API CRUD"},
     *      @OA\RequestBody(required=true, description="Profession save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"name"},
     *                  @OA\Property(property="name", type="string", example="")
     *              )
     *          )
     *      ),
     *       @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Profession"),
     *      ),
     *       @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255|unique:professions,name',
        );

        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $profession = new Profession();
        $profession->name = $request->name;
        $profession->save();
        return response()->json([
            'data' => new ProfessionResource($profession),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/profession/{id}",
     *      security={{"api":{}}},
     *      operationId="profession_update",
     *      summary="Update a Profession by ID",
     *      description="Update a specific Profession by its ID",
     *      tags={"Profession API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Profession to update",
     *          @OA\Schema(type="integer")
     *      ),
     *           @OA\RequestBody(required=true, description="Profession save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"name"},
     *                  @OA\Property(property="name", type="string", example=""),
     *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Profession"),
     *      ),
     *     @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function update(Request $request, string $id)
    {
        $rules = array(
            'name' => 'required|string|max:255|unique:professions,name,' . $id,
        );
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $profession = Profession::find($id);
        if (!$profession) {
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $profession->name = $request->name;
        return response()->json([
            'data' => new ProfessionResource($profession),
            'code' => 200
        ]);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/profession/{id}",
     *      security={{"api":{}}},
     *      operationId="profession_delete",
     *      summary="Delete a Profession by ID",
     *      description="Remove a specific Profession by its ID",
     *      tags={"Profession API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Profession to delete",
     *          @OA\Schema(type="integer")
     *      ),
     *          @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Profession"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function destroy(string $id)
    {
        $profession = Profession::find($id);
        if (!$profession) {
            return response()->json([
                'message' => "Profession not found",
                'code' => 404,
            ]);
        }
        $profession->delete();
        return response()->json([
            'data' => new ProfessionResource($profession),
            'code' => 200
        ]);
    }
}
