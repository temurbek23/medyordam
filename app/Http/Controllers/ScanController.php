<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiseaseResource;
use App\Http\ValidatorResponse;
use App\Models\Disease;
use Illuminate\Http\Request;

class ScanController extends Controller
{

    /**
     * @OA\Post(
     *      path="/api/v1/scan",
     *      security={{"api":{}}},
     *      operationId="scan_photo",
     *      summary="Scan a photo",
     *      description="Scan a photo",
     *      tags={"Scan API"},
     *      @OA\RequestBody(required=true, description="Scan photo",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"photo"},
     *                  @OA\Property(property="photo", type="photo", example=""),
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

    public function scan(Request $request)
    {

        $rules = array(
            'photo' => 'required|mimes:png,jpg,jpeg,webp',
        );

        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }

        if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time() . "_" . $file->getClientOriginalName();
            $file->move("uploads/photo", $filename);
        }

        $disease = Disease::first();

        return response()->json([
            'data' => new DiseaseResource($disease),
            'code' => 200
        ]);
    }
}
