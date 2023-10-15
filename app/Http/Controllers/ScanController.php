<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiseaseResource;
use App\Http\ValidatorResponse;
use App\Models\Disease;
use App\Models\Symptom;
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
     *              @OA\Schema(type="object", required={"symptom"},
     *                  @OA\Property(property="symptom", type="string", example="cut"),
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
            'symptom' => 'required|string',
        );

        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }

        $symptom = Symptom::where('name', $request->symptom)->first();

        if (!$symptom)
            return response()->json([
                'message' => 'Symptom not found',
                'code' => 404
            ]);

        return response()->json([
            'data' => new DiseaseResource($symptom->diseases()->first()),
            'code' => 200
        ]);
    }
}
