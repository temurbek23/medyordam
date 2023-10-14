<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\FirstAid;
use App\Http\Resources\FirstAidResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;

  /**
 * @OA\Schema(
 *     schema="FirstAid",
 *     title="FirstAid title",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="case", type="string"),
 *				@OA\Property(property="photo", type="file"),
 *				@OA\Property(property="treatment", type="string"),
 *				@OA\Property(property="created_at", type="string", format="date-time"),
 *				@OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */

class FirstAidController extends Controller
{
    /**
 *@OA\Get(
 *      path="/api/v1/first_aid",
 *      security={{"api":{}}},
 *      operationId="first_aid_index",
 *      summary="Get all FirstAids",
 *      description="Retrieve all FirstAids",
 *      tags={"FirstAid API CRUD"},
 *      @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/FirstAid"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function index()
    {
        $first_aidS = FirstAid::all();
        return response()->json([
            'data' => FirstAidResource::collection($first_aidS),
        ]);
    }

    /**
 * @OA\Get(
 *      path="/api/v1/first_aid/{id}",
 *      security={{"api":{}}},
 *      operationId="first_aid_show",
 *      summary="Get a single FirstAid by ID",
 *      description="Retrieve a single FirstAid by its ID",
 *      tags={"FirstAid API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the FirstAid to retrieve",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(response=200,description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/FirstAid"),
 *     ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function show(string $id)
    {
        $first_aid = FirstAid::find($id);
        if(!$first_aid){
            return response()->json([
                'message' => "FirstAid not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new FirstAidResource($first_aid),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/first_aid",
 *      security={{"api":{}}},
 *      operationId="first_aid_store",
 *      summary="Create a new FirstAid",
 *      description="Add a new FirstAid",
 *      tags={"FirstAid API CRUD"},
 *      @OA\RequestBody(required=true, description="FirstAid save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"case", "photo", "treatment"},
 *                  @OA\Property(property="case", type="string", example=""),
 *					@OA\Property(property="photo", type="file", example=""),
 *					@OA\Property(property="treatment", type="string", example="")
 *              )
 *          )
 *      ),
 *       @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/FirstAid"),
 *      ),
 *       @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function store(Request $request)
    {
        $rules = array (
  'case' => 'required|string|max:255',
  'photo' => 'required|mimes:jpg,png,webp',
  'treatment' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $first_aid = new FirstAid();
        $first_aid->case = $request->case;
		if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($first_aid->photo) {
                $oldFilePath = 'uploads/photo/'.basename($first_aid->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $first_aid->photo = asset("uploads/photo/$filename");
        }
		$first_aid->treatment = $request->treatment;
        $first_aid->save();
        return response()->json([
            'data' => new FirstAidResource($first_aid),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/first_aid/{id}",
 *      security={{"api":{}}},
 *      operationId="first_aid_update",
 *      summary="Update a FirstAid by ID",
 *      description="Update a specific FirstAid by its ID",
 *      tags={"FirstAid API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the FirstAid to update",
 *          @OA\Schema(type="integer")
 *      ),
 *           @OA\RequestBody(required=true, description="FirstAid save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"case", "photo", "treatment"},
 *                  @OA\Property(property="case", type="string", example=""),
 *					@OA\Property(property="photo", type="file", example=""),
 *					@OA\Property(property="treatment", type="string", example=""),
 *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
 *              )
 *          )
 *      ),
 *
 *     @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/FirstAid"),
 *      ),
 *     @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function update(Request $request, string $id)
    {
        $rules = array (
  'case' => 'required|string|max:255',
  'photo' => 'required|mimes:jpg,png,webp',
  'treatment' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $first_aid = FirstAid::find($id);
        if(!$first_aid){
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $first_aid->case = $request->case;
		if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($first_aid->photo) {
                $oldFilePath = 'uploads/photo/'.basename($first_aid->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $first_aid->photo = asset("uploads/photo/$filename");
        }
		$first_aid->treatment = $request->treatment;
        return response()->json([
            'data' => new FirstAidResource($first_aid),
            'code' => 200
        ]);
    }

    /**
 * @OA\Delete(
 *      path="/api/v1/first_aid/{id}",
 *      security={{"api":{}}},
 *      operationId="first_aid_delete",
 *      summary="Delete a FirstAid by ID",
 *      description="Remove a specific FirstAid by its ID",
 *      tags={"FirstAid API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the FirstAid to delete",
 *          @OA\Schema(type="integer")
 *      ),
 *          @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/FirstAid"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function destroy(string $id)
    {
        $first_aid = FirstAid::find($id);
        if(!$first_aid){
            return response()->json([
                'message' => "FirstAid not found",
                'code' => 404,
            ]);
        }
        $first_aid->delete();
        return response()->json([
            'data' => new FirstAidResource($first_aid),
            'code' => 200
        ]);
    }
}
