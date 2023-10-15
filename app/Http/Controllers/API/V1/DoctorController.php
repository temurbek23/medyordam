<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Http\Resources\DoctorResource;
use App\Http\ValidatorResponse;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Doctor",
 *     title="Doctor title",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="firstname", type="string"),
 *				@OA\Property(property="lastname", type="string"),
 *				@OA\Property(property="email", type="string"),
 *				@OA\Property(property="contact", type="string"),
 *				@OA\Property(property="photo", type="file"),
 *				@OA\Property(property="about", type="string"),
 *				@OA\Property(property="education", type="string"),
 *				@OA\Property(property="practice", type="string"),
 *				@OA\Property(property="residency", type="string"),
 *				@OA\Property(property="created_at", type="string", format="date-time"),
 *				@OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */

class DoctorController extends Controller
{
    /**
     *@OA\Get(
     *      path="/api/v1/doctor",
     *      security={{"api":{}}},
     *      operationId="doctor_index",
     *      summary="Get all Doctors",
     *      description="Retrieve all Doctors",
     *      tags={"Doctor API CRUD"},
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Doctor"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function index()
    {
        $doctorS = Doctor::with('professions')->get();
        return response()->json([
            'data' => DoctorResource::collection($doctorS),
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/doctor/{id}",
     *      security={{"api":{}}},
     *      operationId="doctor_show",
     *      summary="Get a single Doctor by ID",
     *      description="Retrieve a single Doctor by its ID",
     *      tags={"Doctor API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Doctor to retrieve",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Doctor"),
     *     ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function show(string $id)
    {
        $doctor = Doctor::with('professions')->find($id);
        if (!$doctor) {
            return response()->json([
                'message' => "Doctor not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new DoctorResource($doctor),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/doctor",
     *      security={{"api":{}}},
     *      operationId="doctor_store",
     *      summary="Create a new Doctor",
     *      description="Add a new Doctor",
     *      tags={"Doctor API CRUD"},
     *      @OA\RequestBody(required=true, description="Doctor save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"firstname", "lastname", "password", "email", "contact", "photo", "about", "education", "practice", "residency"},
     *                  @OA\Property(property="firstname", type="string", example=""),
     *					@OA\Property(property="lastname", type="string", example=""),
     *					@OA\Property(property="password", type="string", example=""),
     *					@OA\Property(property="email", type="string", example=""),
     *					@OA\Property(property="contact", type="string", example=""),
     *					@OA\Property(property="photo", type="file", example=""),
     *					@OA\Property(property="about", type="string", example=""),
     *					@OA\Property(property="education", type="string", example=""),
     *					@OA\Property(property="practice", type="string", example=""),
     *					@OA\Property(property="residency", type="string", example="")
     *              )
     *          )
     *      ),
     *       @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Doctor"),
     *      ),
     *       @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function store(Request $request)
    {
        $rules = array(
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'password' => 'required|string|max:255|min:8',
            'email' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'photo' => 'required|mimes:jpg,png,webp',
            'about' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'practice' => 'required|string|max:255',
            'residency' => 'required|string|max:255',
        );
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $doctor = new Doctor();
        $doctor->firstname = $request->firstname;
        $doctor->lastname = $request->lastname;
        $doctor->password = $request->password;
        $doctor->email = $request->email;
        $doctor->contact = $request->contact;
        if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time() . "_" . $file->getClientOriginalName();
            if ($doctor->photo) {
                $oldFilePath = 'uploads/photo/' . basename($doctor->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $doctor->photo = asset("uploads/photo/$filename");
        }
        $doctor->about = $request->about;
        $doctor->education = $request->education;
        $doctor->practice = $request->practice;
        $doctor->residency = $request->residency;
        $doctor->save();
        return response()->json([
            'data' => new DoctorResource($doctor),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/doctor/{id}",
     *      security={{"api":{}}},
     *      operationId="doctor_update",
     *      summary="Update a Doctor by ID",
     *      description="Update a specific Doctor by its ID",
     *      tags={"Doctor API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Doctor to update",
     *          @OA\Schema(type="integer")
     *      ),
     *           @OA\RequestBody(required=true, description="Doctor save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"firstname", "lastname", "email", "contact", "photo", "about", "education", "practice", "residency"},
     *                  @OA\Property(property="firstname", type="string", example=""),
     *					@OA\Property(property="lastname", type="string", example=""),
     *					@OA\Property(property="email", type="string", example=""),
     *					@OA\Property(property="contact", type="string", example=""),
     *					@OA\Property(property="photo", type="file", example=""),
     *					@OA\Property(property="about", type="string", example=""),
     *					@OA\Property(property="education", type="string", example=""),
     *					@OA\Property(property="practice", type="string", example=""),
     *					@OA\Property(property="residency", type="string", example=""),
     *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Doctor"),
     *      ),
     *     @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function update(Request $request, string $id)
    {
        $rules = array(
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'photo' => 'required|mimes:jpg,png,webp',
            'about' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'practice' => 'required|string|max:255',
            'residency' => 'required|string|max:255',
        );
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json([
                'message' => "Event not found",
                'code' => 404
            ]);
        }
        $doctor->firstname = $request->firstname;
        $doctor->lastname = $request->lastname;
        $doctor->email = $request->email;
        $doctor->contact = $request->contact;
        if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time() . "_" . $file->getClientOriginalName();
            if ($doctor->photo) {
                $oldFilePath = 'uploads/photo/' . basename($doctor->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $doctor->photo = asset("uploads/photo/$filename");
        }
        $doctor->about = $request->about;
        $doctor->education = $request->education;
        $doctor->practice = $request->practice;
        $doctor->residency = $request->residency;
        return response()->json([
            'data' => new DoctorResource($doctor),
            'code' => 200
        ]);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/doctor/{id}",
     *      security={{"api":{}}},
     *      operationId="doctor_delete",
     *      summary="Delete a Doctor by ID",
     *      description="Remove a specific Doctor by its ID",
     *      tags={"Doctor API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Doctor to delete",
     *          @OA\Schema(type="integer")
     *      ),
     *          @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Doctor"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json([
                'message' => "Doctor not found",
                'code' => 404,
            ]);
        }
        $doctor->delete();
        return response()->json([
            'data' => new DoctorResource($doctor),
            'code' => 200
        ]);
    }
}
