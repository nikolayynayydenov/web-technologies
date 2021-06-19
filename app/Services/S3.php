<?php

namespace App\Services;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;
use \Exception;

class S3
{
    protected $s3Client;

    public function __construct()
    {
        $this->s3Client = new S3Client([
            'profile' => 'default',
            'region' => 'us-east-1',
            'version' => '2006-03-01'
        ]);
    }

    public function getAndSave($key)
    {
        $path = __DIR__ . '/../../public/images/avatars/' . $key;
        $bucket = 'photo-output';

        if ($this->s3Client->doesObjectExist($bucket, $key)) {
            $this->s3Client->getObject([
                'Bucket' => $bucket,
                'Key' => $key,
                'SaveAs' => $path
            ]);
        }
    }

    public function put($file, $key)
    {
        if (!preg_match('/-.*\./', $key)) {
            throw new Exception("key is in incorrent format");
        }

        return $this->s3Client->putObject([
            'Bucket' => 'photo-input',
            'Key' => $key,
            'SourceFile' => $file,
        ]);
    }
}
