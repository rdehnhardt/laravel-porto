<?php

namespace Porto\Traits;

use Fractal;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function transform($data, $transformer = null): array
    {
        $fractal = Fractal::create($data, $transformer);

        return $fractal->toArray();
    }

    public function json($message, $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    public function created($message = null, $status = 201, array $headers = [], $options = 0): JsonResponse
    {
        return $this->json($message, $status, $headers, $options);
    }

    public function accepted($message = null, $status = 202, array $headers = [], $options = 0): JsonResponse
    {
        return $this->json($message, $status, $headers, $options);
    }

    public function forbiden($message = null, $status = 401, array $headers = [], $options = 0): JsonResponse
    {
        return $this->json($message, $status, $headers, $options);
    }

    public function error($message = null, $status = 500, array $headers = [], $options = 0): JsonResponse
    {
        return $this->json($message, $status, $headers, $options);
    }

    public function deleted(): JsonResponse
    {
        return $this->accepted();
    }

    public function noContent($status = 204): JsonResponse
    {
        return $this->json(null, $status);
    }
}

