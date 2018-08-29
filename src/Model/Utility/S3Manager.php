<?php
namespace App\Model\Utility;

use Cake\Log\Log;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class S3Manager
{

    private $_s3Client;

    /**
     * __construct method
     *
     * @return void
     */
    function __construct()
    {
        $this->_s3Client = new S3Client([
            'credentials' => [
                'key' => env('ACCESS_KEY'),
                'secret' => env('SECRET_KEY'),
            ],
            'region' => env('REGION'),
            'version' => 'latest'
        ]);
    }

    /**
     * putObject method
     *
     * @param string $directory
     * @param string $baseFileName
     * @param string $newFileName
     * @return boolean
     */
    public function putObject($directory, $baseFileName, $newFileName)
    {
        $ret = 'No';
        try {
            $fullPath = $directory;
            $result = $this->_s3Client->putObject([
                'ACL' => 'public-read',
                'Bucket' => env('BUCKET_NAME'),
                'Key' => env('IMAGE_PATH') . $newFileName,
                'SourceFile' => $fullPath,
                'ContentType' => mime_content_type($fullPath),
            ]);
            $ret = $result['ObjectURL'];
        } catch (S3Exception $e) {
            Log::error($e->getMessage());
        }
        return $ret;
    }

    /**
     * deleteObject method
     *
     * @param string $deleteFileName
     * @return boolean
     */
    public function deleteObject($deleteFileName)
    {
        $ret = false;
        try {
            $result = $this->_s3Client->deleteObject([
                'Bucket' => env('BUCKET_NAME'),
                'Key' => env('IMAGE_PATH').$deleteFileName
            ]);
            $ret = true;
        } catch(S3Exception $e) {
            Log::error($e->getMessage());
        }
        return $ret;
    }
}
