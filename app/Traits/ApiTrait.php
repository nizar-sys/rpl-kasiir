<?php
namespace App\Traits;

trait ApiTrait
{
    /**
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, $message = '', $status = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public function error($message = '')
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ]);
    }
}