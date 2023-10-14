<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;

  /**
 * @OA\Schema(
 *     schema="Admin",
 *     title="Admin title",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="firstname", type="string"),
 *				@OA\Property(property="lastname", type="string"),
 *				@OA\Property(property="password", type="string"),
 *				@OA\Property(property="email", type="string"),
 *				@OA\Property(property="created_at", type="string", format="date-time"),
 *				@OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */

class AdminController extends Controller
{
    /**
 *@OA\Get(
 *      path="/api/v1/admin",
 *      security={{"api":{}}},
 *      operationId="admin_index",
 *      summary="Get all Admins",
 *      description="Retrieve all Admins",
 *      tags={"Admin API CRUD"},
 *      @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Admin"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function index()
    {
        $adminS = Admin::all();
        return response()->json([
            'data' => AdminResource::collection($adminS),
        ]);
    }

    /**
 * @OA\Get(
 *      path="/api/v1/admin/{id}",
 *      security={{"api":{}}},
 *      operationId="admin_show",
 *      summary="Get a single Admin by ID",
 *      description="Retrieve a single Admin by its ID",
 *      tags={"Admin API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Admin to retrieve",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(response=200,description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/Admin"),
 *     ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function show(string $id)
    {
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json([
                'message' => "Admin not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new AdminResource($admin),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/admin",
 *      security={{"api":{}}},
 *      operationId="admin_store",
 *      summary="Create a new Admin",
 *      description="Add a new Admin",
 *      tags={"Admin API CRUD"},
 *      @OA\RequestBody(required=true, description="Admin save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"firstname", "lastname", "password", "email"},
 *                  @OA\Property(property="firstname", type="string", example=""),
 *					@OA\Property(property="lastname", type="string", example=""),
 *					@OA\Property(property="password", type="string", example=""),
 *					@OA\Property(property="email", type="string", example="")
 *              )
 *          )
 *      ),
 *       @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Admin"),
 *      ),
 *       @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function store(Request $request)
    {
        $rules = array (
  'firstname' => 'required|string|max:255',
  'lastname' => 'required|string|max:255',
  'password' => 'required|string|max:255',
  'email' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $admin = new Admin();
        $admin->firstname = $request->firstname;
		$admin->lastname = $request->lastname;
		$admin->password = $request->password;
		$admin->email = $request->email;
        $admin->save();
        return response()->json([
            'data' => new AdminResource($admin),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/admin/{id}",
 *      security={{"api":{}}},
 *      operationId="admin_update",
 *      summary="Update a Admin by ID",
 *      description="Update a specific Admin by its ID",
 *      tags={"Admin API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Admin to update",
 *          @OA\Schema(type="integer")
 *      ),
 *           @OA\RequestBody(required=true, description="Admin save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"firstname", "lastname", "email"},
 *                  @OA\Property(property="firstname", type="string", example=""),
 *					@OA\Property(property="lastname", type="string", example=""),
 *					@OA\Property(property="email", type="string", example=""),
 *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
 *              )
 *          )
 *      ),
 *
 *     @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Admin"),
 *      ),
 *     @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function update(Request $request, string $id)
    {
        $rules = array (
  'firstname' => 'required|string|max:255',
  'lastname' => 'required|string|max:255',
  'email' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $admin->firstname = $request->firstname;
		$admin->lastname = $request->lastname;
		$admin->email = $request->email;
        return response()->json([
            'data' => new AdminResource($admin),
            'code' => 200
        ]);
    }

    /**
 * @OA\Delete(
 *      path="/api/v1/admin/{id}",
 *      security={{"api":{}}},
 *      operationId="admin_delete",
 *      summary="Delete a Admin by ID",
 *      description="Remove a specific Admin by its ID",
 *      tags={"Admin API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Admin to delete",
 *          @OA\Schema(type="integer")
 *      ),
 *          @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Admin"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json([
                'message' => "Admin not found",
                'code' => 404,
            ]);
        }
        $admin->delete();
        return response()->json([
            'data' => new AdminResource($admin),
            'code' => 200
        ]);
    }
}
