<?php

namespace ERP\Http\Controllers;

use Illuminate\Http\Request;
use AWS;
use Aws\Rekognition\RekognitionClient;

class TestController extends Controller
{
    //
    public function test()
    {
    	/*$s3 = AWS::createClient('s3');
		$file = "test.jpg";
		$file_url = $s3->getObjectUrl(env('AWS_BUCKET'), $file);

		$client = AWS::createClient('rekognition');
		$result = $client->getEndpoint();
		

		$client = new RekognitionClient(config('aws'));
		$rekognition = RekognitionClient::factory(array(
			'region'	=> config('aws.region'),
			'version'	=> 'latest'
		));

		// now we need to run rekognition over this
		$labels = $rekognition->detectLabels([
			'Image'		=> [
				'S3Object'	=> [
					'Bucket'	=> env('AWS_BUCKET'),
					'Name'		=> 'test.jpg',
					],
				],
		]);
		dd($labels);

		$result = $client->compareFaces([
		    'SimilarityThreshold' => 90,
		    'SourceImage' => [
		        'S3Object' => [
		            'Bucket' => env('AWS_BUCKET'),
		            'Name' => 'test.jpg',
		        ],
		    ],
		    'TargetImage' => [
		        'S3Object' => [
		            'Bucket' => env('AWS_BUCKET'),
		            'Name' => 'test.jpg',
		        ],
		    ],
		]);
    	dd($result);
    	*/
    }
}
