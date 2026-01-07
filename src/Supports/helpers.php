<?php


use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Shope\Core\Exceptions\CustomException;

if (! function_exists('newUuid')) {
    function newUuid()
    {
        return Str::ulid(); // time sortable
    }
}

if (! function_exists('ResponseSuccess')) {
    function ResponseSuccess($data, $message = null, $jsonStatus = Response::HTTP_OK)
    {
        return response()->json(['success' => true, 'data' => $data, 'message' => $message], $jsonStatus);
    }
}

if (! function_exists('ResponseError')) {
    function ResponseError($message = null, $jsonStatus = Response::HTTP_INTERNAL_SERVER_ERROR, $throwable = null, $resource = null)
    {
        if ($throwable) {
            if (! $throwable instanceof CustomException) {
                Log::error($throwable);
                //Log::channel('mail')->error($throwable);
            } else {
                Log::error($throwable->getMessage());
            }
        } else {
            $message = __($message ?? 'Something went wrong');
            Log::error($message);
            //Log::channel('mail')->error($message);
        }

        if ($throwable && $throwable instanceof CustomException) {
            $jsonStatus = $throwable->getStatusCode();
            $message    = __($throwable->getMessage());
        } elseif ($throwable && $throwable instanceof QueryException) {
            $message = 'A database error occurred.Please try again';
        }

        if (! is_int($jsonStatus) || $jsonStatus < 100 || $jsonStatus > 599) {
            $jsonStatus = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json([
            'success'  => false,
            'message'  => $message,
            'status'   => $jsonStatus
        ], $jsonStatus);
    }
}

if (! function_exists('paginateMetaData')) {
    function paginateMetaData($data)
    {
        if (! ($data instanceof LengthAwarePaginator || $data instanceof Paginator)) {
            return null;
        }

        $total_items = $data->total();
        $per_page    = $data->perPage();
        $total_pages = ceil($total_items / $per_page);

        return [
            'current_page' => $data->currentPage(),
            'last_page'    => $data->lastPage(),
            'per_page'     => $per_page,
            'total_items'  => $total_items,
            'total_pages'  => $total_pages,
            'from'         => $data->firstItem(),
            'to'           => $data->lastItem(),
        ];
    }
}


