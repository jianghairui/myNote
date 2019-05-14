<?php
require_once __DIR__ . '/autoload.php';

use OSS\OssClient;
use OSS\Core\OssException;
use OSS\Core\OssUtil;
class Alioss {

     // 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
    protected   $accessKeyId;
    protected   $accessKeySecret;
// Endpoint以杭州为例，其它Region请按实际情况填写。
    protected   $endpoint;
// 存储空间名称
    protected   $bucket;

    protected   $ossClient;

    public function __construct() {
        $this->accessKeyId = "LTAIjRt8GKOEX4fQ";
        $this->accessKeySecret = "czAWdvpkbGz86C00mSI1jcQ9PMzaGs";
        $this->endpoint = "http://oss-cn-qingdao.aliyuncs.com";
        $this->bucket = "oss-jianghairui-01";
        try {
            $this->ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
            // 设置Socket层传输数据的超时时间，单位秒，默认5184000秒。
            $this->ossClient->setTimeout(3600);
            // 设置建立连接的超时时间，单位秒，默认10秒。
            $this->ossClient->setConnectTimeout(10);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function getFileList() {
        try {
            $listObjectInfo = $this->ossClient->listObjects($this->bucket);
            $objectList = $listObjectInfo->getObjectList();
            if (!empty($objectList)) {
                foreach ($objectList as $objectInfo) {
                    print($objectInfo->getKey() . "\t" . $objectInfo->getSize() . "\t" . $objectInfo->getLastModified() . "\n");
                }
            }
        } catch (OssException $e) {
            die($e->getMessage());
        }
        return $objectList;
    }

    public function uploadFile() {
        // 文件名称
        $object = time() . '.jpg';
        $filePath = "./a.jpg";
        try {
            $res = $this->ossClient->uploadFile($this->bucket, $object, $filePath);
        } catch (OssException $e) {
            die($e->getMessage());
        }
        return $res;
    }

    public function createBucket() {
        try {
            $res = $this->ossClient->createBucket($this->bucket);
        } catch (OssException $e) {
            die($e->getMessage());
        }
        return $res;
    }

    public function getBucketList() {
        try {
            $bucketListInfo = $this->ossClient->listBuckets();
            $bucketList = $bucketListInfo->getBucketList();
            $arr = [];
            foreach($bucketList as &$bucket) {
                $data['location'] =  $bucket->getLocation();
                $data['name'] =  $bucket->getName();
                $data['createDate'] =  $bucket->getCreateDate();
                $arr[] = $data;
            }
        } catch (OssException $e) {
            die($e->getMessage());
        }
        return $arr;
    }

    public function multiPartUpload() {
        // 文件名称
        $object = "b" . time() . ".mp4";
        $uploadFile = "./b.mp4";
        /**
         *  步骤1：初始化一个分片上传事件，获取uploadId。
         */
        try{
            $ossClient = $this->ossClient;
            $bucket = $this->bucket;
            //返回uploadId，它是分片上传事件的唯一标识，您可以根据这个ID来发起相关的操作，如取消分片上传、查询分片上传等。
            $uploadId = $ossClient->initiateMultipartUpload($bucket, $object);
        } catch(OssException $e) {
            die($e->getMessage() . "\n");
        }
        echo $uploadId . PHP_EOL;
        /*
         * 步骤2：上传分片。
         */
        $partSize = 1024 * 1024;
        $uploadFileSize = filesize($uploadFile);
        $pieces = $ossClient->generateMultiuploadParts($uploadFileSize, $partSize);
        $responseUploadPart = array();
        $uploadPosition = 0;
        $isCheckMd5 = true;
        foreach ($pieces as $i => $piece) {
            $fromPos = $uploadPosition + (integer)$piece[$ossClient::OSS_SEEK_TO];
            $toPos = (integer)$piece[$ossClient::OSS_LENGTH] + $fromPos - 1;
            $upOptions = array(
                $ossClient::OSS_FILE_UPLOAD => $uploadFile,
                $ossClient::OSS_PART_NUM => ($i + 1),
                $ossClient::OSS_SEEK_TO => $fromPos,
                $ossClient::OSS_LENGTH => $toPos - $fromPos + 1,
                $ossClient::OSS_CHECK_MD5 => $isCheckMd5,
            );
            // MD5校验。
            if ($isCheckMd5) {
                $contentMd5 = OssUtil::getMd5SumForFile($uploadFile, $fromPos, $toPos);
                $upOptions[$ossClient::OSS_CONTENT_MD5] = $contentMd5;
            }
            try {
                // 上传分片。
                $responseUploadPart[] = $ossClient->uploadPart($bucket, $object, $uploadId, $upOptions);
            } catch(OssException $e) {
                die($e->getMessage() . "\n");
            }
            echo __FUNCTION__ . ": initiateMultipartUpload, uploadPart - part#{$i} OK" . PHP_EOL;
        }
// $uploadParts是由每个分片的ETag和分片号（PartNumber）组成的数组。
        $uploadParts = array();
        foreach ($responseUploadPart as $i => $eTag) {
            $uploadParts[] = array(
                'PartNumber' => ($i + 1),
                'ETag' => $eTag,
            );
        }
        /**
         * 步骤3：完成上传。
         */
        try {
            // 在执行该操作时，需要提供所有有效的$uploadParts。OSS收到提交的$uploadParts后，会逐一验证每个分片的有效性。当所有的数据分片验证通过后，OSS将把这些分片组合成一个完整的文件。
            $ossClient->completeMultipartUpload($bucket, $object, $uploadId, $uploadParts);
        }  catch(OssException $e) {
            die($e->getMessage() . "\n");
        }
        echo __FUNCTION__ . ": completeMultipartUpload OK" . PHP_EOL;

    }

    public function test() {

    }


}

$oss = new Alioss();
$res = $oss->multiPartUpload();
print_r($res);

















function p($Arr) {
    echo '<pre>';
    print_r($Arr);
    echo '</pre>';
}
