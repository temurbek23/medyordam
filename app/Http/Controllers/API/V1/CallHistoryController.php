<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\CallHistory;
use App\Http\Resources\CallHistoryResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Schema(
 *     schema="CallHistory",
 *     title="CallHistory title",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="doctor_id", type="integer"),
 *				@OA\Property(property="patient_id", type="integer"),
 *				@OA\Property(property="duration", type="integer"),
 *				@OA\Property(property="created_at", type="string", format="date-time"),
 *				@OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */

class CallHistoryController extends Controller
{
    /**
 *@OA\Get(
 *      path="/api/v1/call_history",
 *      security={{"api":{}}},
 *      operationId="call_history_index",
 *      summary="Get all CallHistorys",
 *      description="Retrieve all CallHistorys",
 *      tags={"CallHistory API CRUD"},
 *      @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/CallHistory"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function index()
    {
        $call_historyS = CallHistory::all();
        return response()->json([
            'data' => CallHistoryResource::collection($call_historyS),
        ]);
    }

    /**
 * @OA\Get(
 *      path="/api/v1/call_history/{id}",
 *      security={{"api":{}}},
 *      operationId="call_history_show",
 *      summary="Get a single CallHistory by ID",
 *      description="Retrieve a single CallHistory by its ID",
 *      tags={"CallHistory API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the CallHistory to retrieve",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(response=200,description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/CallHistory"),
 *     ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function show(string $id)
    {
        $call_history = CallHistory::find($id);
        if(!$call_history){
            return response()->json([
                'message' => "CallHistory not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new CallHistoryResource($call_history),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/call_history",
 *      security={{"api":{}}},
 *      operationId="call_history_store",
 *      summary="Create a new CallHistory",
 *      description="Add a new CallHistory",
 *      tags={"CallHistory API CRUD"},
 *      @OA\RequestBody(required=true, description="CallHistory save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"doctor_id", "patient_id", "duration"},
 *                  @OA\Property(property="doctor_id", type="integer", example=""),
 *					@OA\Property(property="patient_id", type="integer", example=""),
 *					@OA\Property(property="duration", type="integer", example="")
 *              )
 *          )
 *      ),
 *       @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/CallHistory"),
 *      ),
 *       @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function store(Request $request)
    {
        $rules = array (
  'doctor_id' => 'required|integer',
  'patient_id' => 'required|integer',
  'duration' => 'required|integer',
);
        //TODO ADD exists in table
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $call_history = new CallHistory();
        $call_history->doctor_id = $request->doctor_id;
		$call_history->patient_id = $request->patient_id;
		$call_history->duration = $request->duration;
        $call_history->save();
        return response()->json([
            'data' => new CallHistoryResource($call_history),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/call_history/{id}",
 *      security={{"api":{}}},
 *      operationId="call_history_update",
 *      summary="Update a CallHistory by ID",
 *      description="Update a specific CallHistory by its ID",
 *      tags={"CallHistory API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the CallHistory to update",
 *          @OA\Schema(type="integer")
 *      ),
 *           @OA\RequestBody(required=true, description="CallHistory save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"doctor_id", "patient_id", "duration"},
 *                  @OA\Property(property="doctor_id", type="integer", example=""),
 *					@OA\Property(property="patient_id", type="integer", example=""),
 *					@OA\Property(property="duration", type="integer", example=""),
 *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
 *              )
 *          )
 *      ),
 *
 *     @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/CallHistory"),
 *      ),
 *     @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function update(Request $request, string $id)
    {
        $rules = array (
  'doctor_id' => 'required|integer',
  'patient_id' => 'required|integer',
  'duration' => 'required|integer',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $call_history = CallHistory::find($id);
        if(!$call_history){
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $call_history->doctor_id = $request->doctor_id;
		$call_history->patient_id = $request->patient_id;
		$call_history->duration = $request->duration;
        return response()->json([
            'data' => new CallHistoryResource($call_history),
            'code' => 200
        ]);
    }

    /**
 * @OA\Delete(
 *      path="/api/v1/call_history/{id}",
 *      security={{"api":{}}},
 *      operationId="call_history_delete",
 *      summary="Delete a CallHistory by ID",
 *      description="Remove a specific CallHistory by its ID",
 *      tags={"CallHistory API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the CallHistory to delete",
 *          @OA\Schema(type="integer")
 *      ),
 *          @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/CallHistory"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function destroy(string $id)
    {
        $call_history = CallHistory::find($id);
        if(!$call_history){
            return response()->json([
                'message' => "CallHistory not found",
                'code' => 404,
            ]);
        }
        $call_history->delete();
        return response()->json([
            'data' => new CallHistoryResource($call_history),
            'code' => 200
        ]);
    }
}
