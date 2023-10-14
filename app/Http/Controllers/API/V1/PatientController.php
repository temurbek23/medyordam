<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Http\Resources\PatientResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;

  /**
 * @OA\Schema(
 *     schema="Patient",
 *     title="Patient title",
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
 *				@OA\Property(property="contact", type="string"),
 *				@OA\Property(property="created_at", type="string", format="date-time"),
 *				@OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */

class PatientController extends Controller
{
    /**
 *@OA\Get(
 *      path="/api/v1/patient",
 *      security={{"api":{}}},
 *      operationId="patient_index",
 *      summary="Get all Patients",
 *      description="Retrieve all Patients",
 *      tags={"Patient API CRUD"},
 *      @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Patient"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function index()
    {
        $patientS = Patient::all();
        return response()->json([
            'data' => PatientResource::collection($patientS),
        ]);
    }

    /**
 * @OA\Get(
 *      path="/api/v1/patient/{id}",
 *      security={{"api":{}}},
 *      operationId="patient_show",
 *      summary="Get a single Patient by ID",
 *      description="Retrieve a single Patient by its ID",
 *      tags={"Patient API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Patient to retrieve",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(response=200,description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/Patient"),
 *     ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function show(string $id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            return response()->json([
                'message' => "Patient not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new PatientResource($patient),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/patient",
 *      security={{"api":{}}},
 *      operationId="patient_store",
 *      summary="Create a new Patient",
 *      description="Add a new Patient",
 *      tags={"Patient API CRUD"},
 *      @OA\RequestBody(required=true, description="Patient save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"firstname", "lastname", "password", "email", "contact"},
 *                  @OA\Property(property="firstname", type="string", example=""),
 *					@OA\Property(property="lastname", type="string", example=""),
 *					@OA\Property(property="password", type="string", example=""),
 *					@OA\Property(property="email", type="string", example=""),
 *					@OA\Property(property="contact", type="string", example="")
 *              )
 *          )
 *      ),
 *       @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Patient"),
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
  'contact' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $patient = new Patient();
        $patient->firstname = $request->firstname;
		$patient->lastname = $request->lastname;
		$patient->password = $request->password;
		$patient->email = $request->email;
		$patient->contact = $request->contact;
        $patient->save();
        return response()->json([
            'data' => new PatientResource($patient),
            'code' => 200
        ]);
    }

    /**
 * @OA\Post(
 *      path="/api/v1/patient/{id}",
 *      security={{"api":{}}},
 *      operationId="patient_update",
 *      summary="Update a Patient by ID",
 *      description="Update a specific Patient by its ID",
 *      tags={"Patient API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Patient to update",
 *          @OA\Schema(type="integer")
 *      ),
 *           @OA\RequestBody(required=true, description="Patient save",
 *           @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(type="object", required={"firstname", "lastname", "email", "contact"},
 *                  @OA\Property(property="firstname", type="string", example=""),
 *					@OA\Property(property="lastname", type="string", example=""),
 *					@OA\Property(property="email", type="string", example=""),
 *					@OA\Property(property="contact", type="string", example=""),
 *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
 *              )
 *          )
 *      ),
 *
 *     @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Patient"),
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
  'contact' => 'required|string|max:255',
);
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $patient = Patient::find($id);
        if(!$patient){
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $patient->firstname = $request->firstname;
		$patient->lastname = $request->lastname;
		$patient->email = $request->email;
		$patient->contact = $request->contact;
        return response()->json([
            'data' => new PatientResource($patient),
            'code' => 200
        ]);
    }

    /**
 * @OA\Delete(
 *      path="/api/v1/patient/{id}",
 *      security={{"api":{}}},
 *      operationId="patient_delete",
 *      summary="Delete a Patient by ID",
 *      description="Remove a specific Patient by its ID",
 *      tags={"Patient API CRUD"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the Patient to delete",
 *          @OA\Schema(type="integer")
 *      ),
 *          @OA\Response(response=200,description="Successful operation",
 *           @OA\JsonContent(ref="#/components/schemas/Patient"),
 *      ),
 *      @OA\Response(response=404,description="Not found",
 *          @OA\JsonContent(ref="#/components/schemas/Error"),
 *      ),
 * )
 */
    public function destroy(string $id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            return response()->json([
                'message' => "Patient not found",
                'code' => 404,
            ]);
        }
        $patient->delete();
        return response()->json([
            'data' => new PatientResource($patient),
            'code' => 200
        ]);
    }
}
