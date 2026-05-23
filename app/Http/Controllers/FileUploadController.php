<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkDeleteFileUploadRequest;
use App\Http\Requests\StoreFileUploadRequest;
use App\Http\Resources\FileUploadCollection;
use App\Models\FileUpload;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function __construct(private FileUploadService $service)
    {
    }

    public function index(Request $request)
    {
        $fileUploadCollection = new FileUploadCollection($this->service->showAllFileUpload($request->user()));
        return $fileUploadCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }
    public function store(StoreFileUploadRequest $request)
    {
        try {
            $fileUploadCollection = new FileUploadCollection($this->service->uploadFile($request->validated(), $request->user()->id));
            return $fileUploadCollection->additional([
                'success' => true,
                'message' => 'File uploaded successfully',
                'code' => 201,
            ]);
        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    public function download(FileUpload $fileUpload)
    {
        try {
            $path = $this->service->getDownloadPath($fileUpload);
            if (!file_exists($path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'resource not found',
                    'code' => 404,
                ], 404);
            }

            return response()->download($path, $fileUpload->original_file_name);

        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    public function destroy(BulkDeleteFileUploadRequest $request)
    {
        try {
            $attributes = $request->validated()['uuids'];

            $files = $this->service->checkFileOwnership($attributes, $request->user()->id);

            $validFileIds = $files->pluck('id')->toArray();

            $this->service->deleteFile($validFileIds);
            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully',
                'code' => 200,
                'deleted_count' => count($validFileIds),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
